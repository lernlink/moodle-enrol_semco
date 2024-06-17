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
 * Enrolment method "SEMCO" - Hook: Allows plugins to modify the page navigation before the page output is started.
 *
 * @package    enrol_semco
 * @copyright  2024 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_semco\local\hook\output;

/**
 * Hook to allow plugins to modify the page navigation before the page output is started.
 *
 * @package    enrol_semco
 * @copyright  2024 Alexander Bias, lern.link GmbH <alexander.bias@lernlink.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class before_standard_top_of_body_html_generation {
    /**
     * Callback to modify the page navigation.
     *
     * @param \core\hook\output\before_standard_top_of_body_html_generation $hook
     */
    public static function callback(\core\hook\output\before_standard_top_of_body_html_generation $hook): void {
        global $CFG;

        // Require local library.
        require_once($CFG->dirroot . '/enrol/semco/locallib.php');

        // Call callback implementation.
        enrol_semco_callbackimpl_before_standard_top_of_body_html($hook);
    }
}
