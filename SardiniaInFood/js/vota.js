
$(document).ready(function() {
 $('.ratings_stars').hover(

            //gestisce il passaggio del mouse

    function() {
        $(this).prevAll().andSelf().addClass('ratings_over');           
    },

    function() {
        $(this).prevAll().andSelf().removeClass('ratings_over');
    }
);
            
//spedisce il voto al database
$('.ratings_stars').bind('click', function() {

    var selezionato = $(this).attr("class");
    
                 if(selezionato =="star_1 ratings_stars ratings_over")
                    var voto = 1;   
                 if(selezionato =="star_2 ratings_stars ratings_over")
                    var voto = 2; 
                 if(selezionato =="star_3 ratings_stars ratings_over")
                    var voto = 3; 
                 if(selezionato =="star_4 ratings_stars ratings_over")
                    var voto = 4; 
                 if(selezionato =="star_5 ratings_stars ratings_over")
                    var voto = 5; 
                
             
                 
                 
            $.ajax({ 
                type: "POST",
                url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=vota",
                
                data: { voto : voto }
                //non fa nulla
                //{ voto: value }
                //lo prende ma da voto 0
                //{voto : "value"}
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById("vota_hearts"). style.display = 'none';
            }).fail(function() { alert("Errore: si è verificato un problema. Il tuo voto è andato perso"); 
    });		
});
});