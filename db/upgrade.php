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
 * Upgrade.
 *
 * @package    mod_teammeeting
 * @copyright  2021 Université Clermont Auvergne
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade function.
 *
 * @param int $oldversion The version we are upgrading from.
 * @return bool The result.
 */
function xmldb_teammeeting_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2022011003) {

        // Define field lastpresenterssync to be added to teammeeting.
        $table = new xmldb_table('teammeeting');
        $field = new xmldb_field('lastpresenterssync', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'creatorid');

        // Conditionally launch add field lastpresenterssync.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Teammeeting savepoint reached.
        upgrade_mod_savepoint(true, 2022011003, 'teammeeting');
    }

    if ($oldversion < 2022012700) {

        // Rename field creatorid on table teammeeting to usermodified.
        $table = new xmldb_table('teammeeting');
        $field = new xmldb_field('creatorid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'timemodified');

        // Launch rename field creatorid.
        $dbman->rename_field($table, $field, 'usermodified');

        // Teammeeting savepoint reached.
        upgrade_mod_savepoint(true, 2022012700, 'teammeeting');
    }

    if ($oldversion < 2022012701) {

        // Define field organiserid to be added to teammeeting.
        $table = new xmldb_table('teammeeting');
        $field = new xmldb_field('organiserid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'reusemeeting');

        // Conditionally launch add field organiserid.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Teammeeting savepoint reached.
        upgrade_mod_savepoint(true, 2022012701, 'teammeeting');
    }

    if ($oldversion < 2022012702) {

        // Changing nullability of field onlinemeetingid on table teammeeting to null.
        $table = new xmldb_table('teammeeting');
        $field = new xmldb_field('onlinemeetingid', XMLDB_TYPE_TEXT, null, null, null, null, null, 'organiserid');

        // Launch change of nullability for field onlinemeetingid.
        $dbman->change_field_notnull($table, $field);

        // Teammeeting savepoint reached.
        upgrade_mod_savepoint(true, 2022012702, 'teammeeting');
    }

    if ($oldversion < 2022012703) {

        // Changing nullability of field externalurl on table teammeeting to null.
        $table = new xmldb_table('teammeeting');
        $field = new xmldb_field('externalurl', XMLDB_TYPE_TEXT, null, null, null, null, null, 'onlinemeetingid');

        // Launch change of nullability for field externalurl.
        $dbman->change_field_notnull($table, $field);

        // Teammeeting savepoint reached.
        upgrade_mod_savepoint(true, 2022012703, 'teammeeting');
    }

    return true;
}
