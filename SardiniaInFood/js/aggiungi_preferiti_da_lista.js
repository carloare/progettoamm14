$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:image").click(function() {
//prendo l'id associato all'azienda  
  var id = this.id;
 
 
 
 $.ajax({ //spedizione alla ClienteController per essere cancellato dai preferiti
                type: "POST",
                url: "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/ClienteController.php?cmd=inseriscitraipreferiti",
                data: "id_azienda="+id,
                dataType: "text"
                
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                
                $("#preferito_da_lista"+id).toggle();
                
               // document.getElementById("profile"+id).style.display='none';
            }).fail(function() { alert("Errore: si è verificato un problema"); });
  
});    
});

