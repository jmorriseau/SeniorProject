<?php
echo 'hello';
include('./autoload.php');

 $db = new DAO();

 $data = array();
 $buildings = array();

 $data = $db->sql("SELECT * FROM Building");
 var_dump(count($data));
 var_dump($data);
 ?>


<h1>Add/Edit Building</h1>
<hr/>

<form id="add_building" action="#" method="post">
  <div class="form-container building-container">

    <div class="form-row">
      <label>Building Name</label>
      <input type="text" name="buildingName" class="validate" placeholder="North Building" maxlength="40" minlength="2" required />
      <span class="hide">*</span>
    </div>

    <div class="form-row">
      <label>Campus</label>
      <select name="campusName" class="validate" required>
        <option value="">--Choose One--</option>
        <option value="access_road">Access Road</option>
        <option value="east_greenwich">East Greenwich</option>
        <option value="post_road">Post Road</option>
      </select>
    </div>

    <div class="form-row">
      <label>Address Line 1</label>
      <input type="text" name="addressLine1" class="validate" placeholder="15 Main St" maxlength="40" minlength="2" required />
    </div>

    <div class="form-row">
      <label>Address Line 2</label>
      <input type="text" name="addressLine2" class="validate" placeholder="Suite 200" maxlength="40" minlength="2" />
    </div>

    <div class="form-row">
      <label>City</label>
      <input type="text" name="city" class="validate" placeholder="North Attleboro" maxlength="150" minlength="2" required/>
    </div>

	<div class="form-row">
		<label>State</label>
			<select name="state" class="vaildate" required>
				<option value="">--Choose One--</option>
				<?php
					include 'states.php';
					foreach ($states as $key => $value){
						echo '<option value="', $key, '">', $value, '</option>';
					}
				?>
      </select>
    </div>

    <div class="form-row">
      <label>Zip</label>
      <input type="text" name="zip" class="validate" placeholder="02903" maxlength="10" minlength="5" required/>
    </div>

    <div class="form-row">
      <label></label>
      <button class="btn btn-default" onclick="loadPage('building')">Cancel</button>
      <button class="btn btn-success" name="save" type="submit">Save</button>
    </div>

  </div>
</form>

<script type="text/javascript" src="./js/page/add_edit_building.js"></script>
<!--
<script>
console.log(campuses);

$('.btn-success').click(function(){


  var newBuilding = {
    buildingName : $("input[name=buildingName]").val(),
    campusName: $("select[name=campusName] option:selected").val(),
  }

  campuses.push(newBuilding);
  newBuilding = null;
  console.log(campuses);

})

</script>-->
