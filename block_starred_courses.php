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
 * Temporary Enrolments Block.
 *
 * @package    block_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/blocks/starred_courses/lib.php');

class block_starred_courses extends block_base {

    public function init() {
        $this->title = get_string('title', 'block_starred_courses');
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
        global $CFG, $DB, $COURSE, $USER;

        $this->content = new stdClass();
        $this->content->text = "<a>TEST</a>";
        return $this->content;
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
