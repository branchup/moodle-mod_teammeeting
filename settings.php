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
 * Settings.
 *
 * @package    mod_teammeeting
 * @copyright  2020 Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configduration('mod_teammeeting/meetingdefaultduration',
        get_string('meetingdefaultduration', 'mod_teammeeting'),
        get_string('meetingdefaultduration_help', 'mod_teammeeting') ,
        2 * HOURSECS,
        HOURSECS
    ));
    $settings->add(new admin_setting_configcheckbox('mod_teammeeting/prefixonlinemeetingname',
        get_string('prefixonlinemeetingname', 'mod_teammeeting'),
        get_string('prefixonlinemeetingname_help', 'mod_teammeeting') ,
        0
    ));
}
