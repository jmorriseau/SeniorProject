<?php
  header('Content-type: application/json');
  include('../autoload.php');

  $dbc = new DAO();
  $message = '';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $file = $_POST['file']; #Takes file name from front end

    $csv = array_map('str_getcsv', file('../text_files/' . $file)); #Break CSV into Array

    array_walk($csv, function(&$a) use ($csv) {
      $a = array_combine($csv[0], $a);
    }); # makes the raw CSV file that include headers into associative array

    array_shift($csv); # remove column header

    $dbc->sql("DELETE FROM Enrollment where 0 = 0;");

    foreach ($csv as $header => $value) {
      $dbc->sql("INSERT INTO Enrollment (
        course_id, student_id)
        VALUES(
      '" .$value['course_id']. "',
      '" .$value['student_id']. "' )
     ;"); #Inserts enrollment into database
    }

  }

  $message = createClasses($dbc);
  echo json_encode($message);

  function createClasses($db){
    $count = array(); //Contains count of enrolled and department number for the course.
    $course_attr = array(); //contains attributes for courses in count.
    $room_attr = array(); //gets collects of rooms and attributes.
    $class_room_match = array(); //Contains rooms that match any
    $faculty_depts = array();
    $faculty_course_available = array();
    $sql_info_array = array();
    $booking_errors = array();
    $faculty_bookings = array();
    $faculty_errors = array();


    $enrollment = $db->sql("SELECT course_id, count(course_id) as total
    FROM Enrollment
    GROUP BY course_id
    ORDER BY total desc;");

    foreach ($enrollment as $header => $value) {
      foreach ($enrollment as $value => $thing) {
        $cid = $thing['course_id'] ;
        $ctot = array($thing['total']);
        $count += [$cid => $ctot];
        }
    }

    $course_dept_sql = $db->sql("SELECT course_id, departments_id, credit_hours FROM Courses");

    foreach ($course_dept_sql as $key => $value) {
      if(array_key_exists($value['course_id'], $count)){
        array_push($count[$value['course_id']], $value['departments_id']);
        array_push($count[$value['course_id']], $value['credit_hours']);
      }
    }

    $course_attr_sql = $db->sql("SELECT Course_Attribute_Relation.course_id, Course_Attribute_Relation.attributes_id
      FROM Course_Attribute_Relation
      WHERE EXISTS (
        SELECT course_id, count(course_id) as total
        FROM Enrollment
        WHERE Course_Attribute_Relation.course_id = Enrollment.course_id
        GROUP BY course_id
      )
      ORDER BY course_id");

    //For each for $course_attr
    foreach ($course_attr_sql as $key => $value) {
      if(array_key_exists($value['course_id'], $course_attr)){
        array_push($course_attr[$value['course_id']], $value['attributes_id']);
      } else {
        $foreach_array = array($value['attributes_id']);
        $course_attr += [$value['course_id'] => $foreach_array];
      }
    }

    $class_attr_sql = $db->sql("SELECT Class_Attribute_Relation.classroom_id, Class_Attribute_Relation.attributes_id
      FROM Class_Attribute_Relation
      ORDER BY classroom_id");

    //For each for $room_attr
    foreach ($class_attr_sql as $key => $value) {
      if(array_key_exists($value['classroom_id'], $room_attr)){
        array_push($room_attr[$value['classroom_id']], $value['attributes_id']);
      } else {
        $foreach_array = array($value['attributes_id']);
        $room_attr += [$value['classroom_id'] => $foreach_array];
      }
    }

    $faculty_dept_sql = $db->sql("SELECT Faculty_Dept_Relation.faculty_id, Faculty_Dept_Relation.departments_id
    FROM Faculty_Dept_Relation
    WHERE EXISTS (
    	SELECT Courses.course_id, Courses.departments_id
    	FROM Courses
    	WHERE EXISTS (
    		SELECT course_id, COUNT(course_id) as Total
    		FROM Enrollment
    		WHERE Enrollment.course_id = course_id
    		GROUP BY course_id
    	) AND Faculty_Dept_Relation.departments_id = Courses.departments_id
    )
    ORDER BY faculty_id;");

    //For each for $faculty_depts
    foreach ($faculty_dept_sql as $key => $value) {
      if(array_key_exists($value['faculty_id'], $faculty_depts)){
        array_push($faculty_depts[$value['faculty_id']], $value['departments_id']);
      } else {
        $foreach_array = array($value['departments_id']);
        $faculty_depts += [$value['faculty_id'] => $foreach_array];
      }
    }

    foreach ($count as $key => $value) {
      $cr_attr = $course_attr_sql[$key];
      foreach($class_attr_sql as $key2 => $value2){
          $result = array_diff($value2, $cr_attr);
          if(count($result) < 1){
            if(array_key_exists($key2, $class_room_match)){
              array_push($class_room_match[$key2], $key);
            } else {
              $foreach_array = array($key);
              $class_room_match += [$key2 => $foreach_array];
            }
          }
      }
    }

    //For each for $faculty_course_available
    foreach ($count as $key => $value) {
      foreach($faculty_depts as $key2 => $value2){
          if(in_array($value[1], $value2)){
            if(array_key_exists($key, $faculty_course_available)){
              array_push($faculty_course_available[$key], $key2);
            } else {
              $foreach_array = array($key2);
              $faculty_course_available += [$key => $foreach_array];
            }
          }
      }
    }

    // Array format: Key = course_id(room_id, credit_hours, departments_id, day, start_time, end_time, faculty_id)

    foreach($class_room_match as $cl_r_key => $cl_r_value){
      foreach($cl_r_value as $crv_key => $crv_value){
        if (array_key_exists($crv_value, $sql_info_array)){  }
        else {
          $foreach_array = array($cl_r_key);
          $sql_info_array += [$crv_value => $foreach_array];
          array_push($sql_info_array[$crv_value], $count[$crv_value][2]);
          array_push($sql_info_array[$crv_value], $count[$crv_value][3]);
        }
      }
    }

    $time = "08:00:00";
    $day = array('MON','TUE','WED','THU','FRI');
    $booked_full = array();
    $day_number = 0;
    $cur_room = 0;
    $first = true;

    foreach($sql_info_array as $sia_key => $sia_value){
      if($first === true){
        $cur_room = $sia_value[0];
        $first = false;
      }
      if($sia_value[0] != $cur_room){
        $time = "08:00:00";
        $day_number = 0;
        $cur_room = $sia_value[0];
      }

      $tempArr = explode(':', $time);
      if($tempArr[0] > 18){
          if($day_number === 4){
            $booking_errors += [$sia_key => $sia_value];
            if (array_key_exists($sia_value[0], $booked_full)){ }
            else{
                $booked_full +=[$sia_value[0] => 'Full'];
            }
            unset($sql_info_array[$sia_key]);
          } else {
            $day_number = $day_number + 1;
            $time = "08:00:00";
            array_push($sql_info_array[$sia_key], $day[$day_number]);
            array_push($sql_info_array[$sia_key], $time);
            $cred_hours = (float)$sia_value[1];
            $time = date('H:i:s', strtotime($time. ' + ' . $cred_hours . ' hours'));
            array_push($sql_info_array[$sia_key], $time);
          }
      } else {
          array_push($sql_info_array[$sia_key], $day[$day_number]);
          array_push($sql_info_array[$sia_key], $time);
          $cred_hours = (float)$sia_value[1];
          $time = date('H:i:s', strtotime($time. ' + ' . $cred_hours . ' hours'));
          array_push($sql_info_array[$sia_key], $time);
          $time = date('H:i:s', strtotime($time. ' + ' . 30 . ' minutes'));
      }
    }

    /* ------------------------------------------------------------------------------------------ */

    $sql_copy = array();
    $i = 0;

    //Run the time determiner multiple time, weeding out what is left over every time.
    while($i < 5) {
      $room_match_copy = $class_room_match;

      foreach($booked_full as $b_key => $b_copy){
        unset($room_match_copy[$b_key]);
      }

      $sql_i_copy = array();

      foreach($room_match_copy as $cl_r_key => $cl_r_value){
        foreach($cl_r_value as $crv_key => $crv_value){
          if (array_key_exists($crv_value, $sql_info_array)){  }
          else {
            $foreach_array = array($cl_r_key);
            $sql_i_copy += [$crv_value => $foreach_array];
            array_push($sql_i_copy[$crv_value], $count[$crv_value][2]);
          }
        }
      }

      $time = "08:00:00";
      $day = array('MON','TUE','WED','THU','FRI');
      $booked_full = array();
      $day_number = 0;
      $cur_room = 0;
      $first = true;

      foreach($sql_i_copy as $sia_key => $sia_value){
        if($first === true){
          $cur_room = $sia_value[0];
          $first = false;
        }
        if($sia_value[0] != $cur_room){
          $time = "08:00:00";
          $day_number = 0;
          $cur_room = $sia_value[0];
        }

        $tempArr = explode(':', $time);
        if($tempArr[0] > 18){
            if($day_number === 4){
              $booking_errors += [$sia_key => $sia_value];
              if (array_key_exists($sia_value[0], $booked_full)){ }
              else{
                  $booked_full +=[$sia_value[0] => 'Full'];
              }
              unset($sql_i_copy[$sia_key]);
            } else {
              $day_number = $day_number + 1;
              $time = "08:00:00";
              array_push($sql_i_copy[$sia_key], $day[$day_number]);
              array_push($sql_i_copy[$sia_key], $time);
              $cred_hours = (float)$sia_value[1];
              $time = date('H:i:s', strtotime($time. ' + ' . $cred_hours . ' hours'));
              array_push($sql_i_copy[$sia_key], $time);
            }
        } else {
            array_push($sql_i_copy[$sia_key], $day[$day_number]);
            array_push($sql_i_copy[$sia_key], $time);
            $cred_hours = (float)$sia_value[1];
            $time = date('H:i:s', strtotime($time. ' + ' . $cred_hours . ' hours'));
            array_push($sql_i_copy[$sia_key], $time);
            $time = date('H:i:s', strtotime($time. ' + ' . 30 . ' minutes'));
        }
      }

      foreach($sql_i_copy as $key => $value){
        $sql_copy += [$key => $value];
      }

      $i++;
    }

    //fills official list of sql info.
    foreach($sql_copy as $key => $value){
      $sql_info_array += [$key => $value];
    }

    //Fixes issues with departments
    foreach($sql_info_array as $key => $value){
      $sql_info_array[$key][2] = $count[$key][1];
    }

    foreach($faculty_depts as $key => $value){
      $help_array = array("08:00:00", "08:00:00");
      $double_help_array = array();
      $double_help_array += ["MON" => $help_array];
      $double_help_array += ["TUE" => $help_array];
      $double_help_array += ["WED" => $help_array];
      $double_help_array += ["THU" => $help_array];
      $double_help_array += ["FRI" => $help_array];
      $faculty_bookings += [$key => $double_help_array];
    }

    $teacher_found = false;
    foreach($sql_info_array as $key => $value){
      foreach($faculty_course_available[$key] as $fca_key => $fca_value){
        if($teacher_found === true){

        } else {
          $booking_xplod = explode(':',$faculty_bookings[$fca_value][$sql_info_array[$key][3]][1]);
          $class_xplod = explode(':', $sql_info_array[$key][4]);

          if($booking_xplod[0] <= $class_xplod[0]){
            array_push($sql_info_array[$key], $fca_value);
            $faculty_bookings[$fca_value][$sql_info_array[$key][3]][1] = $sql_info_array[$key][5];
            $teacher_found = true;
          }
        }
      }
      $teacher_found = false;
    }

    foreach($sql_info_array as $key => $value){
      if($sql_info_array[$key][6] === NULL){
        $faculty_errors += [$key => $value];
        unset($sql_info_array[$key]);
      }
    }


    $classrooms = $db->sql("SELECT classroom_id from Classroom;");
    $room_check_array = array();

    foreach ($classrooms as $key => $value) {
      if(array_key_exists($value['classroom_id'], $room_check_array)){
        array_push($room_check_array[$value['classroom_id']], 1);
      } else {
        $foreach_array = array(1);
        $room_check_array += [$value['classroom_id'] => $foreach_array];
      }
    }

    foreach($sql_info_array as $key => $value){
      if(array_key_exists($sql_info_array[$key][0], $room_check_array)){
      } else {
        unset($sql_info_array[$key]);
      }
    }

    //                                   0         1               2         3        4        5          6
    // Array format: Key = course_id(room_id, credit_hours, departments_id, day, start_time, end_time, faculty_id)
    echo count($count) . " ";

    echo count($sql_info_array);

    //$helper_key;
    //try{
    foreach($sql_info_array as $key => $value){
    //$helper_key = $key;
    if($key != null && $sql_info_array[$key][0] != null && $sql_info_array[$key][1] != null && $sql_info_array[$key][2] != null && $sql_info_array[$key][3] != null && $sql_info_array[$key][4] != null && $sql_info_array[$key][5] != null && $sql_info_array[$key][6] != null){
          $db->sql("INSERT INTO [dbo].[Class]
                 ([faculty_id]
                 ,[classroom_id]
                 ,[course_id]
                 ,[class_day]
                 ,[start_time]
                 ,[end_time])
           VALUES
                 ('" .$sql_info_array[$key][6]. "',
                 '" .$sql_info_array[$key][0]. "',
                 '" .$key. "',
                 '" .$sql_info_array[$key][3]. "',
                 '" .$sql_info_array[$key][4]. "',
                 '" .$sql_info_array[$key][5]. "');"
               );
           }
    }
    /*) catch (exception $e){
      echo "Course " . $helper_key . " ";
      echo "<br  /><br  />";
      echo "Room " . $sql_info_array[$helper_key][0] . " ";
      echo "<br  /><br  />";
      echo "Credit " . $sql_info_array[$helper_key][1] . " ";
      echo "<br  /><br  />";
      echo "Department " .$sql_info_array[$helper_key][2]. " ";
      echo "<br  /><br  />";
      echo "Day " .$sql_info_array[$helper_key][3]. " ";
      echo "<br  /><br  />";
      echo "Start " .$sql_info_array[$helper_key][4]. " ";
      echo "<br  /><br  />";
      echo "End " .$sql_info_array[$helper_key][5]. " ";
      echo "<br  /><br  />";
      echo "Faculty " .$sql_info_array[$helper_key][6]. " ";
      echo "<br  /><br  />";
      echo $e;
    }*/

    return "Classes attempted: " . count($count). "\n\nClasses Made: " . count($sql_info_array);
  }

?>
