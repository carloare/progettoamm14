<?php
include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';
?>

       <?php
       
       
       $numero_richiami = UtenteFactory::numeroRichiami();
      
      switch ($numero_richiami) {
    case 0:
        ?> <h6 class="no-report"></h6>
       <?php break;
    case 1:
        ?> <h6 class="report">Hai ricevuto un richiamo</h6>
       <?php break;
    case 2:
        ?> <h6 class="report">Hai ricevuto due richiami</h6>
       <?php break;
} 
       
       
       ?>



   