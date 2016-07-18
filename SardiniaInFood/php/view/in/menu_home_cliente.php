<div id="menu_home_cliente">
    <ul>
        <li>     
             <a href="/SardiniaInFood/php/controller/ClienteController.php?cmd=show_preferiti" title="mostra i miei preferiti" method="POST">Preferiti</a>
        </li>
        <?php
        if($_REQUEST['cmd']=='cercadovecosa')
{
    
echo '
    <li>
        <li>     
                    <a href="?cmd=back_clear_home_page" title="cancella i risultati ottenuti" method="POST">Pulisci</a>
        </li>
    </li>
';

}

?>
      <li>
        <a class="alert" href ="/SardiniaInFood/php/controller/ClienteController.php?cmd=cancella" title="cancella il mio profilo" onclick ="return confirm('Sei sicuro?');">Cancella profilo</a>
    </li>
    <li>
 
        <a href="http://localhost/SardiniaInFood/php/index.php?page=0&logout" method="POST" title="Esci">Logout</a>

    </li> 
        
        
        
    </ul>
</div>    
    