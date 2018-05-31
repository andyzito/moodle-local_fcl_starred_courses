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
 * @package    block_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/blocks/starred_courses/lib.php');

class block_starred_courses extends block_list {

    public function init() {
        global $USER;

        $this->title = get_string('title', 'block_starred_courses');
        initialize_starred_courses_user_preference($USER->id);
    }

    public function applicable_formats() {
        return array('all' => true);
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function has_config() {
        return true;
    }

    public function get_content() {
        global $CFG, $COURSE;

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        if ($CFG->block_starred_courses_display_starred) {
            $this->make_starred();
        }

        if ($CFG->block_starred_courses_display_recent) {
            $this->make_recent();
        }

        if ($CFG->block_starred_courses_display_toggle && $this->in_course()) {
            if ($this->content->items !== array()) {
                $this->content->items[] = $this->get_separator();
            }
            $this->content->footer = $this->get_toggle_link();
        }
        return $this->content;
    }

    public function in_course() {
        global $COURSE;

        return isset($COURSE) && $COURSE->id > 1;
    }

    public function get_separator() {
        $separator = html_writer::span('', 'separator');
        return $separator;
    }

    public function make_starred() {
        global $USER;

        if (! empty($starred = array_filter(get_starred_courses($USER->id)))) {
            foreach ($starred as $course) {
                $courselink = html_writer::link(
                    new moodle_url('/course/view.php', array('id' => $course->id)),
                    process_coursename($course->fullname)
                );
                $this->content->items[] = $courselink;
            }
        }
    }

    public function make_recent() {

    }

    public function get_toggle_link() {
        global $COURSE;

        $linktext = 'Star/unstar this course';

        $togglelink = html_writer::link(
                new moodle_url('/blocks/starred_courses/toggle_starred.php', array('courseid' => $COURSE->id)),
                $linktext,
                array('class' => 'toggle_link')
            );

        return $togglelink;
    }

    // public function content_is_trusted() {
    //     global $SCRIPT;
    //
    //     if (!$context = context::instance_by_id($this->instance->parentcontextid)) {
    //         return false;
    //     }
    //     // Find out if this block is on the profile page.
    //     if ($context->contextlevel == CONTEXT_USER) {
    //         if ($SCRIPT === '/my/index.php') {
    //             // This is exception - page is completely private, nobody else may see content there.
    //             // That is why we allow JS here.
    //             return true;
    //         } else {
    //             // No JS on public personal pages, it would be a big security issue.
    //             return false;
    //         }
    //     }
    //
    //     return true;
    // }
}
