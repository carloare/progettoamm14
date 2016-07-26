<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<?php 
 if (session_status() != 2) session_start();
$azienda = $_SESSION['current_user'];
$servizi = UtenteFactory::cercaServizi($azienda->getId());
?>

<!--
 <form action="/SardiniaInFood/php/controller/AziendaController.php" method="post">
        <?php
        
        $id_azienda=$_SESSION['current_user']->getId();
        ?>
   


<!--verifica se l'azienda offre dei servizi -->

<form action="/SardiniaInFood/php/controller/AziendaController.php" method="POST">
    

  <?php  $result=UtenteFactory::verificaServiziOfferti($id_azienda);
    //offre dei servizi
    if($result==1)
    {?>
    
    

        <?php $servizi = UtenteFactory::mostraServizi();
       
    
        
        while ($row = $servizi->fetch_row()) {
        

        
         if ($row[0]==1) 
      {?>
          <input type="checkbox" name="servizi[]" value="<?php echo $row[2]; ?>" checked='checked' /><span><?php echo $row[1];?></span> <br>      
  <?php    }
          
      else
      {?>
       <input type="checkbox" name="servizi[]" value="<?php echo $row[2]; ?>" /><span><?php echo $row[1]; ?></span> <br>      
 <?php }
        }
        
        
        }
        else
        {
             $servizi = UtenteFactory::listaServizi(); 
    while ($row = $servizi->fetch_row()) { ?>
 
                
         <input type="checkbox" name="servizi[]" value="<?php echo $row[0]; ?>" /><span><?php echo $row[1];?></span><br>       
       <?php }
        }
        
        
        
        
        
        
        
 ?>        
        
       
       
       
       

        <br>    
<input type="hidden" name="cmd" value="update_servizi">
<input type="submit" value="Aggiorna">
    </form>
</div>