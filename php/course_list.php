<?php
//if subject id is passed set it to a php variable
if(isset($_GET['sid'])){
    $course_id = $_GET['sid'];
}

include('./autoload.php');

 $db = new DAO();
 $courses;

 if (isset($course_id)){
    $courses = $db->sql("SELECT * FROM Courses where departments_id = '" .$course_id ."' ORDER BY course_name");
//     $courses = $db->sql("SELECT * FROM Courses");
// var_dump($courses);
    

    if(count($courses) > 0){
      echo '<select class"load-courses" name="courses" size="23">';
        foreach($courses as $course){
          echo "<option data-sid=" . $course_id . " value=" . $course['course_id']
              ." class='edit-course'>" . $course['course_name'] .
              " ".$course['course_number']."</option>";
        }
        echo '</select>';
      }
      else {
         echo '<select class"load-courses" name="courses" size="23">';
         echo '<option value="" disabled>There are no courses for this subject.</option>';
         echo '</select>';
      }
}

 ?>