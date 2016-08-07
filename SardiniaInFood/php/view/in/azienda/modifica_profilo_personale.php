<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<?php 
   if (session_status() != 2) session_start();
   
   
   if(isset($_SESSION['errore']) AND ( $_SESSION['errore']== 5)) 
   {
      $azienda = UtenteFactory::cercaAzienda($_POST['username_azienda'], $_POST['password_azienda']);
      $_SESSION['current_user'] = $azienda;
   }
   else
   {
      $azienda = $_SESSION['current_user'];
   }
   
   ?>
<div id="box-form">
   <h1 class="white">
      Modifica il tuo profilo personale
   </h1>
   <h3 class="white" >
      Dati personali
   </h3>
   <div class="form-generic">
      <form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/AziendaController.php" method="post">
         <p class="submitrec"> <label for="nome_completo_azienda">Nome Completo:</label></p>
         <input type="text" name="nome_completo_azienda" id="nome_completo_azienda" value="<?php echo $azienda->getNomeCompleto(); ?>" title="modifica il tuo nome completo">
         <?php if (isset($_SESSION['nome_completo_azienda'])) echo $_SESSION['nome_completo_azienda'];?> 
         <p class="submitrec"><label for="tipo_incarichi_id">Tipo di incarico:</label></p>
         <select id="tipo_incarichi_id" name="tipo_incarichi_id" title="modifica l'incarico svolto">
            <?php      
               $id_incarico = $azienda->getTipo_incarichi_id();
               
                        if ((isset($id_incarico)) AND ($id_incarico != "-1"))
                        	{
                         //mostra i possibili incarichi 
                        	$nome_incarico = UtenteFactory::mostraIncarico($id_incarico);        
                        while ($row = $nome_incarico->fetch_row())
                        	{ ?>  
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php
               }        
                      }
                 ?> 
            <?php
               //prima entrata mostra tutti gli incarichi
               if ((!isset($id_incarico)) OR ($id_incarico == "-1"))
               	{
                 ?>  
            <option value="-1">Con che tipo di incarico?</option>
            <?php
               $incarichi=UtenteFactory::mostraElencoIncarichi(0);
               }
               elseif ((isset($id_incarico)) AND ($id_incarico != "-1"))
               {
               $not_show = $id_incarico;
               $incarichi=UtenteFactory::mostraElencoIncarichi($not_show);
               }
                while ($row = $incarichi->fetch_row())
               { ?> 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php
               }
               ?>      
         </select>
         <p class="submitrec"><label for="email_personale_azienda">E-mail:</label></p>
         <input type="email" name="email_personale_azienda" id="email_personale_azienda" value="<?php echo $azienda->getEmailPersonale(); ?>" title="modifica la tua email">
         <?php if (isset($_SESSION['email_personale_azienda'])) echo $_SESSION['email_personale_azienda']; ?> 
         <p class="submitrec"><label for="username_azienda">Username:</label></p>
         <input type="text" name="username_azienda" id="username_azienda" value="<?php echo $azienda->getUsername(); ?>" title="modifica il tuo username">
         <?php if (isset($_SESSION['username_azienda'])) echo $_SESSION['username_azienda']; ?> 
         <p class="submitrec"><label for="password_azienda">Password:</label></p>
         <input class="submitrec" type="password" name="password_azienda" id="password_azienda" value="<?php echo $azienda->getPassword(); ?>" title="modifica la tua password">
         <?php if (isset($_SESSION['password_azienda'])) echo $_SESSION['password_azienda']; ?>       
         <br>
         <input type="hidden" name="cmd" value="update_profilo_personale">
         <input type="submit" value="Aggiorna">
      </form>
   </div>
</div>
