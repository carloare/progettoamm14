<?php
 
/*quando si verifica un qualche tipo di errore viene riempito $_SESSION['errore']
 * con il numero che specifica il tipo di errore occorso.
 * In error-out.php viene mostrato il messaggio di errore.
 */


if(session_status()!=2)
            session_start();



if(isset($_SESSION['errore'])) {
    
    $errore = $_SESSION['errore'];
    
    
switch ($errore) {
    

    
    case 1: 
    //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Inserire dei parametri di ricerca" height="48" width="48" title="Inserire dei parametri di ricerca"> 
    <h4>Errore inserire dei parametri di ricerca</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 2: 
    //errore campo commenta contiene caratteri non validi
   
       ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="errore nessun risultato trovato" height="48" width="48" title="errore nessun risultato trovato"> 
    <h4>Errore Il campo nome contiene caratteri non validi.<br>Verifica eventuali errori di battitura.</div></h4>
    </div>
    <?php     
 
        break;
    
    
    
    case 3: 
    //errore nessun risultato trovato
   
        ?>
         <div class="avviso">
    <img src="/SardiniaInFood/images/avviso.png" alt="Nessun risultato &egrave; stato trovato" height="48" width="48" title="Nessun risultato &egrave; stato trovato"> 
    <h4>ATTENZIONE nessun risultato trovato</h4>
    </div>
    <?php   
 
        break; 
    
    
    
    case 4: 
    //errore nessun risultato trovato
   
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="errore nessun risultato trovato" height="48" width="48" title="errore nessun risultato trovato"> 
    <h4>Inserire dei parametri di ricerca</h4>
    </div>
    <?php   
 
        break;
    
     case 5: 
    //errore nessun risultato trovato
   
        ?>
        <div class="successo">
    <img src="/SardiniaInFood/images/successo.png" alt="successo" height="48" width="48" title="successo!!!"> 
    <h4>L'aggiornamento ha avuto successo<br>Gli aggiornamenti saranno disponibili al prossimo login</h4>
    </div>
    <?php   
 
        break;
    
    case 6: 
    //errore nessun risultato trovato
   
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="insuccesso" height="48" width="48" title="insuccesso!!!"> 
    <h4>L'aggiornamento non ha avuto successo</h4>
    </div>
    <?php   
   
    
    
    

} 
//pulizia
unset($_SESSION['errore']);
$errore=0;
}
?>