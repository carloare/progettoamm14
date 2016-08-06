<!--pagina di moderazione delle recensioni / commenti.-->
<script type="text/javascript" src="/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/js/banna.js"></script>
<script type="text/javascript" src="/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/js/richiamo.js"></script>
<script type="text/javascript" src="/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/js/falsa_segnalazione.js"></script>
<script type="text/javascript" src="/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<script type="text/javascript" src="/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/js/customize-amm.js"></script>
<?php   
   include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/UtenteFactory.php';
   //conta il numero delle recensioni
   $numero_recensioni_segnalate = UtenteFactory::contaSegnalazioni();
   //se ci sono delle segnalazioni
   if($numero_recensioni_segnalate>0)
   {
   //paginazione 
       //numero sengnalazioni per pagina
   $segnalazioni_per_pagina = 10;
       //calcolo per trovare il numero totale delle necessarie per mostrare tutti i commenti sengnalati
   $pagine_totali = ceil($numero_recensioni_segnalate/10);
       //'calcolo' per trovare la pagina corrente
   $pagina_corrente=(!(isset($_REQUEST['pagex'])) ? 1 : (int)$_REQUEST['pagex']);
        //calcolo per trovare la prima pagina da visualizzare
   $primo = ($pagina_corrente - 1) * $segnalazioni_per_pagina;
   ?> 
<div class="page-administration">
   <h1>MODERAZIONE RECENSIONI</h1>
   <?php
      //mostra le recensioni segnalate
      $risultati=UtenteFactory::showSegnalazioni($primo, $segnalazioni_per_pagina);
      ?> 
   <?php
      while($row = $risultati->fetch_object()) {    
          //mini-profilo
          $id_cliente= $row->id_clienti;
          $recensione= $row->recensione;
          $data= $row->data;
          $name = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
          $id_recensione=$row->id;
          //cerca l'id dell'autore della recensione 
          $id_scrittore=UtenteFactory::cercaClientePerIdRecensione($id_recensione);
          //cerca l'id della segnalazione
          $id_segnalazione=UtenteFactory::idSegnalazioni($id_recensione, $id_scrittore);
      //le tre operazioni che l'amministratore può compiere sono:
          //- bannare immediatamente l'autore della recensione
          //- fare un richiamo all'autore della recensione (sono ammessi massimo 3 richiami dopo di che il cliente è bannato automaticamente)
          //- occorre gestire il caso di una falsa segnalazione          
          ?>  
   <div class="cancella<?php echo $id_cliente; ?>">
    <div class="segnalazione<?php echo $id_segnalazione; ?>">
      <div class="moderation-review">
         <p class="bold"><?php echo $name; ?></p>
         <p class="bold"><?php echo $data; ?> </p>
         <p><?php echo $recensione; ?></p>
         <div class="actions">
            <div class="form-banna">
               <input type="submit" id="<?php echo $id_scrittore; ?>"  class="banna" value="BANNA" >
            </div>
            <div class="form-richiamo">
               <input type="submit" id="<?php echo $id_recensione."-".$id_segnalazione;?>" class="richiamo" value="RICHIAMO" >
            </div>
            <div class="form-falso-richiamo">
               <input type="submit"  id="<?php echo $id_recensione."-".$id_segnalazione; ?>" class="falsa_segnalazione" value="FALSO RICHIAMO" >
            </div>
         </div>
      </div>
    </div>
   </div>
   <?php
      }?>
</div>


<div id="paginazione" class="showcase_pagination">
<?php
   if($segnalazioni_per_pagina>0 AND $pagine_totali>0 )
   {
   //link delle pagine
   for($pagina=1; $pagina<=$pagine_totali; $pagina++)
   {
       if($pagina_corrente==$pagina)
       {
            ?> <div id="current-page"><?php echo $pagina; ?></div> <?php       
       }
       else
       {        
       ?>
<form class="bottom-pagination" action="/SardiniaInFood/php/controller/AmministratoreController.php#paginazione" method="POST">        
   <input type="hidden" name="cmd" value="showsegnalazioni">
   <input type="hidden" name="pagex" value="<?php echo $pagina; ?>">        
   <div class="other-page"><input type="submit" value="<?php echo $pagina; ?>"></div>    
</form>
<?php   
   }
   }
   }
   } 
    else
   {echo '<h1>non sono presenti segnalazioni sulle recensioni</h1>';}
   ?>
</div>
