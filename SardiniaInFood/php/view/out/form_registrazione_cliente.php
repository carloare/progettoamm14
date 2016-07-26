<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<div id="box-form">

    
        <h1 class="white">

   Registrazione nuovo cliente

</h1>
<p class="center white">

Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. 
</p>
    
    <div class="form-generic">   
    
    
    <form action="/SardiniaInFood/php/controller/BaseController.php" id="registrazione_cliente" method="POST">
            
                <p class="submitrec"><label for="nome_completo_cliente">Nome Completo</label></p>
                <input type="text" name="nome_completo" id="nome_completo_cliente" value="<?php if (isset($_POST['nome_completo'])AND $_POST['ruolo']==0) echo $_POST['nome_completo'];?>"
                 class="submitrec" title="inserisci il tuo nome"><?php if(isset($_SESSION['nome_completo_cliente'])) echo $_SESSION['nome_completo_cliente'];  ?> 
               
                
                <p class="submitrec"><label for="email_personale_cliente">Email</label></p>
                <input type="email" name="email_personale" id="email_personale_cliente" value="<?php if (isset($_POST['email_personale'])AND $_POST['ruolo']==0) echo $_POST['email_personale'];?>"
                 class="submitrec"      title="inserisci la tua email"><?php if(isset($_SESSION['email_cliente'])) echo $_SESSION['email_cliente']; ?>
               
                
                <p class="submitrec"><label for="username_cliente">Username</label></p>
                <input type="text" name="username" id="username_cliente" value="<?php if (isset($_POST['username'])AND $_POST['ruolo']==0) echo $_POST['username'];?>" 
                  class="submitrec"     title="inserisci il tuo username da usare nel login"><?php if(isset($_SESSION['username_cliente'])) echo $_SESSION['username_cliente']; ?> 
               
                <p class="submitrec"><label for="password_cliente">Password</label></p>
                <input type="password" name="password" id="password_cliente" value="<?php if (isset($_POST['password'])AND $_POST['ruolo']==0) echo $_POST['password'];?>" 
                  class="submitrec"     title="inserisci la tua password da usare nel login"><?php if(isset($_SESSION['password_cliente'])) echo $_SESSION['password_cliente']; ?>       
  
                 <p class="submitrec"><label for="password_cliente_conferma">Ripeti Password</label></p>
                <input type="password" name="password_conferma" id="password_cliente_conferma" value="" 
                  class="submitrec"     title="inserisci nuovamente la tua password">       
                
                
                <br>
                
                <input type="hidden" name="cmd" value="registrazione_cliente">
                <input type="hidden" name="ruolo" value="0">
                <input type="hidden" name="numero_richiami" value="0">
                <input type="hidden" name="bannato" value="0">
                <input type="submit" class="submitrec" value="ISCRIVITI">
                
            </form> 

    </div>
    </div>
