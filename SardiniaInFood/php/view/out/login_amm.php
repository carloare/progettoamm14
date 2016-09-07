<!--form di login per l'amministratore dell'applicazione-->
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/customize-amm.js"></script>
<div id="box-form">
   <h1 class="white">
      Login Amministratore
   </h1>
   <div class="form-generic">
      <form name="login_form" action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" method="POST">
         <input type="text" name="username_amm" value="Username" title="" id="username" class="submitlogin"onfocus="this.value=''" > 
         <input type="password" name="password_amm" value="Password" title="" id="password" class="submitlogin" onfocus="this.value=''" >
         <input type="hidden" name="cmd" value="login_amm">
         <input type="hidden" name="page" value="admin"> <!--!!-->
         <input type="submit" class="submitlogin" name="submit" value="LOGIN"> 
      </form>
   </div>
</div>
