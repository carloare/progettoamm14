<ul class="main-menu">
    <li>
        <div class="dropdown">
            <button class="dropbutton">MODIFICA PROFILO</button>
                <div class="dropdown-content">
    <a href="/SardiniaInFood/php/controller/AziendaController.php?cmd=modifica_profilo_personale">MODIFICA PROFILO PERSONALE</a>
    <a href="/SardiniaInFood/php/controller/AziendaController.php?cmd=modifica_profilo_azienda">MODIFICA PROFILO AZIENDA</a>
    <a href="/SardiniaInFood/php/controller/AziendaController.php?cmd=modifica_servizi">MODIFICA SERVIZI OFFERTI</a>
                </div>
            </div>
    </li>
     <li>
        <a class="alert" href ="/SardiniaInFood/php/controller/AziendaController.php?cmd=cancella" title="cancella il profilo di questa azienda" onclick ="return confirm('Sei sicuro?');">CANCELLA QUESTO PROFILO</a>
    </li>
     <li class="logout">
 
        <a href="http://localhost/SardiniaInFood/php/index.php?page=0&logout" method="POST" title="Esci">LOGOUT</a>

    </li> 

    
</ul>


