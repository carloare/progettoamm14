$(document).ready(function() {
    $('.ratings_stars').hover(

        //aggiungo e rimuovo al volo le classi css, sulla selezione corrente
        //-colore di rosso il cuore
        //-script per assegnare il voto
        //con:
        //prevAll seleziona tutti i cuori precedenti a quello corrente
        //andSelf seleziona il cuore sotto il mouse

        //passaggio avanti         

        function() {
            $(this).prevAll().andSelf().addClass('ratings_over');
        },

        //passaggio indietro
        function() {
            $(this).prevAll().andSelf().removeClass('ratings_over');
        }
    );

    //spedisce il voto al database
    $('.ratings_stars').bind('click', function() {

        //legge l'attributo selezionato
        var selezionato = $(this).attr("class");

        if (selezionato == "star_1 ratings_stars ratings_over")
            var voto = 1;
        if (selezionato == "star_2 ratings_stars ratings_over")
            var voto = 2;
        if (selezionato == "star_3 ratings_stars ratings_over")
            var voto = 3;
        if (selezionato == "star_4 ratings_stars ratings_over")
            var voto = 4;
        if (selezionato == "star_5 ratings_stars ratings_over")
            var voto = 5;

        var id_azienda = $('.box-services').attr("id");


        $.ajax({
            type: "POST",
            url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=vota",

            data: {
                voto: voto,
                id_azienda: id_azienda
            }

        }).done(function(messaggio) {
            //alert("Messaggio:" + messaggio);
            $("#rating1").toggle();
            $("#vota_hearts").html("Grazie per aver votato");
            //document.getElementsByClassName("box-byrating"). style.display = 'none';
        }).fail(function() {
            alert("Errore: si è verificato un problema. Il tuo voto è andato perso");

        });
    });
});