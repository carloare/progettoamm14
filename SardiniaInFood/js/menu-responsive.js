$(document).ready(function() {
    $('#mobnav-btn').click(
        function() {
            $('.main-menu').toggleClass("xactive");
        });
    $('.mobnav-subarrow').click(
        function() {
            $(this).parent().toggleClass("xpopdrop");
        });
});