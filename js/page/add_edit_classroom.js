$(function () {
//    if delete classroom  button is clicked run ajax to delete classroom
    $(".delete_classroom").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var classroom_id = $(this).data("delete");
		console.log(classroom_id);
        $.ajax({
            url: "php/api/ClassroomResource.php?id=" + classroom_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                console.log("success " + data);
                alert('Classroom has been deleted.');
                loadPage('classroom');
            }
        });
    });
});

var form = document.querySelector('form');

form.addEventListener('submit', checkForm);

//Set regex validation for wach field being passed from add_edit_classroom
var regexValidations = {
	"buildingName": /^[a-zA-Z 0-9]*$/,
	"roomNumber": /^[a-zA-Z 0-9]*$/,
	"classroomType": /^[a-zA-Z 0-9]*$/,
	"roomCap": /^\d+$/
};


//check form on submit
function checkForm(e){
	e.preventDefault();
	
	//set flag to help check validation
	var isValid = true;
	
	//for each field in the add_edit_classroom form with the validate class, see if the field is empty or fails regex validation
	//if so set the isValid flad to false and add the error class to signify an error to the user else remove the error class
	// $('#add_classroom .validate').each(function(){
	// 	if($(this).val() == "" || !regexValidations[this.name].test(this.value)){
	// 		$(this).parent().addClass('error');
	// 		isValid = false;
	// 	}
	// 	else {
	// 		$(this).parent().removeClass('error');
	// 	}
	// });

	// if the isValid flag gets set to false, alert the user else send to php via ajax
	if(isValid == false){
		alert("Please correct all fields.");
	}
	else {
		var type;
		if ($(".submit-form").hasClass("Add")) {
            type = "POST";
        }
        else {
            type = "PUT";
        }
		alert("Form is valid");
		$.ajax({
			url: "php/api/ClassroomResource.php",
			type: type,
			dataType: "JSON",
			data: {
				buildingId: $("select[name=buildingName]").val(),
				roomNumber: $("input[name=roomNumber]").val(),
				classroomTypeId: $("select[name=classroomType]").val(),
				roomCap: $("input[name=roomCap]").val()
			},
			//if ajax is successful, return to classroom main page and alert the user
		success: function(data){
			if(data !== ""){
				alert(data);
			}
			else {
				loadPage('classroom');
				//$("#content").load("tools/contacts/index.php", function () {
                    //     if (url == "tools/contacts/add_contact_db.php") {
                    //         alert("Contact successfully added");
                    //     }
                    //     else if (url == "tools/contacts/edit_contact_db.php") {
                    //         alert("Contact successfully edited");
                    //     }

                    // });
			}
		},
		//if ajax is unsuccessful, show reponse test in console
		error: function(data){
			console.log(data.responseText);
		}
		});
	}
	
	
}