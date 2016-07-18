<?php
include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';
?>

<div>
    <h3>Dati azienda</h3>
<!--registrazione azienda versione alpha-->

   <form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">

  
   
   
   <p> <label for="name_azienda">Nome Azienda:</label></p>
   <input type="text" name="name_azienda" id="name_azienda" value="<?php if (isset($_POST['name_azienda'])) echo $_POST['name_azienda']; ?>" title="inserisci il nome della tua azienda"> <?php if (isset($_SESSION['name_azienda'])) echo $_SESSION['name_azienda']; ?>
  
    <p><label for="tipo_attivita_id">Tipo di attivit&agrave;:</label></p>
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare">
                
<?php
//rientro dopo il submit, mostra l'attività selezionata
if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
{
	$id_attivita = $_POST['tipo_attivita_id'];
	$nome_attivita = UtenteFactory::mostraAttivita($id_attivita);
?> 
   <!-- <option value="<?php// echo $id_attivita; ?>" > <?php //echo $nome_attivita; ?></option>-->
  
     
   <?php  while ($row = $nome_attivita->fetch_row())
	{ ?> 
 
            <option value="<?php
		echo $row[0]; ?>"><?php
		echo $row[1]; ?></option>
                
      <?php
	} } ?> 


     
<?php
//alla prima, mostra tutte le attività
if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1"))
{
    ?> <option value="-1">Cosa</option> <?php
	$attivita = UtenteFactory::mostraElencoAttivita(0);
      
}
//quando viene selezionato qualcosa, devono essere mostrate tutte le attività tranne quella selezionata
elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
{
	$not_show = $_POST['tipo_attivita_id'];
    
        //uso la stessa funzione di prima ma invece di passare 0 (id non assegnato ad alcuna attività)
        //passo l'id dell'attività da non mostrare (gli id validi vanno da 1 in poi)
        //Lo faccio perchè le query si differenziano solo per la clausola WHERE
        
	$attivita = UtenteFactory::mostraElencoAttivita($not_show);
       
}while ($row = $attivita->fetch_row()) { ?> 
 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                
      <?php } 


?>

       
       
   </select><?php if(isset($_SESSION['tipo_attivita_id'])) echo $_SESSION['tipo_attivita_id'];?>
   
   <p><label for="email_azienda">E-mail:</label></p>
   <input type="email" name="company_mail_azienda" id="email_azienda" value="<?php if (isset($_POST['company_mail_azienda'])) echo $_POST['company_mail_azienda']; ?>" title="inserisci l'email dell'azienda"><?php if (isset($_SESSION['company_mail_azienda'])) echo $_SESSION['company_mail_azienda']; ?>
   
   
   <p><label for="descrizione_azienda">Breve Descrizione:</label></p>
   <textarea name="descrizione_azienda" id="descrizione_azienda" title="inserisci una brevissima descrizione (max 150)" rows="4" cols="50" maxlength="150"><?php if (isset($_POST['descrizione_azienda'])) echo $_POST['descrizione_azienda']; ?></textarea> <?php if (isset($_SESSION['descrizione_azienda'])) echo $_SESSION['descrizione_azienda']; ?>


   <p><label for="citta_azienda">Citta:</label></p>
   <input type="text" name="city_azienda" id="citta_azienda" value="<?php if (isset($_POST['city_azienda'])) echo $_POST['city_azienda']; ?>" title="inserisci la citt&agrave"><?php if (isset($_SESSION['city_azienda'])) echo $_SESSION['city_azienda']; ?>
   
   
   <p><label for="indirizzo_azienda">Indirizzo:</label></p>
   <input type="text" name="address_azienda" id="indirizzo_azienda" value="<?php if (isset($_POST['address_azienda'])) echo $_POST['address_azienda']; ?>" title="inserisci l'indirizzo"><?php if (isset($_SESSION['address_azienda'])) echo $_SESSION['address_azienda']; ?>
   
   
   <p><label for="telefono_azienda">Numero di telefono:</label></p>
   <input type="text" name="phone_azienda" id="telefono_azienda" value="<?php if (isset($_POST['phone_azienda'])) echo $_POST['phone_azienda']; ?>" title="inserisci il numero di telefono"><?php if (isset($_SESSION['phone_azienda'])) echo $_SESSION['phone_azienda']; ?>
   
   
   <p><label for="sito_web_azienda">Sito Web:</label></p>
   <input type="text" name="sito_web_azienda" id="sito_web_azienda" value="<?php if (isset($_POST['sito_web_azienda'])) echo $_POST['sito_web_azienda']; ?>" title="inserisci l'indirizzo del sito web"><?php if (isset($_SESSION['sito_web_azienda'])) echo $_SESSION['sito_web_azienda']; ?>
   <br>
   
 
   
        <input type="hidden" name="cmd" value="registrazione_azienda">
        <input type="hidden" name="part" value="2">
       <input type="submit" value="Avanti &gt;">
    </form>
</div>

