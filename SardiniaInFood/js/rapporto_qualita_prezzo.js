//funzionamento: vedi vota.js
$(document).ready(function() {
    $('.rapporto_qualita_prezzo_dollars').hover(


        function() {
            $(this).prevAll().andSelf().addClass('rapporto_qualita_prezzo_over');
        },

        function() {
            $(this).prevAll().andSelf().removeClass('rapporto_qualita_prezzo_over');
        }
    );

    $('.rapporto_qualita_prezzo_dollars').bind('click', function() {

        var selezionato = $(this).attr("class");
        if (selezionato == "dollar_1 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
            var voto_qp = 1;
        if (selezionato == "dollar_2 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
            var voto_qp = 2;
        if (selezionato == "dollar_3 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
            var voto_qp = 3;
        if (selezionato == "dollar_4 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
            var voto_qp = 4;
        if (selezionato == "dollar_5 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
            var voto_qp = 5;

        var id_azienda = $('.box-services').attr("id");

        $.ajax({
            type: "POST",
            url: "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/ClienteController.php?cmd=rapporto_qualita_prezzo",

            data: {
                voto_qp: voto_qp,
                id_azienda: id_azienda
            }

        }).done(function(messaggio) {
            //alert("Messaggio:" + messaggio);
            $("#rating2").toggle();
            $("#rapporto_qualita_prezzo").html("Grazie per aver votato");
            //document.getElementsByClassName("box-byrating dx"). style.display = 'none';
        }).fail(function() {
            alert("Errore: si è verificato un problema. Il tuo voto_qualitaprezzo è andato perso");
        });
    });
});
