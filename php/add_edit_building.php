<?php
//if building id is passed set it to a php variable
if (isset($_GET['bid'])) {
    $building_id = $_GET['bid'];
}
if(isset($_GET['cn'])){
    $campus_name = $_GET['cn'];
}
if(isset($_GET['cid'])){
    $campus_id = $_GET['cid'];
}

//var_dump($campus_name);
include('./autoload.php');

 $db = new DAO();
 $building;
 $action;

//if there is a building Id, pull building information
 if (isset($building_id)){
    $building = $db->sql("SELECT * FROM Building where building_id = '" .$building_id ."'");
    $action = "Edit";
 }
 else {
     $action = "Add";
 }
?>

<div class="hide building-form">
  <h1><?php echo $action ?> Building</h1>
  <hr/>

  <form id="add_building" action="#" method="post">
    <div class="form-container building-container">

      <div class="form-row">
        <label>Building Name</label>
        <input type="text" name="buildingName" class="validate" placeholder="North Building" maxlength="40" minlength="2" required
        value="<?php
            if(isset($building[0]['building_name'])){
                echo $building[0]['building_name'];
            }
            ?>"/>
        <span class="hide">*</span>
      </div>

      <div class="form-row">
        <label>Campus</label>
        <select name="campusName" class="validate" required disabled>
          <option value="">--Choose One--</option>
          <?php
          if(isset($building[0]['campus_id'])){
              $campus_selected = $building[0]['campus_id'];
              echo "<option value='$campus_selected' selected='selected'>$campus_name</option>";
          }
          else{
              echo "<option value='$campus_id' selected='selected'>$campus_name</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-row">
        <label>Address Line 1</label>
        <input type="text" name="addressLine1" class="validate" placeholder="15 Main St" maxlength="40" minlength="2" required
        value="<?php
            if(isset($building[0]['address'])){
                echo $building[0]['address'];
            }
        ?>"/>
      </div>

      <div class="form-row">
        <label>Address Line 2</label>
        <input type="text" name="addressLine2"  placeholder="Suite 200" maxlength="40" minlength="2" />
      </div>

      <div class="form-row">
        <label>City</label>
        <input type="text" name="city" class="validate" placeholder="North Attleboro" maxlength="150" minlength="2" required
        value="<?php
            if(isset($building[0]['city'])){
                echo $building[0]['city'];
            }
        ?>"/>
      </div>

    <div class="form-row">
      <label>State</label>
        <select name="state" class="vaildate" required>
          <option value="">--Choose One--</option>
           <?php
                if (isset($building[0]['state'])) {
                    $state_selected = $building[0]['state'];
                }
                include 'states.php';

                foreach ($states as $key => $value) {
                    if ($state_selected == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
            ?>
        </select>
      </div>


      <div class="form-row">
        <label>Zip</label>
        <input type="text" name="zip" class="validate" placeholder="02903" maxlength="10" minlength="5" required
        value="<?php if(isset($building[0]['zip'])){echo $building[0]['zip'];}?>"/>
      </div>

      <input type="hidden" name="buildingId" value="<?php if(isset($building[0]['building_id'])){echo $building[0]['building_id'];}?>"/>

      <div class="form-row">
        <label></label>
        <!--<button class="btn btn-default" onclick="loadPage('building')">Cancel</button>-->
        <?php
            if($action == "Edit"){
                echo '<button class="delete_building btn btn-default" data-delete="' . $building[0]['building_id'] . '">Delete</button>';
             }
        ?>
        <button class="btn btn-success submit-form <?php echo $action ?>" name="save" type="submit"><?php echo $action ?></button>
      </div>

    </div>
  </form>
</div>

<script type="text/javascript" src="./js/page/add_edit_building.js"></script>
