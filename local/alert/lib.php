<?php
/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 7/8/2018
 * Time: 9:52 AM
 */
function local_alert_extend_settings_navigation(settings_navigation $settingsnav, context $context)
{
    $coursenode = $settingsnav->get('courseadmin');
    if ($coursenode) {
        $coursenode->add('alert', '../local/alert/activitylist.php?id='.$_GET['id']);


    }

}

