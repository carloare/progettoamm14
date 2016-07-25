$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:image").click(function() {
  
 //prendo l'id associato all'commento
 
 var id = this.id;


$.ajax({//spedizione alla ClienteController per effettuare la segnalazione della recensione
               type: "POST",
               url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=segnalazionerecensione",
               data: "id="+id,
             dataType: "text"
                
                //WORK IN PROGRESS
           }).done(function(messaggio) {
               alert("Messaggio:" + messaggio);
             
               document.getElementById(id).style.display='none';
            }).fail(function() { alert("Errore: si è verificato un problema"); });
   
});});

