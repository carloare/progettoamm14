$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:submit.banna").click(function() {
//prendo l'id associato all'azienda  
  var id = this.id;
 
 var vector = id.split("-");
 
 $.ajax({ //spedizione a AmministratoreController per bannare un cliente
              type: "POST",
                url: "/SardiniaInFood/php/controller/AmministratoreController.php?cmd=banna",
                data: "id_cliente="+vector[0],
                dataType: "text"
                
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                $(".segnalazione"+vector[1]).toggle();
                //document.getElementsByClassName("moderation-review"). style.display = 'none';
                //document.getElementById('nascondi').style.display='none';
            }).fail(function() { alert("Errore: si è verificato un problema");
        });
  
});    
});


