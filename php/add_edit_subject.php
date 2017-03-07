<?php
//if department id is passed set it to a php variable
if (isset($_GET['subjectId'])) {
    $department_id = $_GET['subjectId'];
}

include('./autoload.php');

$db = new DAO();
$department;
$action;

//if there is a department Id, pull building information
 if (isset($department_id)){
    $department = $db->sql("SELECT * FROM Departments where departments_id = '" .$department_id ."'");
    $action = "Update";
 }
 else {
     $action = "Add";
 }
?>

<h1><?php echo $action ?> Subject</h1>
<hr/>
<span class="fa fa-times pull-right" onclick="loadPage('course')"></span>
<div class="form-container edit-subject-container">
<form id="add_subject">
  <div class="form-row">
    <label>Subject Name:</label>
    <input type="text" name="subjectName" class="validate" placeholder="English" maxlength="100" minlength="2" required
      value="<?php
              if(isset($department[0]['department_name'])){
                echo $department[0]['department_name'];
                }
              ?>"/>
  </div>

  <input type="hidden" name="subjectId" value="<?php if(isset($department[0]['departments_id'])){echo $department[0]['departments_id'];}?>"/>

  <div class="form-row">
    <label></label>
    <?php
        // if($action == "Update"){
        //         echo '<button class="delete_subject btn btn-default" data-delete="' . $department[0]['departments_id'] . '">Delete</button>';
        // }
    ?>
    <button class="btn btn-success submit-form <?php echo $action ?>" name="save" type="submit"><?php echo $action ?></button>
  </div>
</div>
</form>

<script type="text/javascript" src="./js/page/add_edit_subject.js"></script>
