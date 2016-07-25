<script type="text/javascript" src="/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/banna.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/richiamo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/falso_richiamo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>


<?php
   
    include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';

?>
<h1>MODERAZIONE MESSAGGI</h1>



<article>
    <h1>WORK IN PROGRESS</h1>
</article>

<article>
    
    
    <div>
        <?php
        //conta il numero delle recensioni
$numero_recensioni_segnalate = UtenteFactory::contaSegnalazioni();

if($numero_recensioni_segnalate>0)
{

$segnalazioni_per_pagina = 10;

$pagine_totali = ceil($numero_recensioni_segnalate/10);

$pagina_corrente=(!(isset($_REQUEST['pagex'])) ? 1 : (int)$_REQUEST['pagex']);

$primo = ($pagina_corrente - 1) * $segnalazioni_per_pagina;



/**SONO ARRIVATO QUA**/

$risultati=UtenteFactory::showSegnalazioni($primo, $segnalazioni_per_pagina);


while($row = $risultati->fetch_object()) {
    
$id_cliente= $row->id_clienti;
 $recensione= $row->recensione;

 ?> <div id="nascondi"> <?php


   
    $data= $row->data;
    echo $data;
    echo ' ';
    
   $name = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
   echo $name;
 echo ' ha scritto: ';

    $recensione= $row->recensione;
    echo $recensione;
    
    $id_recensione=$row->id;
  
    ?>
        
      <!--uso l'id delle recensione per fare tutto-->
  
  <input type="image" src="/SardiniaInFood/images/remove-comment.png" id="<?php echo $id_recensione; ?>" class="falso_richiamo" alt="falso_richiamo" height="32" width="32" title="Falso richiamo">
       
     
     
              <!--uso l'id delle recensione per fare tutto-->
  
  <input type="image" src="/SardiniaInFood/images/caution.png" id="<?php echo $id_recensione; ?>" class="richiamo" alt="richiama" height="32" width="32" title="Richiama">
       
  
  <!--uso l'id cliente per fare tutto-->
        
  <input type="image" src="/SardiniaInFood/images/banned.png" id="<?php echo $id_cliente; ?>" class="banna" alt="bannato" height="32" width="32" title="Banna">
       
        <?php
        echo '</div>';
    echo '<br>';
    
}


if($segnalazioni_per_pagina>0 AND $pagine_totali>0 )
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
        <form action="/SardiniaInFood/php/controller/AmministratoreController.php#paginazione" method="POST">
        
        <input type="hidden" name="cmd" value="showsegnalazioni">
        <input type="hidden" name="pagex" value="<?php echo $pagina; ?>">
        
        <input type="submit" value="<?php echo $pagina; ?>">
    
    </form>
    <?php    
        
  
    }
}

}}
else
{echo '<h1>non sono presenti segnalazioni sulle recensioni</h1>';}












        


?>
   
 
   
   
   
   
   
   
   
   
   
   
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    </article>
    
