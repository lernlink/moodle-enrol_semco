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
 * Enrolment method "SEMCO" - Language pack
 *
 * @package    enrol_semco
 * @copyright  2022 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'SEMCO';

// Enrolment instances.
$string['instance_namewithbookingid'] = 'SEMCO [Booking ID: {$a}]';
$string['instance_namewithoutbookingid'] = 'SEMCO';

// Admin settings.
$string['settings_connectioninfoheading'] = 'Connection information';
$string['settings_enrolmentheading'] = 'Enrolment process';
$string['settings_role'] = 'Role';
$string['settings_role_desc'] = 'With this setting, you control with which role SEMCO enrols users into courses. The configured role is mandatory for all users who are enrolled from SEMCO and cannot be overridden with the SEMCO enrolment webservice endpoint. Please note as well that changes of this setting will not have any effect on existing enrolments.';
$string['settings_tokeninfo'] = 'Webservice token';
$string['settings_tokeninfofound'] = 'The webservice token for the SEMCO webservice user is:<br /><strong>{$a}</strong><br />Please use this webservice token to configure the Moodle connection in SEMCO.';
$string['settings_tokeninfononefound'] = 'No existing webservice token was found for the SEMCO webservice user. Please create a token manually.';
$string['settings_wwwrootinfo'] = 'Moodle base URL';
$string['settings_wwwrootinfofound'] = 'The Moodle base URL for the SEMCO webservice connection is:<br /><strong>{$a}</strong><br />Please use this Moodle base URL to configure the Moodle connection in SEMCO.';

// Webservice errors.
$string['bookingidduplicate'] = 'There is already an enrolment instance with this SEMCO booking ID ({$a}).';
$string['bookingidduplicatemustchange'] = 'There is already an enrolment instance with this SEMCO booking ID ({$a}). If you want to edit the enrolment without changing the SEMCO booking ID, simply do not pass the booking ID as parameter. If you want to edit the enrolment and change the SEMCO booking ID, make sure that you do not set it to an ID which exists somewhere else in the system already.';
$string['bookingidempty'] = 'The SEMCO booking ID field must not be empty.';
$string['bookingoverlap'] = 'There is already an enrolment instance with an enrolment period which overlaps with the given enrolment period. However, overlapping enrolment periods are not supported.';
$string['coursenotexist'] = 'The given course ({$a}) does not exist.';
$string['enrolnoinstance'] = 'The SEMCO enrolment plugin instance associated to the given user enrolment instance ({$a}) does not exist.';
$string['enrolnouserinstance'] = 'The given user enrolment instance ({$a}) does not exist.';
$string['semcopluginnotenabled'] = 'The SEMCO enrolment plugin is not enabled currently.';
$string['semcopluginnotinstalled'] = 'The SEMCO enrolment plugin has not yet been installed.';
$string['timeendinvalid'] = 'The Timeend field must be greater than or equal to zero.';
$string['timestartinvalid'] = 'The Timestart field must be greater than or equal to zero.';
$string['usernotexist'] = 'The given user ({$a}) does not exist.';
$string['wsusercannotassign'] = 'You don\'t have the permission to assign this role ({$a->roleid}) to this user ({$a->userid}) in this course ({$a->courseid}).';

// Installer.
$string['installer_addedusertorole'] = 'The role \'SEMCO webservice\' was assigned to the user \'SEMCO webservice\' automatically.';
$string['installer_addedusertoservice'] = 'The user \'SEMCO webservice\' was added to the SEMCO webservice as allowed user automatically.';
$string['installer_createdrole'] = 'The role \'SEMCO webservice\' was created and properly configured automatially. This role is used for the SEMCO webservice user in Moodle.';
$string['installer_createdprofilefield'] = 'The user profile field \'SEMCO user ID\' was created and properly configured automatially. This user profile field is used for Moodle users which are created by the SEMCO webservice.';
$string['installer_createduser'] = 'The user \'SEMCO webservice\' was created automatially. This user is used to create the webservice token for SEMCO.';
$string['installer_createdusertoken'] = 'A webservice token was created automatically for the user \'SEMCO webservice\'. You can view it on the plugin\'s settings page.';
$string['installer_enabledauth'] = 'Moodle\'s webservice auth method has been enabled automatically to allow SEMCO to communicate with Moodle via webservices.';
$string['installer_enabledrest'] = 'Moodle\'s webservice REST protocol has been enabled automatically to allow SEMCO to communicate with Moodle via webservices.';
$string['installer_enabledws'] = 'Moodle\'s webservice subsystem has been enabled automatically to allow SEMCO to communicate with Moodle via webservices.';
$string['installer_enabledplugin'] = 'The SEMCO enrolment plugin has been enabled automatically.';
$string['installer_finalnotenoproblems'] = 'SEMCO should be able to communicate with Moodle now.';
$string['installer_finalnotewithproblems'] = 'As there were issues with the automatic configuration in the previous steps, SEMCO might not be able to communicate with Moodle yet. Please double-check all configurations manually.';
$string['installer_notcreatedprofilefield'] = 'The user profile field \'SEMCO user ID\' could not be created and properly configured automatically as it seems to exist already. Please verify the user field configuration manually.';
$string['installer_notcreatedrole'] = 'The role \'SEMCO webservice\' could not be created and properly configured automatically as it seems to exist already. Please verify the role configuration manually.';
$string['installer_notcreateduser'] = 'The user \'SEMCO webservice\' could not be created automatically as it seems to exist already. Please verify the user configuration manually.';
$string['installer_queuedcapabilitytask'] = 'The necessary capability \'webservice/rest:use\' could not be added to the role \'SEMCO webservice\' during the initial installation of Moodle as this capability did not exist yet (the webservice subsystem will be installed after this plugin). An ad-hoc task was queued to add this capability automatically as soon as the Moodle cron is running for the first time.';
$string['installer_roledescription'] = 'This is an internal role which has the single purpose to assign all necessary capabilities to the SEMCO webservice user. Do not assign this role to any other (especially not human) user.';
$string['installer_rolename'] = 'SEMCO webservice';
$string['installer_userfieldfullname'] = 'SEMCO User ID';
$string['installer_userfirstname'] = 'SEMCO';
$string['installer_userlastname'] = 'Webservice';
$string['uninstaller_remainenabled'] = 'The SEMCO enrolment plugin is removed and will not need Moodle\'s webservice subsystem and webservice auth method anymore. However, as the plugin uninstaller does not know, if any other plugins or features still need it, both will remain enabled. Please disable them manually if you do not need them anymore.';
$string['uninstaller_removedrole'] = 'The role \'SEMCO webservice\' was removed automatically.';
$string['uninstaller_removeduser'] = 'The user \'SEMCO webservice\' was removed automatically.';

// Capabilities.
$string['semco:editenrolment'] = 'Edit an existing SEMCO user enrolment';
$string['semco:enrol'] = 'Enrol SEMCO users into a course';
$string['semco:getenrolments'] = 'Get the existing SEMCO user enrolments from a course';
$string['semco:unenrol'] = 'Unenrol SEMCO users from a course';
$string['semco:usewebservice'] = 'Use the SEMCO enrolment webservices';

// Privacy API.
$string['privacy:metadata'] = 'The SEMCO enrolment plugin does not store any personal data.';
