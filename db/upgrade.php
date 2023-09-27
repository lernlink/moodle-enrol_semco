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
 * Enrolment method "SEMCO" - Upgrade script
 *
 * @package    enrol_semco
 * @copyright  2023 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Require plugin library.
require_once($CFG->dirroot.'/enrol/semco/locallib.php');

/**
 * Function to upgrade enrol_semco
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_enrol_semco_upgrade($oldversion) {
    global $DB, $OUTPUT;

    if ($oldversion < 2022112801) {
        // Get system context.
        $systemcontext = context_system::instance();

        // Get the role ID of the SEMCO role.
        $semcoroleid = $DB->get_field('role', 'id', ['shortname' => ENROL_SEMCO_ROLEANDUSERNAME]);

        // Update the plugin's capabilities. The Moodle core updater would do this himself, but it would do it _after_ processing
        // this file. To be able to run assign_capability() now, we need to prepone this step ourselves.
        update_capabilities('enrol_semco');

        // Assign the newly created capability to the SEMCO role.
        assign_capability('enrol/semco:getcoursecompletions', CAP_ALLOW, $semcoroleid, $systemcontext->id);

        // Assign additional Moodle core capability to the SEMCO role.
        assign_capability('moodle/course:viewhiddencourses', CAP_ALLOW, $semcoroleid, $systemcontext->id);
        assign_capability('moodle/grade:viewall', CAP_ALLOW, $semcoroleid, $systemcontext->id);

        // And show a notification about that fact (this also looks fine in the CLI installer).
        $notification = new \core\output\notification(get_string('updater_2023092601_addcapability', 'enrol_semco'),
                \core\output\notification::NOTIFY_INFO);
        $notification->set_show_closebutton(false);
        echo $OUTPUT->render($notification);

        // Enrol_semco savepoint reached.
        upgrade_plugin_savepoint(true, 2022112801, 'enrol', 'semco');
    }

    return true;
}
