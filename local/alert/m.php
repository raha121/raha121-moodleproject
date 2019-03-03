<?php
/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 9/17/2018
 * Time: 12:01 PM
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->libdir .'/simplepie/moodle_simplepie.php');
//$courseid = optional_param('courseid', 0, PARAM_INT);

//
//if ($courseid) {
//    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
//    $PAGE->set_course($course);
//    $context = $PAGE->context;
//} else {
//    $context = context_system::instance();
//    $PAGE->set_context($context);
//}

//$managesharedfeeds = has_capability('block/rss_client:manageanyfeeds', $context);
//if (!$managesharedfeeds) {
//    require_capability('block/rss_client:manageownfeeds', $context);
//}

//if ($courseid) {
//    $urlparams['courseid'] = $courseid;
//}

$managefeeds = new moodle_url('/local/alert/m.php', $urlparams);

$PAGE->set_url('/local/alert/m.php', $urlparams);
$PAGE->set_pagelayout('admin');



//$mform = new feed_edit_form($PAGE->url, $isadding, $managesharedfeeds);
//$mform->set_data($rssrecord);


$alertTitle = 'alert';

    $PAGE->set_title($alertTitle);
    $PAGE->set_heading('bala');

    $PAGE->navbar->add('mmd');
    $PAGE->navbar->add('efs');
    $PAGE->navbar->add('ast', '#' );
    $PAGE->navbar->add($alertTitle);

    echo $OUTPUT->header();
    echo $OUTPUT->heading('title', 2);

echo 'mmd';
    echo $OUTPUT->footer();

