<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<?php 
   if (session_status() != 2) session_start();
   
   if(isset($_SESSION['errore']) AND ( $_SESSION['errore']== 5)) 
   {
      $azienda = UtenteFactory::cercaAzienda($_SESSION['current_user']->getUsername(), $_SESSION['current_user']->getPassword());
      $_SESSION['current_user'] = $azienda;
   }
   else
   {
      $azienda = $_SESSION['current_user'];
   }
   
   $id_attivita = $azienda->getTipo_attivita_id(); 
   
   ?>
<div id="box-form">
   <h1 class="white">
      Modifica il profilo della tua azienda
   </h1>
   <h3 class="white" >
      Dati azienda
   </h3>
   <div class="form-generic">
      <form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/AziendaController.php" method="post">
         <!--fare tutto cosi-->
         <p class="submitrec"><label for="name_azienda">Nome Azienda:</label></p>
         <input type="text" name="name_azienda" id="name_azienda" value="<?php if(isset($_REQUEST['name_azienda'])) echo $_REQUEST['name_azienda']; else { echo $azienda->getNomeAzienda();} ?>" title="modifica il nome della tua azienda"> 
         <?php if (isset($_SESSION['name_azienda'])) echo $_SESSION['name_azienda']; ?>
         <p class="submitrec"><label for="tipo_attivita_id">Tipo di attivit&agrave;:</label></p>
         <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare" class="submitrec" >
            <?php
               $id_attivita = $azienda->getTipo_attivita_id();
               //dopo aver fatto la submit, mostra l'attività selezionata della select come "primo elemento" visibile
               if ((isset($id_attivita)) AND ($_POST['tipo_attivita_id'] != "-1")) {
               $nome_attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
                       ?> 
            <option value="<?php echo $id_attivita; ?>" > <?php echo$nome_attivita; ?></option>
            <?php
               //dopo aver fatto la submit, mostra tutte le attività selezionabili tranne quella che è stata selezionata
                  $attivita = UtenteFactory::listaAttivita($id_attivita);
                                 while ($row = $attivita->fetch_row()) {
                     ?> 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php }
               }
               ?> 
            <?php
               //mostra tutte le attività selezionabili dentro la select
                if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1")) {
                    ?> 
            <option value="-1">Cosa</option>
            <?php
               $attivita = UtenteFactory::listaAttivita(0);         
                while ($row = $attivita->fetch_row()) {
               ?> 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php }
               }
                   ?>
         </select>
         <p class="submitrec"><label for="email_azienda">E-mail:</label></p>
         <input type="email" name="company_mail_azienda" id="email_azienda" value="<?php echo $azienda->getEmail(); ?>" title="modifica l'email dell'azienda"><?php if (isset($_SESSION['company_mail_azienda'])) echo $_SESSION['company_mail_azienda']; ?>
         <p class="submitrec"><label for="descrizione_azienda">Breve Descrizione:</label></p>
         <textarea name="descrizione_azienda" id="descrizione_azienda" title="modifica una brevissima descrizione (max 150)" rows="4" cols="50" maxlength="150"><?php echo $azienda->getDescrizione(); ?></textarea>
         <?php if (isset($_SESSION['descrizione_azienda'])) echo $_SESSION['descrizione_azienda']; ?>
         <p class="submitrec"><label for="citta_azienda">Citta:</label></p>
         <input type="text" name="city_azienda" id="citta_azienda" value="<?php echo $azienda->getCitta(); ?>" title="modifica la citt&agrave"><?php if (isset($_SESSION['city_azienda'])) echo $_SESSION['city_azienda']; ?>
         <p class="submitrec"><label for="indirizzo_azienda">Indirizzo:</label></p>
         <input type="text" name="address_azienda" id="indirizzo_azienda" value="<?php echo $azienda->getIndirizzo(); ?>" title="modifica l'indirizzo"><?php if (isset($_SESSION['address_azienda'])) echo $_SESSION['address_azienda']; ?>
         <p class="submitrec"><label for="telefono_azienda">Numero di telefono:</label></p>
         <input type="text" name="phone_azienda" id="telefono_azienda" value="<?php echo $azienda->getTelefono(); ?>" title="modifica il numero di telefono"><?php if (isset($_SESSION['phone_azienda'])) echo $_SESSION['phone_azienda']; ?>
         <p class="submitrec"><label for="sito_web_azienda">Sito Web:</label></p>
         <input type="text" name="sito_web_azienda" id="sito_web_azienda" value="<?php echo $azienda->getSitoWeb(); ?>" 
            title="modifica l'indirizzo del sito web"><?php if (isset($_SESSION['sito_web_azienda'])) echo $_SESSION['sito_web_azienda']; ?>
         <br>
         <input type="hidden" name="cmd" value="update_profilo_azienda">
         <input class="submitrec" type="submit" value="Aggiorna">
      </form>
   </div>
</div>
