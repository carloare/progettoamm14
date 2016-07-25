$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:image").click(function() {
//prendo l'id associato all'azienda  
  var id = this.id;
 
 $.ajax({ //spedizione alla ClienteController per essere cancellato dai preferiti
                type: "POST",
                url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=cancellapreferito",
                data: "id_azienda="+id,
                dataType: "text"
                
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById("profile"+id).style.display='none';
            }).fail(function() { alert("Errore: si è verificato un problema"); });
  
});    
});


