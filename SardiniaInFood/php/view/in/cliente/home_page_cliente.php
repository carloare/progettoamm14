<!--form di ricerca
form della home page cliente che permette di effettuare delle ricerche
-->
<article>
    <h1>HOME PAGE CLIENTE</h1>
</article>
<article>

<form>
 

<input type="text" name="citta" value="<?php if (isset($_POST['citta'])) echo $_POST['citta']; else echo "Dove";?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attività">
                
<?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 1)) { ?> <option value="1" selected>Agriturismo</option><?php } ?> 
    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 2)) { ?> <option value="2" selected>American Bar</option><?php } ?>
        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 3)) { ?> <option value="3" selected>Bar Caff&egrave;</option><?php } ?> 
            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 4)) { ?> <option value="4" selected>Birreria</option><?php } ?>
                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 5)) { ?> <option value="5" selected>Bistrot</option><?php } ?>
                    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 6)) { ?> <option value="6" selected>Fast Food</option><?php } ?> 
                        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 7)) { ?> <option value="7" selected>Gelateria</option><?php } ?>
                            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 8)) { ?> <option value="8" selected>Osteria</option><?php } ?> 
                                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 9)) { ?> <option value="9" selected>Pasticceria</option><?php } ?>
                                    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 10)) { ?> <option value="10" selected>Pizzeria</option><?php } ?>
                                        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 11)) { ?> <option value="11" selected>Pub</option><?php } ?> 
                                            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 12)) { ?> <option value="12" selected>Ristorante</option><?php } ?>
                                                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 13)) { ?> <option value="13" selected>Self Service</option><?php } ?> 
                                                    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 14)) { ?> <option value="14" selected>Snack Bar</option><?php } ?>
                                                        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 15)) { ?> <option value="15" selected>Take Away</option><?php } ?>
                                                            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 16)) { ?> <option value="16" selected>Trattoria</option><?php } ?> 
                                                                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 17)) { ?> <option value="17" selected>Altro</option><?php } ?> 
                                                                    <?php if (!isset($_POST['tipo_attivita_id'])) { ?><option value="-1">Cosa</option><?php } ?>
                    
                <option value="-1">Tutto</option>
                <option value="1">Agriturismo</option> 
                <option value="2">American Bar</option>
                <option value="3">Bar Caff&egrave;</option>
                <option value="4">Birreria</option>
                <option value="5">Bistrot</option>
                <option value="6">Fast Food</option>
                <option value="7">Gelateria</option>
                <option value="8">Osteria</option>
                <option value="9">Pasticceria</option>
                <option value="10">Pizzeria</option>
                <option value="11">Pub</option>
                <option value="12">Ristorante</option>
                <option value="13">Self Service</option>
                <option value="14">Snack Bar</option>
                <option value="15">Tack Away</option>
                <option value="16">Trattoria</option>
                <option value="17">Altro</option>
            </select>  
          

</form> 
</article>
<?php
var_dump($_SESSION['current_user']);
?>