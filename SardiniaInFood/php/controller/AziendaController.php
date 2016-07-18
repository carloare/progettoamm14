<?php

//controller dell'azienda


include_once '../view/ViewDescriptor.php';
include_once '../model/UtenteFactory.php';
include_once '../model/Azienda.php';
include_once '../model/Utente.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';






if(session_status()!=2) session_start();

if(isset($_REQUEST['cmd'])) 
    AziendaController::handleInput();
 

class AziendaController { 
    //A seconda del compito da eseguire viene richiamata la funzione associata         
     public static function handleInput() 
    {
        switch($_REQUEST["cmd"])
        {
             //cancella il profilo del cliente  
      case 'cancella':         
                self::cancella();
                break;     
            
               //modifica il profilo del cliente  
      case 'modifica':         
                self::showPaginaModifica();
                break;     
      
      //modifica il profilo del cliente  
      case 'back_home_page':         
                self::showHomePage();
                break;           
            

      case 'showrecensioni':         
    self::showHomePage();
 
                break;   

       case 'modifica_profilo_personale':  
          self::modificaProfiloPersonale();
                break;      
        case 'modifica_profilo_azienda':  
          self::modificaProfiloAzienda();
                break;      
         case 'modifica_servizi':  
          self::modificaServizi();
                break;   
            
        case 'update_profilo_personale':  
          self::updateProfiloPersonale();
                break;  
            
        case 'update_profilo_azienda':  
          self::updateProfiloAzienda();
                break;   
            
            
           case 'update_servizi':  
          self::updateServizi();
                break;   
        }
    }    
   
     /*
* =============================CANCELLA IL PROFILO DELL'AZIENDA========================================
*/    
   //permette di cancellare il profilo il profilo di un'azienda
                public static function cancella()
    {

    $delete_id = $_SESSION['current_user']->getId();

   
   
    UtenteFactory::cancellaAzienda($delete_id);
    
    }
    
    
        /*
* =============================MODIFICA IL PROFILO DELL'AZIENDA========================================
*/    
   //pagina dove è possibile modificare il profilo dell'azienda
    
    public static function showPaginaModifica() {
    
       $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_change_profile_azienda.php");
       $vd->setContentFile("../view/in/azienda/change_profile.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
    }
     
   /*
* =============================MOSTRA LA HOME PAGE DELL'AZIENDA========================================
*/    
   //mostra la home page dell'azienda
    
    public static function showHomePage() {
    
       $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_home_azienda.php");
       $vd->setContentFile("../view/in/azienda/home_page_azienda.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
    }
    
     /*
* =============================MODIFICA IL PROFILO PERSONALE========================================
*/    
   //modifica la parte del profilo azienda che riguarda il proprio profilo
    
     public static function modificaProfiloPersonale() {
    
       $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_modifica_profilo.php");
       $vd->setContentFile("../view/in/azienda/modifica_profilo_personale.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
    }
   
     /*
* =============================MODIFICA IL PROFILO PERSONALE========================================
*/    
   //modifica la parte del profilo azienda che riguarda il proprio profilo
    
     public static function modificaProfiloAzienda() {
    
       $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_modifica_profilo.php");
       $vd->setContentFile("../view/in/azienda/modifica_profilo_azienda.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
    }
     /*
* =============================MODIFICA IL PROFILO PERSONALE========================================
*/    
   //modifica la parte del profilo azienda che riguarda il proprio profilo
    
     public static function modificaServizi() {
    
       $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_modifica_profilo.php");
       $vd->setContentFile("../view/in/azienda/modifica_servizi.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
    }
  
    
    /*
* =============================MODIFICA IL PROFILO PERSONALE========================================
*/    
   //modifica la parte del profilo azienda che riguarda il proprio profilo
    
     public static function updateProfiloPersonale() {
    
         define("nome_completo_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");
			define("email_personale_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");
			define("username_regexpr", "/^[A-Za-z0-9 ]{3,20}$/");
			define("password_regexpr", "/^[a-zA-Z0-9]+$/");
         
         
       $name = trim($_REQUEST['nome_completo_azienda']);
				$task = trim($_REQUEST['tipo_incarichi_id']);
				$mail = trim($_REQUEST['email_personale_azienda']);
				$username = trim($_REQUEST['username_azienda']);
				$pass = trim($_REQUEST['password_azienda']);
				$id = $_SESSION['current_user']->getId();

				
                                
                             
                                
                                $error_rec = 0; //verifica la presenza di un generico errore
                                
				//if (isset($_SESSION['azienda']))
				//{
					//$utente = $_SESSION['azienda'];
				//}
				//else
				
                              
                                
					$utente = new Azienda();
				

				

				// verifica la correttezza dei valori inseriti nella compliazione del form

				if (!empty($name))
				{
					unset($_SESSION['nome_completo_azienda']);
					if (1 === preg_match(nome_completo_regexpr, $name))
					{
						$utente->setNomeCompleto($name);
					}
					else
					{
						$_SESSION['nome_completo_azienda'] = "<br> <div id='messaggio-errore'>Il campo nome completo contiene caratteri non validi.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['nome_completo_azienda'] = "<br><div id='messaggio-errore'>Il campo nome completo &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($task))
				{
					unset($_SESSION['tipo_incarichi_id']);
					$utente->setTipo_incarichi_id($task);
				}

				if ($task == "-1")
				{
					$_SESSION['tipo_incarichi_id'] = "<br><div id='messaggio-errore'>Il campo tipo di incarico non &egrave; stato schelto</div>";
					$error_rec++;
				}

				if (!empty($mail))
				{
					unset($_SESSION['email_personale_azienda']);
					if (1 === preg_match(email_personale_regexpr, $mail))
					{
						$valido = UtenteFactory::cercaEmailUpdate($mail, 1, $id);
                                                
						if ($valido == 'SI')
						{
                                                    
							$utente->setEmailConferma($mail);
						}
						else
						{
							$_SESSION['email_personale_azienda'] = "<br><div id='messaggio-errore'>Questa email &egrave; gi&agrave; stato utilizzata<br /></div>";
							$error_rec++;
						}
					}
					else
					{
						$_SESSION['email_personale_azienda'] = "<br> <div id='messaggio-errore'>Questo indirizzo email non &egrave; valido.<br />Verifica eventuali errori di battitura.<br />Esempio email valida: email@esempio.com</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['email_personale_azienda'] = "<br><div id='messaggio-errore'>Il campo email &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($username))
				{
					unset($_SESSION['username_azienda']);
					if (1 === preg_match(username_regexpr, $username))
					{
						$valido = UtenteFactory::cercaUsernameUpdate($username, 1, $id);
						if ($valido == 'SI')
						{
							$utente->setUsername($username);
						}
						else
						{
							$_SESSION['username_azienda'] = "<br><div id='messaggio-errore'>Questo Username &egrave; gi&agrave; stato utilizzato<br />scegline un altro</div>";
							$error_rec++;
						}
					}
					else
					{
						$_SESSION['username_azienda'] = "<br><div id='messaggio-errore'>Il campo username completo contiene caratteri non validi.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['username_azienda'] = "<br><div id='messaggio-errore'>Il campo username completo &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($pass))
				{
					unset($_SESSION['password_azienda']);
					if (1 === preg_match(password_regexpr, $pass))
					{
						$utente->setPassword($pass);
					}
					else
					{
						$_SESSION['password_azienda'] = "<br><div id='messaggio-errore'>Il campo password non &egrave; valido.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['password_azienda'] = "<br><div id='messaggio-errore'>Il campo password &egrave; vuoto</div>";
					$error_rec++;
				}

                                echo $error_rec;
                                
				if ($error_rec == 0)
				{
				$update = UtenteFactory::updateProfiloPersonale($id, $utente);

                                
                                
            if($update =='INSUCCESSO')
            {
                $_SESSION['errore'] = 6;
            }
            elseif($update =='SUCCESSO')
            {
                $_SESSION['errore'] = 5;
            }	
				}
				

					// $_SESSION['azienda'] = $utente;

					
					$vd = new ViewDescriptor();
					$vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_modifica_profilo.php");
       $vd->setContentFile("../view/in/azienda/modifica_profilo_personale.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");

					// richiamo la vista

					require_once '../view/Master.php';

				
    }  
    
    
    
    
    
    
    
     /*
* =============================MODIFICA IL PROFILO AZIENDA========================================
*/    
   //modifica la parte propria del profilo azienda
    
     public static function updateProfiloAzienda() {


         
         
         define("nome_azienda_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");
			define("descrizione_regexpr", "/^[A-Za-z0-9., \xE0\xE8\xE9\xEC\xF2\xF9]{1,150}$/");
			define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
			define("indirizzo_regexpr", "/^[a-zA-Z0-9\s,'-]*$/");
			define("telefono_regexpr", "/^[0-9]{5,15}$/");
			define("sito_web_regexpr", "/^((?:http(?:s)?\:\/\/)?[a-zA-Z0-9_-]+(?:.[a-zA-Z0-9_-]+)*.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$/");
define("email_personale_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");
         
         
         $company_name = trim($_REQUEST['name_azienda']);
				$company_type = $_REQUEST['tipo_attivita_id'];
				$company_email = $_REQUEST['company_mail_azienda'];
				$company_description = trim($_REQUEST['descrizione_azienda']);
				$company_city = trim($_REQUEST['city_azienda']);
				$company_address = trim($_REQUEST['address_azienda']);
				$company_phone = $_REQUEST['phone_azienda'];
				$company_web_site = $_REQUEST['sito_web_azienda'];
				$id = $_SESSION['current_user']->getId();
                                
                                
				$error_rec = 0; //verifica la presenza di un generico errore

                                
                                
                                $utente = new Azienda();
                                
                                
				// pulizia

				if (!empty($company_name))
				{

				        unset($_SESSION['name_azienda']);

					if (1 === preg_match(nome_azienda_regexpr, $company_name))
					{
						$utente->setNomeAzienda($company_name);
					}
					else
					{
						$_SESSION['name_azienda'] = "<br><div id='messaggio-errore'>Il campo nome azienda completo contiene caratteri non validi.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['name_azienda'] = "<br><div id='messaggio-errore'>Il campo nome azienda completo &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($company_type))
				{

					unset($_SESSION['tipo_attivita_id']);

					$utente->setTipo_attivita_id($company_type);
				}

				if ($company_type == "-1")
				{
					$_SESSION['tipo_attivita_id'] = "<br><div id='messaggio-errore'>Il campo tipo di attivit&agrave; non &egrave; stata schelta.</div>";
					$error_rec++;
				}

				if (!empty($company_email))
				{

					unset($_SESSION['company_mail_azienda']);

					if (1 === preg_match(email_personale_regexpr, $company_email))
					{
                                            
                                             $valido = UtenteFactory::cercaEmailUpdate($company_email, 2, $id);
					
                                             if ($valido == 'SI')
						{
							$utente->setEmail($company_email);
						}
						else
						{
							$_SESSION['email_personale_azienda'] = "<br><div id='messaggio-errore'>Questa email &egrave; gi&agrave; stato utilizzata<br /></div>";
							$error_rec++;
						}
                                            
						
					}
					else
					{
						$_SESSION['company_mail_azienda'] = "<br><div id='messaggio-errore'>Il campo email non &egrave; valido. email@esempio.com</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['company_mail_azienda'] = "<br><div id='messaggio-errore'>Il campo email &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($company_description))
				{

					unset($_SESSION['descrizione_azienda']);

					if (1 === preg_match(descrizione_regexpr, $company_description))
					{
						$utente->setDescrizione($company_description);
					}
					else
					{
						$contacaratteri = strlen($company_description);
						if ($contacaratteri >= 150)
						{
							$_SESSION['descrizione_azienda'] = "<br><div id='messaggio-errore'>Il campo descrizione non &egrave; valido.<br />Il campo contiene $contacaratteri caratteri</div>";
						}
						else
						{
							$_SESSION['descrizione_azienda'] = "<br><div id='messaggio-errore'>Il campo descrizione non &egrave; valido.</div>";
						}

						$error_rec++;
					}
				}
				else
				{
					$_SESSION['descrizione_azienda'] = "<br><div id='messaggio-errore'>Il campo descrizione &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($company_city))
				{

					unset($_SESSION['city_azienda']);

					if (1 === preg_match(citta_regexpr, $company_city))
					{
						$utente->setCitta($company_city);
					}
					else
					{
						$_SESSION['city_azienda'] = "<br><div id='messaggio-errore'>Il campo citt&agrave; non &egrave; valido.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['city_azienda'] = "<br><div id='messaggio-errore'>Il campo citt&agrave; &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($company_address))
				{

					unset($_SESSION['address_azienda']);

					if (1 === preg_match(indirizzo_regexpr, $company_address))
					{
                                            echo 'ac'; echo $company_address;
						$utente->setIndirizzo($company_address);
					}
					else
					{
						$_SESSION['address_azienda'] = "<br><div id='messaggio-errore'>Il campo indirizzo non &egrave; valido.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['address_azienda'] = "<br><div id='messaggio-errore'>Il campo indirizzo &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($company_phone))
				{

					unset($_SESSION['phone_azienda']);

					if (1 === preg_match(telefono_regexpr, $company_phone))
					{
						$utente->setTelefono($company_phone);
					}
					else
					{
						$_SESSION['phone_azienda'] = "<br><div id='messaggio-errore'>Il campo telefono non &egrave; valido.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['phone_azienda'] = "<br><div id='messaggio-errore'>Il campo telefono &egrave; vuoto</div>";
					$error_rec++;
				}

				if (!empty($company_web_site))
				{

					unset($_SESSION['sito_web_azienda']);

					if (1 === preg_match(sito_web_regexpr, $company_web_site))
					{
						$utente->setSitoWeb($company_web_site);
					}
					else
					{
						$_SESSION['sito_web_azienda'] = "<br><div id='messaggio-errore'>Il campo del sito web non &egrave; valido.<br />Verifica eventuali errori di battitura.</div>";
						$error_rec++;
					}
				}
				else
				{
					$_SESSION['sito_web_azienda'] = "<br><div id='messaggio-errore'>Il campo del sito web &egrave; vuoto</div>";
					$error_rec++;
				}

         
         
         
         if ($error_rec == 0)
				{
				$update = UtenteFactory::updateProfiloAzienda($id, $utente);

                                
                                
            if($update =='INSUCCESSO')
            {
                $_SESSION['errore'] = 6;
            }
            elseif($update =='SUCCESSO')
            {
                $_SESSION['errore'] = 5;
            }	
				}
				

					// $_SESSION['azienda'] = $utente;

					
					$vd = new ViewDescriptor();
					$vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_modifica_profilo.php");
       $vd->setContentFile("../view/in/azienda/modifica_profilo_azienda.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");

					// richiamo la vista

					require_once '../view/Master.php';

				
    }  
         
         
         
         
         
            /*
* =============================UPDATE SERVIZI========================================
*/    
   //aggiorna i servizi offerti
    
     public static function updateServizi() {
    
         
         $utente = $_SESSION['current_user'];

				// se mi arriva correttametne la sessione azienda

				if (isset($utente))
				{

					// se mi arriva la request dei servizi la metto in sessione

					if (isset($_REQUEST['servizi']))
					{
						$_SESSION['servizi'] = $_REQUEST['servizi'];
					}

					// effettua la registrazione dell'azienda

					 $update = UtenteFactory::updateServizi($utente);

                                
                                
            if($update =='INSUCCESSO')
            {
                $_SESSION['errore'] = 6;
            }
            elseif($update =='SUCCESSO')
            {
                $_SESSION['errore'] = 5;
            }	
				 $vd = new ViewDescriptor();
					$vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_modifica_profilo.php");
       $vd->setContentFile("../view/in/azienda/modifica_servizi.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");

					// richiamo la vista

					require_once '../view/Master.php';
				}}
         
         
         
    
         
         
     
            
            
            
           
            
    
         
         
         
         
         
         
         
         
         
     
}

?>
