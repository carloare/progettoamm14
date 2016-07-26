<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/customize-amm.js"></script>

<div id="box-form">
    
    <h1 class="white">

   Login Amministratore

</h1>
<p class="center white">

Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il capo vedeva il suo ventre arcuato, bruno e diviso in tanti segmenti ricurvi, in cima a cui la coperta da letto, vicina a scivolar giù tutta, si manteneva a fatica.
    
</p>
    
    <div class="form-generic">   
    
    
<form name="login_form" action="/SardiniaInFood/php/controller/BaseController.php" method="POST"> 
    
     <input type="text" name="username_amm" value="Username" title="" id="username" class="submitlogin"onfocus="this.value=''" > 
  
<input type="password" name="password_amm" value="Password" title="" id="password" class="submitlogin" onfocus="this.value=''" >
 
   <input type="hidden" name="cmd" value="login_amm">
   <input type="hidden" name="page" value="admin"> <!--!!-->
  <input type="submit" class="submitlogin" name="submit" value="LOGIN"> 
</form> 
</div>
</div>