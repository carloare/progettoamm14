<script type="text/javascript" src="/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<div id="box-form">
    
    <h1 class="white">

   Login Cliente

</h1>
<p class="center white">

Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il capo vedeva il suo ventre arcuato, bruno e diviso in tanti segmenti ricurvi, in cima a cui la coperta da letto, vicina a scivolar giù tutta, si manteneva a fatica.
    
</p>
    
    <div class="form-generic">   
    
    
<form name="login_form" action="/SardiniaInFood/php/controller/BaseController.php" method="POST"> 
    
 <input type="text" name="username_cliente" value="Username" title="inserisci il tuo username" onfocus="this.value=''" class="submitlogin"> 
  
<input type="password" name="password_cliente" value="Password" title="inserisci la tua password" onfocus="this.value=''" class="submitlogin" ><br>
 
  <input type="hidden" name="cmd" value="login_cliente">
  <input type="submit" class="submitlogin" name="submit" value="LOGIN"> 
</form> 
</div>
</div>