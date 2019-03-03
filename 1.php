<?php
/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 3/1/2019
 * Time: 4:07 PM
 */

$alert[0] =1;

$date1 = date_create(null,timezone_open("Asia/Tehran"));
$date=date_create("2013-03-15",timezone_open("Asia/Tehran"));
$date = date_timestamp_set($date,time());
    date_sub($date,date_interval_create_from_date_string($alert[0]." days"));

$diff=date_diff($date1,$date);

print_r($diff);
