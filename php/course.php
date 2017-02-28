<?php
include('./autoload.php');

$db = new DAO();
$subjects = array();
$courses = array();
$selectedSubject = "";
?>

<div class="header">
  <h1>Current Courses</h1>
</div>
<hr/>

<div class="select-subject">
  <div class="select-header add-edit-sub-btn">Subjects
    <button class="btn btn-success pull-right" onclick="loadPage('add_edit_subject')">
      <span class="fa fa-plus-circle"></span> Add Subject
    </button>
  </div>
  <select name="subjects" size="23">
  <?php
    $subjects = $db->sql("SELECT * FROM Departments ORDER BY department_name");
    if(count($subjects) > 0){
      foreach($subjects as $subject){
        echo "<option value=" . $subject['departments_id'] ." class='edit-subject' name='subjectID'>" . $subject['department_name'] . "</option>";
      }
    }
  ?>
  </select>
</div>

<div class="selected-subject">
  <div class="course-header add-edit-course-btn">Courses
    
  </div>
  <div class="load-course">
    <?php
      if($selectedSubject == ""){
        echo '<select class"load-courses" name="courses" size="23">';
        echo '<option value="" disabled>Please select a subject</option>';
        echo '</select>';
      } 
    ?>
  </div>
<div>

 <script>

  $(function(){
      //if an existing subject is clicked add edit button
      $(".edit-subject").on("click",function(){
          var subjectId = $(this).val();
          console.log("got the subject id " + subjectId + " I got into the edit-subject function");
          $("#edit-sub-btn").remove();
          $("#add-course-btn").remove();
          $(".add-edit-sub-btn").append("<button id='edit-sub-btn' data-sub=" + subjectId + " class='btn btn-success pull-right'> <span class='fa fa-plus-circle'></span> Edit Subject</button>");
          $(".add-edit-course-btn").append("<button id='add-course-btn' class='btn btn-success pull-right' data-sub=" + subjectId + "><span class='fa fa-plus-circle'></span> Add Course </button>")
          $(".load-course").load('php/course_list.php?sid=' + subjectId);
      });

      //if an existing course is clicked add edit button
      $("body").on("click", '.edit-course',function(){          
          var courseId = $(this).val();
          var subId = $(this).data("sid");
          console.log("got the course id " + courseId + " the subject Id right here " + subId);
          $("#edit-course-btn").remove()
          $(".add-edit-course-btn").append("<button id='edit-course-btn' data-sid=" + subId + " data-course=" + courseId + " class='btn btn-success pull-right'> <span class='fa fa-plus-circle'></span> Edit Course</button>");
      });


      //if an edit subject is clicked load edit subject and fill existing information 
      $("body").on("click", "#edit-sub-btn",function(){
        console.log("Here i am");
        var subjectId = $(this).data("sub");
        console.log("the subject id for editing: " + subjectId);
        $(".content-container").load("php/add_edit_subject.php?subjectId=" + subjectId);
      });

      //if an edit course is clicked load edit subject and fill existing information 
      $("body").on("click", "#edit-course-btn",function(){
        console.log("Here i am");
        var courseId = $(this).data("course");
        var subId = $(this).data("sid");
        console.log("the course id for editing: " + courseId + " the subject id: " + subId);
        $(".content-container").load("php/add_edit_course.php?courseId=" + courseId + "&sid=" + subId);
      });

      //if add course is clicked load add edit course with the existing subject id
      $("body").on("click", "#add-course-btn", function(){
        var subId = $(this).data("sub");
        console.log("Got the subject Id: " + subId + " for adding a course");
        $(".content-container").load("php/add_edit_course.php?sid=" + subId);
      })
  });
</script>
