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
function editCampus(elem){
  console.log(elem);

  $(".campus-container section").not(".active").addClass("inactive");
  $(elem).parent("section").removeClass("inactive").addClass("active");

console.log($(elem).siblings(".campus_cid").data("cid"));
}

function closeEdit(){
  $(".campus-container section").removeClass("active inactive");
}

</script>
