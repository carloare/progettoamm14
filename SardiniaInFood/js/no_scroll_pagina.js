jQuery(document).ready(function($) {
    //se si cerca di inserire un commento con lo scroll si rimane sempre fermi nel form
    $(window).scrollTop($("#recensione").offset().top);
});