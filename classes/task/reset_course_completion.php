<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Enrolment method "SEMCO" - Scheduled task for resetting course completion on subsequent enrolments.
 *
 * @package    enrol_semco
 * @copyright  2023 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_semco\task;
use core\task\scheduled_task;

defined('MOODLE_INTERNAL') || die();

// Require plugin library.
require_once($CFG->dirroot.'/enrol/semco/locallib.php');

// If local_recompletion is installed.
if (enrol_semco_check_local_recompletion() == true) {
    // Require local_recompletion plugin library.
    require_once($CFG->dirroot . '/local/recompletion/locallib.php');
}

/**
 * Enrolment method "SEMCO" - Scheduled task for resetting course completion on subsequent enrolments.
 *
 * @package    enrol_semco
 * @copyright  2023 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class reset_course_completion extends scheduled_task {

    /**
     * Return localised task name.
     *
     * @return string
     */
    public function get_name() {
        return get_string('task_resetcoursecompletion', 'enrol_semco');
    }

    /**
     * Run the main task.
     */
    public function execute() {
        global $DB;

        // If local_recompletion is not installed (or too old).
        if (enrol_semco_check_local_recompletion() != true) {
            // Trace.
            mtrace('local_recompletion is not installed or too old, so there is nothing to do here.');

            // Return.
            return true;
        }

        // If resetting course completion is not enabled at all.
        if (get_config('enrol_semco', 'resetcoursecompletion') != ENROL_SEMCO_SETTING_SELECT_YES) {
            // Trace.
            mtrace('Resetting course completion is not enabled at all in this plugin, so there is nothing to do here.');

            // Return.
            return true;
        }

        // Initialize return value.
        $erroroccurred = false;

        // Trace.
        mtrace('Checking for enrolments which have already started '.
            'and which should have been reset by the scheduled task but haven\'t.');

        // Get all enrolments which have already started
        // and which should have been reset by the scheduled task but haven't.
        $sql = 'SELECT e.id AS enrolid, e.customchar1 AS semcobookingid, ue.userid AS userid, e.courseid AS courseid,
                    ue.timestart AS timestart, e.customint1 AS hasbeenreset
                FROM {user_enrolments} ue
                JOIN {enrol} e ON e.id = ue.enrolid
                WHERE e.enrol = :enrol
                AND ue.timestart <= :timestart
                AND e.customint1 IS NULL
                AND EXISTS
                   (SELECT e2.id
                    FROM {user_enrolments} ue2
                    JOIN {enrol} e2 ON e2.id = ue2.enrolid
                    WHERE e2.enrol = :enrol2
                    AND ue2.userid = ue.userid
                    AND e2.courseid = e.courseid
                    AND ue2.id != ue.id
                    AND ue2.timeend < ue.timestart
                   )
                ORDER BY e.courseid ASC, ue.userid ASC, ue.timestart ASC';
        $sqlparams = ['enrol' => 'semco',
            'enrol2' => 'semco', // For a strange reason, Moodle does not allow to reuse SQL parameters.
            'timestart' => time(),
        ];
        $missedenrolments = $DB->get_records_sql($sql, $sqlparams);

        // If there are any missed enrolments.
        $missedenrolmentscount = count($missedenrolments);
        if ($missedenrolmentscount > 0) {
            // Trace.
            mtrace('... Found '.$missedenrolmentscount.' missed enrolments, that\'s bad.');

            // Get configured recipients.
            $recipients = get_users_from_config(get_config('enrol_semco', 'notifyonmissedreset'),
                    'enrol/semco:receiveresetnotifications');

            // If there are no configured recipients.
            if (!is_array($recipients) || count($recipients) <= 0) {
                // Get the site admin and add him to an array with one element.
                $recipients = [get_admin()];
            }

            // Get message subject.
            $messagesubject = get_string('notification_missedcoursereset_subj', 'enrol_semco');

            // Compose message body.
            $messagebody = get_string('notification_missedcoursereset_bodyheader', 'enrol_semco').PHP_EOL.PHP_EOL;
            foreach ($missedenrolments as $me) {
                $placeholders = ['userid' => $me->userid,
                        'courseid' => $me->courseid,
                        'semcobookingid' => $me->semcobookingid,
                        'timestart' => userdate($me->timestart),
                ];
                $messagebody .= '=> '.get_string('notification_missedcoursereset_bodyline', 'enrol_semco', $placeholders).PHP_EOL;
            }

            // Trace.
            mtrace('... I will send an information message to these users:');

            // Send mail.
            foreach ($recipients as $r) {
                // Trace.
                mtrace('... ... '.fullname($r));

                // Email the admin directly rather than putting these through the messaging system.
                email_to_user($r, \core_user::get_support_user(), $messagesubject, $messagebody);
            }

            // Trace.
            mtrace('... And I will ignore these enrolments in subquequent runs of this task.');

            // And remember the failure in the database
            // (this will not have any effect except that this course is not handled again in this task).
            foreach ($missedenrolments as $me) {
                $record = new \stdClass();
                $record->id = $me->enrolid;
                $record->customint1 = ENROL_SEMCO_COURSERESETRESULT_FAILED;
                $DB->update_record('enrol', $record);
            }

        } else {
            // Trace.
            mtrace('... Found 0 missed enrolments, that\'s good.');
        }

        // Trace.
        mtrace('Getting all enrolments which will start in the future '.
                'and which have at least one preceding enrolment which is already finished.');

        // Get all enrolments which will start in the future
        // and which have at least one preceding enrolment which is already finished
        // and which have not been handled by this task yet.
        $sql = 'SELECT e.id AS enrolid, e.customchar1 AS semcobookingid, ue.userid AS userid, e.courseid AS courseid,
                    ue.timestart AS timestart, e.customint1 AS hasbeenreset
                FROM {user_enrolments} ue
                JOIN {enrol} e ON e.id = ue.enrolid
                WHERE e.enrol = :enrol
                AND ue.timestart > :timestart
                AND e.customint1 IS NULL
                AND EXISTS
                   (SELECT e2.id
                    FROM {user_enrolments} ue2
                    JOIN {enrol} e2 ON e2.id = ue2.enrolid
                    WHERE e2.enrol = :enrol2
                    AND ue2.userid = ue.userid
                    AND e2.courseid = e.courseid
                    AND ue2.id != ue.id
                    AND ue2.timeend < ue.timestart
                   )
                ORDER BY e.courseid ASC, ue.userid ASC, ue.timestart ASC';
        $sqlparams = ['enrol' => 'semco',
                'enrol2' => 'semco', // For a strange reason, Moodle does not allow to reuse SQL parameters.
                'timestart' => time(),
        ];
        $upcomingenrolments = $DB->get_records_sql($sql, $sqlparams);

        // If there aren't any enrolments.
        $upcomingenrolmentscount = count($upcomingenrolments);
        if ($upcomingenrolmentscount == 0) {
            // Trace.
            mtrace('... Found 0 enrolments, so there is nothing to do here.');

            // Return.
            return true;
        } else {
            // Trace.
            mtrace('... Found '.count($upcomingenrolments).' enrolments which will now be iterated.');
        }

        // Initialize an array of processed courses.
        // This array will hold courseid-userid tuples of courses which have already been processed.
        $processedcourses = [];

        // Iterate over these enrolments.
        foreach ($upcomingenrolments as $e) {
            // Trace.
            mtrace('Looking at enrolment of user '.$e->userid.' in course '.$e->courseid.
                ' with SEMCO booking ID '.$e->semcobookingid.' starting at '.userdate($e->timestart));

            // If we have already processed another enrolment for this course and user.
            if (in_array($e->courseid.'-'.$e->userid, $processedcourses)) {
                // Skip this enrolment as we must not reset more than one enrolment per course and user in the future.
                // As the enrolments are sorted by timestart, we can be sure that the enrolment which has already been processed
                // is the first enrolment and we can now be sure that we can skip all the following enrolments.

                // Trace.
                mtrace('... Skip resetting course completion as an earlier enrolment for this course was processed already.');

                // And skip this enrolment.
                continue;
            }

            // If the enrolment still starts in less than the configured lead time.
            $leadtime = get_config('enrol_semco', 'resetleadtime');
            if ($e->timestart > time() + $leadtime) {
                // Trace.
                switch($leadtime) {
                    case HOURSECS:
                        $leadtimestring = 'one hour';
                        break;
                    case DAYSECS:
                        $leadtimestring = 'one day';
                        break;
                    case WEEKSECS:
                        $leadtimestring = 'one week';
                        break;
                }
                mtrace('... Skip resetting course completion as it\'s more than '.$leadtimestring.' until this enrolment starts.');

                // Remember this enrolment in the array of processed courses.
                $processedcourses[] = $e->courseid.'-'.$e->userid;

                // And skip this enrolment.
                continue;
            }

            // Get the recompletion config for this course.
            $recompletionconfig = (object) $DB->get_records_menu('local_recompletion_config',
                ['course' => $e->courseid], '', 'name, value');

            // If recompletion is not enabled at all.
            if (empty($recompletionconfig->recompletiontype)) {
                // Trace.
                mtrace('... Skip resetting course completion as course recompletion is not enabled at all in the '.
                        'course\'s recompletion settings.');

                // Remember this enrolment in the array of processed courses.
                $processedcourses[] = $e->courseid.'-'.$e->userid;

                // And remember the reset in the database.
                $record = new \stdClass();
                $record->id = $e->enrolid;
                $record->customint1 = ENROL_SEMCO_COURSERESETRESULT_SKIPPED;
                $DB->update_record('enrol', $record);

                // And skip this enrolment.
                continue;
            }

            // If recompletion is not set to OnDemand.
            if ($recompletionconfig->recompletiontype != \local_recompletion_recompletion_form::RECOMPLETION_TYPE_ONDEMAND) {
                // Trace.
                mtrace('... Skip resetting course completion as course recompletion is not set to OnDemand '.
                        'in the course\'s recompletion settings.');

                // Remember this enrolment in the array of processed courses.
                $processedcourses[] = $e->courseid.'-'.$e->userid;

                // And remember the reset in the database.
                $record = new \stdClass();
                $record->id = $e->enrolid;
                $record->customint1 = ENROL_SEMCO_COURSERESETRESULT_SKIPPED;
                $DB->update_record('enrol', $record);

                // And skip this enrolment.
                continue;
            }

            // Trace.
            mtrace('... Reset course completion as it\'s less than one hour until this enrolment starts.');

            // Get the local_recompletion reset task.
            $resettask = new \local_recompletion\task\check_recompletion();

            // Get the full course record.
            $course = get_course($e->courseid);

            // Trigger the reset and store the error output (which is an array).
            $reseterrors = $resettask->reset_user($e->userid, $course, $recompletionconfig);

            // If there was an error.
            if (!empty($reseterrors)) {
                // Trace: Just output the errors.
                mtrace('... ... An error occurred: ');
                foreach ($reseterrors as $re) {
                    mtrace('... ... '.$re);
                }

                // Remember this enrolment in the array of processed courses.
                $processedcourses[] = $e->courseid.'-'.$e->userid;

                // But let the scheduled task fail as we do not know if the failure was harmful or not.
                $erroroccurred = true;

                // Otherwise, if the reset seemed to be successful.
            } else {
                // Trace.
                mtrace('... ... Success.');

                // Remember this enrolment in the array of processed courses.
                $processedcourses[] = $e->courseid.'-'.$e->userid;

                // And remember the reset in the database.
                $record = new \stdClass();
                $record->id = $e->enrolid;
                $record->customint1 = ENROL_SEMCO_COURSERESETRESULT_SUCCESS;
                $DB->update_record('enrol', $record);
            }
        }

        return $erroroccurred;
    }
}
