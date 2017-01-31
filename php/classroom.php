<!-- <button class="btn" onclick="launchModal('.edit-classroom','add_edit_building')">Test model edit</button> -->

<div class="modal-container edit-classroom">
  <div class="modal-header">
    Edit Classroom
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
    <button class="pull-right" onclick="closeModal('.edit-classroom')">Close</button>
  </div>
</div>

<div class="header">
  <h1>Current Classrooms</h1>
</div>
<hr />

<div class="classroom-container content-container">

  <div class="classroom-selector select-campus">
    <label>Select a campus:</label>
    <select onchange="updateSlidingSelect('.select-campus','.select-building')">
      <option value="">--Choose One--</option>
      <option value="access_road">Access Road</option>
      <option value="east_greenwich">East Greenwich</option>
      <option value="post_road">Post Road</option>
    </select>
  </div>

  <div class="classroom-selector select-building">
    <label>Select a building:</label>
    <select onchange="updateSlidingSelect('.select-building','.select-floor')">
      <option value="">--Choose One--</option>
      <option value="main_building">Main Building</option>
      <option value="east_building">East Building</option>
      <option value="west_building">West Building</option>
    </select>
  </div>

  <div class="classroom-selector select-floor">
    <label>Select a floor:</label>
    <select onchange="updateSlidingSelect('.select-floor','.result-classrooms')">
      <option value="">--Choose One--</option>
      <option value="floor_one">Frist Floor</option>
      <option value="floor_two">Second Floor</option>
      <option value="floor_three">Third Floor</option>
    </select>
  </div>

  <div class="result-classrooms">
    Available Classrooms
    <ul>
      <li>N208 <span class="pull-right"><span class="mock-link" onclick="loadPage('add_edit_classroom')">Edit</span> | <a href="#">Delete</a></span></li>
      <li>N209 <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
      <li>N210 <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
      <li>N215 <span class="pull-right"><a href="#">Edit</a> | <a href="#">Delete</a></span></li>
    </ul>
  </div>

</div>
