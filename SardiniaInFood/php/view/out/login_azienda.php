<!--form di login per l'azienda-->
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<div id="box-form">
   <h1 class="white">
      Login Azienda
   </h1>
   <div class="form-generic">
      <form name="login_form" action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" method="POST"> 
         <input type="text" name="username_azienda" value="Username" title="inserisci il tuo username" onfocus="this.value=''" class="submitlogin"> 
         <input type="password" name="password_azienda" value="Password" title="inserisci la tua password" onfocus="this.value=''" class="submitlogin" ><br>
         <input type="hidden" name="cmd" value="login_azienda">
         <input type="submit" class="submitlogin" name="submit" value="LOGIN"> 
      </form>
   </div>
</div>
