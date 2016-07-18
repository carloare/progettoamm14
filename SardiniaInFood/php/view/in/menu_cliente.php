<ul class="menu">
<?php

if($_REQUEST['cmd']=='show_preferiti' || $_REQUEST['cmd']=='indietro')
{
    
echo '
    <li>
        <li>     
             <a href="?cmd=back_home_page" title="ritorna alla Homepage" method="POST">Home</a>
        </li>
    </li>
';
}



if($_REQUEST['cmd']=='cercadovecosa')
{
    
echo '
    <li>
        <li>     
             <a href="?cmd=back_home_page" title="pulisci dai risultati" method="POST">Pulisci</a>
        </li>
    </li>
';
}

if($_REQUEST['cmd']=='profileandvote')
{
echo '
    <li>
        <li>     
             <a href="?cmd=indietro" method="POST" title="ritorna alla pagina precedente">&laquo; Indietro</a>
        </li>
    </li>
';
}

else
{
    
}


if($_REQUEST['cmd']!='profileandvote' AND $_REQUEST['cmd']!='show_preferiti')
{
echo '
     <li>
        <li>     
             <a href="/SardiniaInFood/php/controller/ClienteController.php?cmd=show_preferiti" title="mostra i miei preferiti" method="POST">Preferiti</a>
        </li>
    </li>
';
}
else
{
    
}

?>


    <div id="uscita">
       <li>
        <a class="alert" href ="/SardiniaInFood/php/controller/ClienteController.php?cmd=cancella" title="cancella il mio profilo" onclick ="return confirm('Sei sicuro?');">Cancella profilo</a>
    </li>
    <li>
 
        <a href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/index.php?page=0" method="POST" title="Ritorna alla home page">Logout</a>

        
    </li>
    </div>
    
    
</ul>
