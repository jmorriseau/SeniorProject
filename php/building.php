 <script>
  $(function(){
      //if an existing contact is clicked go to add building page and fill existing information 
      $(".edit-campus-btn").on("click",function(){
          var id = $(this).data("cid");
          var cn = $(this).data("cn");
          cn = cn.replace(/ /g, '\u00a0');
          console.log("got the id " + id);
          console.log("got the campus name " + cn);
          $(".campus-buildings").load('php/building_list.php?cid=' + id + '&cn=' + cn);
      });
      //if the add new building button is clicked go to the add edit building page
      $(".add-campus-btn").on("click",function(){
          var id = $(this).data("cid");
          var cn = $(this).data("cn");
          cn = cn.replace(/ /g, '\u00a0');
          console.log("have the campus id for adding " + id);
          console.log("have the campus name for adding " + cn);
          $.ajax({
            method:"GET",
            url:'php/add_edit_building.php?cid=' + id + '&cn=' + cn,
            success: function(result){
              $('.campus-buildings').html(result);
              $(".building-form").removeClass("hide");
              $(".campus-container").css({"height": "700px", "background-color": "#e2e2e2"});
            }
          })
          //  $(".campus-buildings").load("php/building_list.php?bid=" + bid);
          //  $(".building-form").removeClass("hide");
          //  $(".campus-container").css({"height": "700px", "background-color": "#e2e2e2"});
      });
  });
</script>

<?php
include('./autoload.php');

 $db = new DAO();
 $data = array();

 ?>

<div class="header">
  <h1>Current Campuses</h1>
</div>
<hr />

<div class="campus-container">
  <?php
  $data = $db->sql("SELECT * FROM Campus");

    if (count($data) > 0) {
      foreach($data as $d) {
        echo '<section>';
        echo "<span class='close-edit fa fa-times' onClick='closeEdit()'></span>";
        echo '<div class="campus-info-container">';
          if($d["campus_id"] == 1){
            echo '<div class="campus-image east-green"></div>';
          }
          else if($d["campus_id"] == 2){
            echo '<div class="campus-image access-road"></div>';
          }
          else if($d["campus_id"] == 3){
            echo '<div class="campus-image post-road"></div>';
          }
        echo '<div class="campus-address">';
        echo '<div class="campus-card-header">' . $d['campus_name'] .'</div>';
        echo '<button class="btn btn-success add-campus-btn" data-cid="' .$d["campus_id"]. '" data-cn="' .$d["campus_name"]. '">Add New Building</button>';
        echo '</div>';
        echo '</div>';
        echo '<button class="btn btn-success edit-campus-btn" data-cid="' .$d["campus_id"]. '" data-cn="' .$d["campus_name"]. '" onClick="editCampus(this)">Edit</button>';        
        echo '<div id="access-buildings" class="campus-buildings">';
        echo '</div>';
        echo '</section>';
      }
    }

  ?>
  
</div>



