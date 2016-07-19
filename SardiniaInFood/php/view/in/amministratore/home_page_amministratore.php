<?php
include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';
?>
<article>
    <h1>HOME PAGE AMMINISTRATORE</h1>
     
    <h2>Statistiche</h2>
    <h4>Numero aziende registrate: </h4> 
    <?php //numero aziende registrate 
    $aziende_registrate = UtenteFactory::contaAziende(); echo $aziende_registrate;?>
    
    
    <h4>Numero clienti registrate: </h4>
    <?php //numero clienti registrati
    $clienti_registrate = UtenteFactory::contaClienti(); echo $clienti_registrate;?>
    
    
    <h4>Numero recensioni: </h4>
    <?php //numero commenti (il nome contaRecensioni è già stato usato)
    $numero_recensioni = UtenteFactory::contaCommenti(); echo $numero_recensioni;?>  
     
     
    <h4>Numero accessi: </h4>
    <?php //numero commenti (il nome contaRecensioni è già stato usato)
    $numero_recensioni = UtenteFactory::contaVisualizzazioni(); echo $numero_recensioni;?>
     
         
    <h4>Numero recensioni per azienda: </h4>
    <?php //numero recensioni per azienda
    $media = $numero_recensioni/$aziende_registrate; echo $media; ?>
     
    
    
    <h4>Numero recensioni per cliente: </h4>
    <?php //numero recensioni per azienda
    $media = $numero_recensioni/$clienti_registrate; echo $media; ?>
    
</article>
