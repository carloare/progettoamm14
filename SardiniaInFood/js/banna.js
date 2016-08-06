$(document).ready(function() {
    
    $("input:submit.banna").click(function() {
        //id dello scrittore della recensione + id segnalazione  
        var id = this.id;

        $.ajax({ //spedizione a AmministratoreController per bannare un cliente
            type: "POST",
            url: "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/AmministratoreController.php?cmd=banna",
            data: "id_cliente=" + id,
            dataType: "text"

        }).done(function(messaggio) {
            //fa il toggle su tutte le recensioni mandate da uno stesso cliente
            $(".cancella" + id).toggle();

        }).fail(function() {
            alert("Errore: si è verificato un problema");
        });

    });
});
