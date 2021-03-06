<!--seconda parte della registrazione di una nuova azienda.
Inserimento dei dati veri e propri che riguardano un'azienda-->
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>    
<?php
   include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/UtenteFactory.php';
   //cancellare errori rimasti in sessione
   $_SESSION['step2']=1; 
   ?>
<div id="box-form">
   <h1 class="white">
      Registrazione nuova azienda
   </h1>
   <p class="center white">
      Inserisci i dati dell'azienda.
   </p>
   <div>
      <div class="form-generic">
         <form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" method="POST">
            <p class="submitrec"> <label for="name_azienda">Nome Azienda</label></p>
            <input type="text" name="name_azienda" id="name_azienda" value="<?php if (isset($_POST['name_azienda'])) echo $_POST['name_azienda']; ?>" title="inserisci il nome della tua azienda"> <?php if (isset($_SESSION['name_azienda'])) echo $_SESSION['name_azienda']; ?>
            <p class="submitrec" ><label for="tipo_attivita_id">Tipo di attivit&agrave;</label></p>
            <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare" class="submitrec" >
               <?php
                  //dopo aver fatto la submit, mostra l'attività selezionata della select come "primo elemento" visibile
                if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1")) {
                $id_attivita = $_POST['tipo_attivita_id'];
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
            <?php if (isset($_SESSION['tipo_attivita_id'])) echo $_SESSION['tipo_attivita_id']; ?>
            <p class="submitrec" ><label for="email_azienda">Email</label></p>
            <input type="email" name="email_azienda" id="email_azienda" value="<?php if (isset($_POST['email_azienda'])) echo $_POST['email_azienda']; ?>" title="inserisci l'email dell'azienda"><?php if (isset($_SESSION['email_azienda'])) echo $_SESSION['email_azienda']; ?>
            <p class="submitrec" ><label for="descrizione_azienda">Breve Descrizione</label></p>
            <textarea name="descrizione_azienda" id="descrizione_azienda" title="inserisci una brevissima descrizione (max 250)" rows="4" cols="50" maxlength="250"><?php if (isset($_POST['descrizione_azienda'])) echo $_POST['descrizione_azienda']; ?></textarea>
            <?php if (isset($_SESSION['descrizione_azienda'])) echo $_SESSION['descrizione_azienda']; ?>
            <p class="submitrec" ><label for="citta_azienda">Citta</label></p>
            <input type="text" name="city_azienda" id="citta_azienda" value="<?php if (isset($_POST['city_azienda'])) echo $_POST['city_azienda']; ?>" title="inserisci la citt&agrave"><?php if (isset($_SESSION['city_azienda'])) echo $_SESSION['city_azienda']; ?>
            <p class="submitrec" ><label for="indirizzo_azienda">Indirizzo</label></p>
            <input type="text" name="address_azienda" id="indirizzo_azienda" value="<?php if (isset($_POST['address_azienda'])) echo $_POST['address_azienda']; ?>" title="inserisci l'indirizzo"><?php if (isset($_SESSION['address_azienda'])) echo $_SESSION['address_azienda']; ?>
            <p class="submitrec" ><label for="telefono_azienda">Numero di telefono</label></p>
            <input type="text" name="phone_azienda" id="telefono_azienda" value="<?php if (isset($_POST['phone_azienda'])) echo $_POST['phone_azienda']; ?>" title="inserisci il numero di telefono"><?php if (isset($_SESSION['phone_azienda'])) echo $_SESSION['phone_azienda']; ?>
            <p class="submitrec" ><label for="sito_web_azienda">Sito Web</label></p>
            <input type="text" name="sito_web_azienda" id="sito_web_azienda" value="<?php if (isset($_POST['sito_web_azienda'])) echo $_POST['sito_web_azienda']; ?>" title="inserisci l'indirizzo del sito web"><?php if (isset($_SESSION['sito_web_azienda'])) echo $_SESSION['sito_web_azienda']; ?>
            <input type="hidden" name="cmd" value="registrazione_azienda">
            <input type="hidden" name="part" value="2">
            <input class="submitrec" type="submit" value="Avanti &gt;">
         </form>
      </div>
   </div>
</div>
