
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
					// console.log("success " + data);
					// alert('Classroom has been deleted.');
					// loadPage('classroom');
					$(".classroom-modal").removeClass("error-modal");
					$('.classroom-modal .modal-header').html("Classroom");
                    $('.classroom-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Classroom deleted successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.classroom-modal');
					setTimeout(function(){closeModal('.classroom-modal');loadPage('classroom')},3000);
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
	var classroomErrorList = "";
	//for each field in the add_edit_classroom form with the validate class, see if the field is empty or fails regex validation
	//if so set the isValid flad to false and add the error class to signify an error to the user else remove the error class
	$('#add_edit_classroom .validate').each(function(){
		console.log($(this).val());
		console.log(this.name);
		console.log(classroomRegexValidations);
		if($(this).val() == "" || !classroomRegexValidations[this.name].test($(this).val())){
			$(this).parent().addClass('error');
			isValid = false;
			classroomErrorList += $(this).parent().find("label").text() + "<br /> ";
		}
		else {
			$(this).parent().removeClass('error');
		}
	});

	// if the isValid flag gets set to false, alert the user else send to php via ajax
	if(isValid == false){
		//alert("Please correct all fields.");
		$(".classroom-modal").addClass("error-modal");
        $('.classroom-modal .modal-header').html("Classroom");
        $('.classroom-modal .modal-body').html(
            '<div class="alert-box warning">' +
            '<div class="alert-icon">' + 
                '<span class="fa fa-exclamation-triangle"></span>' +
            '</div>' +
            '<div class="alert-text">' +
                "Please correct the following fields:<br />" +
				classroomErrorList +
            '</div>' +
            '</div>'
        )
        launchModal('.classroom-modal');
	}
	else {
		var type;
		var classroomNumber = $.trim($("input[name=roomNumber]").val());
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
				classNumber: $.trim($("input[name=roomNumber]").val()),
				roomTypeId: $("select[name=classroomType]").val(),
				capacity: $.trim($("input[name=roomCap]").val()),
				id : $("input[name=classroomId]").val()
			},
			//if ajax is successful, return to classroom main page and alert the user
		success: function(data){
			if(data !== "" && data == 'Classroom Added'){
					// alert("Classroom added successfully.")
                    // loadPage('classroom');
					$(".classroom-modal").removeClass("error-modal");
					$('.classroom-modal .modal-header').html("Classroom");
                    $('.classroom-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Classroom  " + classroomNumber +
                                " has been added successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.classroom-modal');
					setTimeout(function(){closeModal('.classroom-modal');loadPage('classroom')},3000);
			}
			else if(data !== "" && data == 'Classroom Updated'){
				 	// alert("Classroom updated successfully.")
                	// loadPage('classroom');
					$(".classroom-modal").removeClass("error-modal");
					$('.classroom-modal .modal-header').html("Classroom");
                    $('.classroom-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Classroom  " + classroomNumber + 
                                " has been updated successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.classroom-modal');
					setTimeout(function(){closeModal('.classroom-modal');loadPage('classroom')},3000);
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
