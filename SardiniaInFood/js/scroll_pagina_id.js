jQuery(document).ready(function($) {
    var id = $('input:hidden').val();
    //$('.favorites').attr('id');
    alert(id);
    //dopo l'inserimento di un commento viene fatto uno scrollo che porta nella parte superiore di 'top_recensioni'
    $(window).scrollTop($("id").offset().top);
});