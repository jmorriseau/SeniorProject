<h1>Add/Edit Classroom</h1>
<hr/>

<form id="add_classroom" action="#" method="post">
	<div class="form-container edit-classroom-container">

	<div class="form-row">
		<label>Building Name:</label>
		<select name="buildingName" class="validate" required>
			<option value="">--Choose One--></option>
			<option value="1" selected="selected">Main Building</option>
		</select>
	  </div>
	  
	  <div class="form-row">
		<label>Room Number:</label>
		<input type="text" name="roomNumber" class="validate"placeholder="N210" maxlength="20" minlength="1" required />
	  </div>
	  
	  <div class="form-row">
		<label>Classroom Type:</label>
		<select name="classroomType" class="validate" required>
		  <option value="">--Choose One--</option>
		  <option value="1">Hall</option>
		  <option value="2" selected="selected">Lab</option>
		  <option value="3">Lecture</option>
		</select>
	  </div>
	  
	  <div class="form-row">
		<label>Room Capacity:</label>
		<input type="number" name="roomCap" class="validate" placeholder="15" min="0" max="30" required/>
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
	  
	  <div class="form-row">
		<label></label>
		<button class="btn btn-default" onclick="loadPage('classroom')">Cancel</button>
		<button class="btn btn-success" name="save" type="submit">Save</button>
	  </div>
	  
	</div>
</form>

<script type="text/javascript" src="./js/page/add_edit_classroom.js"></script>
