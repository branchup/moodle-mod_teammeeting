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
 * Restore steps.
 *
 * @package    mod_teammeeting
 * @copyright  2021 Murdoch University
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Restore steps.
 *
 * @package    mod_teammeeting
 * @copyright  2021 Murdoch University
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_teammeeting_activity_structure_step extends restore_activity_structure_step {

    /**
     * Define structure.
     */
    protected function define_structure() {
        $paths = [
            new restore_path_element('teammeeting', '/activity/teammeeting')
        ];

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process element.
     *
     * @param array $data The data.
     */
    protected function process_teammeeting($data) {
        global $DB, $USER;

        $data = (object) $data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();
        $data->usermodified = $this->get_mappingid('user', $data->usermodified, $USER->id);

        // Restored activities do not restore their associated online meeting.
        $data->organiserid = null;
        $data->onlinemeetingid = null;
        $data->externalurl = null;
        $data->lastpresentersync = 0;

        // Insert the new record.
        $newitemid = $DB->insert_record('teammeeting', $data);

        $this->apply_activity_instance($newitemid);
    }

    /**
     * After execute.
     */
    protected function after_execute() {
        $this->add_related_files('mod_teammeeting', 'intro', null);
    }
}
