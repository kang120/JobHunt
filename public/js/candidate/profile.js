function first_setup_profile(){
    window.location.href = baseUrl + "candidate/profile?tab=education";
}

function changePicture(){
    $("#profile-picture").change(function(){
        $("#upload-picture").submit();
    });

    $("#profile-picture").click();
}

function showAddEducationForm(){
    $("#add-btn").css("display", "none");
    $("#add-profile-form").css("display", "block");
}

function closeAddProfileForm(){
    $("#add-btn").css("display", "block");
    $("#add-profile-form").css("display", "none");
}

function openContactForm(){
    $("#contact-box").css("display", "none");
    $("#open-contact-btn").css("display", "none");

    $("#contact-edit-box").css("display", "block");
    $("#close-contact-btn").css("display", "block");
}

function closeContactForm(){
    $("#contact-edit-box").css("display", "none");
    $("#close-contact-btn").css("display", "none");

    $("#contact-box").css("display", "block");
    $("#open-contact-btn").css("display", "block");
}

function deleteEducation(index){
    if(confirm("Are you sure to delete this education?") == true){
        $("#delete-btn-" + index).submit();
    }
}

function deleteExperience(index){
    if(confirm("Are you sure to delete this experience?") == true){
        $("#delete-btn-" + index).submit();
    }
}

function deleteSkill(index){
    if(confirm("Are you sure to delete this skill?") == true){
        $("#delete-btn-" + index).submit();
    }
}

function deleteLanguage(index){
    if(confirm("Are you sure to delete this language?") == true){
        $("#delete-btn-" + index).submit();
    }
}
