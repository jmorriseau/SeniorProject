<h1>Add/Edit Building</h1>
<hr/>
<!--<form id="add_building" method="">-->
<div class="form-container building-container">
  <div class="form-row">
    <label>Building Name</label>
    <input type="text" name="buildingName" />
  </div>
  <div class="form-row">
    <label>Campus</label>
    <select name="campusName">
      <option value="">--Choose One--</option>
      <option value="access_road">Access Road</option>
      <option value="east_greenwich">East Greenwich</option>
      <option value="post_road">Post Road</option>
    </select>
  </div>
  <div class="form-row">
    <label>Address Line 1</label>
    <input type="text" name="addressLine1" />
  </div>
  <div class="form-row">
    <label>Address Line 2</label>
    <input type="text" name="addressLine2" />
  </div>
  <div class="form-row">
    <label>City</label>
    <input type="text" name="city" />
  </div>
  <div class="form-row">
    <label>State</label>
    <select name="state">
      <option value="">--Choose One--</option>
      <option value="ri">Rhode Island</option>
      <option value="ma">Massachusetts</option>
      <option value="ct">Connecticut</option>
    </select>
  </div>
  <div class="form-row">
    <label>Zip</label>
    <input type="text" name="zip" />
  </div>
  <div class="form-row">
    <label></label>
    <button class="btn btn-default" onclick="loadPage('building')">Cancel</button>
    <button class="btn btn-success" name="save">Save</button>
  </div>
</div>
<!--</form>-->


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




</script>
