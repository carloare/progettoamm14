$(document).ready(function(){
    
//button
$("input:image").click(function() {
  
  //alert(this.id);
 id = this.id;
 

$.ajax({
               type: "POST",
               url: "ClienteController.php?cmd=segnalazionerecensione",
               data: "id="+id,
             dataType: "text"
                
                
           })//.done(function(messaggio) {
               // alert("Messaggio:" + messaggio);
              //  document.getElementById("profile"+id).style.display='none';
         //   }).fail(function() { alert("Errore: si è verificato un problema"); });
  
//    
});});

