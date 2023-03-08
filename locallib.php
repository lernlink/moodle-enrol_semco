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
 * Enrolment method "SEMCO" - Local library
 *
 * @package    enrol_semco
 * @copyright  2022 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('ENROL_SEMCO_ROLEANDUSERNAME', 'semcowebservice');
define('ENROL_SEMCO_AUTH', 'webservice');
define('ENROL_SEMCO_SERVICENAME', 'enrol_semco');
define('ENROL_SEMCO_USERFIELDCATEGORY', 'SEMCO');
define('ENROL_SEMCO_USERFIELDNAME', 'semco_userid');

/**
 * Helper function to get the first student archetype role id.
 * This algorithm is needed two times during the plugin installation.
 *
 * @return int The first student archetype role id.
 */
function enrol_semco_get_firststudentroleid() {
    $studentarchetype = get_archetype_roles('student');
    if ($studentarchetype != false && count($studentarchetype) > 0) {
        $firststudentrole = array_shift($studentarchetype);
        $firststudentroleid = $firststudentrole->id;
    } else {
        $firststudentroleid = '';
    }

    return $firststudentroleid;
}

/**
 * Callback function to update the role-assignment permissions as soon as the enrol_semco/role was changed.
 */
function enrol_semco_roleassign_updatecallback() {
    global $DB;

    // Get the new setting value.
    $newsemcoroleid = get_config('enrol_semco', 'role');

    // Get the SEMCO webservice role ID from the database.
    $semcoroleid = $DB->get_field('role', 'id', array('shortname' => ENROL_SEMCO_ROLEANDUSERNAME));

    // If we have found a role ID.
    if (is_numeric($newsemcoroleid) && is_numeric($semcoroleid)) {
        // Check if the SEMCO webservice user is already allowed to assign the new setting's role.
        // (We have to check that because otherwise core_role_set_assign_allowed() would throw a 'duplicate key value violation').
        $alreadyallowed = $DB->record_exists('role_allow_assign', array('roleid' => $semcoroleid,
                'allowassign' => $newsemcoroleid));

        // If the role is not allowed yet.
        if ($alreadyallowed == false) {
            // Allow the SEMCO webservice role to assign the new role.
            core_role_set_assign_allowed($semcoroleid, $newsemcoroleid);
        }
    }
}
