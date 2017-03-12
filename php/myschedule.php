<?php
include('./autoload.php');
$db = new DAO();
$mySchedule = array();
$mySchedule = $db->sql("SELECT CLass.class_id, Class.faculty_id, Class.class_day, Faculty.first_name, Faculty.last_name, Classroom.class_number,
  Building.building_name, Campus.Campus_name, Courses.course_name, Courses.course_number, Class.start_time, Class.end_time
from Class, Faculty, Classroom, Courses, Building, Campus
WHERE Class.faculty_id = Faculty.faculty_id AND Class.classroom_id = Classroom.classroom_id AND Class.course_id = Courses.course_id
AND Classroom.building_id = Building.building_id AND Building.campus_id = Campus.campus_id AND Class.faculty_id IN
(SELECT Faculty_User_Relation.faculty_id FROM [dbo].[User], Faculty_User_Relation
WHERE  [dbo].[User].user_id = Faculty_User_Relation.user_id AND [dbo].[User].user_name ='".$_SESSION['account'][0]['user_name']."')");
?>
<h1>My Schedule</h1>
<hr/>
<span><?php echo $mySchedule[3]['first_name'].' '.$mySchedule[4]['last_name'].'<span class="pull-right">'.'' ; ?></span>
<div class="result-myschedule">
 <?php

if(count($mySchedule) > 0){
  echo '<table>';
  echo'<tr>'.'<th> Course Name </th>'.'<th> Day of Class </th> '.'<th> Campus </th>'.'<th> Start Time </th>'.'<th> End Time </th>'.' <th> Room Number <th/>';
      foreach ($mySchedule as $ms) {
        echo '<tr>'.'<td>'.$ms['course_name'].'</td><td>'.$ms['class_day'].'</td><td>'.$ms['Campus_name'].'</td><td>'.date('h:m A',strtotime($ms['start_time'])).'</td><td>'.date('h:m A',strtotime($ms['end_time'])).'</td><td>'.$ms['class_number'].'</td>';
      }
} ?>
</div>
