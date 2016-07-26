<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<div id="box-form">

    
        <h1 class="white">

   Registrazione nuova azienda

</h1>
<h3 class="white" >
Servizi offerti
</h3>
    
<div>
     <div class="form-generic">   
    
<form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">

    <?php $servizi = UtenteFactory::listaServizi(); 
    while ($row = $servizi->fetch_row()) { ?>
 
                
         <input class="submitrec" type="checkbox" name="servizi[]" value="<?php echo $row[0]; ?>" /><span class="submitrec" ><?php echo $row[1];?></span><br>       
       <?php  } ?>
 

 <br>    
 <input type="hidden" name="cmd" value="registrazione_azienda">
        <input type="hidden" name="part" value="3">
        <input class="submitrec" type="submit" value="Join">
    </form>
</div></div>
</div>