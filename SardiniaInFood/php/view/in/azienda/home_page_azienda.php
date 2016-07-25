<script type="text/javascript" src="/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>
<?php
   
    include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';

?>



<article>

    

   <?php
   echo '<img src="/SardiniaInFood/images/star-black-fivepointed-shape.png" alt="numero preferenze" title="numero preferenze" height="64" width="64">';
    $preferenze = UtenteFactory::contaPreferenze();
    echo $preferenze;
    echo '<br><br>';
   ?>
    
    
    <section id="views">   
<!--mostra i risultati delle statistiche-->


<?php
if (session_status() != 2) session_start();
$azienda = $_SESSION['current_user'];
//da passare in caso di modifica del profilo
$id_azienda = $azienda->getId();

//usato nelle visualizzazione delle statistiche
$views = UtenteFactory::numeroVisualizzazioni($id_azienda);

echo '<img src="/SardiniaInFood/images/eye.png" alt="numero visualizzazioni" title="numero visualizzazioni" height="64" width="64">';
echo $views;
echo '<br><br>';

?>

</section>  

    <section id="rating">   
    
<!--<img src="/FoodAdvisor/images/heart347.png" alt="Like" height="64" width="64" title="rating"> -->

<?php
 //nella tabella Voti vado a ricercare tutti i voti dati per una stessa azienda
echo '<img src="/SardiniaInFood/images/heart.png" alt="media voto" title="media voto" height="64" width="64">';
    $giudizio = UtenteFactory::mediaVoto($id_azienda);
    
if($giudizio==0)
{
    echo '<br>';
        echo $azienda->getNomeAzienda();
        echo ' non ha ricevuto ancora nessun voto';
        echo '<br><br>';
}
else
{
   
echo $giudizio;
  echo '<br><br>';
}

?>
</section> 
<?php
    
 $numero_voti=UtenteFactory::numeroVoti($id_azienda);

 echo '<br><br>numero voti v: ';
echo $numero_voti;
  echo '<br><br>';
?>
    
    
    
    
    
    
    
    
    
    
</section>  

    <section id="rating2">   
    
<!--<img src="/FoodAdvisor/images/heart347.png" alt="Like" height="64" width="64" title="rating"> -->

<?php
 //nella tabella Voti vado a ricercare tutti i voti dati per una stessa azienda
echo '<img src="/SardiniaInFood/images/money-bag-with-dollar-symbol.png" alt="media rapporto qualit&agrave; prezzo" title="media rapporto qualit&agrave; prezzo" height="64" width="64">';
    $giudizio = UtenteFactory::rapportoQP($id_azienda);
    
if($giudizio==0)
{
    echo '<br>';
        echo $azienda->getNomeAzienda();
        echo ' non ha ricevuto ancora nessun voto';
        echo '<br><br>';
}
else
{
    
echo $giudizio;
  echo '<br><br>';
}

?>
</section> 
<?php
     $numero_voti_qp = UtenteFactory::numeroVotiQP($id_azienda);
     echo '<br><br>numero voti qp: ';
     echo  $numero_voti_qp;
  echo '<br><br>';
?>



</article>


<article>
    <h1 id="paginazione">Recensioni ricevute</h1>
</article>

<article>
 <img src="/SardiniaInFood/images/speech-bubbles-comment-option.png" alt="recensioni" title="recensioni" height="64" width="64">


    <div>
        <?php
        //conta il numero delle recensioni
$numero_recensioni = UtenteFactory::contaRecensioni($id_azienda);
       
$commenti_per_pagina = 10;

$pagine_totali = ceil($numero_recensioni/10);

$pagina_corrente=(!(isset($_REQUEST['pagex'])) ? 1 : (int)$_REQUEST['pagex']);

$primo = ($pagina_corrente - 1) * $commenti_per_pagina;





$risultati=UtenteFactory::showRecensioni($id_azienda, $primo, $commenti_per_pagina);

while($row = $risultati->fetch_object()) {

    $data= $row->data;
    echo $data;
    echo ' ';
    
   $name = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
   echo $name;
 echo ' ha scritto: ';

    $recensione= $row->recensione;
    echo $recensione;
    echo '<br>';
    
}


if($commenti_per_pagina>0 AND $pagine_totali>0 )
{
//link delle pagine
for($pagina=1; $pagina<=$pagine_totali; $pagina++)
{
    if($pagina_corrente==$pagina)
    {
        echo "<p>".$pagina_corrente."</p>";
       
    }
    else
    {
        
    ?>
        <form action="/SardiniaInFood/php/controller/AziendaController.php#paginazione" method="POST">
        
        <input type="hidden" name="cmd" value="showrecensioni">
        <input type="hidden" name="pagex" value="<?php echo $pagina; ?>">
        
        <input type="submit" value="<?php echo $pagina; ?>">
    
    </form>
    <?php    
        
  
    }
}

}












        


?>
   
 
   
   
   
   
   
   
   
   
   
   
    </div>
</article>