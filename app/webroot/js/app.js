$(document).ready(function(){
    $("ul.notes-echelle").addClass("js");
    $("ul.notes-echelle li").addClass("note-off");
    $("ul.notes-echelle li").mouseover(function() {
        $(this).nextAll("li").addClass("note-off");
        $(this).prevAll("li").removeClass("note-off");
        $(this).removeClass("note-off");
    });
    $("ul.notes-echelle").mouseout(function() {
        $(this).children("li").addClass("note-off");
        $(this).find("li div.clearfix input:checked").parent("li div.clearfix").trigger("mouseover");
    });


});