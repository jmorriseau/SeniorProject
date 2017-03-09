
//    if delete classroom  button is clicked run ajax to delete classroom
    $(document).on('click', '.delete_classroom',function (e) {
        e.stopPropagation();
        e.preventDefault();
        var classroom_id = $(this).data("delete");
		console.log(classroom_id);
        $.ajax({
            url: "php/api/ClassroomResource.php?id=" + classroom_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
				if(data !== "" && data == 'Classroom Deleted'){
					console.log("success " + data);
					alert('Classroom has been deleted.');
					loadPage('classroom');
				}
				else {
					alert(data);
				}
                
            }
        });
    });	

//Set regex validation for wach field being passed from add_edit_classroom
var classroomRegexValidations = {
	"roomNumber": /^[a-zA-Z0-9]*$/,
	"roomCap": /^[0-9]*$/
	
};




//check form on submit
function classroomCheckForm(e){
	e.preventDefault();
	
	//set flag to help check validation
	var isValid = true;
	
	//for each field in the add_edit_classroom form with the validate class, see if the field is empty or fails regex validation
	//if so set the isValid flad to false and add the error class to signify an error to the user else remove the error class
	$('#add_edit_classroom .validate').each(function(){
		console.log($(this).val());
		console.log(this.name);
		console.log(classroomRegexValidations);
		if($(this).val() == "" || !classroomRegexValidations[this.name].test($(this).val())){
			$(this).parent().addClass('error');
			isValid = false;
		}
		else {
			$(this).parent().removeClass('error');
		}
	});

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
		//alert("Form is valid");
		$.ajax({
			url: "php/api/ClassroomResource.php",
			type: type,
			dataType: "JSON",
			data: {
				buildingId: $("input[name=buildingId]").val(),
				classNumber: $("input[name=roomNumber]").val(),
				roomTypeId: $("select[name=classroomType]").val(),
				capacity: $("input[name=roomCap]").val(),
				id : $("input[name=classroomId]").val()
			},
			//if ajax is successful, return to classroom main page and alert the user
		success: function(data){
			if(data !== "" && data == 'Classroom Added'){
					alert("Classroom added successfully.")
                    loadPage('classroom');
			}
			else if(data !== "" && data == 'Classroom Updated'){
				 	alert("Classroom updated successfully.")
                	loadPage('classroom');
			}
			else{
				alert(data);
			}
		},
		//if ajax is unsuccessful, show reponse test in console
		error: function(data){
			console.log(data.responseText);
		}
		});
	}
	
	
}



