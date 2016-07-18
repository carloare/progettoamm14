$(document).ready(function(){
    
    $("#nascondi1").hide();
    $("#nascondi2").hide();
    $("#nascondi3").hide();
    

    $("div#datipersonali").click('slow', function(){
        
        
         $("div#nascondi1").toggle();
         $("div#nascondi2").hide();
    $("div#nascondi3").hide();
  
        
    });   
    
    $("div#datiazienda").click('slow', function(){
        
     
         $("div#nascondi2").toggle();
         $("div#nascondi1").hide();
    $("div#nascondi3").hide();
     
        
    });    

    $("div#datiservizi").click('slow', function(){
       
   
          $("div#nascondi3").toggle();
         $("div#nascondi1").hide();
    $("div#nascondi2").hide();
    
    });    
});

