jQuery(document).ready(function($) {
    //dopo l'inserimento di un commento viene fatto uno scrollo che porta nella parte superiore di 'top_recensioni'
    $(window).scrollTop($(".box-reviews").offset().top);
});