/*global $, jQuery, alert*/

$(document).ready(function () {
    "use strict";
    // dropdown
    $(".mega-menu").click(function(){
      $(".mega-menu-dropdown").toggleClass("show-hide");
    });
    //price slider
    if($('#price').length){
        $("#price").slider({});
    }
    
});
