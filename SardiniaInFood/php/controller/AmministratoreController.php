<?php

//controller dell'azienda


include_once '../view/ViewDescriptor.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';






if(session_status()!=2) session_start();

if(isset($_REQUEST['cmd'])) 
    AmministratoreController::handleInput();
 

class AmministratoreController { 
    //A seconda del compito da eseguire viene richiamata la funzione associata         
     public static function handleInput() 
    {
        switch($_REQUEST["cmd"])
        {
             //moderazione clienti  
      case 'mod':         
                self::moderazione();
                break;   
      case 'home':         
                self::showHomePageAmministratore();
                break;          
           

        }
    }    
   
    
        /*
* =============================MODERAZIONE========================================
*/    
   //pagina dove è possibile fare una moderazione dei clienti se sono stati 
    //'incolpati' di aver inserito messaggi non appropriati
    
    public static function moderazione() {
    
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood");
        $vd->setLogoFile("../view/in/amministratore/logo.php");
        $vd->setMenuFile("../view/in/amministratore/menu_mod_amministratore.php");
        $vd->setErrorFile("../view/in/amministratore/error_amministratore.php");
	$vd->setContentFile("../view/in/amministratore/mod_amministratore.php");
	$vd->setFooterFile("../view/in/amministratore/footer_empty.php");
			

		// richiamo la vista

		require_once "../view/Master.php";
    }
     
    
 /*
* =============================HOME page========================================
*/    
   //pagina dove è possibile fare una moderazione dei clienti se sono stati 
    //'incolpati' di aver inserito messaggi non appropriati
    
    public static function showHomePageAmministratore() {
    
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood");
			$vd->setLogoFile("../view/in/amministratore/logo.php");
			$vd->setMenuFile("../view/in/amministratore/menu_home_amministratore.php");
			$vd->setErrorFile("../view/in/amministratore/error_amministratore.php");
			$vd->setContentFile("../view/in/amministratore/home_page_amministratore.php");
			$vd->setFooterFile("../view/in/amministratore/footer_empty.php");
			

		// richiamo la vista

		require_once "../view/Master.php";
    }    
   
    
  


}

?>
