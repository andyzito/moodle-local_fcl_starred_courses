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
 * starred_courses block settings
 *
 * @package    block_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

function initialize_starred_courses_user_preference($userid) {
    if (! get_user_preferences('starred_courses', false, $userid)) {
        set_user_preference('starred_courses', '', $userid);
    }
}

function course_is_starred($userid, $courseid) {
    if ($starred = get_starred_course_ids($userid)) {
        return in_array($courseid, $starred);
    }
    return false;
}

function star_course($userid, $courseid) {
    if ($starred = get_starred_course_ids($userid)) {
        if (! in_array($courseid, $starred)) {
            $starred[] = $courseid;
            $starred = implode(',', array_filter($starred));
            return set_user_preference('starred_courses', $starred, $userid);
        }
    }
    return false;
}

function unstar_course($userid, $courseid) {
    if ($starred = get_starred_course_ids($userid)) {
        if (($key = array_search($courseid, $starred)) !== false) {
            unset($starred[$key]);
            $starred = implode(',', array_filter($starred));
            return set_user_preference('starred_courses', $starred, $userid);
        }
    }
    return false;
}

function get_recent_courses($userid) {
    global $DB, $CFG;

    $limit = $CFG->block_starred_courses_recent_limit;

    $conditions = array("ac.userid=$userid");

    $sql = "SELECT ac.*
            FROM {user_lastaccess} ac";

    if ($CFG->block_starred_courses_recent_enrolled_only) {
        $sql .= " JOIN {course} c ON ac.courseid=c.id
                JOIN {enrol} e ON c.id=e.courseid
                JOIN {user_enrolments} ue ON e.id=ue.enrolid
                JOIN {user} u ON u.id=ue.userid";
        $conditions[] = "u.id=$userid";
    }

    $sql .= " WHERE " . implode(' AND ', $conditions);
    $sql .= " ORDER BY ac.timeaccess DESC";
    $sql .= $limit ? " LIMIT $limit" : '';
    $accesses = $DB->get_records_sql($sql);
    $courseids = array();
    foreach ($accesses as $access) {
        $courseids[] = $access->courseid;
    }
    $courses = array();
    $courseids = array_unique($courseids);
    foreach ($courseids as $courseid) {
        $course = $DB->get_record('course', array('id' => $courseid));
        $courses[] = $course;
    }
    return $courses;
}

function get_starred_course_ids($userid) {
    $starred = get_user_preferences('starred_courses', false, $userid);
    if ($starred = explode(',', $starred)) {
        return $starred;
    }
    return false;
}

function get_starred_courses($userid) {
    global $DB;

    $starred_courses = array();
    if ($starred_ids = get_starred_course_ids($userid)) {
        foreach ($starred_ids as $courseid) {
            $course = $DB->get_record('course', array('id' => $courseid));
            $starred_courses[] = $course;
        }
    }
    return $starred_courses;
}

function process_coursename($name) {
    global $CFG;

    $length = $CFG->block_starred_courses_name_length;

    if ($length > 0 && strlen($name) > $length) {
        $name = substr($name, 0, $length - 3);
        $name .= "...";
    }
    return $name;
}
