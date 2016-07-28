<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<?php 
 if (session_status() != 2) session_start();
$azienda = $_SESSION['current_user'];
$servizi = UtenteFactory::cercaServiziAzienda($azienda->getId());
?>

<!--
 <form action="/SardiniaInFood/php/controller/AziendaController.php" method="post">
        <?php
        
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
<form action="/SardiniaInFood/php/controller/AziendaController.php" method="POST">
    

  <?php  $result=UtenteFactory::verificaServiziOfferti($id_azienda);
    //offre dei servizi
    if($result==1)
    {?>
    
    

        <?php $servizi = UtenteFactory::cercaServiziAzienda($id_azienda);
       
    
        
        while ($row = $servizi->fetch_row()) {
        

        
         if ($row[1]==1) 
      {?>
          <input type="checkbox" name="servizi[]" value="<?php echo $row[1]; ?>" checked='checked' /><span class="submitrec"><?php echo $row[0];?></span> <br>      
  <?php    }
          
      else
      {?>
       <input type="checkbox" name="servizi[]" value="<?php echo $row[1]; ?>" /><span class="submitrec"><?php echo $row[0]; ?></span> <br>      
 <?php }
        }
        
        
        }
        else
        {
             $servizi = UtenteFactory::listaServizi(); 
    while ($row = $servizi->fetch_row()) { ?>
 
                
         <input type="checkbox" name="servizi[]" value="<?php echo $row[0]; ?>" /><span class="submitrec"><?php echo $row[1];?></span><br>       
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