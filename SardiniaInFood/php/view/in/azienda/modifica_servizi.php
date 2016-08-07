<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<?php 
   if (session_status() != 2) session_start();
   $azienda = $_SESSION['current_user'];
   $servizi = UtenteFactory::cercaServiziAzienda($azienda->getId());
   $id_azienda=$_SESSION['current_user']->getId();
   ?>
<!--verifica se l'azienda offre dei servizi -->
<div id="box-form">
   <h1 class="white">
      Modifica i servizi che offre la tua azienda
   </h1>
   <h3 class="white" >
      Servizi offerti
   </h3>
   <div>
      <div class="form-generic">
         <form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/AziendaController.php" method="POST">
            <?php  
               //verifica se l'azienda offre effettivamente dei servizi
               $result=UtenteFactory::verificaServiziOfferti($id_azienda);
                 //offre dei servizi
                 if($result==1)
                 {?>
            <?php $servizi = UtenteFactory::cercaServiziAzienda($id_azienda);
               while ($row = $servizi->fetch_row()) {
               
           ?>    
               
               
            <input type="checkbox" name="update_servizi[]" value="<?php echo $row[2]; ?>" <?php if($row[1]==1)  { ?>checked='checked' <?php } ?> /><span class="submitrec"><?php echo $row[0];?></span> <br>      
            <?php
               }
               
               
               }
               //non offre servizi
               else
               {
                    $servizi = UtenteFactory::listaServizi(); 
               while ($row = $servizi->fetch_row()) { ?>
            <input type="checkbox" name="update_servizi[]" value="<?php echo $row[0]; ?>" /><span class="submitrec"><?php echo $row[1];?></span><br>       
            <?php }
               }
               
               
               ?>        
            <br>    
            <input type="hidden" name="cmd" value="update_servizi">
            <input type="submit" class="submitrec" value="Aggiorna">
         </form>
      </div>
   </div>
</div>
