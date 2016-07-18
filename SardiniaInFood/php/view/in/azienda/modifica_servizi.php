 <?php 
 if (session_status() != 2) session_start();
$azienda = $_SESSION['current_user'];
$servizi = UtenteFactory::cercaServizi($azienda->getId());
?>


 <form action="/SardiniaInFood/php/controller/AziendaController.php" method="post">
        <?php
        
        $id_azienda=$_SESSION['current_user']->getId();
        ?>
   
        <?php
   $mysqli = new mysqli();
   $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            } else {
    
?>
        
        <?php 

    $query="SELECT id_servizi, valore
FROM Aziende_Servizi
WHERE id_aziende =$id_azienda";   
     $result = $mysqli->query($query);
     
    
     
     while ($row = $result->fetch_array()) { 
         
         $attivita = UtenteFactory::showServizio($row[0]);
         
         
 
      if ($row[1]==1)
      {?>
          <input type="checkbox" name="servizi[]" checked='checked' /><span><?php echo $attivita;?></span> <br>      
     <?php }
          
      else
      {?>
       <input type="checkbox" name="servizi[]" /><span><?php echo $attivita;?></span> <br>      
     <?php }
      
            
          }}     
            ?>      
        
        
        

<input type="hidden" name="cmd" value="update_servizi">
<input type="submit" value="Aggiorna">
    </form>
