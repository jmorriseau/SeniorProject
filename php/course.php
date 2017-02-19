 <script>
  $(function(){
      //if an existing subject is clicked add edit button
      $(".edit-subject").on("click",function(){
          var subjectId = $(this).val();
          console.log("got the subject id " + subjectId);
          $("#edit-sub-btn").remove()
          $(".add-edit-sub-btn").append("<button id='edit-sub-btn' class='btn btn-success pull-right'> <span class='fa fa-plus-circle'></span> Edit Subject</button>");
      });

      $(".edit-course").on("click",function(){
          var courseId = $(this).val();

          console.log("got the course id " + courseId);
          $("#edit-course-btn").remove()
          $(".add-edit-course-btn").append("<button id='edit-course-btn' class='btn btn-success pull-right'> <span class='fa fa-plus-circle'></span> Edit Course</button>");
      });
  });
</script>


<?php
include('./autoload.php');

$db = new DAO();
$subjects = array();
$courses = array();
$selectedSubject = 19;
?>

<div class="header">
  <h1>Current Courses
</h1>
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
        echo "<option value=" . $subject['departments_id'] ." class='edit-subject'>" . $subject['department_name'] . "</option>";
      }
    }
  ?>
  </select>
</div>

<div class="selected-subject">
  <div class="course-header add-edit-course-btn">Courses
    <button class="btn btn-success pull-right" onclick="loadPage('add_edit_course')">
      <span class="fa fa-plus-circle"></span> Add Course
    </button>
  </div>
  <select name="courses" size="23">
  <?php
    if($selectedSubject == ""){
       echo '<option value="">Please select a subject</option>';
    } else {
     
      $courses = $db->sql("SELECT * FROM Courses");
      if(count($courses) > 0){
        foreach($courses as $course){
          echo "<option value=" . $course['course_id'] ." class='edit-course'>" . $course['course_name'] . "</option>";
        }
      }
    }
  ?>
  </select>
<div>




<!--<div class="accordian-container collapsed">
  <div class="accordian-header" onclick="toggleAccordian(this)">
    <span class="fa fa-plus"></span>
    English
  </div>
  <div class="accordian-body">
    English 101
  </div>
</div>

</div>-->
