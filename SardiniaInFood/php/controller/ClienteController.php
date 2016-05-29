<?php

//Pagina che gestisce l'input dell'utente loggato


include_once '../view/ViewDescriptor.php';
include_once '../model/UtenteFactory.php';
include_once '../model/Cliente.php';
include_once '../model/Utente.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';


//include_once '/FoodAdvisor/php/Settings.php';

if(session_status()!=2)
            session_start();

if(isset($_REQUEST['cmd']))
    ClienteController::handleInput();


class ClienteController { 
    
//A seconda del compito da eseguire viene richiamata la funzione associata         
     public static function handleInput() 
    {
        switch($_REQUEST["cmd"])
        {
                        
 /*
* ===============================CERCA DOVE COSA===============================================
*/
  //Analizza i parametri passati dal form per effettuare una ricerca


              case 'ricerca': 
             
                  
            
                   //flag per controllare la presenza di errori
                   $errore = 0;
                  //espressione regolare 
                 define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
         
                 //parametri inseriti nel form di ricerca
           $city_request = $_REQUEST['citta'];
           //'pulizia' del parametro city
           $city = trim($city_request);
           
           $tipo_attivita_id = $_REQUEST['tipo_attivita_id'];
           
             //per semplicità se il parametro city è uguale a 'Dove',
           //che significa che l'utente non ha inserito nulla nel campo form 'citta',
           //oppure è uguale a '', che significa che l'utente
           //ha lasciato uno spazio bianco nel campo form 'citta', allora viene considerato
           //UNDEFINE
           
           if($city=="Dove" || $city=="")
           {
               $citta='UNDEFINE';
           }
           //in caso contrario si va a controllare il contenuto di city
           //affinchè rispetti l'espressione regolare
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
          
           $_SESSION['errore'] = 1;
             
             //richiama la home page
    $vd = new ViewDescriptor();
  
     $vd->setTitolo("Benvenuto in SardiniaInFood");
     $vd->setLogoFile('../view/in/logo.php');
      $vd->setMenuFile('../view/out/menu_cliente.php'); 
     $vd->setContentFile('../view/in/cliente/home_page_cliente.php'); //richiama la home page
     $vd->setErrorFile('../view/in/error_in.php');
    $vd->setFooterFile('../view/in/footer_home_page.php'); 
				
     
     // richiamo la vista
     require_once '../view/Master.php';  
      }
      
   
      
      
      
         break;   
/*
 * ================================================================================
 */                     
                    case "profileandvote": 
             self::showProfileAndVote();
                  break;
                    
                     case "back_home_page": 
             self::ShowHomePage();
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
                
                
                
   /*
* ===============================CERCA DOVE COSA===============================================
*/        
    //l'utente può ricercare un certo tipo di azienda in un certo luogo
     public static function cercaDoveCosa($citta, $tipo_attivita_id)
    {
          
         //flag per controllare la presenza di errori
          $errore=0;
         
          
          
  //le possibili combinazioni citta / tipo attivita sono

           // citta=='UNDEFINE' / tipo_attivita_id == -1  => CASO NON VALIDO
           // citta=='stringa' / tipo_attivita_id == -1 => CASO VALIDO
           // citta=='UNDEFINE' / tipo_attivita_id >= 1 => CASO VALIDO
           // citta=='stringa' / tipo_attivita_id >= 1 => CASO VALIDO        
          
    
          
         //verifica che non ci si trovi nel caso non valido
         if($citta=='UNDEFINE' AND $tipo_attivita_id==-1)
             {
                   $_SESSION['errore']=2;
                   $errore++;
               }      
    
               //se $errore==0 non sono passato per il caso non valido
               if($errore==0)
               { 
                 
  
                 
//funzione che ricerca in un certo luogo una certa categoria di aziende
$risultati = UtenteFactory::cercaDoveCosa($citta, $tipo_attivita_id);


if($risultati!='ZERO')
{
    //passaggio dei risultati ottenuti
$_SESSION['risultati_cliente']=  serialize($risultati);
    
}
else
{
   //errore nessun risultato trovato
    $_SESSION['errore']=3;
    
    //in qualunque caso richiamo la home page
    $vd = new ViewDescriptor();
     
     $vd->setTitolo("Benvenuto in SardiniaInFood");
    
     $vd->setLogoFile('../view/in/logo.php');
     $vd->setMenuFile('../view/in/menu_cliente.php');
     $vd->setContentFile('../view/in/cliente/home_page_cliente.php');
     $vd->setErrorFile('../view/in/error_in.php');
     $vd->setFooterFile('../view/in/footer_empty.php');   
     
     // richiamo la vista
     require_once '../view/Master.php';  
}
     
         }

 //in qualunque caso richiamo la home page
    $vd = new ViewDescriptor();
     
     $vd->setTitolo("Benvenuto in SardiniaInFood");
   
   $vd->setLogoFile('../view/in/logo.php');
     $vd->setMenuFile('../view/in/menu_cliente.php');
     $vd->setContentFile('../view/in/cliente/home_page_cliente.php');
     $vd->setErrorFile('../view/in/error_in.php');
     $vd->setFooterFile('../view/in/footer_empty.php');   
     
     // richiamo la vista
     require_once '../view/Master.php';  
     
      
    }
    
 /*
* ==============================SHOW PROFILE AND VOTE================================================
*/                  
                
                  //mostra il profilo dell"azienda selezionata
     public static function showProfileAndVote()
    {
         
         
         $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_cliente.php");
       $vd->setContentFile("../view/in/cliente/show_profile_and_vote.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
         
         
    }
                
    /*
* ================================MOSTRA HOME PAGE==============================================
*/                  
     
    
                //ritorna alla home page
     public static function ShowHomePage()
    {
         
         
         $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_cliente.php");
       $vd->setContentFile("../view/in/cliente/home_page_cliente.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
         
         
    }
                
                
                
                
                
                
                
                
                
                
                
}
?>
