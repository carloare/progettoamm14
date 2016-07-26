<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<?php 
 if (session_status() != 2) session_start();
$azienda = $_SESSION['current_user'];

?>

<form action="/SardiniaInFood/php/controller/AziendaController.php" method="post">
   <!--fare tutto cosi-->
   <p> <label for="name_azienda">Nome Azienda:</label></p>
   <input type="text" name="name_azienda" id="name_azienda" value="<?php if(isset($_REQUEST['name_azienda'])) echo $_REQUEST['name_azienda']; else { echo $azienda->getNomeAzienda();} ?>" title="modifica il nome della tua azienda"> 
       <?php if (isset($_SESSION['name_azienda'])) echo $_SESSION['name_azienda']; ?>
  
   

   
   
  <p><label for="tipo_attivita_id">Tipo di attivit&agrave;:</label></p>

       
        <select id="tipo_attivita_id" name="tipo_attivita_id" title="modifica l'attivit&agrave; svolto">
            <option <?php if($azienda->getTipo_attivita_id() == 1 ) echo 'selected' ; ?> value='1'>Agriturismo</option>
                <option <?php if($azienda->getTipo_attivita_id() == 2 ) echo 'selected' ; ?> value="2">American Bar</option>
                    <option <?php if($azienda->getTipo_attivita_id() == 3 ) echo 'selected' ; ?> value="3">Bar Caff&egrave;</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 4 ) echo 'selected' ; ?> value="4">Birreria</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 5 ) echo 'selected' ; ?> value="5">Bistrot</option>
                <option <?php if($azienda->getTipo_attivita_id() == 6 ) echo 'selected' ; ?> value="6">Fast Food</option>
                    <option <?php if($azienda->getTipo_attivita_id() == 7 ) echo 'selected' ; ?> value="7">Gelateria</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 8 ) echo 'selected' ; ?> value="8">Osteria</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 9 ) echo 'selected' ; ?> value="9">Pasticceria</option>
                <option <?php if($azienda->getTipo_attivita_id() == 10 ) echo 'selected' ; ?> value="10">Pizzeria</option>
                    <option <?php if($azienda->getTipo_attivita_id() == 11 ) echo 'selected' ; ?> value="11">Pub</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 12 ) echo 'selected' ; ?> value="12">Ristorante</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 13 ) echo 'selected' ; ?> value="13">Self Service</option>
                <option <?php if($azienda->getTipo_attivita_id() == 14 ) echo 'selected' ; ?> value="14">Snack Bar</option>
                    <option <?php if($azienda->getTipo_attivita_id() == 15 ) echo 'selected' ; ?> value="15">Take Away</option>
                        <option <?php if($azienda->getTipo_attivita_id() == 16 ) echo 'selected' ; ?> value="16">Trattoria</option>
                <option <?php if($azienda->getTipo_attivita_id() == 17 ) echo 'selected' ; ?> value="17">Altro</option>
            </select> 
   
   
   
   
   
   
   
   
   <p><label for="email_azienda">E-mail:</label></p>
   <input type="email" name="company_mail_azienda" id="email_azienda" value="<?php echo $azienda->getEmail(); ?>" title="modifica l'email dell'azienda"><?php if (isset($_SESSION['company_mail_azienda'])) echo $_SESSION['company_mail_azienda']; ?>
   
   
   
   
   
   <p><label for="descrizione_azienda">Breve Descrizione:</label></p>
   <textarea name="descrizione_azienda" id="descrizione_azienda" title="modifica una brevissima descrizione (max 150)" rows="4" cols="50" maxlength="150"><?php echo $azienda->getDescrizione(); ?></textarea> <?php if (isset($_SESSION['descrizione_azienda'])) echo $_SESSION['descrizione_azienda']; ?>


   
   
   
   
   
   
   
   
   <p><label for="citta_azienda">Citta:</label></p>
   <input type="text" name="city_azienda" id="citta_azienda" value="<?php echo $azienda->getCitta(); ?>" title="modifica la citt&agrave"><?php if (isset($_SESSION['city_azienda'])) echo $_SESSION['city_azienda']; ?>
   
   
   <p><label for="indirizzo_azienda">Indirizzo:</label></p>
   <input type="text" name="address_azienda" id="indirizzo_azienda" value="<?php echo $azienda->getIndirizzo(); ?>" title="modifica l'indirizzo"><?php if (isset($_SESSION['address_azienda'])) echo $_SESSION['address_azienda']; ?>
   
   
   <p><label for="telefono_azienda">Numero di telefono:</label></p>
   <input type="text" name="phone_azienda" id="telefono_azienda" value="<?php echo $azienda->getTelefono(); ?>" title="modifica il numero di telefono"><?php if (isset($_SESSION['phone_azienda'])) echo $_SESSION['phone_azienda']; ?>
   
   
   <p><label for="sito_web_azienda">Sito Web:</label></p>
   <input type="text" name="sito_web_azienda" id="sito_web_azienda" value="<?php echo $azienda->getSitoWeb(); ?>" 
          title="modifica l'indirizzo del sito web"><?php if (isset($_SESSION['sito_web_azienda'])) echo $_SESSION['sito_web_azienda']; ?>
   
   <br>
   <input type="hidden" name="cmd" value="update_profilo_azienda">
  
        <input type="submit" value="Aggiorna">
   </form>

