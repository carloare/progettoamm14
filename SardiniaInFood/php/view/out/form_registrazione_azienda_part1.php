

<?php
include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';
?>

<div>
    <h3>Dati personali</h3>

    <form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">

 <h3>Dati di chi effettua la registrazione</h3>
   
   
   <p> <label for="nome_completo_azienda">Nome Completo:</label></p>
   <input type="text" name="nome_completo_azienda" id="nome_completo_azienda" value="<?php if (isset($_POST['nome_completo_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['nome_completo_azienda']; ?>" 
          title="inserisci il tuo nome completo"> <?php if (isset($_SESSION['nome_completo_azienda'])) echo $_SESSION['nome_completo_azienda']; ?> 
   
   <p><label for="tipo_incarichi_id">Tipo di incarico:</label></p>
   <select id="tipo_incarichi_id" name="tipo_incarichi_id" title="inserisci l'incarico che svolgi nell'azienda">
       
       <?php

if ((isset($_POST['tipo_incarichi_id'])) AND ($_POST['tipo_incarichi_id'] != "-1"))
	{
	$id_incarichi = $_POST['tipo_incarichi_id'];
	$nome_incarico = UtenteFactory::mostraIncarico($id_incarichi);
        
while ($row = $nome_incarico->fetch_row())
	{ ?> 
 
            <option value="<?php
		echo $row[0]; ?>"><?php
		echo $row[1]; ?></option>
                
      <?php
	}}
  
 ?> 

     
    


<?php
//prima entrata mostra tutti gli incarichi
if ((!isset($_POST['tipo_incarichi_id'])) OR ($_POST['tipo_incarichi_id'] == "-1"))
	{
  ?>  <option value="-1">Che tipo di incarico svolgi dentro l'azienda?</option> <?php
	$incarichi=UtenteFactory::mostraElencoIncarichi(0);
        
	}
elseif ((isset($_POST['tipo_incarichi_id'])) AND ($_POST['tipo_incarichi_id'] != "-1"))
	{
	$not_show = $_POST['tipo_incarichi_id'];
	$incarichi=UtenteFactory::mostraElencoIncarichi($not_show);
	}
        
       
  while ($row = $incarichi->fetch_row())
	{ ?> 
 
            <option value="<?php
		echo $row[0]; ?>"><?php
		echo $row[1]; ?></option>
                
      <?php
	}
    
   
       
        
        
        
        
        
        
        
        
        
?>       
       
   </select><?php if(isset($_SESSION['tipo_incarichi_id'])) echo $_SESSION['tipo_incarichi_id']; ?>
       
          

   <p><label for="email_personale_azienda">E-mail:</label></p>
   <input type="email" name="email_personale_azienda" id="email_personale_azienda" value="<?php if (isset($_POST['email_personale_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['email_personale_azienda']; ?>" 
          title="inserisci la tua email"><?php if (isset($_SESSION['email_personale_azienda'])) echo $_SESSION['email_personale_azienda']; ?> 
   
   
   <p><label for="username_azienda">Username:</label></p>
   <input type="text" name="username_azienda" id="username_azienda" value="<?php if (isset($_POST['username_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['username_azienda']; ?>" 
          title="inserisci il tuo username&#13ti verr&agrave; richiesto per fare il login"><?php if (isset($_SESSION['username_azienda'])) echo $_SESSION['username_azienda']; ?> 
   
   
   <p><label for="password_azienda">Password:</label></p>
   <input type="password" name="password_azienda" id="password_azienda" value="<?php if (isset($_POST['password_azienda']) AND $_POST['ruolo'] == 1) echo $_POST['password_azienda']; ?>" 
          title="inserisci la tua password&#13ti verr&agrave; richiesta per fare il login"> <?php if (isset($_SESSION['password_azienda'])) echo $_SESSION['password_azienda']; ?>       
   
      <p><label for="password_azienda_conferma">Conferma Password:</label></p>
                <input type="password" name="password_conferma" id="password_azienda_conferma" value="" 
                       title="inserisci nuovamente la tua password">       
   
   <br>
 
        <input type="hidden" name="cmd" value="registrazione_azienda">
        <input type="hidden" name="part" value="1">
        <input type="hidden" name="ruolo" value="1">
        <input type="submit" value="Avanti &gt;">
    
    </form>
</div>