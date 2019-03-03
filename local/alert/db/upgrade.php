<?php
/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 12/5/2018
 * Time: 6:10 PM
 */
function xmldb_local_alert_upgrade($oldversion) {
    global $CFG,$DB;
    $dbman = $DB->get_manager();
    if ($oldversion < 2018070833) {
        // Define table local_alert_assign to be created
        $table = new xmldb_table('local_alert_assign');
        // Adding fields to table local_alert_assign:
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10',
            XMLDB_NOTNULL, XMLDB_SEQUENCE );

        $table->add_field('assignment_id', XMLDB_TYPE_INTEGER, '10',
            XMLDB_NULL, null );

        $table->add_field('alert1', XMLDB_TYPE_TEXT,
            XMLDB_NULL,null );

        $table->add_field('alert2', XMLDB_TYPE_TEXT,
            XMLDB_NULL,null );

        $table->add_field('alert3', XMLDB_TYPE_TEXT,
            XMLDB_NULL,null );

        $table->add_field('alert4', XMLDB_TYPE_TEXT,
            XMLDB_NULL,null );

        $table->add_field('alert5', XMLDB_TYPE_TEXT,
            XMLDB_NULL,null );

        $table->add_field('course_id', XMLDB_TYPE_INTEGER, '10',
            XMLDB_NULL, null );

        // Adding keys to table local_alert_assign.
        //primary key :
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        //foreign keys:
        $table->add_key('assignment_id',
            XMLDB_KEY_FOREIGN, array('assignment_id'), 'mdl_assign',
            array('id'));

        $table->add_key('course_id',
            XMLDB_KEY_FOREIGN, array('course_id'), 'mdl_course',
            array('id'));
        //unique key:
        $table->add_key('unique_key',
            XMLDB_KEY_UNIQUE, array('assignment_id', 'course_id'));
        //Create table:

        if (!$dbman->table_exists($table)) {

            $dbman->create_table($table);
        }

    }

    return true;
}