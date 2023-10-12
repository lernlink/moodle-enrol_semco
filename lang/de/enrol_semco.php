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
$string['instance_namewithbookingid'] = 'SEMCO [Buchungsnummer: {$a}]';
$string['instance_namewithoutbookingid'] = 'SEMCO';

// Admin settings.
$string['settings_connectioninfoheading'] = 'Verbindungsdaten';
$string['settings_enrolmentheading'] = 'Einschreibungsprozess';
$string['settings_role'] = 'Rolle';
$string['settings_role_desc'] = 'Mit dieser Einstellung steuern Sie mit welcher Rolle SEMCO Nutzer in Kurse eingeschrieben werden. Die konfigurierte Rolle wird verpflichtend für alle Nutzer genutzt, welche von SEMCO heraus eingeschrieben werden und kann auch über den SEMCO Webservice-Endpunkt überschrieben werden. Bitte beachten Sie außerdem dass Änderungen an dieser Einstellung sich nicht auf schon erfolgte Einschreibungen auswirken werden.';
$string['settings_tokeninfo'] = 'Webservice Tokens';
$string['settings_tokeninfofound'] = 'Das Webserver Token des SEMCO Webservice Nutzer lautet:<br /><strong>{$a}</strong><br />Bitte nutzen Sie dieses Webservice Token um die Verbindung zu Moodle in SEMCO herzustellen.';
$string['settings_tokeninfononefound'] = 'Es wurde kein existierendes Webservice Token für den SEMCO Webservice Nutzer gefunden. Bitte legen Sie manuell ein Token an.';
$string['settings_wwwrootinfo'] = 'Moodle Basis-URL';
$string['settings_wwwrootinfofound'] = 'Die Moodle Basis-URL für die SEMCO Webservice Verbindung lautet:<br /><strong>{$a}</strong><br />Bitte nutzen Sie diese Basis-URL um die Verbindung zu Moodle in SEMCO herzustellen.';

// Installer.
$string['installer_addedusertorole'] = 'Die Rolle \'SEMCO Webservice\' wurde dem Nutezr \'SEMCO Webservice\' automatisch zugewiesen.';
$string['installer_addedusertoservice'] = 'Der Nutzer \'SEMCO Webservice\' wurde automatisch zum SEMCO Webservice als berechtigte Person zugewiesen.';
$string['installer_createdrole'] = 'Die Rolle \'SEMCO Webservice\' wurde automatisch erstellt und passend konfiguriert. Diese Rolle wurde für den SEMCO Webservice Nutzer in Moodle verwendet.';
$string['installer_createdprofilefield1'] = 'Das Nutzerprofilfeld \'SEMCO Nutzer ID\' wurde automatisch erstellt und passend konfiguriert. Dieses Nutzerprofilfeld wird für Moodle Nutzer, welche vom SEMCO Webservice angelegt werden, befüllt.';
$string['installer_createdprofilefield2'] = 'Das Nutzerprofilfeld \'SEMCO Nutzer Firma\' wurde automatisch erstellt und passend konfiguriert. Dieses Nutzerprofilfeld wird für Moodle Nutzer, welche vom SEMCO Webservice angelegt werden, befüllt.';
$string['installer_createdprofilefieldcategory'] = 'Die Nutzerprofilfeld-Kategorie \'SEMCO\' wurde automatisch erstellt und passend konfiguriert. Dieses Nutzerprofilfeld-Kategorie wird für Profilfelder im Zusammenhang mit Moodle Nutzern, welche vom SEMCO Webservice angelegt werden, genutzt.';
$string['installer_createduser'] = 'Der Nutzer \'SEMCO Webservice\' wurde automatisch erstellt. Dieser Nutzer wird dazu verwendet um das Webservice Token für SEMCO zu erstellen.';
$string['installer_createdusertoken'] = 'Ein Webservice Token für den Nutzer \'SEMCO Webservice\' wurde automatisch erstellt. Sie können das Token auf der Einstellungseite des Plugins ansehen.';
$string['installer_enabledauth'] = 'Die Authentifizierungsmethode \'Webservices\' wurde automatisch aktiviert damit SEMCO darüber mit den Moodle Webservices kommunizieren kann.';
$string['installer_enabledrest'] = 'Das Webservice Protokoll \'REST\' wurde automatisch aktiviert damit SEMCO darüber mit den Moodle Webservices kommunizieren kann.';
$string['installer_enabledws'] = 'Das Webservice Subsystem in Moodle wurde automatisch aktiviert damit SEMCO daürber mit den Moodle Webservices kommunizieren kann.';
$string['installer_enabledplugin'] = 'Das SEMCO Einschreibeplugin wurde automatisch aktiviert.';
$string['installer_finalnotenoproblems'] = 'SEMCO sollte nun mit Moodle kommunizieren können.';
$string['installer_finalnotewithproblems'] = 'Da in den vorangehenden Schritten leider Probleme bei der automatischen Konfiguration aufgetreten sind kann es sein dass SEMCO noch nicht mit Moodle kommunizieren kann. Bitte prüfen Sie alle nötigen Einstellungen manuell.';
$string['installer_notcreatedprofilefield1'] = 'Das Nutzerprofilfeld \'SEMCO Nutzer ID\' konnte nicht automatisch erstellt und passend konfiguriert werden da es anscheinend schon existiert. Bitte verifizieren Sie die Konfiguration des Nutzerprofilfelds manuell.';
$string['installer_notcreatedprofilefield2'] = 'Das Nutzerprofilfeld \'SEMCO Nutzer Firma\' konnte nicht automatisch erstellt und passend konfiguriert werden da es anscheinend schon existiert. Bitte verifizieren Sie die Konfiguration des Nutzerprofilfelds manuell.';
$string['installer_notcreatedrole'] = 'Die Rolle \'SEMCO Webservice\' konnte nicht automatisch erstellt und passend konfiguriert werden da sie anscheinend schon existiert. Bitte verifizieren Sie die Konfiguration der Rolle manuell.';
$string['installer_notcreateduser'] = 'Der Nutzer \'SEMCO Webservice\' konnte nicht automatisch erstellt werden da er anscheinend schon existiert. Bitte verifizieren Sie die Konfiguration des Nutzers manuell.';
$string['installer_queuedcapabilitytask'] = 'Das erforderliche Rechte \'webservice/rest:use\' konnte während der initialen Installation von Moodle nicht zur Rolle \'SEMCO Webservice\' hinzugefügt werden da dieses Recht noch nicht existiert (Das Webservice Subsystem wird erst nach diesem Plugin installiert werden). Ein Ad-hoc Task wurde eingeplant, welcher dieses Recht automatisch hinzufügen wird sobald der Moodle Cron das erste Mal läuft.';
$string['installer_roledescription'] = 'Dies ist eine interne Rolle mit dem einzigen Zweck dem SEMCO Webservice Nutzer die notwendigen Rechte zuzuweisen. Geben Sie diese Rolle keinem anderen Moodle Nutzer, vor allem keinen von Menschen genutzern Moodle Nutzerkonten.';
$string['installer_rolename'] = 'SEMCO Webservice';
$string['installer_userfield1fullname'] = 'SEMCO Nutzer ID';
$string['installer_userfield2fullname'] = 'SEMCO Nutzer Firma';
$string['installer_userfirstname'] = 'SEMCO';
$string['installer_userlastname'] = 'Webservice';
$string['uninstaller_remainenabled'] = 'Das SEMCO Einschreibeplugin wird entfernt und wird das Moodle Webservice Subsystem sowie die Authentifizierungsmethode \'Webservice\' nicht mehr benötigen. Da der Plugin Uninstaller jedoch nicht wissen kann ob andere Plugins oder aktivierte Funktionen in Moodle diese weiterhin brauchen werden sie weiterhin aktiviert bleiben. Bitte deaktivieren Sie sie selbst manuell falls Sie nicht mehr benötigt werden.';
$string['uninstaller_removedrole'] = 'Die Rolle \'SEMCO Webservice\' wurde automatisch entfernt.';
$string['uninstaller_removeduser'] = 'Der Nutzer \'SEMCO Webservice\' wurde automatisch entfernt.';

// Updater.
$string['updater_2023092601_addcapability'] = 'Die Rechte \'enrol/semco:getcoursecompletions\', \'moodle/course:viewhiddencourses\' and \'moodle/grade:viewall\' wurden während des Plugin-Updates automatisch zur Rolle \'SEMCO Webservice\' hinzugefügt.';
$string['updater_2023092605_addprofilefield'] = 'Das Nutzerprofilfeld \'SEMCO Nutzer Firma\' wurde während des Plugin-Updates automatisch erstellt und passend konfiguriert.';

// Capabilities.
$string['semco:editenrolment'] = 'Bearbeitung einer existierenden SEMCO Einschreibung';
$string['semco:enrol'] = 'Einschreibung eines SEMCO Nutzers in einen Kurs';
$string['semco:getenrolments'] = 'Abrufen der existierenden SEMCO Einschreibungen aus einem Kurs';
$string['semco:getcoursecompletions'] = 'Abrufen der (abgeschlossenen) Kursabschlüsse für Nutzer mit SEMCO Einschreibungen in einem Kurs';
$string['semco:unenrol'] = 'Ausschreibung eines SEMCO Nutzers aus einem Kurs';
$string['semco:usewebservice'] = 'Benutzung der SEMCO Webservices zur Einschreibung';

// Tasks.
$string['task_cleanorphaned'] = 'Bereinigung verwaister SEMCO Einschreibungsinstanzen.';

// Privacy API.
$string['privacy:metadata'] = 'Das SEMCO Einschreibeplugin speichert keinerlei personenbezogene Daten.';
