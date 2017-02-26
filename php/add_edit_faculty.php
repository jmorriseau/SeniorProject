<?php
//if faculty id is passed set it to a php variable
if (isset($_GET['fid'])) {
    $faculty_id = $_GET['fid'];
}

include('./autoload.php');

$db = new DAO();
$faculty;
$action;

//if there is a faculty Id, pull information
 if (isset($faculty_id)){
    $faculty = $db->sql("SELECT * FROM Faculty where faculty_id = '" . $faculty_id ."'");
    $action = "Update";
 }
 else {
     $action = "Add";
 }
?>

<h1><?php echo $action ?> Faculty</h1>
<hr/>

<form id="add_faculty" action="#" method="post">
  <div class="form-row">
    <label>First Name:</label>
    <input type="text" name="firstName" class="validate" placeholder="George" maxlength="100" minlength="2" required
    value="<?php
            if(isset($faculty[0]['first_name'])){
              echo $faculty[0]['first_name'];
              }
            ?>"/>
  </div>

  <div class="form-row">
    <label>Last Name:</label>
    <input type="text" name="lastName" class="validate" placeholder="Saban" maxlength="100" minlength="2" required
    value="<?php
            if(isset($faculty[0]['last_name'])){
              echo $faculty[0]['last_name'];
              }
            ?>"/>
  </div>

  <!--<div class="form-row">
    <label>Phone:</label>
    <input type="text" name="phoneNumber" class="validate" placeholder="(401)739-5000" maxlength="10" minlength="10" required
    value=""/>
  </div>

  <div class="form-row">
    <label>Email:</label>
    <input type="text" value="gsaban@neit.edu" />
  </div>-->

  <input type="hidden" name="userId" value="<?php if(isset($faculty[0]['user_id'])){echo $faculty[0]['user_id'];}?>"/>
  <input type="hidden" name="facultyId" value="<?php if(isset($faculty[0]['faculty_id'])){echo $faculty[0]['faculty_id'];}?>"/>

  <div class="form-row">
    <label></label>
    <?php
        if($action == "Update"){
                echo '<button class="delete_faculty btn btn-default" data-delete="' . $faculty[0]['faculty_id'] . '">Delete</button>';
        }
    ?>
        <button class="btn btn-success submit-form <?php echo $action ?>" name="save" type="submit"><?php echo $action ?></button>
  </div>
</form>

<script type="text/javascript" src="./js/page/add_edit_faculty.js"></script>
