$(document).ready(function(){
    
//Il JQUERY partirà al click sull'immgaine
$("input:submit.banna").click(function() {
//id dello scrittore della recensione + id segnalazione  
  var id = this.id;
 //splitta gli id
 var vector = id.split("-");
 //ottengo
 //vector[0] è l'id del cliente
 //vector[1] è l'id della segnalazione
 $.ajax({ //spedizione a AmministratoreController per bannare un cliente
              type: "POST",
                url: "/SardiniaInFood/php/controller/AmministratoreController.php?cmd=banna",
                data: "id_cliente="+vector[0],
                dataType: "text"
                
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                $(".segnalazione"+vector[1]).toggle();
             
            }).fail(function() { alert("Errore: si è verificato un problema");
        });
  
});    
});


