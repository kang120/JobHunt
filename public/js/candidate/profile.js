function showAddEducationForm(){
    $("#add-btn").css("display", "none");
    $("#add-profile-form").css("display", "block");
}

function closeAddProfileForm(){
    $("#add-btn").css("display", "block");
    $("#add-profile-form").css("display", "none");
}

window.onload = function(){
    $("#add-btn").click(function(){
        showAddEducationForm();
    })
}
