<!--form di login per il cliente-->
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<div id="box-form">
   <h1 class="white">
      Login Cliente
   </h1>
   <div class="form-generic">
      <form name="login_form" action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" method="POST"> 
         <input type="text" name="username_cliente" value="Username" title="inserisci il tuo username" onfocus="this.value=''" class="submitlogin"> 
         <input type="password" name="password_cliente" value="Password" title="inserisci la tua password" onfocus="this.value=''" class="submitlogin" ><br>
         <input type="hidden" name="cmd" value="login_cliente">
         <input type="submit" class="submitlogin" name="submit" value="LOGIN"> 
      </form>
   </div>
</div>
