<article>
    <section id="profile">
<?php
//$_SESSION['utente'] contiene l'utente precedentemente trovato con cercautente 
//nel login

$azienda = $_SESSION['current_user'];

echo '<h3>';

echo $azienda->getNomeAzienda();

echo"<br><br>";

echo $azienda->getCitta();

echo"<br><br>";

echo $azienda->getIndirizzo();

echo"<br><br>";

echo 'tel: ';
echo $azienda->getTelefono();

echo"<br><br>";

echo $azienda->getEmail();

echo"<br><br>";

echo $azienda->getPassword();

echo"<br><br>";

echo $azienda->getSitoWeb();

echo"<br><br>";

echo $azienda->getDescrizione();

echo"<br><br>";

echo '</h3>';

?>
</section>     
    

   <?php
   echo '<br><br>contapreferenze: ';
    $preferenze = UtenteFactory::contaPreferenze();
    echo $preferenze;
    echo '<br><br>';
   ?>
    
    
    <section id="views">   
<!--mostra i risultati delle statistiche-->

<!--<img src="/FoodAdvisor/images/eyeball15.png" alt="Views" height="32" width="32" title="numero visualizzazioni"> -->

<?php

//da passare in caso di modifica del profilo
$id_azienda = $azienda->getId();

//usato nelle visualizzazione delle statistiche
$views = UtenteFactory::numeroVisualizzazioni($id_azienda);

echo '<br>';
echo $views;
echo '<br><br>';

?>

</section>  

    <section id="rating">   
    
<!--<img src="/FoodAdvisor/images/heart347.png" alt="Like" height="64" width="64" title="rating"> -->

<?php
 //nella tabella Voti vado a ricercare tutti i voti dati per una stessa azienda
    $giudizio = UtenteFactory::mediaVotoInStatistiche($id_azienda);
    
if($giudizio==0)
{
    echo '<br>';
        echo $azienda->getNomeAzienda();
        echo ' non ha ricevuto ancora nessun voto';
        echo '<br><br>';
}
else
{
    echo '<br>';
echo $giudizio;
  echo '<br><br>';
}

?>
</section> 
<?php
    
 $numero_voti=UtenteFactory::numeroVoti($id_azienda);

 
echo $numero_voti;
  echo '<br><br>';
?>
    
    
    
    
    
    
    
    
    
    
</section>  

    <section id="rating2">   
    
<!--<img src="/FoodAdvisor/images/heart347.png" alt="Like" height="64" width="64" title="rating"> -->

<?php
 //nella tabella Voti vado a ricercare tutti i voti dati per una stessa azienda
    $giudizio = UtenteFactory::rapportoQualitaPrezzoInStatistiche($id_azienda);
    
if($giudizio==0)
{
    echo '<br>';
        echo $azienda->getNomeAzienda();
        echo ' non ha ricevuto ancora nessun voto';
        echo '<br><br>';
}
else
{
    echo '<br>';
echo $giudizio;
  echo '<br><br>';
}

?>
</section> 
<?php
     $numero_voti_qp = UtenteFactory::numeroVotiQualitaPrezzo($id_azienda);
     echo  $numero_voti_qp;
  echo '<br><br>';
?>

</article>

<img src="/SardiniaInFood/images/recensioni.png" alt="recensioni">