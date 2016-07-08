$(document).ready(function(){

        
          $('#inserisci_tra_i_preferiti').click(function(){

            $.ajax({
                type: "POST",
                url: "ClienteController.php?cmd=inseriscitraipreferiti",
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById("preferenza").style.display = 'none';
            }).fail(function() { alert("Errore: si è verificato un problema"); });

        });

});


