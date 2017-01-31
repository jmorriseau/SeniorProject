<div class="header">
<h1>Current Campuses</h1>
</div>
<hr />

<div class="campus-container">
  <section>
    <span class="close-edit fa fa-times" onClick="closeEdit()"></span>
    <div class="campus-info-container">
      <div class="campus-image access-road"></div>
      <div class="campus-address">
          <div class="campus-card-header">Access Road Campus</div>
          100 Access Road<br />
          Warwick, RI 02886
      </div>
    </div>
    <button class="btn btn-success edit-campus-btn" onclick="editCampus(this)">Edit</button>
    <div id="access-buildings" class="campus-buildings">
    </div>
  </section>

  <section>
    <span class="close-edit fa fa-times" onClick="closeEdit()"></span>
    <div class="campus-info-container">
      <div class="campus-image east-green"></div>
      <div class="campus-address">
          <div class="campus-card-header">East Greenwich Campus</div>
          One New England Tech Blvd<br />
          East Greenwich, RI 02818-1205
      </div>
    </div>
    <button class="btn btn-success edit-campus-btn" onclick="editCampus(this)">Edit</button>
    <div id="eg-buildings" class="campus-buildings">
    </div>
  </section>

  <section>
    <span class="close-edit fa fa-times" onClick="closeEdit()"></span>
    <div class="campus-info-container">
      <div class="campus-image post-road"></div>
      <div class="campus-address">
          <div class="campus-card-header">Post Road Campus</div>
          2480 Post Road<br />
          Warwick, RI 02886
      </div>
    </div>
    <button class="btn btn-success edit-campus-btn" onclick="editCampus(this)">Edit</button>
    <div id="post-rd-buildings" class="campus-buildings">
    </div>
  </section>
</div>

<script type="text/javascript">
  $(function() {
    console.log("Did It");
    var access = "";
    var eastGreen = "";
    var postRd = "";

    for(var i = 0; i < campuses.length; i++){

      if(campuses[i].campusName == "Access Road"){

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

    }

    // for(var i = 0; i < campuses.length; i++) {
    //   console.log(campuses[i].buildings.length);
    //   html += '<div class="accordian-container collapsed">';
    //   html += '<div class="accordian-header" onclick="toggleAccordian(this)">';
    //   html += '<span class="fa fa-plus"></span>';
    //   html += campuses[i].campusName;
    //   html += '</div>';
    //   html += '<div class="accordian-body">';
    //
    //     for(var x = 0; x < campuses[i].buildings.length; x++) {
    //       html += campuses[i].buildings[x].name;
    //     }
    //
    //     html += '<span class="fa fa-trash pull-right" onClick="deleteAlert()"></span>';
    //     html += '<span class="fa fa-pencil-square-o pull-right" onClick="loadPage(\'add_edit_building\')"></span>';
    //     html += '</div>';
    //     html += '</div>';
    // }

    $("#access-buildings").html(access);
    $("#eg-buildings").html(eastGreen);
    $("#post-rd-buildings").html(postRd);

    access = "";
    eastGreen = "";
    postRd = "";
  })
</script>
