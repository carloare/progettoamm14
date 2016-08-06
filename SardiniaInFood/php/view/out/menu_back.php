<!--menu per tornare alla home page-->
 <?php 
		
                if(isset($_GET['page']) AND $_GET['page']=='admin')
		{                    
                  
		?> <li class="blue"> 
        <a href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/?page=0" title="torna alla home page">BACK</a>
    </li>	
              <?php } else { ?>
    <li> 
        <a href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/?page=0" title="torna alla home page">BACK</a>
    </li>

    
<?php } ?>
