<script type="text/javascript" src="/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<?php 
 if (session_status() != 2) session_start();
$azienda = $_SESSION['current_user'];

?>

<form action="/SardiniaInFood/php/controller/AziendaController.php" method="post">
           
           
   <p> <label for="nome_completo_azienda">Nome Completo:</label></p>
   <input type="text" name="nome_completo_azienda" id="nome_completo_azienda" value="<?php echo $azienda->getNomeCompleto(); ?>" title="modifica il tuo nome completo">
       <?php if (isset($_SESSION['nome_completo_azienda'])) echo $_SESSION['nome_completo_azienda']; ?> 
   
   
   
   <p><label for="tipo_incarichi_id">Tipo di incarico:</label></p>

       
        <select id="tipo_incarichi_id" name="tipo_incarichi_id" title="modifica l'incarico svolto">
            <option <?php if($azienda->getTipo_incarichi_id() == 1 ) echo 'selected' ; ?> value='1'>Proprietario</option>
                <option <?php if($azienda->getTipo_incarichi_id() == 2 ) echo 'selected' ; ?> value="2">Direttore Generale</option>
                    <option <?php if($azienda->getTipo_incarichi_id() == 3 ) echo 'selected' ; ?> value="3">Consulente</option>
                        <option <?php if($azienda->getTipo_incarichi_id() == 4 ) echo 'selected' ; ?> value="4">Altro</option>
                
            </select>
       
  
   
   <p><label for="email_personale_azienda">E-mail:</label></p>
   <input type="email" name="email_personale_azienda" id="email_personale_azienda" value="<?php echo $azienda->getEmailPersonale(); ?>" title="modifica la tua email">
       <?php if (isset($_SESSION['email_personale_azienda'])) echo $_SESSION['email_personale_azienda']; ?> 
   
   
   <p><label for="username_azienda">Username:</label></p>
   <input type="text" name="username_azienda" id="username_azienda" value="<?php echo $azienda->getUsername(); ?>" title="modifica il tuo username">
       <?php if (isset($_SESSION['username_azienda'])) echo $_SESSION['username_azienda']; ?> 
   
   
   <p><label for="password_azienda">Password:</label></p>
   <input type="password" name="password_azienda" id="password_azienda" value="<?php echo $azienda->getPassword(); ?>" title="modifica la tua password">
 <?php if (isset($_SESSION['password_azienda'])) echo $_SESSION['password_azienda']; ?>       
   <br>
   
   
   
   
   
   
   <input type="hidden" name="cmd" value="update_profilo_personale">
  
        <input type="submit" value="Aggiorna">
       </form>
       
       
   
