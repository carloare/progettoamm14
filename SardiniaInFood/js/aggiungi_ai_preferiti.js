$(document).ready(function() {

    //quando si clicca l'immagine della stella
    $('input:button').click(function() {
        var id = this.id;


        $.ajax({ //l'azienda viene passata per essere inserita nella lista dei preferiti
            type: "POST",
            url: "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/ClienteController.php?cmd=inseriscitraipreferiti",
            data: "id_azienda=" + id,
            dataType: "text"
        }).done(function(messaggio) {
            //alert("Messaggio:" + messaggio);
            $("#bottone-preferiti" + id).toggle();
            //document.getElementById("stella").style.display = 'none';
        }).fail(function() {
            alert("Errore: si è verificato un problema");
        });

    });

});
