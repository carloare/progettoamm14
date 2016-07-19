$(document).ready(function(){

        //quando si clicca l'immagine della stella
          $('#inserisci_tra_i_preferiti').click(function(){

            $.ajax({ //l'azienda viene passata per essere inserita nella lista dei preferiti
                type: "POST",
                url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=inseriscitraipreferiti",
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById("stella").style.display = 'none';
            }).fail(function() { alert("Errore: si è verificato un problema"); });

        });

});


