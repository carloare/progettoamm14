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
				$vd->setErrorFile('view/out/error_out.php');
				$vd->setMenuFile('view/out/menu_home_page.php');
				$vd->setContentFile('view/out/home_page_default.php');
				$vd->setFooterFile('view/out/footer_home_page.php');
				if (isset($GET['logout']))
					{
					session_destroy();
					}

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

	/*
	 * Errori     
        */

	public static

	function write404()
		{
		}


	public static function write403()
		{
		}
	}

?>
