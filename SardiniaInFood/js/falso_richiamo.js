$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:submit.falso_richiamo").click(function() {
//prendo l'id associato all'azienda  
  var id = this.id;

 var vector = id.split("-"); 
 
                //da qui in poi potete usare l'id recuperato per fare qualcosa
                        //in questo caso faccio apparire un alert con dentro l'id recuperato.
 
          
 
 $.ajax({ //spedizione a AmministratoreController per bannare un cliente
              type: "POST",
                url: "/SardiniaInFood/php/controller/AmministratoreController.php?cmd=falso_richiamo",
                data: "id_recensione="+vector[0],
                dataType: "text"
                
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
               $(".segnalazione"+vector[1]).toggle();
                //document.getElementsByClassName("moderation-review"). style.display = 'none';
               // document.getElementById('nascondi').style.display='none';
            }).fail(function() { alert("Errore: si è verificato un problema");
        });
  
});    
});