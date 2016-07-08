$(document).ready(function() {
 $('.rapporto_qualita_prezzo_dollars').hover(

            //gestisce il passaggio del mouse

    function() {
        $(this).prevAll().andSelf().addClass('rapporto_qualita_prezzo_over');           
    },

    function() {
        $(this).prevAll().andSelf().removeClass('rapporto_qualita_prezzo_over');
    }
);
            
//spedisce il voto_qp al database
$('.rapporto_qualita_prezzo_dollars').bind('click', function() {

    var selezionato = $(this).attr("class");
                 if(selezionato =="dollar_1 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
                    var voto_qp = 1;   
                 if(selezionato =="dollar_2 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
                    var voto_qp = 2; 
                 if(selezionato =="dollar_3 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
                    var voto_qp = 3; 
                 if(selezionato =="dollar_4 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
                    var voto_qp = 4; 
                 if(selezionato =="dollar_5 rapporto_qualita_prezzo_dollars rapporto_qualita_prezzo_over")
                    var voto_qp = 5; 
             
            $.ajax({
                type: "POST",
                url: "/SardiniaInFood/php/controller/ClienteController.php?cmd=rapporto_qualita_prezzo",
                   
                data: { voto_qp : voto_qp }
                //non fa nulla
                //{ voto_qp: value }
                //lo prende ma da voto_qp 0
                //{voto_qp : "value"}
            }).done(function(messaggio) {
                alert("Messaggio:" + messaggio);
                document.getElementById("rapporto_qualita_prezzo"). style.display = 'none';
            }).fail(function() { alert("Errore: si è verificato un problema. Il tuo voto_qp è andato perso"); 
    });		
});
});

