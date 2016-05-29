<article>
    <form action="controller/BaseController.php" id="registrazione_cliente" method="POST">
            
                <p> <label for="nome_completo_cliente">Nome Completo:</label></p>
                <input type="text" name="nome_completo" id="nome_completo_cliente" value="<?php if (isset($_POST['nome_completo'])AND $_POST['ruolo']==0) echo $_POST['nome_completo'];?>" title="inserisci il tuo nome completo"><?php if(isset($_SESSION['nome_completo_cliente'])) echo $_SESSION['nome_completo_cliente']; ?> 
               
                <p><label for="username_cliente">Username:</label></p>
                <input type="text" name="username" id="username_cliente" value="<?php if (isset($_POST['username'])AND $_POST['ruolo']==0) echo $_POST['username'];?>" title="inserisci il tuo username"><?php if(isset($_SESSION['username_cliente'])) echo $_SESSION['username_cliente']; ?> 
               
                <p><label for="password_cliente">Password:</label></p>
                <input type="password" name="password" id="password_cliente" value="<?php if (isset($_POST['password'])AND $_POST['ruolo']==0) echo $_POST['password'];?>" title="inserisci la tua password"><?php if(isset($_SESSION['password_cliente'])) echo $_SESSION['password_cliente']; ?>       
   
                <p><label for="email_conferma_cliente">Email:</label></p>
                <input type="email" name="email_conferma" id="email_conferma_cliente" value="<?php if (isset($_POST['email_conferma'])AND $_POST['ruolo']==0) echo $_POST['email_conferma'];?>" title="inserisci la tua email"><?php if(isset($_SESSION['email_cliente'])) echo $_SESSION['email_cliente']; ?>
                                
                <input type="hidden" name="cmd" value="registrazione_cliente">
                <input type="hidden" name="ruolo" value="0">
                <input type="hidden" name="numero_richiami" value="0">
                <p><input type="submit" value="Submit"></p>
                
            </form> 
</article>


