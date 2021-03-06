<?php
//if the classroom id is passed set it to a php variable
if (isset($_GET['cid'])) {
    $classroom_id = $_GET['cid'];
}
//if the building id is passed set it to a php variable
if(isset($_GET['bid'])) {
	$building_id = $_GET['bid'];
}

include('./autoload.php');

$db = new DAO();

//if there is a classroom Id, pull classroom information
 if (isset($classroom_id)){
    $classroom = $db->sql("SELECT * FROM Classroom where classroom_id  = '" .$classroom_id ."'");
		$classRoomTypes = $db->sql("SELECT * FROM Room_Type_Table");
		//var_dump($classRoomTypes);
    $action = "Update";
 }
 else {
     $action = "Add";
 }
?>

<h1><?php echo $action ?> Classroom</h1>
<hr/>
<span class="fa fa-times pull-right" onclick="loadPage('classroom')"></span>

<div class="form-container edit-classroom-container">
	<form id="add_edit_classroom" onsubmit="classroomCheckForm(event)">

			<input type="hidden" name="buildingId" value="<?php if(isset($classroom[0]['building_id'])){echo $classroom[0]['building_id'];}else{echo $building_id;}?>"/>

			<div class="form-row">
			<label>Room Number</label>
			<input type="text" name="roomNumber" class="validate" placeholder="210" maxlength="4" minlength="1" required value="<?php if(isset($classroom[0]['class_number'])){echo rtrim($classroom[0]['class_number']);}?>"/>
			</div>

			<div class="form-row">
			<label>Classroom Type</label>
			<select name="classroomType"  required>
				<option value="">--Choose One--</option>
				<?php
						if(isset($classroom[0]['room_type_id'])){
								$classroom_selected = $classroom[0]['room_type_id'];
								if($classroom_selected == "1"){
									echo "<option value='$classroom_selected' selected='selected'>Lab</option>";
									echo "<option value='2'>Lecture</option>";
									echo "<option value='3'>Lab and Lecture</option>";
								}
								else if($classroom_selected == "2"){
									echo "<option value='1'>Lab</option>";
									echo "<option value='$classroom_selected' selected='selected'>Lecture</option>";
									echo "<option value='3'>Lab and Lecture</option>";
								}
								else if($classroom_selected == "3"){
									echo "<option value='1'>Lab</option>";
									echo "<option value='2'>Lecture</option>";
									echo "<option value='$classroom_selected' selected='selected'>Lab and Lecture</option>";
								}
						}
						else{
								echo "<option value='1'>Lab</option>";
								echo "<option value='2'>Lecture</option>";
								echo "<option value='3'>Lab and Lecture</option>";
						}
						?>
			</select>
			</div>

			<div class="form-row">
			<label>Room Capacity</label>
			<input type="number" name="roomCap" class="validate" placeholder="15" min="1" max="30" required
			value="<?php if(isset($classroom[0]['capacity'])){echo rtrim($classroom[0]['capacity']);}?>"/>
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

			<input type="hidden" name="classroomId" value="<?php if(isset($classroom[0]['classroom_id'])){echo $classroom[0]['classroom_id'];}?>"/>

			<div class="form-row">
			<label></label>
			<?php
				if($action == "Update"){
					echo '<button class="delete_classroom btn btn-default" data-delete="' . $classroom[0]['classroom_id'] . '">Delete</button>';
				}
			?>
			<button class="btn btn-success submit-form add-edit-classroom-btn <?php echo $action ?>" name="save" type="submit"><?php echo $action ?></button>
			</div>

		
	</form>
</div>

<div class="modal-container classroom-modal">
    <div class="modal-header">
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
		<p class="pull-right">You will automatically be redirected.</p>
        <button class="btn btn-success pull-right" onclick="closeModal('.classroom-modal','classroom')">Close</button>
    </div>
</div>

<script type="text/javascript" src="./js/page/add_edit_classroom.js"></script>