<?php
echo 'hello';
include('./autoload.php');

 $db = new DAO();

 $data = array();
 $campuses = array();
 ?>



<div class="header">
<h1>Current Campuses</h1>
</div>
<hr />

<div class="campus-container">
<?php
$data = $db->sql("SELECT * FROM Campus");
var_dump(count($data));
var_dump($data);

if (count($data) > 0) {
  echo "pickles";
  foreach($data as $d) {
    echo '<section>';
    echo "<span class='close-edit fa fa-times' onClick='closeEdit()'></span>";
    echo '<div class="campus-info-container">';
    echo '<div class="campus-image access-road"></div>';
    echo '<div class="campus-address">';

    echo '<div class="campus-card-header">' . $d['campus_name'] .'</div>';
    echo '</div>';
    echo '</div>';
    echo "<button class='btn btn-success edit-campus-btn' onClick='editCampus(this)'>Edit</button>";
    echo '<div class="campus_cid" data-cid="' .$d["campus_id"]. '">'.$d["campus_id"]. '</div>';
    echo '<div id="access-buildings" class="campus-buildings">';
    echo '</div>';
    echo '</section>';

  }
}

?>
</div>

<script type="text/javascript">
<<<<<<< HEAD
function editCampus(elem){
  console.log(elem);
=======
  $(function() {
    console.log("Did It");
    var access = "";
    var eastGreen = "";
    var postRd = "";

console.log(campuses.length);
    for(var i = 0; i < campuses.length; i++){
console.log(campuses[i]);
      if(campuses[i].campusName == "Access Road"){
        console.log(campuses[i].buildings);
         for(var x = 0; x < campuses[i].buildings.length; x++){
           access += "<div class='buildings-row'>";
           access += campuses[i].buildings[x].name;
           access += "<button class='btn btn-success pull-right' onclick='loadSubPage(\"add_edit_building\")'>";
           access += '<span class="fa fa-plus-circle"></span>';
           access += 'Add building';
           access += '</button>';
           access += '</div>';
         }

      }
      else if(campuses[i].campusName == "East Greenwich"){

         for(var x = 0; x < campuses[i].buildings.length; x++){
           eastGreen += "<div class='buildings-row'>";
           eastGreen += campuses[i].buildings[x].name;
           eastGreen += "<button class='btn btn-success pull-right' onclick='loadPage(\"add_edit_building\")'>";
           eastGreen += '<span class="fa fa-plus-circle"></span>';
           eastGreen += 'Add building';
           eastGreen += '</button>';
           eastGreen += '</div>';
         }

      }
      else if(campuses[i].campusName == "Post Road"){

         for(var x = 0; x < campuses[i].buildings.length; x++){
           postRd += "<div class='buildings-row'>";
           postRd += campuses[i].buildings[x].name;
           postRd += "<button class='btn btn-success pull-right' onclick='loadPage(\"add_edit_building\")'>";
           postRd += '<span class="fa fa-plus-circle"></span>';
           postRd += 'Add building';
           postRd += '</button>';
           postRd += '</div>';
         }
      }
>>>>>>> 472c16c2443c623cac5cf54a4f2d03e2848fa233

  $(".campus-container section").not(".active").addClass("inactive");
  $(elem).parent("section").removeClass("inactive").addClass("active");

console.log($(elem).siblings(".campus_cid").data("cid"));
}

function closeEdit(){
  $(".campus-container section").removeClass("active inactive");
}

</script>
