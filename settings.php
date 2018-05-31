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

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configcheckbox('block_starred_courses_display_starred',
        get_string('settings:display_starred:desc', 'block_starred_courses'),
        get_string('settings:display_starred:subdesc', 'block_starred_courses'),
        1));

    $settings->add(new admin_setting_configcheckbox('block_starred_courses_display_recent',
        get_string('settings:display_recent:desc', 'block_starred_courses'),
        get_string('settings:display_recent:subdesc', 'block_starred_courses'),
        0));

    $settings->add(new admin_setting_configcheckbox('block_starred_courses_display_toggle',
        get_string('settings:display_toggle:desc', 'block_starred_courses'),
        get_string('settings:display_toggle:subdesc', 'block_starred_courses'),
        1));

    $options = array(0 => 'Off');
    $range = range(10,50,5);
    $temp = array_combine($range, $range);
    $options = $options + $temp;

    $settings->add(new admin_setting_configselect('block_starred_courses_name_length',
        get_string('settings:name_length:desc', 'block_starred_courses'),
        get_string('settings:name_length:subdesc', 'block_starred_courses'),
        0,
        $options));

    $settings->add(new admin_setting_configcheckbox('block_starred_courses_recent_enrolled_only',
        get_string('settings:recent_enrolled_only:desc', 'block_starred_courses'),
        get_string('settings:recent_enrolled_only:subdesc', 'block_starred_courses'),
        0));

    $options = array('Off');
    $options = array_merge($options, range(1,10));

    $settings->add(new admin_setting_configselect('block_starred_courses_recent_limit',
        get_string('settings:recent_limit:desc', 'block_starred_courses'),
        get_string('settings:recent_limit:subdesc', 'block_starred_courses'),
        5,
        $options));

    $settings->add(new admin_setting_configselect('block_starred_courses_starred_limit',
        get_string('settings:starred_limit:desc', 'block_starred_courses'),
        get_string('settings:starred_limit:subdesc', 'block_starred_courses'),
        0,
        $options));

    $options = array(
        'Truncate list',
        'See all link',
        'Scrollbox',
    );

    $settings->add(new admin_setting_configselect('block_starred_courses_starred_limit_behavior',
        get_string('settings:starred_limit_behavior:desc', 'block_starred_courses'),
        get_string('settings:starred_limit_behavior:subdesc', 'block_starred_courses'),
        1,
        $options));
}
