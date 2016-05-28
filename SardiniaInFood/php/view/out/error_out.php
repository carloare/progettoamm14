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
    //errore nella registrazione. Si è verificato un errore nel form di registrazione.
    
        ?>
        <div class="error">
    <img src="/SardiniaInFood/images/circle.png" alt="Errore nell'inserimento dei dati" height="32" width="32" title="Errore nell'inserimento dei dati"> 
    <h4>Errore nell'inserimento dei dati</h4>
    </div>
    <?php   
 
        break;
    case 2: 
    //errore nella registrazione. L'utente che tenta di registrarsi è già presente nel database
    
        ?>
        <div class="error">
    <img src="/SardiniaInFood/images/circle.png" alt="Errore nella registrazione" height="32" width="32" title="Errore nell'inserimento dei dati"> 
    <h4>Errore nella restrazione</h4>
    </div>
    <?php   
 
        break;
    
    
    case 3: 
    //errore utente non trovato
    /* CAMBIARE CICLE CON QUALCOSALTRO*/
        ?>
        <div class="warning">
    <img src="/SardiniaInFood/images/circle.png" alt="Errore utente inesistente" height="32" width="32" title="Errore utente inesistente"> 
    <h4>Utente non trovato</h4>
    </div>
    <?php   
 
        break;
    
    
    
    case 4: 
    //errore in fase di login; username e password possono essere vuote o composte da caratteri non validi
   
        ?>
        <div class="warning">
    <img src="/SardiniaInFood/images/circle.png" alt="Errore nellinserimento dei dati in login" height="32" width="32" title="Errore nellinserimento dei dati in login"> 
    <h4>Errore nellinserimento dei dati in login</h4>
    </div>
    <?php   
 
        break;

} 
//pulizia
$_SESSION['errore']=0;
}
?>
