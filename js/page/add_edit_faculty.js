$(function () {
//    if delete faculty button is clicked run ajax to delete faculty
    $(".delete_faculty").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var faculty_id = $(this).data("delete");
        console.log(faculty_id + " julie");
        $.ajax({
            url: "php/api/FacultyResource.php?id=" + faculty_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                console.log("success " + data);
                alert('Faculty has been deleted.');
                loadPage('faculty');
            }
        });
    });
});


var form = document.querySelector('form');

form.addEventListener('submit', checkForm);


//Set regexValidation for each field being passed from add_edit_building
// var regexValidations = {

// };

//check form on submit
function checkForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;

    //for each field in the add_subject form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    // $('#add_faculty .validate').each(function () {
    //     //$(this).length <= 0) ||
    //     if ($(this).val() == "" || !regexValidations[this.name].test(this.value)) {
    //         $(this).parent().addClass('error');
    //         console.log($(this).val());
    //         isValid = false;
    //     }
    //     else {
    //         $(this).parent().removeClass('error');
    //     }
    // });

    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (isValid == false) {
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

        $.ajax({
            url: "php/api/FacultyResource.php",
            type: type,
            dataType: "JSON",
            data: {
                firstName: $("input[name=firstName]").val(),
                lastName: $("input[name=lastName]").val(),
                phoneNumber: $("input[name=phoneNumber]").val(),
                email: $("input[name=email]").val(),
                id: $("input[name=facultyId]").val()
            },
            //if ajax is successful, return to course main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Faculty Added') {
                    alert("Faculty added successfully.")
                        loadPage('faculty');
                }
                else if (data !== "" && data == 'Faculty Updated'){
                        alert("Faculty updated successfully.")
                        loadPage('faculty');
                } 
            },
            //if ajax is unsuccessful, show response text in console
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }

}
