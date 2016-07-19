<?php
 
/*quando si verifica un qualche tipo di errore viene riempito $_SESSION['errore']
 * con il numero che specifica il tipo di errore occorso.
 * In errore-out.php viene mostrato il messaggio di errore.
 */





if(isset($_SESSION['errore'])) {
    
    $errore = $_SESSION['errore'];
    
    
switch ($errore) {
    
    case 1: 
    //errore nella registrazione. Si è verificato un errore nel form di registrazione.
    
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Errore nell'inserimento dei dati" height="48" width="48" title="Errore nell'inserimento dei dati"> 
    <h4>Si &egrave; verificato un errore nell'inserimento dei dati</h4>
    </div>
    <?php   
 
        break;
    case 2: 
    //errore nella registrazione. L'utente che tenta di registrarsi è già presente nel database
    
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Errore nella registrazione" height="48" width="48" title="Errore nell'inserimento dei dati"> 
    <h4>Errore nella restrazione</h4>
    </div>
    <?php   
 
        break;
    
    
    case 3: 
    //errore utente non trovato
    /* CAMBIARE CICLE CON QUALCOSALTRO*/
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Errore utente inesistente" height="48" width="48" title="Errore utente inesistente"> 
    <h4>Utente non trovato</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 4: 
    //errore in fase di login; username e password possono essere vuote o composte da caratteri non validi
   
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Errore nellinserimento dei dati in login" height="48" width="48" title="Errore nellinserimento dei dati in login"> 
    <h4>Errore nellinserimento dei dati in login</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 5: 
    //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Inserire dei parametri di ricerca" height="48" width="48" title="Inserire dei parametri di ricerca"> 
    <h4>Errore inserire dei parametri di ricerca</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 6: 
    //alert nessun risultato trovato
   
        ?>
        <div class="avviso">
    <img src="/SardiniaInFood/images/avviso.png" alt="Nessun risultato &egrave; stato trovato" height="48" width="48" title="Nessun risultato &egrave; stato trovato"> 
    <h4>ATTENZIONE nessun risultato trovato</h4>
    </div>
    <?php   
 
        break;
    
    
    case 7: 
    //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   
        ?>
        <div class="errore">
    <img src="/SardiniaInFood/images/error.png" alt="Utente Bannato" height="48" width="48" title="Utente Bannato"> 
    <h4>Errore impossibile effettuare l'accesso a SardegnaInFood<br>Utente Bannato</h4>
    </div>
    <?php   
 
        break;

} 
//pulizia
unset($_SESSION['errore']);
$errore=0;
}
?>
