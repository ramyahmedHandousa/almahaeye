/*global $, jQuery, alert*/

$(document).ready(function () {
    "use strict";
    //main-slider
    $('.main-slider').slick({
        dots: true,
        arrows: false,
        rtl:true,
        autoplay:true,
        autoplaySpeed:5000,
    });
    // dropdown
    $(".mega-menu").click(function(){
        $(".mega-menu-dropdown").toggleClass("show-hide");
    });
    //price slider
    if($('#price').length){
        $("#price").slider({});
    }

    $('.notifications > a').click(function() {
        $('.notification-content').toggle(
            function() {
                $(this).closest('li').toggleClass('active');
            }
        );
    });


});
