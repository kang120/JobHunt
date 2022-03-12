function showQuestionModal(){
    console.log("gg");
    $("#container").css("opacity", 0.5);
    $("#container *").prop("disabled", true);
    $("#question-modal").css("display", "block");
}

function closeQuestionModal(){
    $("#container").css("opacity", 1);
    $("#container *").prop("disabled", false);
    $("#question-modal").css("display", "none");
}