<ul class="menu_home_azienda">

    <li>
        <div class="dropdown" style="float:left;">
  <button class="dropbtn">Modifica profilo</button>
  <div class="dropdown-content" style="left:0;">
    <a href="/SardiniaInFood/php/controller/AziendaController.php?cmd=modifica_profilo_personale">Modifica profilo personali</a>
    <a href="/SardiniaInFood/php/controller/AziendaController.php?cmd=modifica_profilo_azienda">Modifica profilo azienda</a>
    <a href="/SardiniaInFood/php/controller/AziendaController.php?cmd=modifica_servizi">Modifica servizi offerti</a>
  </div>
</div>
    </li>
     <li>
        <a class="alert" href ="/SardiniaInFood/php/controller/AziendaController.php?cmd=cancella" title="cancella il profilo di questa azienda" onclick ="return confirm('Sei sicuro?');">CANCELLA QUESTO PROFILO</a>
    </li>
    <li>
  <!--bottone per il logout-->
        <a href="http://localhost/SardiniaInFood/php/index.php?page=0&logout" method="POST" title="Torna alla home page">LOGOUT</a>

    </li>

    
</ul>

