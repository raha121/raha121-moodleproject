<?php


/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 7/8/2018
 * Time: 9:52 AM
 */


global $DB, $USER, $COURSE, $CFG, $PAGE;
require_once("C:\wamp64\www\moodle\config.php");
//echo "C:\wamp64\www\moodle\lib\modinfolib.php";
require_once("C:\wamp64\www\moodle\lib\datalib.php");
require_once("C:\wamp64\www\moodle\local\alert\activitylist.php");
//$activities = get_course_mods(3);
require_once("$CFG->libdir/formslib.php");
require_once($CFG->libdir . '/simplepie/moodle_simplepie.php');


class assignment_form extends moodleform
{
    //Add elements to form
    public function definition()
    {
        global $CFG;
        global $DB;
        global $USER;


        echo ' <h1>تنظیمات هشدارها</h1>';
        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('html', '<input type="checkbox" name="isf" id="isf" style="display: none">');

        $assignmentname = $DB->
        get_records_sql('SELECT * FROM {assign} WHERE course = ' . $_GET['id'] . '
            ORDER BY id');


        //        $alerts = $DB->
//        get_records_sql('SELECT * FROM {local_alert_assign} WHERE user_id = ' . $USER->id);

        //aval inja masalan :)

        $alerts = $DB->get_records_sql
        ('SELECT * FROM {local_alert_assign} WHERE assignment_id is null AND course_id = ?', array((int)$_GET['id']));
        $ja = json_encode(reset($alerts));
//echo '<pre>'.$ja.'</pre>';
        echo "<script>var allAss = $ja;</script>";

        $mform->addElement('html', ' <table style="display: block" id="table">
<thead>
<tr>
<th>
Duration
</th>
<th>
Time
</th>
</tr>
</thead>

<!-- <tr id="r">            
<td id="ISINcb" class="lblCell_R">
   <select name=\'isinz[]\'>
       <option>0</option>
       <option>1</option>
       <option>2</option>
       <option>3</option>
   </select>
  </td><td> <input type="time" name="time[]"
               min="00:00" max="23:59"  /> </td>
</tr> -->

<caption><a onclick="add()">add</a>
<a onclick="deleteT()">delete</a></caption></table>
<script>

document.onreadystatechange = function () {
  if (document.readyState === "complete") {

setTimeout(function() {
   var table = document.getElementById(\'table\');
   if(allAss.length == 0){
   row=table.insertRow();
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]"><option>0</option><option>1</option><option>2</option><option>3</option></select></td><td> <input type="time" name="time[]" min="00:00" max="23:59"/></td>\';
   }else{
       if(allAss.alert1 != null && allAss.alert1 != \'\' ){
           var arr = allAss.alert1.split(\'@\');
          row=table.insertRow();
          var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
       }
       if(allAss.alert2 != null && allAss.alert2 != \'\'){
           var arr = allAss.alert2.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       
       if(allAss.alert3 != null && allAss.alert3 != \'\'){
           var arr = allAss.alert3.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       
       if(allAss.alert4 != null && allAss.alert4 != \'\'){
           var arr = allAss.alert4.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       if(allAss.alert5 != null && allAss.alert5 != \'\'){
           var arr = allAss.alert5.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       
   }
   
   },500);
      }
}
</script>


<br/>');

        //ta inja masalan :D

        $mform->addElement('html', '  
        <p dir="ltr"></p>
<div id="demo" >
<div id="each" dir="rtl" style="display: none">
    ');
        $courseid = -1;


        foreach ($assignmentname as $mn) {
            $courseid = $mn->course;

            $alerts = $DB->get_records_sql
            ('SELECT * FROM {local_alert_assign} WHERE assignment_id = ' . $mn->id . ' AND course_id = ?', array((int)$_GET['id']));

            $ja = json_encode(reset($alerts));
//echo '<pre>'.$ja.'</pre>';
            echo "<script>var ass" . $mn->id . " = $ja;</script>";

            $mform->addElement('html', '<h3>' . $mn->name . '</h3><table id="table' . $mn->id . '">
            <thead>
<tr>
<th>
Duration
</th>
<th>
Time
</th>
</tr>
</thead>
 
            ');

            $typeitem[] = &$mform->createElement('advcheckbox', $mn->id, '',
                $mn->name, array('name' => $mn->id, 'group' => 1), $mn->id);
            $mform->addElement('html', '
<!--<tr id="r' . $mn->id . '">

<td id="ISINcb" class="lblCell_R">
   <select name=\'isinz[' . $mn->id . '][]\'>
       <option>0</option>
       <option>1</option>
       <option>2</option>
       <option>3</option>
   </select>
  </td><td>  
  <input type="time" name="time[' . $mn->id . '][]"
               min="00:00" max="23:59"  /> </td>
</tr>
-->');


            $mform->addElement('html', '<caption><a onclick="add(' . $mn->id . ')">add</a>
<a onclick="deleteT(' . $mn->id . ')">delete</a></caption>
</table>

<script>
      setTimeout(function() {


var it =  ass' . $mn->id . ';
   var table = document.getElementById(\'table'. $mn->id .'\');
   if(it.length == 0){
   row=table.insertRow();
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]"><option>0</option><option>1</option><option>2</option><option>3</option></select></td><td> <input type="time" name="time[]" min="00:00" max="23:59"/></td>\';
   }else{
       if(it.alert1 != null && it.alert1 != \'\' ){
           var arr = it.alert1.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       if(it.alert2 != null && it.alert2 != \'\'){
           var arr = it.alert2.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       
       if(allAss.alert3 != null && allAss.alert3 != \'\'){
           var arr = allAss.alert3.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       
       if(it.alert4 != null && it.alert4 != \'\'){
           var arr = it.alert4.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       if(it.alert5 != null && it.alert5 != \'\'){
           var arr = it.alert5.split(\'@\');
          row=table.insertRow();
 var options = "";
          for(var i = 0 ; i < 4 ; i++){
              var selected = "";
              if(arr[0] == i){
                  selected = "selected";
              }
              options += "<option "+selected+" >"+i+"</option>";
              }
          
   row.innerHTML=\'<td class="lblCell_R"><select name="isinz[]" >\' + options + \'</select></td><td> <input type="time" name="time[]" min="00:00" max="23:59" value="\'+arr[1]+\'" /></td>\';
     
          
       }
       
   }

 
         },500);

</script>


');
        }
        $mform->addElement('html', '</div>
 <button type="button"  style="height:50px;width:150px" onclick="feachbtn(this)" id="f1">for each seprate assignment</button>
');
        $mform->addElement
        ('html', ' <input  type="text" value=" ' . $courseid . '" name="courseid" style="display:none"/>');


        $mform->addElement('html', '
<script>
function befSubmit() {
         var a = document.getElementById("isf").checked 
         if (a){
             tb1.innerHTML = document.getElementById("isf").outerHTML;
         }else{
             tb2.innerHTML = document.getElementById("isf").outerHTML;
         }
}
var  btn = document.getElementById("");
 var row ;
 function deleteT(a) {
       var table = tb;
    if(a != null){
        table = document.getElementById("table"+a);
    }
      if(table.rows.length > 2){
              table.deleteRow(table.rows.length - 1);
      }
  }
   var tb =document.getElementById("table") ;
    function add(a) {
      var table = tb;
      var table = tb;
    if(a != null){
        table = document.getElementById("table"+a);
    }
   
    if(table.rows.length < 6) {
   row=table.insertRow();
if(a !=null){
    
    row.innerHTML=\'<td  class="lblCell_R"><select name="isinz[\'+a+\'][]"><option   >0</option><option   >1</option><option   >2</option><option   >3</option></select></td><td> <input type="time"  name="time[\'+a+\'][]" min="00:00" max="23:59"  /> </td>\';

}else{
    row.innerHTML=\'<td  class="lblCell_R"><select name="isinz[]"><option   >0</option><option   >1</option><option   >2</option><option   >3</option></select></td><td> <input type="time"  name="time[]" min="00:00" max="23:59"  /> </td>\';
}
}
    }
//    btn.onclick = function () {
//        var n = tb.rows.length;
//        var row = tb.insertRow();
//        row.id = "t" + n;
//        row.innerHTML = \'<td >\' + n + \'</td><td><input  name="answer[is][\' + n + \']" type="checkbox"></td><td><input type="text" name="answer[text][\' + n + \']" placeholder="Answer" class="form-control"  ></td> <td><input type="button" class="btn btn-warning" value="X" onClick="delet(\' + n + \')"/></td>\';
    
    
    var tb1 =document.getElementById("table") ;
    var tb2 = document.getElementById("each");
     function feachbtn(a) {
         if(tb1.style.display === \'block\'){
         document.getElementById("isf").checked = true;
tb1.style.display = \'none\';
tb2.style.display = \'block\';
        a.innerText="for all assignment";
}else{
                  document.getElementById("isf").checked = false;
tb2.style.display = \'none\';
tb1.style.display = \'block\';
        a.innerText="for each seprate assignment";

}
}

</script>
</div>


        ');

        $mform->addElement('submit', 'submitbutton', get_string('savechanges'), ['onclick' => 'befSubmit()']);


        //Default value
    }

    //Custom validation should be added here
    function validation($data, $files)
    {
        return array();
    }
}

$managefeeds = new moodle_url('/local/alert/activitylist.php', $urlparams);

$PAGE->set_url('/local/alert/activitylist.php', $urlparams);
$PAGE->set_pagelayout('admin');


$course = $DB->get_record('course', array('id' => $_GET['id']), '*', MUST_EXIST);

$alertTitle = 'alert';

$PAGE->set_title($course->fullname . ' - Alert Setting');
//$PAGE->set_heading($course->fullname.' - Alert Setting');
$PAGE->set_heading($course->fullname);
$PAGE->navbar->add($course->fullname, '/course/view.php?id=' . $_GET['id']);
$PAGE->navbar->add('هشدارها');

echo $OUTPUT->header();
echo $OUTPUT->heading('Alert Setting for ' . $course->fullname, 2);

//    --------------Assignemnt---------------

$mform = new assignment_form(array('id' => $_GET['id'], 'onsubmit' => 'befSubmit()'));


//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    //query_for save in data base.

//    $alerts = $DB->get_records_sql
//    ('SELECT * FROM {local_alert_assignment} WHERE user_id = ' . $USER->id);


    echo '<div width="200" dir="ltr">';
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    echo "<br>";
    echo "<br>";
    echo $_POST['isf'];
    echo '</div>';
    $mform->display();
} else {


    //Set default data (if any)
    $mform->set_data($toform);
    //displays the form
    $mform->display();
}


//Save Assignment Alert to DB:
function setAlert($i, $record, $duration, $time)
{
    switch ($i) {
        case 1 :
            $record->alert1 = $duration . '@' . $time;
            break;
        case 2:
            $record->alert2 = $duration . '@' . $time;
            break;
        case 3:
            $record->alert3 = $duration . '@' . $time;
            break;
        case 4:
            $record->alert4 = $duration . '@' . $time;
            break;
        case 5:
            $record->alert5 = $duration . '@' . $time;
            break;


    }
}

if (isset($_POST['submitbutton'])) {

    if ($_POST['isf'] == 'on') {
        foreach ($_POST['isinz'] as $assignment_id => $durations) {
            $record = new stdClass();
            $i = 1;
            $record->assignment_id = $assignment_id;
            $record->course_id = $_GET['id'];
            foreach ($durations as $key => $duration) {

                if (!empty($duration) && !empty($_POST['time'][$assignment_id][$key])) {
                    setAlert($i, $record, $duration, $_POST['time'][$assignment_id][$key]);
                    $i++;
                }
            }
            if (!empty($record->alert1)) {
                $DB->insert_record('local_alert_assign', $record, false);
            }


        }
    } else {
        //

        $i = 1;
        $record = new stdClass();
        $record->course_id = $_GET['id'];
        foreach ($_POST['isinz'] as $index => $duration) {
            if (empty($duration) || empty($_POST['time'][$index])) {
                break;
            }
            setAlert($i, $record, $duration, $_POST['time'][$index]);
            $i++;
        }
        if (!empty($record->alert1)) {
            $DB->insert_record('local_alert_assign', $record, false);
        }
    }

}


echo $OUTPUT->footer();
