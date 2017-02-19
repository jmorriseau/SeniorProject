<?php
//if department id is passed set it to a php variable
if (isset($_GET['did'])) {
    $department_id = $_GET['did'];
}

include('./autoload.php');

$db = new DAO();
$department;
$action;

//if there is a department Id, pull building information
 if (isset($department_id)){
    $department = $db->sql("SELECT * FROM Departments where departments_id = '" .$department_id ."'");
    $action = "Edit";
 }
 else {
     $action = "Add";
 }
?>

<h1>Add/Edit Subject</h1>
<hr/>
<div class="form-container edit-classroom-container">
<form id="add_subject" action="#" method="post">
  <div class="form-row">
    <label>Subject Name:</label>
    <input type="text" name="subjectName" class="validate" placeholder="English" maxlength="100" minlength="2" required
      value="<?php
              if(isset($department[0]['department_name'])){
                echo $department[0]['department_name'];
                }
              ?>"/>
  </div>

  <div class="form-row">
    <label></label>
    <!--<button class="btn btn-default" onclick="loadPage('course')">Cancel</button>
    <button class="btn btn-success" onclick="loadPage('course')">Save</button>-->
    <!--<?php
        if($action == "Edit"){
                echo '<button class="delete_subject btn btn-default" data-delete="' . $building[0]['building_id'] . '">Delete</button>';
        }
    ?>-->
    <button class="btn btn-success submit-form <?php echo $action ?>" name="save" type="submit"><?php echo $action ?></button>
  </div>
</div>
</form>

<script type="text/javascript" src="./js/page/add_edit_subject.js"></script>
