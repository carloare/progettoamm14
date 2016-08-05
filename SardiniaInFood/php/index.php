<?php

/*
* Classe che controlla il punto di accesso dell'applicazione
*/


   include_once 'view/ViewDescriptor.php';
   include_once 'model/Utente.php';
   include_once 'model/UtenteFactory.php';
   include_once 'model/Azienda.php';
   
   if (session_status() != 2) session_start();

   $_SESSION['visible_logout'] = 1000;

// punto unico di accesso

FrontController::start();

class FrontController

{
	public static function start()
	{

		// caricamento pagina

		$vd = new ViewDescriptor();

		// durante il primo ingresso all'applicazioine ricevo da index.html il parametro
		// page = 0, viene mandata in esecuzione dallo switch l'home page
		// di default. Da qui si accede alle varie funzionalità.

		$vd->setTitolo("Home SardegnaInFood");
		$vd->setLogoFile('view/out/logo.php');
		
                $value = $_GET['page'];
		
                if(isset($value))
		{
                    if($value == 'admin')
                    {
			$value = 5;
                    }    
	
			switch ($value)
			{

				// home page visualizzata di default

			case 0:                            
				$vd->setMenuFile('view/out/menu_home_page.php'); //menu 
				$vd->setContentFile('view/out/home_page_default.php'); //home page default
				$vd->setErrorFile('view/out/error_out.php'); //specifica la presenza di eventuali errori
				$vd->setFooterFile('view/out/footer_home_page.php'); //footer
				if ((isset($_GET['logout'])) AND (isset($_SESSION['current_user']))) 
				{
                                                                        
                                    session_destroy();
				}

				break;

				// form di registrazione del cliente

			case 1:
                             session_destroy();
                             session_start();
                             
				$vd->setMenuFile('view/out/menu_back.php'); //menu del form di registrazione del cliente
				$vd->setContentFile('view/out/form_registrazione_cliente.php'); //form per la registrazione di un nuovo cliente
				$vd->setErrorFile('view/out/error_out.php');
				$vd->setFooterFile('view/out/footer_empty.php');
				break;

				// login cliente

			case 2:
				$vd->setMenuFile('view/out/menu_back.php'); //menu del form di login di un cliente
				$vd->setContentFile('view/out/login_cliente.php'); //form login cliente
				$vd->setErrorFile('view/out/error_out.php');
				$vd->setFooterFile('view/out/footer_empty.php');
				break;

				// form di registrazione dell'azienda

			case 3:
                             session_destroy();
                             session_start();
                             
				$vd->setMenuFile('view/out/menu_back.php'); //menu registrazione azienda
				$vd->setContentFile('view/out/form_registrazione_azienda_part1.php'); //form per la registrazione di una nuova azienda (parte 1 di 3)
				$vd->setErrorFile('view/out/error_out.php');
				$vd->setFooterFile('view/out/footer_empty.php');
				break;

				// login azienda

			case 4:
				$vd->setMenuFile('view/out/menu_back.php');  //menu login azienda
				$vd->setContentFile('view/out/login_azienda.php'); 
				$vd->setErrorFile('view/out/error_out.php');
				$vd->setFooterFile('view/out/footer_empty.php');
				break;

                                //login amministratore                            
                            
			case 5:
				$vd->setMenuFile('view/out/menu_back.php'); //menu amministratore
				$vd->setContentFile('view/out/login_amm.php'); //login amministratore
				$vd->setErrorFile('view/out/error_empty.php');
				$vd->setFooterFile('view/out/footer_empty.php');
				break;

			default:
				self::write404();
				break;
			}

			// richiamo la vista

			require_once 'view/Master.php';

		} 
		
	}

	/*ERRORI*/
	public static function write404()
	{
            $vd = new ViewDescriptor();
            
            $vd->setTitolo("Errore SardegnaInFood");
            $vd->setLogoFile('view/out/logo.php');
            $vd->setMenuFile('view/out/menu_back.php');
            $vd->setContentFile('view/out/errore404.php'); 
            $vd->setErrorFile('view/out/error_empty.php');
	    $vd->setFooterFile('view/out/footer_empty.php');
           
           require_once 'view/Master.php';
	}

	
}

?>