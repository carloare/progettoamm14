<!--menu per tornare alla home page-->
 <?php 
		
                if(isset($_GET['page']) AND $_GET['page']=='admin')
		{                    
                  
		?> <li class="blue"> 
        <a href="/SardiniaInFood/php/?page=0" title="torna alla home page">HOME</a>
    </li>	
              <?php } else { ?>
    <li> 
        <a href="/SardiniaInFood/php/?page=0" title="torna alla home page">HOME</a>
    </li>

    
<?php } ?>