/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $('.navtab').click(function() {
        var v = $(this).attr("href");
        $(".my-tab").hide();
        $("#" + v).fadeIn(100);
    });
});
