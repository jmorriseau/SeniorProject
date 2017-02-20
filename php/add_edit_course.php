<?php
//if course id is passed set it to a php variable
if (isset($_GET['courseId'])) {
    $course_id = $_GET['courseId'];
}

include('./autoload.php');

$db = new DAO();
$course;
$action;

//if there is a course Id, pull course information
 if (isset($course_id)){
    $course = $db->sql("SELECT * FROM Courses where course_id = '" .$course_id ."'");
    $action = "Update";
 }
 else {
     $action = "Add";
 }
?>


<h1><?php echo $action ?> Course</h1>
<hr/>
<span class="fa fa-times pull-right" onclick="loadPage('course')"></span>
<div class="form-container edit-classroom-container">
<form id="add_course" action="#" method="post">
  <div class="form-row">
    <label>Course Name:</label>
    <input type="text" name="courseName" class="validate" placeholder="English 101" maxlength="100" minlength="2" required
    value="<?php
            if(isset($course[0]['course_name'])){
              echo $course[0]['course_name'];
              }
            ?>"/>
  </div>

  <div class="form-row">
    <label>Course Number:</label>
    <input type="text" name="courseNumber" placeholder="EN101" maxlength="8" minlength="3" required 
    value="<?php
              if(isset($course[0]['course_number'])){
              echo $course[0]['course_number'];
              }
              ?>"/>
  </div>

<!-- boys say we dont need this 
  <div class="form-row">    
    <label>Classroom Type:</label>
    <select>
      <option value="">--Choose One--</option>
      <option value="hall">Hall</option>
      <option value="lab" selected="selected">Lab</option>
      <option value="lecture">Lecture</option>
    </select>
  </div>-->

  <div class="form-row">
    <label>Credit Hours:</label>
    <input type="number" name="creditHours" class="validate" placeholder="4" min="0" max="5" required
    value="<?php
              if(isset($course[0]['credit_hours'])){
              echo $course[0]['credit_hours'];
              }
              ?>"/>
  </div>

  <div class="form-row">

    <div class="accordian-container collapsed">
      <div class="accordian-header" onclick="toggleAccordian(this)">
        <span class="fa fa-plus"></span>
        Software
      </div>
      <div class="accordian-body">
        Photoshop etc
      </div>
    </div>

    <div class="accordian-container collapsed">
      <div class="accordian-header" onclick="toggleAccordian(this)">
        <span class="fa fa-plus"></span>
        Hardware
      </div>
      <div class="accordian-body">
        Desk etc
      </div>
    </div>

  </div>

  <input type="hidden" name="courseId" value="<?php if(isset($course[0]['course_id'])){echo $course[0]['course_id'];}?>"/>

  <div class="form-row">
    <label></label>
    <!--<button class="btn btn-default" onclick="loadPage('course')">Cancel</button>
    <button class="btn btn-success" onclick="loadPage('course')">Save</button>-->
    <?php
        if($action == "Update"){
                echo '<button class="delete_course btn btn-default" data-delete="' . $course[0]['course_id'] . '">Delete</button>';
        }
    ?>
        <button class="btn btn-success submit-form <?php echo $action ?>" name="save" type="submit"><?php echo $action ?></button>
  </div>
</div>
</form>

<script type="text/javascript" src="./js/page/add_edit_course.js"></script>
