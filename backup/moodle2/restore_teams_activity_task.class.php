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
 * Restore task.
 *
 * @package    mod_teams
 * @copyright  2021 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/restore_teams_stepslib.php');

/**
 * Restore task.
 *
 * @package    mod_teams
 * @copyright  2021 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_teams_activity_task extends restore_activity_task {

    /**
     * Define settings.
     */
    protected function define_my_settings() {
    }

    /**
     * Define steps.
     */
    protected function define_my_steps() {
        $this->add_step(new restore_teams_activity_structure_step('teams_structure', 'teams.xml'));
    }

    /**
     * Define the contents that must be decoded.
     */
    public static function define_decode_contents() {
        $contents = [];
        $contents[] = new restore_decode_content('teams', array('intro'), 'teams');
        return $contents;
    }

    /**
     * Decode link rules.
     */
    public static function define_decode_rules() {
        $rules = [];

        $rules[] = new restore_decode_rule('TEAMSINDEX', '/mod/teams/index.php?id=$1', 'course');
        $rules[] = new restore_decode_rule('TEAMSVIEWBYID', '/mod/teams/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('TEAMSVIEWBYU', '/mod/teams/view.php?u=$1', 'teams');

        return $rules;

    }

    /**
     * Define the restore log rules.
     */
    public static function define_restore_log_rules() {
        return [];
    }

    /**
     * Define the restore log rules for course.
     */
    public static function define_restore_log_rules_for_course() {
        return [];
    }

}
