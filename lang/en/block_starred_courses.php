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
 * Version details.
 *
 * @package    block_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['settings:display_starred:desc'] = 'Starred courses display mode';
$string['settings:display_starred:subdesc'] = '';
$string['settings:display_recent:desc'] = 'Recently accessed courses display mode';
$string['settings:display_recent:subdesc'] = '';
$string['settings:display_toggle:desc'] = 'Display star/unstar link?';
$string['settings:display_toggle:subdesc'] = 'Appears at the bottom of the block on course pages';
$string['settings:name_length:desc'] = 'Course name length limit';
$string['settings:name_length:subdesc'] = 'Course names longer than the limit will be ellipsis truncated.';
$string['settings:recent_enrolled_only:desc'] = 'Limit recent courses by user enrolment?';
$string['settings:recent_enrolled_only:subdesc'] = 'Display only recently accessed courses in which the user is enrolled.';
$string['settings:recent_limit:desc'] = 'Limit number of recent courses displayed';
$string['settings:recent_limit:subdesc'] = '';
$string['settings:starred_limit:desc'] = 'Limit number of starred courses displayed';
$string['settings:starred_limit:subdesc'] = '';
$string['settings:starred_limit_behavior:desc'] = 'Starred course limit exceeded behavior';
$string['settings:starred_limit_behavior:subdesc'] = 'If a user stars more courses than allowed by the starred course limit setting above, the block can simply not display any courses past the limit, display a "See all..." link, or wrap the course links in a scrollable box.';
$string['settings:exclude_starred_from_recent:desc'] = 'Exclude starred courses from recent courses?';
$string['settings:exclude_starred_from_recent:subdesc'] = "Don't display a course under the recent section if it is also a starred course";

$string['errors:front_page_star'] = 'Cannot star the front page!';

$string['notify:course_unstarred'] = 'The course {$a->fullname} has been unstarred.';
$string['notify:course_starred'] = 'The course {$a->fullname} has been starred.';

$string['content:starred_title'] = 'Starred Courses';
$string['content:recent_title'] = 'Recent Courses';

$string['pluginname'] = 'Starred courses';
$string['starred_courses:canconfig'] = 'Configure starred courses block';
$string['starred_courses:canstar'] = 'Star and unstar courses';
$string['starred_courses:addinstance'] = 'Add an instance of the starred courses block';
$string['starred_courses:myaddinstance'] = 'Add an instance of the starred courses block';
$string['title'] = 'Starred Courses';
