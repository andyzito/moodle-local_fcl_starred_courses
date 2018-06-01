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
 * Starred Courses Block.
 *
 * @package    local_fcl_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/local/fcl_starred_courses/lib.php');

class filter {

    public $content = new stdClass();

    public function get_content($instance) {
        global $CFG, $COURSE, $USER;

        $this->content->courses = get_starred_courses($USER->id);

        // If we're in a course...
        if ($this->in_course()) {
            // If there's instance config, use that...
            if (property_exists($instance, 'starred_courses_display_toggle')) {
                if ($instance->config->starred_courses_display_toggle) {
                    $this->content->footer = $this->get_toggle_link();
                }
            // Otherwise default to global config value:
            } else if ($CFG->local_fcl_starred_courses_display_toggle) {
                $this->content->footer = $this->get_toggle_link();
            }
        }

        return $this->content;
    }

    public function in_course() {
        global $COURSE;

        return isset($COURSE) && $COURSE->id > 1;
    }

    // public function make_separator() {
    //     if ($this->content->items !== array()) {
    //         $this->content->items[] = $this->get_separator();
    //     }
    // }
    //
    // public function get_separator() {
    //     $separator = html_writer::span('', 'separator');
    //     return $separator;
    // }

    public function get_starred_courses($userid) {
        global $DB;

        $starred_courses = array();
        if ($starred_ids = $this->get_starred_course_ids($userid)) {
            foreach ($starred_ids as $courseid) {
                $course = $DB->get_record('course', array('id' => $courseid));
                $starred_courses[] = $course;
            }
        }
        return $starred_courses;
    }

    public function get_starred_course_ids($userid) {
        $starred = get_user_preferences('starred_courses', false, $userid);
        if ($starred = explode(',', $starred)) {
            return $starred;
        }
        return false;
    }

    public function get_toggle_link() {
        global $COURSE, $USER;

        $linktext = course_is_starred($USER->id, $COURSE->id) ? 'Unstar this course' : 'Star this course';

        $togglelink = html_writer::link(
                new moodle_url('/blocks/starred_courses/toggle_starred.php', array('courseid' => $COURSE->id)),
                $linktext,
                array('class' => 'toggle_link')
            );

        return $togglelink;
    }
}
