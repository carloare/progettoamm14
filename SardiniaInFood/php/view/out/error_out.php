<?php
   /*quando si verifica un qualche tipo di errore il BaseController lo inserisce in $_SESSION['errore']:
   * indicando il caso che specifica il tipo di errore occorso.
   * In errore-out.php viene mostrato il messaggio di errore.
   */
   if(isset($_SESSION['errore'])) {   
       
      $errore = $_SESSION['errore'];  
      
 switch ($errore) {
   case 1: 
   //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   ?>
<!--<div class="errore">Errore nell'inserimento dei dati<br>Verificare che tutti i campi siano stati completati correttamente </div>
--><?php   
   //break;
   case 2: 
   //errore nella registrazione. L'utente che tenta di registrarsi è già presente nel database    
   ?>
<div class="errore">Errore nella restrazione</div>
<?php    
   break;       
   case 3: 
   //errore durante il login. Utente non trovato
   ?>
<div class="errore">Errore: l'utente non &egrave; stato trovato</div>
<?php   
   break;       
   case 4: 
   //errore in fase di login; username e password possono essere vuote o composte da caratteri non validi   
   ?>
<div class="errore">Errore: lo username e/o la password non sono stati inseriti correttamente</div>
<?php   
   break;   
   case 5: 
   //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
    ?>
<div class="errore">Errore: inserire almeno un parametro per poter eseguire la ricerca</div>
<?php   
   break;   
   case 6: 
   //alert nessun risultato trovato
   ?>
<div class="avviso">Nessun risultato &egrave; stato trovato</div>
<?php   
   break;
   case 7: 
   //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   ?>
<div class="errore">Errore: impossifile effettuare l'accesso. Utente bannato!</div>
<?php   
   break;
   case 8: 
   //errore in fase di ricerca. Campo citta vuoto e tipo di attività non indicato
   ?>
<div class="errore">Errore: non &egrave; possibile registrarsi con Username uguale a 'Username' e Password uguale a 'Password'</div>
<?php   
   break;
   } 
   //pulizia
   unset($_SESSION['errore']);
   $errore=0;
   }
   ?>