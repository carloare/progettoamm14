<?php
include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';
?>

 <ul class="main-menu">
        <li>     
             <a href="/SardiniaInFood/php/controller/ClienteController.php?cmd=show_preferiti" title="mostra i miei preferiti" method="POST">PREFERITI</a>
        </li>
        <?php
        if($_REQUEST['cmd']=='cercadovecosa')
{
    
echo '
    <li>
        <li>     
                    <a href="?cmd=back_clear_home_page" title="cancella i risultati ottenuti" method="POST">PULISCI RICERCA</a>
        </li>
    </li>
';

}

?>
      <li>
        <a class="alert" href ="/SardiniaInFood/php/controller/ClienteController.php?cmd=cancella" title="cancella il mio profilo" onclick ="return confirm('Sei sicuro?');">CANCELLA PROFILO</a>
    </li>
    

    
    <li class="logout">
 
        <a href="http://localhost/SardiniaInFood/php/index.php?page=0&logout" method="POST" title="Esci">LOGOUT</a>

    </li> 
    
    
        
    </ul>

    