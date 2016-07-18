<?php

// Pagina che gestisce l"input dell"utente che non ha ancora effettuato il login

include_once '../view/ViewDescriptor.php';

include_once '../model/Utente.php';

include_once '../model/UtenteFactory.php';

include_once '../model/Azienda.php';

include_once '../model/Cliente.php';

include_once '../Settings.php';

if (session_status() != 2) session_start();

if (isset($_REQUEST['cmd'])) BaseController::handleInput();


class BaseController

	{

	// a seconda del compito da eseguire (cmd) viene richiamata la funzione associata

	public static function handleInput()
		{
		switch ($_REQUEST['cmd'])
			{

/*
 * ==============================REGISTRAZIONE NUOVO CLIENTE===============================================
 */                    
                    
			// registra un nuovo cliente nell"applicazione

		case 'registrazione_cliente':

			// definizione delle espressioni regolari

			define("nome_completo_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");
			define("username_regexpr", "/^[A-Za-z0-9 ]{3,20}$/");
			define("password_regexpr", "/^[a-zA-Z0-9]+$/");
			define("email_conferma_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");

			// valori inseriti dall"utente che si vuole registrare come cliente (POST)

			$name = $_REQUEST['nome_completo'];
			$username = $_REQUEST['username'];
			$pass = $_REQUEST['password'];
			$mail = $_REQUEST['email_conferma'];
                        
                      
			$ruolo = $_REQUEST['ruolo'];

			// flag che verifica la presenza di un generico errore

			$error_rec = 0;
                        
			$utente = new Cliente();

			// ruolo a 0

			$utente->setRuolo($ruolo);

			// numero richiami ricevuti dal cliente a 0

			$utente->setNumeroRichiami(0);

			//verifica la correttezza dei valori inseriti nella compliazione del form

			if (!empty($name))
				{
				if (1 === preg_match(nome_completo_regexpr, $name))
					{
					$nome = self::test_input($name);
					$utente->setNomeCompleto($nome);
					}
				  else
					{
					$_SESSION['nome_completo_cliente'] = "<br> <div id='messaggio-errore'>Il campo nome contiene caratteri non validi.<br>Verifica eventuali errori di battitura.</div>";
					$error_rec++;
					}
				}
			  else
				{
				$_SESSION['nome_completo_cliente'] = "<br> <div id='messaggio-errore'>Il campo nome &egrave; vuoto</div>";
				$error_rec++;
				}

			if (!empty($username))
				{
				if (1 === preg_match(username_regexpr, $username))
					{
					$user = self::test_input($username);
					$utente->setUsername($user);
					}
				  else
					{
					$_SESSION['username_cliente'] = "<br> <div id='messaggio-errore'>Il campo username contiene caratteri non validi.<br>Verifica eventuali errori di battitura.</div>";
					$error_rec++;
					}
				}
			  else
				{
				$_SESSION['username_cliente'] = "<br> <div id='messaggio-errore'>Il campo username &egrave; vuoto</div>";
				$error_rec++;
				}

			if (!empty($pass))
				{
				if (1 === preg_match(password_regexpr, $pass))
					{
					$password = self::test_input($pass);
					$utente->setPassword($password);
					}
				  else
					{
					$_SESSION['password_cliente'] = "<br> <div id='messaggio-errore'>Il campo password non valido.<br>Verifica eventuali errori di battitura.</div>";
					$error_rec++;
					}
				}
			  else
				{
				$_SESSION['password_cliente'] = "<br> <div id='messaggio-errore'>Il campo password &egrave; vuoto</div>";
				$error_rec++;
				}

			if (!empty($mail))
				{
				if (1 === preg_match(email_conferma_regexpr, $mail))
					{
					$email = self::test_input($mail); 
					$utente->setEmailConferma($email);
					}
				  else
					{
					$_SESSION['email_cliente'] = "<br> <div id='messaggio-errore'>Questo indirizzo email non &egrave; valido.<br>Verifica eventuali errori di battitura.<br>Esempio email valida: email@esempio.com</div>";
					$error_rec++;
					}
				}
			  else
				{
				$_SESSION['email_cliente'] = "<br> <div id='messaggio-errore'>Il campo email &egrave; vuoto</div>";
				$error_rec++;
				}

			

			if ($error_rec == 0)
				{
                            //se non si sono verificati errori
                            //vado alla funzione per registrare il nuovo cliente
				self::registrazione_cliente($utente);
				}
			  else
				{

				//in caso di errore

				$vd = new ViewDescriptor();
				$vd->setTitolo("Benvenuto");
                                 //si è verificato un errore (campo vuoto o caratteri non validi) nel form di registrazione
                                $_SESSION['errore'] = 1;
                                

                                
				$vd->setLogoFile("../view/out/logo.php");
				$vd->setMenuFile("../view/out/menu_back.php");
				$vd->setContentFile("../view/out/form_registrazione_cliente.php"); //ritorna al form di registrazione cliente
				$vd->setErrorFile("../view/out/error_out.php");
				$vd->setFooterFile("../view/out/footer_empty.php");

				// richiamo la vista

				require_once '../view/Master.php';

				}

			break;
                        
                    
/*
* =================================LOGIN CLIENTI=============================================
*/                        
//effettua il login del cliente
            case 'login_cliente':  
                
                //flag per controllare la presenza di errori
                $error = 0;
                
             
                //username e password che vengono dal form di login o dopo che un cliente si registra
                $user_cliente = $_REQUEST['username_cliente'];              
                $pass_cliente = $_REQUEST['password_cliente'];
                
                    //definiamo le espressioni regolari per controllare la correttezza formale di username e password
                    define('username_regexpr', '/^[A-Za-z0-9 ]{3,20}$/');
                    define('password_regexpr', '/^[a-zA-Z0-9]+$/');
                    
                
                    
                    //verifica la correttezza dei valori inseriti nella compliazione del form
                    
                    if( 1 === preg_match(username_regexpr, $user_cliente)) 
                    {
                    $user = self::test_input($user_cliente);
                    }
                    else
                    {
                        $error ++;
                    }
                    
                   
                    if( 1 === preg_match(password_regexpr, $pass_cliente)) 
                    {
                    $pass = self::test_input($pass_cliente);
                    }
                    else
                    {
                        $error ++;
                    }
                    
                    
                    
            
             //si è verificato un errore (campo vuoto o caratteri non validi) nel form di login
            if($error != 0) {
                     //errore in fase di login
                $_SESSION['errore'] = 4;
                
                $vd = new ViewDescriptor();     
              
            $vd->setTitolo("SardiniaInFood");
        $vd->setLogoFile("../view/out/logo.php");
        $vd->setMenuFile("../view/out/menu_back.php");
                $vd->setContentFile("../view/out/login_cliente.php"); //ritorna al form di login
                $vd->setErrorFile("../view/out/error_out.php");
                $vd->setFooterFile("../view/out/footer_empty.php");
            // richiamo la vista
            require_once "../view/Master.php"; 
            }
            else 
                {
              //se non si sono verificati errori nel form passa alla funzione login_cliente
                    self::login_cliente($user, $pass);
                }
            
            
            
            
            break;
		
			
                        
/*
* =================================REGISTRAZIONE DI UNA NUOVA AZIENDA=========================================
*/
            
            // registra una nuova azienda nell"applicazione

		case 'registrazione_azienda':

			// definizione delle espressioni regolari

                    define("nome_completo_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");
                    define("email_conferma_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");      
                    
                    //////
                   //
                    //FARE COME NEL FOGLIETTO
                    //
                    
                    
                    
                    
                    
                    define("username_regexpr", "/^[A-Za-z0-9 ]{3,20}$/");
                    define("password_regexpr", "/^[a-zA-Z0-9]+$/");                  
                    define("nome_azienda_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");     
                    define("descrizione_regexpr", "/^[A-Za-z0-9., \xE0\xE8\xE9\xEC\xF2\xF9]{1,150}$/");
                    define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
                    define("indirizzo_regexpr", "/^[a-zA-Z0-9\s,'-]*$/");   
                    define("telefono_regexpr", "/^[0-9]{5,15}$/"); 
                    define("sito_web_regexpr", "/^((?:http(?:s)?\:\/\/)?[a-zA-Z0-9_-]+(?:.[a-zA-Z0-9_-]+)*.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$/");
                   

// valori inseriti dall"utente che vuole registrare la sua azienda (POST)

			$name = $_REQUEST['nome_completo_azienda'];
                        $task = $_REQUEST['tipo_incarichi_id'];
                        $mail = $_REQUEST['email_conferma_azienda'];
			$username = $_REQUEST['username_azienda'];
			$pass = $_REQUEST['password_azienda'];			
			$ruolo = $_REQUEST['ruolo'];
                        $company_name = $_REQUEST['name_azienda'];
                        $company_type = $_REQUEST['tipo_attivita_id'];
                        $company_mail = $_REQUEST['company_mail_azienda'];
                        $company_description = $_REQUEST['descrizione_azienda'];
                        $company_city = $_REQUEST['city_azienda'];
                        $company_address = $_REQUEST['address_azienda'];
                        $company_phone = $_REQUEST['phone_azienda'];
                        $company_web_site = $_REQUEST['sito_web_azienda'];
                       
                
                        
                        
   $_SESSION['nome_completo_azienda']=
$_SESSION['tipo_incarichi_id'] =
$_SESSION['email_conferma_azienda'] =
$_SESSION['username_azienda'] =
$_SESSION['password_azienda']=
$_SESSION['name_azienda']=
$_SESSION['tipo_attivita_id']=
$_SESSION['company_mail_azienda']=
$_SESSION['descrizione_azienda']=
$_SESSION['city_azienda']=
$_SESSION['address_azienda']=
$_SESSION['phone_azienda']=
$_SESSION['sito_web_azienda']            =NULL;          
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
            $error_rec = 0; //verifica la presenza di un generico errore
 
         $utente = new Azienda(); 
         $utente->setRuolo($ruolo);
            
           
                //verifica la correttezza dei valori inseriti nella compliazione del form
         if(!empty($name)) {
                    
                    if( 1 === preg_match(nome_completo_regexpr, $name)){
                        
                    $nome_completo = self::test_input($name);
                    $utente->setNomeCompleto($nome_completo);     
        
                } else {  
                    $_SESSION['nome_completo_azienda'] = "<br> <div id='messaggio-errore'>Il campo nome completo contiene caratteri non validi.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['nome_completo_azienda'] = "<br><div id='messaggio-errore'>Il campo nome completo &egrave; vuoto</div>";
                    $error_rec++;
                }        
                
                                
                
    if(!empty($task)) {
                $utente->setTipo_incarichi_id($task); 
                
                 
               }
               if($task=="") {
                   $_SESSION['tipo_incarichi_id'] = "<br><div id='messaggio-errore'>Il campo tipo di incarico non &egrave; stato schelto.<br> Verr&agrave; impostato automaticamete a Proprietario</div>";
               
               }            
               
               
   if(!empty($mail)) {
                    
                    if( 1 === preg_match(email_conferma_regexpr, $mail)){
            
                    
                    $email = self::test_input($mail);
                    
                    
                    $utente->setEmailConferma($email);     
        
                } else {     
                    $_SESSION['email_conferma_azienda'] = "<br> <div id='messaggio-errore'>Questo indirizzo email non &egrave; valido.<br>Verifica eventuali errori di battitura.<br>Esempio email valida: email@esempio.com</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['email_conferma_azienda'] = "<br><div id='messaggio-errore'>Il campo email &egrave; vuoto</div>";
                    $error_rec++;
                }         
               
                
       if(!empty($username)) {
                    
                    if( 1 === preg_match(username_regexpr, $username)){
                        
                    $nome_utente = self::test_input($username);
                    $utente->setUsername($nome_utente);     
        
                } else {  
                    $_SESSION['username_azienda'] = "<br><div id='messaggio-errore'>Il campo username completo contiene caratteri non validi.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['username_azienda'] = "<br><div id='messaggio-errore'>Il campo username completo &egrave; vuoto</div>";
                    $error_rec++;
                }              
               
        if(!empty($pass)) {
                    
                    if( 1 === preg_match(password_regexpr, $pass)){
            
                    
                    $password = self::test_input($pass);
                    
                    
                    $utente->setPassword($password);     
        
                } else {       
                    $_SESSION['password_azienda'] = "<br><div id='messaggio-errore'>Il campo password non &egrave; valido.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['password_azienda'] = "<br><div id='messaggio-errore'>Il campo password &egrave; vuoto</div>";
                    $error_rec++;
                }        
               
               
               
               
               
               if(!empty($company_name)) {
                    
                    if( 1 === preg_match(nome_azienda_regexpr, $company_name)){
                        
                    $nome_azienda = self::test_input($company_name);
                    $utente->setNomeAzienda($nome_azienda);     
        
                } else {  
                    $_SESSION['name_azienda'] = "<br><div id='messaggio-errore'>Il campo nome azienda completo contiene caratteri non validi.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['name_azienda'] = "<br><div id='messaggio-errore'>Il campo nome azienda completo &egrave; vuoto</div>";
                    $error_rec++;
                }        
               
               
               echo '/bc:';
                echo $company_type;echo '\<br>';
                
                
                 echo '/bc:';
                echo $_REQUEST['tipo_attivita_id']; echo '\<br>';
                
               if(!empty($company_type)) {
                $utente->setTipo_attivita_id($company_type); 
                
               }
               if($company_type=="-1") {
                   echo 'entro qui';
                   $_SESSION['tipo_attivita_id'] = "<br><div id='messaggio-errore'>Il campo tipo di attivit&agrave; non &egrave; stata schelta.</div>";
               $error_rec++; 
               }
               
                  
               
               
              if(!empty($company_mail)) {
                    
                    if( 1 === preg_match(email_conferma_regexpr, $company_mail)){
            
                    
                    $posta = self::test_input($company_mail);
                    
                    
                    $utente->setEmail($posta);     
        
                } else {     
                    $_SESSION['company_mail_azienda'] = "<br><div id='messaggio-errore'>Il campo email non &egrave; valido. email@esempio.com</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['company_mail_azienda'] = "<br><div id='messaggio-errore'>Il campo email &egrave; vuoto</div>";
                    $error_rec++;
                }     
               
                          
               
               if(!empty($company_description)) {
                    
                   echo htmlentities($company_description);
                   
                    if( 1 === preg_match(descrizione_regexpr, $company_description)){
                        
                        
                        /////////
                        //
                        //
                        //
                        //IL CASINO ME LO FA CON LA FUNZIONE test_input dove ho trim e htmlspecialchars
                        //
                        //
                        /////////
                     
           
                    $utente->setDescrizione($company_description);     
        
                } else {      
                     $_SESSION['descrizione_azienda'] = "<br><div id='messaggio-errore'>Il campo descrizione non &egrave; valido.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['descrizione_azienda'] = "<br><div id='messaggio-errore'>Il campo descrizione &egrave; vuoto</div>";
                    $error_rec++;
                }  
               
                     
           

              if(!empty($company_city)) {
                    
                    if( 1 === preg_match(citta_regexpr, $company_city)){
            
                    
                    $citta = self::test_input($company_city);
                    
                    
                    $utente->setCitta($citta);     
        
                } else {       
                    $_SESSION['city_azienda'] = "<br><div id='messaggio-errore'>Il campo citt&agrave; non &egrave; valido.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['city_azienda'] = "<br><div id='messaggio-errore'>Il campo citt&agrave; &egrave; vuoto</div>";
                    $error_rec++;
                }                     
                
                
    
                
                
                if(!empty($company_address)) {
                    
                    if( 1 === preg_match(indirizzo_regexpr, $company_address)){
            
                    
                    $indirizzo = self::test_input($company_address);
                    
                    
                    $utente->setIndirizzo($indirizzo);     
        
                } else {         
                    $_SESSION['address_azienda'] = "<br><div id='messaggio-errore'>Il campo indirizzo non &egrave; valido.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['address_azienda'] = "<br><div id='messaggio-errore'>Il campo indirizzo &egrave; vuoto</div>";
                    $error_rec++;
                }     
                
                                
                 if(!empty($company_phone)) {
                    
                    if( 1 === preg_match(telefono_regexpr, $company_phone)){
            
                    
                    $telefono = self::test_input($company_phone);
                    
                    
                    $utente->setTelefono($telefono);     
        
                } else {        
                    $_SESSION['phone_azienda'] = "<br><div id='messaggio-errore'>Il campo telefono non &egrave; valido.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['phone_azienda'] = "<br><div id='messaggio-errore'>Il campo telefono &egrave; vuoto</div>";
                    $error_rec++;
                }  
                
                
                
       if(!empty($company_web_site)) {
                    
                    if( 1 === preg_match(sito_web_regexpr, $company_web_site)){
            
                    
                    $sito_web = self::test_input($company_web_site);
                    
                    
                    $utente->setSitoWeb($sito_web);     
        
                } else {        
                    $_SESSION['sito_web_azienda'] = "<br><div id='messaggio-errore'>Il campo del sito web non &egrave; valido.<br>Verifica eventuali errori di battitura.</div>";
                    $error_rec++; 
                } 
                
                } else { 
                    $_SESSION['sito_web_azienda'] = "<br><div id='messaggio-errore'>Il campo del sito web &egrave; vuoto</div>";
                    $error_rec++;
                }              
                
               
                             
            
               
         
                
                if (isset ($_REQUEST['accesso_disabili']))
              {
                  $_SESSION['accesso_disabili'] = $_REQUEST['accesso_disabili'];
              }
                 if (isset ($_REQUEST['accetta_carde_di_credito']))
              {
                  $_SESSION['accetta_carde_di_credito'] = $_REQUEST['accetta_carde_di_credito'];
              }   
                
                if (isset ($_REQUEST['accetta_prenotazioni']))
              {
                  $_SESSION['accetta_prenotazioni'] = $_REQUEST['accetta_prenotazioni'];
              }   
                
              
             
              
                if (isset ($_REQUEST['bagno_disponibile']))
              {
                  $_SESSION['bagno_disponibile'] = $_REQUEST['bagno_disponibile'];
              }   
              
              
              
              
                if (isset ($_REQUEST['bancomat']))
              {
                  $_SESSION['bancomat'] = $_REQUEST['bancomat'];
              }   
              
              
              
                if (isset ($_REQUEST['bevande_alcoliche']))
              {
                  $_SESSION['bevande_alcoliche'] = $_REQUEST['bevande_alcoliche'];
              }   
              
               if (isset ($_REQUEST['catering']))
              {
                  $_SESSION['catering'] = $_REQUEST['catering'];
              }   
              
              
              
              if (isset ($_REQUEST['consegna_a_domicilio']))
              {
                  $_SESSION['consegna_a_domicilio'] = $_REQUEST['consegna_a_domicilio'];
              }   
              
              
              
              if (isset ($_REQUEST['da_asporto']))
              {
                  $_SESSION['da_asporto'] = $_REQUEST['da_asporto'];
              }   
              
              
              if (isset ($_REQUEST['guardaroba_disponibile']))
              {
                  $_SESSION['guardaroba_disponibile'] = $_REQUEST['guardaroba_disponibile'];
              }   
              
                            
              
               if (isset ($_REQUEST['musica']))
              {
                  $_SESSION['musica'] = $_REQUEST['musica'];
              }   
              
              
              
              
              if (isset ($_REQUEST['parcheggio_auto']))
              {
                  $_SESSION['parcheggio_auto'] = $_REQUEST['parcheggio_auto'];
              }   
              
              
               if (isset ($_REQUEST['parcheggio_bici']))
              {
                  $_SESSION['parcheggio_bici'] = $_REQUEST['parcheggio_bici'];
              }   
              
              
                 if (isset ($_REQUEST['per_fumatori']))
              {
                  $_SESSION['per_fumatori'] = $_REQUEST['per_fumatori'];
              }   
              
              
               if (isset ($_REQUEST['posti_sedere_aperto']))
              {
                  $_SESSION['posti_sedere_aperto'] = $_REQUEST['posti_sedere_aperto'];
              }   
              
              
                 if (isset ($_REQUEST['stanza_privata']))
              {
                  $_SESSION['stanza_privata'] = $_REQUEST['stanza_privata'];
              }   
              
              
              
              
                 if (isset ($_REQUEST['tv']))
              {
                  $_SESSION['tv'] = $_REQUEST['tv'];
              }   
              
              
                 if (isset ($_REQUEST['wifi']))
              {
                  $_SESSION['wifi'] = $_REQUEST['wifi'];
              }   
              
              
              
              
            
            if($error_rec == 0) {   
        //se non ci sono errori passo alla funzione registrazione_azienda
            self::registrazione_azienda($utente);
            
            } else {
                 //si è verificato un errore (campo vuoto o caratteri non validi) nel form di registrazione
                               
       $_SESSION['errore'] = 1;
                
            $vd = new ViewDescriptor();                           
            $vd->setTitolo("Benvenuto in FoodAdvisor");
            $vd->setLogoFile("../view/out/logo.php");
            $vd->setMenuFile("../view/out/menu_back.php");
            $vd->setContentFile("../view/out/form_registrazione_azienda.php"); 
            $vd->setErrorFile("../view/out/error_out.php");
            $vd->setFooterFile("../view/out/footer_empty.php");
            // richiamo la vista
            require_once "../view/Master.php"; 
      }
      break;  

            
            
            
  /*
* ===================================LOGIN DELL'AZIENDA===========================================
*/
      //effettua il login per l"azienda
            case 'login_azienda':  
                
                
                
                
                    //flag per controllare la presenza di errori
                $error = 0;
                
             
                //username e password che vengono dal form di login o dopo che un cliente si registra
                $user_azienda = $_REQUEST['username_azienda'];              
                $pass_azienda = $_REQUEST['password_azienda'];
                
                    //definiamo le espressioni regolari per controllare la correttezza formale di username e password
                    define("username_regexpr", "/^[A-Za-z0-9 ]{3,20}$/");
                    define("password_regexpr", "/^[a-zA-Z0-9]+$/");
                    
                
                    
                    // verifica la correttezza formale di username e password
                    if( 1 === preg_match(username_regexpr, $user_azienda)) 
                    {
                    $user = self::test_input($user_azienda);
                    }
                    else
                    {
                        $error ++;
                    }
                    
                      // verifica la correttezza formale di username e password
                    if( 1 === preg_match(password_regexpr, $pass_azienda)) 
                    {
                    $pass = self::test_input($pass_azienda);
                    }
                    else
                    {
                        $error ++;
                    }
                    
                    
                    
            
            //messaggio di errore se i campi sono vuoti o non rispettano l"espressione regolare
            if($error != 0) {
                   //errore in fase di login
                $_SESSION['errore'] = 4;
                
                $vd = new ViewDescriptor();     
           
            $vd->setTitolo("SardiniaInFood");
        $vd->setLogoFile("../view/out/logo.php");
        $vd->setMenuFile("../view/out/menu_back.php");
                $vd->setContentFile("../view/out/login_azienda.php"); //ritorna alla funzione login azienda
                $vd->setErrorFile("../view/out/error_out.php");
                $vd->setFooterFile("../view/out/footer_empty.php");
            // richiamo la vista
            require_once "../view/Master.php"; 
            }
            else 
                {
              //se non ci sono errori passa alla funzione login_azienda
                    self::login_azienda($user, $pass);
                }
            
            
            
            
            break;
                
 /*
* ===============================CERCA DOVE COSA===============================================
*/
  //analizza i parametri passati dal form per effettuare una ricerca


              case "cercadovecosa": 
               
                  
            
                   //flag per controllare la presenza di errori
                   $errore = 0;
                  //espressione regolare 
                 define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
         
                 //parametri inseriti nel form di ricerca
           $city_request = $_REQUEST['citta'];
           //"pulizia" del parametro city
           $city = trim($city_request);
           
           $tipo_attivita_id = $_REQUEST['tipo_attivita_id'];
           
             //per semplicità se il parametro city è uguale a "Dove",
           //che significa che l"utente non ha inserito nulla nel campo form "citta",
           //oppure è uguale a "", che significa che l"utente
           //ha lasciato uno spazio bianco nel campo form "citta", allora viene considerato
           //UNDEFINE
           
           if($city=="Dove" || $city=="")
           {
               $citta='UNDEFINE';
           }
           //in caso contrario si va a controllare il contenuto di city
           //affinchè rispetti l"espressione regolare
           else
           {
                  
                    if( 1 === preg_match(citta_regexpr, $city)){
            
                    
                    $citta = self::test_input($city);
                                           
        
                } else {       
                   
                    $errore++; 
                } 
           }    
               
           
     //se non ci sono errori      
      if($errore==0)
          {
            
          //se non ci sono errori richiama la funzione cercaDoveCosa
       
           self::cercaDoveCosa($citta,$tipo_attivita_id);
          }
      else{
          //sono presenti caratteri non validi
          
           $_SESSION['errore'] = 5;
             
             //richiama la home page
    $vd = new ViewDescriptor();
  
     $vd->setTitolo("Benvenuto in SardiniaInFood");
     $vd->setLogoFile("../view/out/logo.php");
     $vd->setMenuFile("../view/out/menu_home_page.php"); 
     $vd->setContentFile("../view/out/home_page_default.php"); //richiama la home page
     $vd->setErrorFile("../view/out/error_out.php");
    $vd->setFooterFile("../view/out/footer_home_page.php"); 
				
     
     // richiamo la vista
     require_once "../view/Master.php";  
      }
      
   
      
      
      
         break;   
/*
 * ================================MOSTRA PROFILO AZIENDA=============================================
 */  
         //mostra il profilo di un'azienda
            case "profile": 
             self::showProfile();
                  break;
/*
 * =============================================================================
 */      
/*
 * =============================================================================
 */      
/*
 * =============================================================================
 */       
/*
 * =============================================================================
 */      
/*
 * =============================================================================
 */      
/*
 * =============================================================================
 */      
/*
 * ====================================LOGOUT=========================================
 */      
      
      
		case 'logout': //back alla pagina index
			$url = "http://localhost/SardiniaInFood/php/index.php?page=0</div>";
			session_destroy();
			header("location:$url");
			break;
			}
		}

/*
* =================================TEST INPUT============================================
*/

	// con questa funzione vado a:
	// - rimuovere gli spazi bianchi all"inizio e alla fine della stringa
	// - converte certi caratteri in entità  HTML

	public static function test_input($data)
		{
		$data = trim($data);
		$data = htmlspecialchars($data);
		return $data;
		}

/*
* ==========================REGISTRAZIONE CLIENTI====================================================
*/
                //funzione si occupa della registrazione di un nuovo cliente
	public static function registrazione_cliente($utente)
		{
          
	    //funzione di registrazione creaUtente a seconda del ruolo:
            //1-verifica che l"utente non sia già registranto
            //andando a confrontare nel database l"indirizzo email inserito durante la 
            //registrazione nel form
            //2-se non risulta che l"utente sia già registrato va effettivamente a
            //registrare il nuovo utente nel database
            //
            //viene usata una transizione
    $test = UtenteFactory::creaUtente($utente);
    



     if($test == "PRESENTE") { 
        
         //se il cliente è già registrato viene mostrato un messaggio di errore
         $_SESSION['errore'] = 2;
         
           $vd = new ViewDescriptor();
                $vd->setTitolo("SardiniaInFood");
                $vd->setLogoFile("../view/out/logo.php");
                $vd->setErrorFile("../view/out/error_out.php");
                $vd->setMenuFile("../view/out/menu_back.php");
                $vd->setContentFile("../view/out/form_registrazione_cliente.php"); //ritorna la form di registrazione cliente
                $vd->setFooterFile("../view/out/footer_empty.php");
         //richiamo la vista
       require_once "../view/Master.php";
     
     }
      else { 
          //in caso la registrazione abbia abuto successo procede con il 
          //login diretto
     $username = $utente->getUsername($utente);
     $password = $utente->getPassword($utente);
         
    ///richiama la funzione di login
    self::login_cliente($username, $password);
          
     }
		}
                
/*
* ==========================LOGIN CLIENTE====================================================
*/
                //Funzione che permette il login del cliente   
    public static function login_cliente($username, $password) {                
   
        //cerco l"utente nel database in base all"email e la password passati        
        $utente = UtenteFactory::cercaCliente($username, $password); 
        // creo il descrittore della vista
        $vd = new ViewDescriptor();
      
        //utente non trovato. Viene visualizzato nuovamente il form di login
        if($utente=="NOTFOUND") {
      
            $_SESSION['errore'] = 3;
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/out/logo.php");
            $vd->setMenuFile("../view/out/menu_back.php");
            $vd->setErrorFile("../view/out/error_out.php"); 
            $vd->setContentFile("../view/out/login_cliente.php"); //ritorno al form di login
            $vd->setFooterFile("../view/out/footer_empty.php");
        
        } else {
            //puliza della sessione di ricerca della home page
            //altrimenti quando si fa logout da cliente
            //ci si ritrova con una eventuale vecchia ricerca fatta prima sulla home page
            $_SESSION['citta']=NULL;
            $_SESSION['tipo_attivita_id']=NULL;
            $_SESSION['risultati']=NULL;
            
            
             //salvo l'utente in sessione
            $_SESSION['current_user'] = $utente;
          
            //si sposta nella home page del cliente
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/in/logo.php");
            $vd->setMenuFile("../view/in/menu_cliente.php");
            $vd->setErrorFile("../view/in/error_in.php"); 
            $vd->setContentFile("../view/in/cliente/home_page_cliente.php");
            $vd->setFooterFile("../view/in/footer_empty.php");
            
                                   
        }
        // richiamo la vista
        require_once "../view/Master.php";
    }   
/*
* ============================REGISTRAZIONE AZIENDA==================================================
*/
               //funzione si occupa della registrazione di una nuova azienda
	public static function registrazione_azienda($utente)
		{
          
            //funzione di registrazione creaUtente a seconda del ruolo:
            //1-verifica che l"utente non sia già registranto
            //andando a confrontare nel database l"indirizzo email inserito durante la 
            //registrazione nel form
            //2-se non risulta che l"utente sia già registrato va effettivamente a
            //registrare il nuovo utente nel database
            //
            //viene usata una transizione
    $test = UtenteFactory::creaUtente($utente);
    



     if($test == "PRESENTE") { 
        
         //se l"azienda è già registrato viene mostrato un messaggio di errore
         $_SESSION['errore'] = 2;
         
         //caricamento pagina
           $vd = new ViewDescriptor();
                $vd->setTitolo("SardiniaInFood");
                $vd->setLogoFile("../view/out/logo.php");
                $vd->setErrorFile("../view/out/error_out.php");
                $vd->setMenuFile("../view/out/menu_back.php");
                $vd->setContentFile("../view/out/form_registrazione_azienda.php"); //ritorna al form di registraizone
                $vd->setFooterFile("../view/out/footer_empty.php");
         //richiamo la vista
       require_once "../view/Master.php";
     
     }
      else { 
          //in caso la registrazione abbia abuto successo procede con il 
          //login diretto
     $username = $utente->getUsername($utente);
     $password = $utente->getPassword($utente);
         
    ///richiama la funzione di login
    self::login_azienda($username, $password);
          
     }
		}
                
/*
* ==============================================================================
*/       
                     //Funzione che permette il login dell"azienda    
    public static function login_azienda($username, $password) {                
  
        //cerco l"utente nel database in base all"email e la password passati        
        $utente = UtenteFactory::cercaAzienda($username, $password); 
        
     
        // creo il descrittore della vista
        $vd = new ViewDescriptor();
      
        //utente non trovato. Viene visualizzato nuovamente il form di login
        if($utente=="NOTFOUND") {
      
            $_SESSION['errore'] = 3;
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/out/logo.php");
            $vd->setMenuFile("../view/out/menu_back.php");
            $vd->setErrorFile("../view/out/error_out.php"); 
            $vd->setContentFile("../view/out/login_cliente.php"); //ritorna al form di login
            $vd->setFooterFile("../view/out/footer_empty.php");
        
        } else {
             //salvo l"utente in sessione
            $_SESSION['current_user'] = $utente;
          
            //si sposta nella home page del cliente
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/in/logo.php");
            $vd->setMenuFile("../view/in/menu_azienda.php");
            $vd->setErrorFile("../view/in/error_in.php"); 
            $vd->setContentFile("../view/in/azienda/home_page_azienda.php");
            $vd->setFooterFile("../view/in/footer_empty.php");
            
                                   
        }
        // richiamo la vista
        require_once "../view/Master.php";
    }   
/*
* ===============================CERCA DOVE COSA===============================================
*/        
    //l"utente può ricercare un certo tipo di azienda in un certo luogo
     public static function cercaDoveCosa($citta, $tipo_attivita_id)
    {
        
         //flag per controllare la presenza di errori
          $errore=0;
         
          
  //le possibili combinazioni citta / tipo attivita sono

           // citta=="UNDEFINE" / tipo_attivita_id == -1  => CASO NON VALIDO
           // citta=="stringa" / tipo_attivita_id == -1 => CASO VALIDO
           // citta=="UNDEFINE" / tipo_attivita_id >= 1 => CASO VALIDO
           // citta=="stringa" / tipo_attivita_id >= 1 => CASO VALIDO        
          
    
          
         //verifica che non ci si trovi nel caso non valido
         if($citta=="UNDEFINE" AND $tipo_attivita_id==-1)
             {
                   $_SESSION['errore']=5;
                   $errore++;
                   //pulizia
              $_SESSION['risultati']='ZERO'; 
              $_SESSION['citta']=NULL;
             $_SESSION['tipo_attivita_id']=NULL;
             
               }      
    
               //se $errore==0 non sono passato per il caso non valido
               if($errore==0)
               { 
                   
                //parametri arrivati correttamente
                   //come detto in home_page_default righe 84-89
                   //qui metto in sessione i parametri che sono corretti
                   $_SESSION['citta']= $citta;
                   $_SESSION['tipo_attivita_id']=$tipo_attivita_id;
   
                 
                 
                 
//funzione che ricerca in un certo luogo una certa categoria di aziende
$risultati = UtenteFactory::cercaDoveCosa($citta, $tipo_attivita_id);



//ho trovato almeno un risultato
if($risultati!='ZERO')
{
   
    //passaggio dei risultati
$_SESSION['risultati']=  $risultati;
    


}
else
{
 
//errore nessun risultato trovato
    $_SESSION['errore']=6;
    //pulizia
   $_SESSION['risultati']='ZERO';
   $_SESSION['citta']=NULL; 
   $_SESSION['tipo_attivita_id']=NULL;
    
    
    
}
               }

//in qualunque caso richiamo la home page
    $vd = new ViewDescriptor();
     
     $vd->setTitolo("Benvenuto in SardiniaInFood");
   
     $vd->setLogoFile("../view/out/logo.php");
     $vd->setMenuFile("../view/out/menu_home_page.php");
     $vd->setContentFile("../view/out/home_page_default.php");
     $vd->setErrorFile("../view/out/error_out.php");
     $vd->setFooterFile("../view/out/footer_home_page.php");   
     
     // richiamo la vista
     require_once "../view/Master.php";  






         

 
     
      
    }
    
 /*
* ===================================SHOW PROFILE===========================================
*/     
     //mostra il profilo dell"azienda selezionata
     public static function showProfile()
    {
         
         
         $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/out/logo.php");  
       $vd->setMenuFile("../view/out/menu_back.php");
       $vd->setContentFile("../view/out/show_profile.php");
       $vd->setErrorFile("../view/out/error_out.php"); 
       $vd->setFooterFile("../view/out/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
         
         
    }
    
 /*
* ==============================================================================
*/   
/*
* ==============================================================================
*/
 /*
* ==============================================================================
*/               
/*
* ==============================================================================
*/                
 /*
* ==============================================================================
*/               
 /*
* ==============================================================================
*/               
 /*
* ==============================================================================
*/               
 /*
* ==============================================================================
*/               
        }
?>

