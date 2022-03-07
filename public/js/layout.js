const baseUrl = "http://localhost/JobHunt/public/";

function displayUserDropDownMenu(){
    $("#user-dropdown").css("display", "block");
}

function closeUserDropDownMenu(){
    $("#user-dropdown").css("display", "none");
}

window.onload = function(){
    $("#profile-nav").click(function(){
        if($("#user-dropdown").css("display") == "none"){
            displayUserDropDownMenu();
        }else{
            closeUserDropDownMenu();
        }
    });

    $("#profile-nav").click(function(e){
        e.stopPropagation();
    })
}

window.onclick = function(){
    closeUserDropDownMenu();
}

function view_profile(){
    window.location.href = baseUrl + "candidate/profile";
}

function signout(){
    window.location.href = baseUrl + "?status=signout";
}
