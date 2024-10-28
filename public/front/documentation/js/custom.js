// $(function() {
// // "use strict";
    
// });

//toggle sidebar

function sidebar_toggle() {
    $("#toggle-sidebar").click(function () {
        $(".left-sidebar").toggleClass("sidebar-toggled");
        $("#main-wrapper").toggleClass("wrapper-toggled");
    });
}

//toggle sidebar on resize

function sidebar_toggle_resize() {
    if ($(window).width() < 991) {
        $(".left-sidebar").addClass("sidebar-toggled");
        $("#main-wrapper").addClass("wrapper-toggled");
    }else {
        $(".left-sidebar").removeClass("sidebar-toggled");
        $("#main-wrapper").removeClass("wrapper-toggled");
    }
}

// Call Toggler        
$(document).ready(function() {
    $('#nav').singlePageNav();
    sidebar_toggle_resize();
    sidebar_toggle();
    $(window).resize(function() {
        sidebar_toggle_resize();
    });
});