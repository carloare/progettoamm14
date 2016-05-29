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
        <div class="warning">
    <img src="/SardiniaInFood/images/circle.png" alt="Inserire dei parametri di ricerca" height="32" width="32" title="Inserire dei parametri di ricerca"> 
    <h4>Errore inserire dei parametri di ricerca</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 2: 
    //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   
        ?>
        <div class="warning">
    <img src="/SardiniaInFood/images/circle.png" alt="Inserire dei parametri di ricerca" height="32" width="32" title="Inserire dei parametri di ricerca"> 
    <h4>Errore inserire dei parametri di ricerca</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 3: 
    //errore nessun risultato trovato
   
        ?>
        <div class="warning">
    <img src="/SardiniaInFood/images/circle.png" alt="errore nessun risultato trovato" height="32" width="32" title="errore nessun risultato trovato"> 
    <h4>Errore nessun risultato trovato</h4>
    </div>
    <?php   
 
        break;
    
    
    

} 
//pulizia
$_SESSION['errore']=0;
}
?>