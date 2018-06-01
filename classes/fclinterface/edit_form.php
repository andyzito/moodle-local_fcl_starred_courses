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
 * starred_courses instance settings
 *
 * @package    local_fcl_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_fcl_starred_courses\fclinterface;

defined('MOODLE_INTERNAL') || die;

class edit_form {

    // Get the name of this plugin for use in the settings header
    public function get_name() {
        return get_string('instance_settings:header_name', 'local_fcl_starred_courses');
    }

    // Get the title of this filter
    public function get_title() {
        // Either use the global title, or default to the title from lang strings.
        $title = $CFG->local_fcl_starred_courses_title ? $CFG->local_fcl_starred_courses_title : get_string('defaults:title', 'local_fcl_starred_courses');

        return $title;
    }

    /**
     * Builds the form to edit instance settings
     * @param MoodleQuickForm $mform
     */
    protected function specific_definition($mform) {
        $pluginname = 'local_fcl_starred_courses';

        // Set the title for the block.
        $fname = 'starred_courses_title';

        $mform->addElement('text', $fname, get_string('instance_settings:title', $pluginname));
        $mform->setDefault($fname, $title);
        $mform->setType($fname, PARAM_TEXT);
    }
}
