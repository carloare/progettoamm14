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
   
     
        
        <?php 

  /*  $query="SELECT id_servizi, valore
FROM Aziende_Servizi
WHERE id_aziende =$id_azienda";   
     $result = $mysqli->query($query);
     
    
     
     while ($row = $result->fetch_array()) { 
         
         $attivita = UtenteFactory::showServizio($row[0]);
         
         
 
      if ($row[1]==1)
      {?>
          <input type="checkbox" name="servizi[]" value="<?php //echo $row[0]; ?>" checked='checked' /><span><?php //echo $attivita;?></span> <br>      
     <?php }
          
      else
      {?>
       <input type="checkbox" name="servizi[]" value="<?php //echo $row[0]; ?>" /><span><?php //echo $attivita;?></span> <br>      
     <?php }
      
            
          }}   */  
            ?>      
        
        
        

<input type="hidden" name="cmd" value="update_servizi">
<input type="submit" value="Aggiorna">
    </form>
-->


<div>
    <h3>Servizi offerti</h3>


    <form action="/SardiniaInFood/php/controller/AziendaController.php" method="POST">

        <?php $servizi = UtenteFactory::mostraServizi();
       
      //problema : altro problema è come capire che l'azienda non offre servizi
        
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
 ?>        
        

        <br>    
<input type="hidden" name="cmd" value="update_servizi">
<input type="submit" value="Aggiorna">
    </form>
</div>