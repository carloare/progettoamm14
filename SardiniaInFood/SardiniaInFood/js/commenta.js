jQuery(document).ready(function($){


    // on submit...
    $("#recensione #submit").click(function() {
       
        // comments
        var comments = $("#comments").val();


        // data string
        var dataString = '&comments=' + comments                                
        // ajax
        
       
        $.ajax({
            type:"POST",
            url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=commenta",
            data: dataString,
            
        }).done(function(messaggio) {
             // alert("Messaggio:" + messaggio);
              document.getElementById("comments").value= "";
            }).fail(function() { alert("Errore: si è verificato un problema. La tua recensione è andata persa"); 
    


    

});
});
});
