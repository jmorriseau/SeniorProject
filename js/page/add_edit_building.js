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
                if(data !== "" && data == 'Building Deleted'){
                //     console.log("success " + data);
                // alert('Building has been deleted.');
                // loadPage('building');
                $(".building-modal").removeClass("error-modal");
                $('.building-modal .modal-header').html("Building");
                    $('.building-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                "Building deleted successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.building-modal');
                    setTimeout(function(){closeModal('.building-modal');loadPage('building')},3000);
                }
                else{
                    alert(data);
                }
            }
        });
    });

});


    var formBuildings = document.querySelectorAll('#add_edit_building');


if(formBuildings.length) {
    formBuildings[0].addEventListener('submit', checkForm);
    formBuildings[1].addEventListener('submit', checkForm);
    formBuildings[2].addEventListener('submit', checkForm);
}


//Set regexValidation for each field being passed from add_edit_building
var buildingRegexValidations = {
    "buildingName": /^[a-zA-Z 0-9]*$/,
    "campusName": /^[a-zA-Z 0-9]/,
    "addressLine1": /^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$/,
    "addressLine2": /[a-z0-9]/i,
    "city": /(?:[A-Z][a-z.-]+[ ]?)+/,
    "state": /^[A-Z]{2}$/,
    "zip": /\b\d{5}(?:-\d{4})?\b/
};



//check form on submit
function checkForm(e) {
    e.preventDefault();

    //console.log(e.target);

    var specificForm = this;
    var buildingErrorList = "";

    specificForm.isValid = true;
    //console.log("Value :" + specificForm.isValid + " before the loop");
    //if address two has a value, add the validator class, if not, remove the validator class
    if ($.trim($("input[name=addressLine2]").val()) != "") {
        $("input[name=addressLine2]").addClass('validate');
    }
    else {
        $("input[name=addressLine2]").removeClass('validate');
    }

    //for each field in the add_edit_building form the with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    $(e.target).find('.validate').each(function () {
        //$(this).length <= 0) ||
        if ($(this).val() == "" || !buildingRegexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            //console.log($(this).val());
            //alert($(this).parent().find("label").text());
            buildingErrorList += $(this).parent().find("label").text() + "<br /> ";
            
        specificForm.isValid = false;
            //console.log("Value is : " + specificForm.isValid + " in the error loop");
        }
        else {
            $(this).parent().removeClass('error');
           //console.log($(this).val());
            //console.log("Value is : " +specificForm.isValid + " in the remove error loop");
        }
    });

    //console.log("Value is :" +this.isValid + " after the loop");
    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (specificForm.isValid == false) {
        $(".building-modal").addClass("error-modal");
        $('.building-modal .modal-header').html("Building");
        $('.building-modal .modal-body').html(

            '<div class="alert-box warning">' +
            '<div class="alert-icon">' + 
                '<span class="fa fa-exclamation-triangle"></span>' +
            '</div>' +
            '<div class="alert-text">' +
                "Please correct the following fields:<br />" + 
                buildingErrorList +
            '</div>' +
            '</div>' 
        )
        launchModal('.building-modal');
    }
    else {
        var type;
        var buldingName = $.trim($(this).find('input[name=buildingName]').val());
		var addressLineConcat = $.trim($(this).find("input[name=addressLine1]").val()) + " " + $.trim($(this).find("input[name=addressLine2]").val());
        if ($(".submit-form").hasClass("Add")) {
            type = "POST";
        }
        else {
            type = "PUT";
        }
        //alert("Type: " + type);
        $.ajax({
            url: "php/api/BuildingResource.php",
            type: type,
            dataType: "JSON",
            data: {
                buildingName: $.trim($(this).find('input[name=buildingName]').val()),
                campusName: $.trim($(this).find("select[name=campusName]").val()),
                addressLine1: addressLineConcat,
                city: $.trim($(this).find("input[name=city]").val()),
                state: $.trim($(this).find("select[name=state]").val()),
                zip: $.trim($(this).find("input[name=zip]").val()),
                id: $.trim($(this).find("input[name=buildingId]").val())
            },
            //if ajax is successful, return to building main page and alert the user
            success: function (data) {
                if (data !== "" && data == 'Building Added') {
                    // alert("Building added successfully.")
                    // loadPage('building');
                    $(".building-modal").removeClass("error-modal");
                    $('.building-modal .modal-header').html("Building");
                    $('.building-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                buldingName +
                                " has been added successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.building-modal');
                    setTimeout(function(){closeModal('.building-modal');loadPage('building')},3000);
                }
                else if (data !== "" && data == 'Building Updated'){
                    // alert("Building updated successfully.")
                    // loadPage('building');
                    $(".building-modal").removeClass("error-modal");
                    $('.building-modal .modal-header').html("Building");
                    $('.building-modal .modal-body').html(
                        '<div class="alert-box info">' +
                            '<div class="alert-icon">' +
                                '<span class="fa fa-info-circle"></span>' +
                            '</div>' +
                            '<div class="alert-text">' +
                                buldingName +
                                " has been updated successfully." +
                            '</div>' +
                        '</div>'
                    )
                    launchModal('.building-modal'); 
                    setTimeout(function(){closeModal('.building-modal');loadPage('building')},3000);
                } 
                else {
                    alert(data);
                }
            },
            //if ajax is unsuccessful, show response text in console
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }

}
