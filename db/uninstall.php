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
 * Enrolment method "SEMCO" - Uninstallation script
 *
 * @package    enrol_semco
 * @copyright  2022 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Require plugin library.
require_once($CFG->dirroot.'/enrol/semco/locallib.php');

// Require user library.
require_once($CFG->dirroot.'/user/lib.php');

/**
 * Uninstall the plugin.
 */
function xmldb_enrol_semco_uninstall() {
    global $DB, $OUTPUT;

    // If the SEMCO webservice role still exists.
    $rolerecord = $DB->get_record('role', array('shortname' => ENROL_SEMCO_ROLEANDUSERNAME));
    if ($rolerecord != false) {
        // Remove it.
        delete_role($rolerecord->id);

        // And show a notification about that fact (this also looks fine in the CLI installer).
        $notification = new \core\output\notification(get_string('uninstaller_removedrole', 'enrol_semco'),
                \core\output\notification::NOTIFY_INFO);
        $notification->set_show_closebutton(false);
        echo $OUTPUT->render($notification);
    }

    // If the SEMCO webservice user still exists.
    $userrecord = $DB->get_record('user', array('username' => ENROL_SEMCO_ROLEANDUSERNAME));
    if ($userrecord != false) {
        // Remove it.
        user_delete_user($userrecord);

        // And show a notification about that fact (this also looks fine in the CLI installer).
        $notification = new \core\output\notification(get_string('uninstaller_removeduser', 'enrol_semco'),
                \core\output\notification::NOTIFY_INFO);
        $notification->set_show_closebutton(false);
        echo $OUTPUT->render($notification);
    }

    // Show a notification about the fact that webservices and webservice auth will remain enabled
    // (this also looks fine in the CLI installer).
    $notification = new \core\output\notification(get_string('uninstaller_remainenabled', 'enrol_semco'),
            \core\output\notification::NOTIFY_INFO);
    $notification->set_show_closebutton(false);
    echo $OUTPUT->render($notification);
}
