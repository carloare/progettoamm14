jQuery(document).ready(function($){


    //al submit
    $("#recensione #submit").click(function() {
       
        //prende il commento inserito
        var comments = $("#comments").val();

if (comments.length != 0) {
    
        
    
        // crea il dataStringa da inviare
        var dataString = '&comments=' + comments                                
              
        $.ajax({ //spedizione al ClienteController per inserire la recensione
            type:"POST",
            url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=commenta",
            data: dataString,
            
            
            
        }).done(function(messaggio) {
        alert("Messaggio:" + messaggio);
              document.getElementById("comments").value= "";
            }).fail(function() { alert("Errore: si è verificato un problema. La tua recensione è andata persa");  
    
});

    }

});
});

