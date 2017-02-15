$(function () {
//    if delete contact  button is clicked run ajax to delete contact
    $(".delete_building").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var building_id = $(this).data("delete");
        $.ajax({
            url: "php/api/BuildingResource.php?id=" + building_id,
            dataType: "JSON",
            method: "DELETE",
            success: function (data) {
                console.log("success " + data);
                alert('Building has been deleted.');
                loadPage('building');
            }
        });
    });
});


var form = document.querySelector('form');

form.addEventListener('submit', checkForm);


//Set regexValidation for each field being passed from add_edit_building
var regexValidations = {
    "buildingName": /^[a-zA-Z 0-9]*$/,
    "campusName": /^[a-zA-Z 0-9]/,
    "addressLine1": /^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$/,
    "addressLine2": /[a-z0-9]/i,
    "city": /.*/,
    "state": /^[A-Z]{2}$/,
    "zip": /^\d{5}(?:[-\s]\d{4})?$/
};

//check form on submit
function checkForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;

    //if address two has a value, add the validator class, if not, remove the validator class
    if ($.trim($("input[name=addressLine2]").val()) != "") {
        $("input[name=addressLine2]").addClass('validate');
    }
    else {
        $("input[name=addressLine2]").removeClass('validate');
    }

    //for each field in the add_edit_building form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    // $('#add_building .validate').each(function () {
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
		var addressLineConcat = $("input[name=addressLine1]").val() + " " + $("input[name=addressLine2]").val();
        if ($(".submit-form").hasClass("Add")) {
            type = "POST";
        }
        else {
            type = "PUT";
        }
        alert("Type: " + type);
        $.ajax({
            url: "php/api/BuildingResource.php",
            type: type,
            dataType: "JSON",
            data: {
                buildingName: $("input[name=buildingName]").val(),
                campusName: $("select[name=campusName]").val(),
                addressLine1: addressLineConcat,
                city: $("input[name=city]").val(),
                state: $("select[name=state]").val(),
                zip: $("input[name=zip]").val(),
                id: $("input[name=buildingId]").val()
            },
            //if ajax is successful, return to building main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Building Added') {
                    alert(data + "this is where I am in the add");
                    alert("Building added successfully.")
                        loadPage('building');
                }
                else if (data !== "" && data == 'Building Updated'){
                    alert(data + "this is where I am in the update");
                        alert("Building updated successfully.")
                        loadPage('building');
                } 
            },
            //if ajax is unsuccessful, show response text in console
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }

}
