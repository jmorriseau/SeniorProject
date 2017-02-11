 <script>
  $(function(){
      //if an existing contact is clicked go to add contact page and fill existing information 
      $(".edit").on("click",function(){
          var id = $(this).data("cid");
          console.log("got the id " + id);
          //$("#content").load("tools/contacts/add_contact.php?cid=" + id);
      });
  });
</script>

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
  //var_dump($data);

    if (count($data) > 0) {
      foreach($data as $d) {
        echo '<section class="edit" data-cid="' .$d["campus_id"]. '">';
        echo "<span class='close-edit fa fa-times' onClick='closeEdit()'></span>";
        echo '<div class="campus-info-container">';
        echo '<div class="campus-image access-road"></div>';
        echo '<div class="campus-address">';
        echo '<div class="campus-card-header">' . $d['campus_name'] .'</div>';
        echo '</div>';
        echo '</div>';
        echo "<button class='btn btn-success edit-campus-btn' onClick='editCampus(this)'>Edit</button>";
        echo '<div id="access-buildings" class="campus-buildings">';
        echo '</div>';
        echo '</section>';
      }
    }

  ?>
  
</div>



