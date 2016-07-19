$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:image.richiamo").click(function() {
//prendo l'id associato all'azienda  
  id = this.id;
 
 $.ajax({ //spedizione a AmministratoreController per bannare un cliente
              type: "POST",
                url: "/SardiniaInFood/php/controller/AmministratoreController.php?cmd=richiama",
                data: "id_recensione="+id,
                dataType: "text"
                
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById('nascondi').style.display='none';
            }).fail(function() { alert("Errore: si è verificato un problema");
        });
  
});    
});