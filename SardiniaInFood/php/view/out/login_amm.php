
<h1>LOGIN AMMINISTRATORE</h1>

<form name="login_form" action="/SardiniaInFood/php/controller/BaseController.php" method="POST"> 

 <p> Username: </p> <input type="text" name="username_amm" value=""> 
  
 <p> Password: </p> <input type="password" name="password_amm" value="">
 <br>
 
  <input type="hidden" name="cmd" value="login_amm">
 <p> <input type="submit" id="submitlogin" name="submit" value="Login"> </p>
</form> 
