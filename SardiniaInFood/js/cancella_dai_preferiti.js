$(document).ready(function(){
    
//button
$("input:image").click(function() {
  //alert(this.id);
  id = this.id;
 // alert(id);
 $.ajax({
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


