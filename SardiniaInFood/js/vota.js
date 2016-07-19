
$(document).ready(function() {
 $('.ratings_stars').hover(

//aggiungo e rimuovo al volo le classi css, sulla selezione corrente
//-colore di rosso il cuore
//-script per assegnare il voto
//con:
//prevAll seleziona tutti i cuori precedenti a quello corrente
//andSelf seleziona il cuore sotto il mouse

//passaggio avanti         

    function() {
        $(this).prevAll().andSelf().addClass('ratings_over');           
    },

//passaggio indietro
    function() {
        $(this).prevAll().andSelf().removeClass('ratings_over');
    }
);
            
//spedisce il voto al database
$('.ratings_stars').bind('click', function() {

//legge l'attributo selezionato
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
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById("vota_hearts"). style.display = 'none';
            }).fail(function() { alert("Errore: si è verificato un problema. Il tuo voto è andato perso"); 
    });		
});
});