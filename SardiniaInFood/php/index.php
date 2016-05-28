<?php
/*
* Classe che controlla il punto di accesso dell'applicazione
*/
include_once 'view/ViewDescriptor.php';

// punto unico di accesso

FrontController::start();

class FrontController

	{
	public static function start()
		{
		if (session_status() != 2) session_start();

		// caricamento pagina

		$vd = new ViewDescriptor();

		// durante il primo ingresso all'applicazioine ricevo da index.html il parametro
		// page = 0, per cui viene mandato in esecuzione dallo switch l'home page
		// di default. Da qui si può accedere alle varie funzionalità.

		$vd->setTitolo("Benvenuto in SardiniaInFood");
		$vd->setLogoFile('view/out/logo.php');
		$value = $_GET['page'];
		if (isset($value))
			{
			switch ($value)
				{

				// home page visualizzata di default

			case 0:
				$vd->setErrorFile('view/out/error_out.php'); //specifica la presenza di eventuali errori
				$vd->setMenuFile('view/out/menu_home_page.php'); //bottoni della home page
				$vd->setContentFile('view/out/home_page_default.php'); //nella home è presente il fom di ricerca
				$vd->setFooterFile('view/out/footer_home_page.php'); //altri bottoni della home page
				if (isset($GET['logout']))
					{
					session_destroy();
					}

				break;

				// form di registrazione del cliente

			case 1:
				$vd->setErrorFile('view/out/error_out.php'); //specifica la presenza di eventuali errori
				$vd->setMenuFile('view/out/menu_back.php'); //bottone per tornare nella home
				$vd->setContentFile('view/out/form_registrazione_cliente.php'); //form per la registrazione di un nuovo cliente
				$vd->setFooterFile('view/out/footer_empty.php'); //footer vuoto
				break;

				// login cliente

			case 2:
				$vd->setErrorFile('view/out/error_out.php'); //specifica la presenza di eventuali errori
				$vd->setMenuFile('view/out/menu_back.php'); //bottone per tornare nella home
				$vd->setContentFile('view/out/login_cliente.php'); //login cliente
				$vd->setFooterFile('view/out/footer_empty.php'); //footer vuoto
				break;

				// form di registrazione del cliente

			case 3:
				$vd->setErrorFile('view/out/error_out.php'); //specifica la presenza di eventuali errori
				$vd->setMenuFile('view/out/menu_back.php'); //bottone per tornare nella home
				$vd->setContentFile('view/out/form_registrazione_azienda.php'); //form per la registrazione di una nuova azienda
				$vd->setFooterFile('view/out/footer_empty.php'); //footer vuoto
				break;

				// login azienda

			case 4:
                               
				$vd->setErrorFile('view/out/error_out.php'); //specifica la presenza di eventuali errori
				$vd->setMenuFile('view/out/menu_back.php'); //bottone per tornare nella home
				$vd->setContentFile('view/out/login_azienda.php'); //login azienda
				$vd->setFooterFile('view/out/footer_empty.php'); //footer vuoto
				break;


			default:
				self::write404();
				break;
				}

			// richiamo la vista

			require_once 'view/Master.php';

			}
		  else
			{
			self::write404();
			}
		}

/*ERRORI*/
	public static function write404()
		{
		}


	public static function write403()
		{
		}
	}

?>
