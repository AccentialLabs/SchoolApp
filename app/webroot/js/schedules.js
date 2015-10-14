$(document).ready(function() {

    $("#btn-schedules").click(function() {
        $("#notes").fadeOut(0);
        $("#avisos").fadeIn(1000);
    });

    $("#btn-notes").click(function() {
        $("#avisos").fadeOut(0);
        $("#notes").fadeIn(1000);
    });

    var url = window.location.href;
    /**
     * contém
     */
    if (url.indexOf("#notes") > -1) {
        $("#avisos").fadeOut(-100);
        $("#notes").fadeIn(500);
    }
    
    
            
    

});

function showModal(description, id){
    $("#modal-descrition").append(description);
    $("#modal-answer-to").val(id);
}

