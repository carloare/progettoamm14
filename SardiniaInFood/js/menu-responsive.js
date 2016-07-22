/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
      $('#mobnav-btn').click(
        function () {
          $('.main-menu').toggleClass("xactive");
        }); 
      $('.mobnav-subarrow').click(
        function () { 
          $(this).parent().toggleClass("xpopdrop");           
        }); 
    });