$(document).ready(function() {

    //Il JQUERY partirà al click sull'immgaine
    $("input:submit.richiamo").click(function() {
        //id recensione + id segnalazione  
        var id = this.id;

        //splitta gli id
        var vector = id.split("-");
        //ottengo
        //vector[0] è l'id della recensione
        //vector[1] è l'id della segnalazione
        $.ajax({ //spedizione a AmministratoreController per bannare un cliente
            type: "POST",
            url: "/SardiniaInFood/php/controller/AmministratoreController.php?cmd=richiama",
            data: "id_recensione=" + vector[0],
            dataType: "text"

        }).done(function(messaggio) {
            //alert("Messaggio:" + messaggio);
            $(".segnalazione" + vector[1]).toggle();
            //document.getElementsByClassName("moderation-review"). style.display = 'none';
            // document.getElementById('nascondi').style.display='none';
        }).fail(function() {
            alert("Errore: si è verificato un problema");
        });

    });
});