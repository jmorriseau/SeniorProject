<?php
//if campus id is passed set it to a php variable
if (isset($_GET['cid'])) {
    $campus_id = $_GET['cid'];
}
if(isset($_GET['cn'])){
  $campus_name = $_GET['cn'];
}

include('./autoload.php');

 $db = new DAO();

 $data = array();

 $data = $db->sql("SELECT * FROM Building where campus_id = '" .$campus_id ."'");
 //var_dump(count($data));  
 //var_dump($data);
  
 foreach($data as $d){
    echo '<div class="buildings-row edit_building" data-cn="' .$campus_name. '" data-bid="' .$d[building_id]. '">' . $d[building_name];
    echo "<button class='btn btn-success pull-right'>";
    echo '<span class="fa fa-plus-circle"></span>';
    echo 'Add building';
    echo '</button>';
    echo '</div></div>';    
 }
 ?>

 <script>
  $(function(){
      //if an existing building is clicked load edit building and fill existing information 
      $(".edit_building").on("click",function(){
          var bid = $(this).data("bid");
          var cn = $(this).data("cn");
          console.log("got the building id " + bid);
          console.log("still have the campus name " + cn);
          $.ajax({
            method:"GET",
            url:'php/add_edit_building.php?bid=' + bid + '&cn=' + cn,
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



