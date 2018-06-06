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
 * @package    local_fcl_starred_courses
 * @copyright  2018 onwards Lafayette College ITS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings = new admin_settingpage('local_fcl_starred_courses', get_string('pluginname', 'local_fcl_starred_courses'));

    $settings->add(new admin_setting_configcheckbox('local_fcl_starred_courses_display_toggle',
        get_string('settings:display_toggle:desc', 'local_fcl_starred_courses'),
        get_string('settings:display_toggle:subdesc', 'local_fcl_starred_courses'),
        1));
}
