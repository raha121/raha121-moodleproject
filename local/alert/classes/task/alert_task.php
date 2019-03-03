<?php
/**
 * // * Created by PhpStorm.
 * // * User: Raha121
 * // * Date: 8/3/2018
 * // * Time: 4:19 PM
 * // */

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
 * A scheduled task.
 *
 * @package    assignfeedback_editpdf
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_alert\task;

use stdClass;

/**
 * Simple task to convert submissions to pdf in the background.
 * @copyright  2016 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class alert_task extends \core\task\scheduled_task
{

    public function get_name()
    {
        return "newtask";
//        return get_string('New_task_1', 'local_alert');
    }


    public function processMail($alert, $assigment)
    {
        $alertone = $alert->alert1;
        $alerttwo = $alert->alert2;
        $alertthree = $alert->alert3;
        $alertfour = $alert->alert4;
        $alertfive = $alert->alert5;
        $isSend = false;
        if ($this->isTime($alertone, $assigment->duedate)) {
            $isSend = true;
        } elseif ($this->isTime($alerttwo, $assigment->duedate)) {
            $isSend = true;
        } elseif ($this->isTime($alertthree, $assigment->duedate)) {
            $isSend = true;
        } elseif ($this->isTime($alertfour, $assigment->duedate)) {
            $isSend = true;
        } elseif ($this->isTime($alertfive, $assigment->duedate)) {
            $isSend = true;
        }
        if ($isSend){
            $this->sendMail($alert,$assigment);
        }

    }

    public function isTime($alertTime, $duedate)
    {
        $result = false;
        $alert = explode('@',$alertTime);
        $date1=date_create(null);
        $date2=date_create($alert[1]);
        $diff=date_diff($date1,$date2);
        if($diff->h == 0 && $diff->i == 0){
            $date=date_create("2013-03-15");
            $date = date_timestamp_set($date,$duedate);
            if($alert[0]>0){
                date_sub($date,date_interval_create_from_date_string($alert[0]." days"));
            }
            $diff=date_diff($date1,$date);
            if($diff->y == 0 && $diff->m == 0 && $diff->d = 0){
                $result = true;
            }
        }
        return $result;
    }

    public function sendMail($alert, $assigment)
    {
        global $CFG, $DB;
        $userfrom = $DB->get_record('user', array('id' => 2));
        $users = $DB->get_records_sql("SELECT DISTINCT u.id AS userid
FROM mdl_enrol e
JOIN mdl_user_enrolments ue ON ue.enrolid = e.id
JOIN mdl_user u ON u.id = ue.userid
JOIN mdl_role_assignments ra ON ra.userid = u.id
JOIN mdl_role r ON r.id = ra.roleid AND r.shortname = 'student'
WHERE e.status = 0 AND u.suspended = 0 AND u.deleted = 0 AND e.courseid = $alert->course_id
  AND (ue.timeend = 0 OR ue.timeend > NOW()) AND ue.status = 0");
        foreach ($users as $user) {
            $userto = $DB->get_record('user', array('id' => $user));
            $a = email_to_user($userfrom, $userto, 'jadid', 'content');

        }
    }

    public function execute()
    {
        global $CFG, $DB;
        $alerts = $DB->get_records_sql('SELECT * FROM {local_alert_assign}');
        foreach ($alerts as $alert) {
            if ($alert->assignment_id == null) {
                $assignments = $DB->get_records_sql("select * from mdl_assign WHERE course = $alert->course_id");
                foreach ($assignments as $assignment) {
                    $this->processMail($alert, $assignment);
                }
            } else {
                $assignment = $DB->get_record('assign', array('id' => $alert->assignment_id, 'course' => $alert->course_id));
                $this->processMail($alert, $assignment);
            }
        }
    }
}
