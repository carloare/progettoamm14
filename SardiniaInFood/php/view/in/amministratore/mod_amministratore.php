<script type="text/javascript" src="/SardiniaInFood/js/banna.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/richiamo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/falso_richiamo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/customize-amm.js"></script>

<?php
   
    include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';

//conta il numero delle recensioni
$numero_recensioni_segnalate = UtenteFactory::contaSegnalazioni();

if($numero_recensioni_segnalate>0)
{
    $segnalazioni_per_pagina = 10;
    $pagine_totali = ceil($numero_recensioni_segnalate/10);
    $pagina_corrente=(!(isset($_REQUEST['pagex'])) ? 1 : (int)$_REQUEST['pagex']);
    $primo = ($pagina_corrente - 1) * $segnalazioni_per_pagina;
?> 

    <div class="page-administration">
    <h1>MODERAZIONE RECENSIONI</h1> 
          <?php


/**SONO ARRIVATO QUA**/

$risultati=UtenteFactory::showSegnalazioni($primo, $segnalazioni_per_pagina);


while($row = $risultati->fetch_object()) {
    
    $id_cliente= $row->id_clienti;
    $recensione= $row->recensione;
    $data= $row->data;
    $name = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
    $recensione= $row->recensione;
    $id_recensione=$row->id;
?> 
 
 
          <div class="moderation-review">
            <p class="bold"><?php echo $name; ?></p>
            <p class="bold"><?php echo $data; ?> </p>
            <p><?php echo $recensione; ?></p>
            <div class="actions">
              <form class="form-banna"><input type="submit" value="BANNA" /></form>
              <form class="form-richiamo"><input type="submit" value="RICHIAMO" /></form>
              <form class="form-falso-richiamo"><input type="submit" value="FALSO RICHIAMO" /></form> 
            </div>
          </div>             
        </div>  
      

<?php

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
   