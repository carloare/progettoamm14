<div>
    <h3>Servizi offerti</h3>

    
<form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">

    <?php $servizi = UtenteFactory::listaServizi(); 
    while ($row = $servizi->fetch_row()) { ?>
 
                
         <input type="checkbox" name="servizi[]" value="<?php echo $row[0]; ?>" /><span><?php echo $row[1];?></span><br>       
       <?php  } ?>
 

 <br>    
 <input type="hidden" name="cmd" value="registrazione_azienda">
        <input type="hidden" name="part" value="3">
        <input type="submit" value="Join">
    </form>
</div>