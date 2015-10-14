$(document).ready(function () {

    $(".resizeDiv").height($("#homeCardDivIcon").width() + 30);
    $(".homeIconConf").css("margin-top", ((($("#homeCardDivIcon").width() + 30) / 2) - 15) + "px");


    $(".resizeDivDouble").height(($("#homeCardDivIcon").width() + 30) * 2);

    $(".calendarArea").height($("#imageServiceHomeId").height());
    $(".offerArea").height($("#imageServiceHomeId").height());
    $(".homeIconConfRight").css("margin-top", (($("#imageServiceHomeId").height() / 2) - 15) + "px");
    
});