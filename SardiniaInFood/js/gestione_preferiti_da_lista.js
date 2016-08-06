$(document).ready(function() {

    $("input:image").click(function() {
        //prendo l'id associato all'azienda  
        var id = this.id;

        //splitto gli id
        var vector = id.split("-");

        //alert(vector[0]),alert(vector[1]) //validità - id_azienda


        if (vector[0] == 0) {

            $.ajax({ //spedizione alla ClienteController per essere cancellato dai preferiti
                type: "POST",
                url: "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/ClienteController.php?cmd=inseriscitraipreferiti",
                data: "id_azienda=" + vector[1],
                dataType: "text"

            });


        } else {
            $.ajax({ //spedizione alla ClienteController per essere cancellato dai preferiti
                type: "POST",
                url: "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/ClienteController.php?cmd=cancellapreferito",
                data: "id_azienda=" + vector[1],
                dataType: "text"

            });
        }

        //location.reload();
        parent.window.location.reload();

    });
});

