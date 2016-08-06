<!--registrazione azienda versione alpha-->
<?php
   $mysqli = new mysqli();
   $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
    
?>


<form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" id="registrazione_azienda" method="POST">
    
    
    
   <h3>Dati di chi effettua la registrazione</h3>
   
   
   <p> <label for="nome_completo_azienda">Nome Completo:</label></p>
   <input type="text" name="nome_completo_azienda" id="nome_completo_azienda" value="<?php if (isset($_POST['nome_completo_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['nome_completo_azienda']; ?>" title="inserisci il tuo nome completo"><?php if (isset($_SESSION['nome_completo_azienda'])) echo $_SESSION['nome_completo_azienda']; ?> 
   
   <p><label for="tipo_incarichi_id">Tipo di incarico:</label></p>
   <select id="tipo_incarichi_id" name="tipo_incarichi_id" title="incarico svolto">
       
       
       
       
       
       
       
       
       
     
<?php 

//quando è settato ed è diverso da -1
if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1")) {
echo 1;
    $pinco=$_POST['tipo_attivita_id'];
    $query="SELECT tipo FROM Incarichi WHERE id='$pinco'";   
    $result = $mysqli->query($query);      
    $pallino=$result->fetch_row();      
    $nome_attivita=$pallino[0];
    
?> 
     
     <option value="<?php echo $pinco;?>"><?php echo $nome_attivita; ?></option>
         
         
<?php }  ?> 

     
 <option value="-1">Che tipo di incarico svolge dentro l'azienda?</option>    


<?php

//quando non è settato ed è uguale a -1
if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1")) 
{
         
     $query="SELECT id, tipo FROM Incarichi ORDER BY tipo DESC"; 
       
     
     //quando è settato ede è diverso da -1
} 

elseif((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == "-1"))
    {
 echo $_SESSION['tipo_attivita_id'];
 $query="SELECT id, tipo FROM Incarichi ORDER BY tipo ASC"; 
    }





elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
{
    echo 3;
     $id_fffff = $_POST['tipo_attivita_id'];
          
     $query="SELECT id, tipo FROM Incarichi WHERE (id != $id_fffff) ORDER BY tipo DESC"; 
     
    echo $_SESSION['tipo_attivita_id'];
}    
     $result = $mysqli->query($query);
     
     while ($row = $result->fetch_row()) { ?> 
 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                
      <?php }  
      
   
     ?>
       
       
   </select><?php if(isset($_SESSION['tipo_incarichi_id'])) echo $_SESSION['tipo_incarichi_id'];?>
       
       
       
       
       
       
       
   
   
   
   
   
   
   
   
   
   

   <p><label for="email_conferma_azienda">E-mail:</label></p>
   <input type="email" name="email_conferma_azienda" id="email_conferma_azienda" value="<?php if (isset($_POST['email_conferma_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['email_conferma_azienda']; ?>" title="inserisci la tua email"><?php if (isset($_SESSION['email_conferma_azienda'])) echo $_SESSION['email_conferma_azienda']; ?> 
   
   
   <p><label for="username_azienda">Username:</label></p>
   <input type="text" name="username_azienda" id="username_azienda" value="<?php if (isset($_POST['username_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['username_azienda']; ?>" title="inserisci il tuo username"><?php if (isset($_SESSION['username_azienda'])) echo $_SESSION['username_azienda']; ?> 
   
   
   <p><label for="password_azienda">Password:</label></p>
   <input type="password" name="password_azienda" id="password_azienda" value="<?php if (isset($_POST['password_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['password_azienda']; ?>" title="inserisci la tua password"> <?php if (isset($_SESSION['password_azienda'])) echo $_SESSION['password_azienda']; ?>       
   <br />
   <hr>
   
   
   
   <h3>Dati dell'azienda</h3>
   
   
   <p> <label for="name_azienda">Nome Azienda:</label></p>
   <input type="text" name="name_azienda" id="name_azienda" value="<?php if (isset($_POST['name_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['name_azienda']; ?>" title="inserisci il nome della tua azienda"> <?php if (isset($_SESSION['name_azienda'])) echo $_SESSION['name_azienda']; ?>
  
   <p><label for="tipo_attivita_id">Tipo di attivit&agrave;:</label></p>
   <select id="tipo_attivita_id" name="tipo_attivita_id" title="scegli il tipo di attivit&agrave;">
    
       
       
       
     
<?php 

//quando è settato ed è diverso da -1
if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1")) {
echo 1;
    $pinco=$_POST['tipo_attivita_id'];
    $query="SELECT tipo FROM Attivita WHERE id='$pinco'";   
    $result = $mysqli->query($query);      
    $pallino=$result->fetch_row();      
    $nome_attivita=$pallino[0];
    
?> 
     
     <option value="<?php echo $pinco;?>"><?php echo $nome_attivita; ?></option>
         
         
<?php }  ?> 

     
 <option value="-1">Che attivit&agrave; svolge?</option>    


<?php

//quando non è settato ed è uguale a -1
if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1")) 
{
         
     $query="SELECT id, tipo FROM Attivita ORDER BY tipo ASC"; 
       
     
     //quando è settato ede è diverso da -1
} 

elseif((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == "-1"))
    {
 echo $_SESSION['tipo_attivita_id'];
 $query="SELECT id, tipo FROM Attivita ORDER BY tipo ASC"; 
    }





elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
{
    echo 3;
     $id_fffff = $_POST['tipo_attivita_id'];
          
     $query="SELECT id, tipo FROM Attivita WHERE (id != $id_fffff) ORDER BY tipo ASC"; 
     
    echo $_SESSION['tipo_attivita_id'];
}    
     $result = $mysqli->query($query);
     
     while ($row = $result->fetch_row()) { ?> 
 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                
      <?php }  
      
   
     ?>

       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
       
   </select><?php if(isset($_SESSION['tipo_attivita_id'])) echo $_SESSION['tipo_attivita_id'];?>
   
   <p><label for="email_azienda">E-mail:</label></p>
   <input type="email" name="company_mail_azienda" id="email_azienda" value="<?php if (isset($_POST['company_mail_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['company_mail_azienda']; ?>" title="inserisci l'email dell'azienda"><?php if (isset($_SESSION['company_mail_azienda'])) echo $_SESSION['company_mail_azienda']; ?>
   
   
   <p><label for="descrizione_azienda">Breve Descrizione:</label></p>
   <textarea name="descrizione_azienda" id="descrizione_azienda" title="inserisci una brevissima descrizione (max 200)" rows="4" cols="50" maxlength="200"><?php if (isset($_POST['descrizione_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['descrizione_azienda']; ?></textarea> <?php if (isset($_SESSION['descrizione_azienda'])) echo $_SESSION['descrizione_azienda']; ?>


   <p><label for="citta_azienda">Citta:</label></p>
   <input type="text" name="city_azienda" id="citta_azienda" value="<?php if (isset($_POST['city_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['city_azienda']; ?>" title="inserisci la citt&agrave"><?php if (isset($_SESSION['city_azienda'])) echo $_SESSION['city_azienda']; ?>
   
   
   <p><label for="indirizzo_azienda">Indirizzo:</label></p>
   <input type="text" name="address_azienda" id="indirizzo_azienda" value="<?php if (isset($_POST['address_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['address_azienda']; ?>" title="inserisci l'indirizzo"><?php if (isset($_SESSION['address_azienda'])) echo $_SESSION['address_azienda']; ?>
   
   
   <p><label for="telefono_azienda">Numero di telefono:</label></p>
   <input type="text" name="phone_azienda" id="telefono_azienda" value="<?php if (isset($_POST['phone_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['phone_azienda']; ?>" title="inserisci il numero di telefono"><?php if (isset($_SESSION['phone_azienda'])) echo $_SESSION['phone_azienda']; ?>
   
   
   <p><label for="sito_web_azienda">Sito Web:</label></p>
   <input type="text" name="sito_web_azienda" id="sito_web_azienda" value="<?php if (isset($_POST['sito_web_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['sito_web_azienda']; ?>" title="inserisci l'indirizzo del sito web"><?php if (isset($_SESSION['sito_web_azienda'])) echo $_SESSION['sito_web_azienda']; ?>
   
   
   
   <br>
   <hr>

   <div id="box_servizi">
       
      Accesso disabili
<input type="radio" name="accesso_disabili" <?php if (isset($_SESSION['accesso_disabili']) && $_SESSION['accesso_disabili']=="1") echo "checked";?> value="1">Si
<input type="radio" name="accesso_disabili" <?php if (isset($_SESSION['accesso_disabili']) && $_SESSION['accesso_disabili']=="0") echo "checked";?> value="0">No<br />      
       
Accetta carte di credio
<input type="radio" name="accetta_carde_di_credito" <?php if (isset($_SESSION['accetta_carde_di_credito']) && $_SESSION['accetta_carde_di_credito']=="1") echo "checked";?> value="1">Si
<input type="radio" name="accetta_carde_di_credito" <?php if (isset($_SESSION['accetta_carde_di_credito']) && $_SESSION['accetta_carde_di_credito']=="0") echo "checked";?> value="0">No<br />      

Accetta prenotazioni
<input type="radio" name="accetta_prenotazioni" <?php if (isset($_SESSION['accetta_prenotazioni']) && $_SESSION['accetta_prenotazioni']=="1") echo "checked";?> value="1">Si
<input type="radio" name="accetta_prenotazioni" <?php if (isset($_SESSION['accetta_prenotazioni']) && $_SESSION['accetta_prenotazioni']=="0") echo "checked";?> value="0">No<br />      

Bagno disponibile
<input type="radio" name="bagno_disponibile" <?php if (isset($_SESSION['bagno_disponibile']) && $_SESSION['bagno_disponibile']=="1") echo "checked";?> value="1">Si
<input type="radio" name="bagno_disponibile" <?php if (isset($_SESSION['bagno_disponibile']) && $_SESSION['bagno_disponibile']=="0") echo "checked";?> value="0">No<br />      

Bancomat  
<input type="radio" name="bancomat" <?php if (isset($_SESSION['bancomat']) && $_SESSION['bancomat']=="1") echo "checked";?> value="1">Si
<input type="radio" name="bancomat" <?php if (isset($_SESSION['bancomat']) && $_SESSION['bancomat']=="0") echo "checked";?> value="0">No<br />      

Bevande alcoliche
<input type="radio" name="bevande_alcoliche" <?php if (isset($_SESSION['bevande_alcoliche']) && $_SESSION['bevande_alcoliche']=="1") echo "checked";?> value="1">Si
<input type="radio" name="bevande_alcoliche" <?php if (isset($_SESSION['bevande_alcoliche']) && $_SESSION['bevande_alcoliche']=="0") echo "checked";?> value="0">No<br />      

Catering  
<input type="radio" name="catering" <?php if (isset($_SESSION['catering']) && $_SESSION['catering']=="1") echo "checked";?> value="1">Si
<input type="radio" name="catering" <?php if (isset($_SESSION['catering']) && $_SESSION['catering']=="0") echo "checked";?> value="0">No<br />      

Consegna a domicilio  
<input type="radio" name="consegna_a_domicilio" <?php if (isset($_SESSION['consegna_a_domicilio']) && $_SESSION['consegna_a_domicilio']=="1") echo "checked";?> value="1">Si
<input type="radio" name="consegna_a_domicilio" <?php if (isset($_SESSION['consegna_a_domicilio']) && $_SESSION['consegna_a_domicilio']=="0") echo "checked";?> value="0">No<br />      

Da asporto
<input type="radio" name="da_asporto" <?php if (isset($_SESSION['da_asporto']) && $_SESSION['da_asporto']=="1") echo "checked";?> value="1">Si
<input type="radio" name="da_asporto" <?php if (isset($_SESSION['da_asporto']) && $_SESSION['da_asporto']=="0") echo "checked";?> value="0">No<br />      

Guardaroba disponibile 
<input type="radio" name="guardaroba_disponibile" <?php if (isset($_SESSION['guardaroba_disponibile']) && $_SESSION['guardaroba_disponibile']=="1") echo "checked";?> value="1">Si
<input type="radio" name="guardaroba_disponibile" <?php if (isset($_SESSION['guardaroba_disponibile']) && $_SESSION['guardaroba_disponibile']=="0") echo "checked";?> value="0">No<br />      

Musica
<input type="radio" name="musica" <?php if (isset($_SESSION['musica']) && $_SESSION['musica']=="1") echo "checked";?> value="1">Si
<input type="radio" name="musica" <?php if (isset($_SESSION['musica']) && $_SESSION['musica']=="0") echo "checked";?> value="0">No<br />      

Parcheggio auto 
<input type="radio" name="parcheggio_auto" <?php if (isset($_SESSION['parcheggio_auto']) && $_SESSION['parcheggio_auto']=="1") echo "checked";?> value="1">Si
<input type="radio" name="parcheggio_auto" <?php if (isset($_SESSION['parcheggio_auto']) && $_SESSION['parcheggio_auto']=="0") echo "checked";?> value="0">No<br />      

Parcheggio bici 
<input type="radio" name="parcheggio_bici" <?php if (isset($_SESSION['parcheggio_bici']) && $_SESSION['parcheggio_bici']=="1") echo "checked";?> value="1">Si
<input type="radio" name="parcheggio_bici" <?php if (isset($_SESSION['parcheggio_bici']) && $_SESSION['parcheggio_bici']=="0") echo "checked";?> value="0">No<br />      

Per fumatori 
<input type="radio" name="per_fumatori" <?php if (isset($_SESSION['per_fumatori']) && $_SESSION['per_fumatori']=="1") echo "checked";?> value="1">Si
<input type="radio" name="per_fumatori" <?php if (isset($_SESSION['per_fumatori']) && $_SESSION['per_fumatori']=="0") echo "checked";?> value="0">No<br />      

Posti a sedere all'aperto 
<input type="radio" name="posti_sedere_aperto" <?php if (isset($_SESSION['posti_sedere_aperto']) && $_SESSION['posti_sedere_aperto']=="1") echo "checked";?> value="1">Si
<input type="radio" name="posti_sedere_aperto" <?php if (isset($_SESSION['posti_sedere_aperto']) && $_SESSION['posti_sedere_aperto']=="0") echo "checked";?> value="0">No<br />      

Stanza privata 
<input type="radio" name="stanza_privata" <?php if (isset($_SESSION['stanza_privata']) && $_SESSION['stanza_privata']=="1") echo "checked";?> value="1">Si
<input type="radio" name="stanza_privata" <?php if (isset($_SESSION['stanza_privata']) && $_SESSION['stanza_privata']=="0") echo "checked";?> value="0">No<br />      

Tv 
<input type="radio" name="tv" <?php if (isset($_SESSION['tv']) && $_SESSION['tv']=="1") echo "checked";?> value="1">Si
<input type="radio" name="tv" <?php if (isset($_SESSION['tv']) && $_SESSION['tv']=="0") echo "checked";?> value="0">No<br />      

Wi-Fi 
<input type="radio" name="wifi" <?php if (isset($_SESSION['wifi']) && $_SESSION['wifi']=="1") echo "checked";?> value="1">Si
<input type="radio" name="wifi" <?php if (isset($_SESSION['wifi']) && $_SESSION['wifi']=="0") echo "checked";?> value="0">No<br />      

   </div>
   <hr>
   <input type="hidden" name="cmd" value="registrazione_azienda">
   <input type="hidden" name="ruolo" value="1">
   <input type="submit" value="Iscriviti">
</form>

