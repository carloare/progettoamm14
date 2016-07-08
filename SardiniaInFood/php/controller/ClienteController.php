<?php

//congroller del cliente


include_once '../view/ViewDescriptor.php';
include_once '../model/UtenteFactory.php';
include_once '../model/Cliente.php';
include_once '../model/Utente.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';




if(session_status()!=2) session_start();

if(isset($_REQUEST['cmd']))
    ClienteController::handleInput();


class ClienteController { 
    
//a seconda del compito da eseguire viene richiamata la funzione associata         
     public static function handleInput() 
    {
        switch($_REQUEST["cmd"])
        {
                        
 /*
* ===============================CERCA DOVE COSA===============================================
*/
  //analizza i parametri passati dal form per effettuare una ricerca


              case 'cercadovecosa': 
             
                  
            
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
      $vd->setMenuFile('../view/in/menu_cliente.php'); 
     $vd->setContentFile('../view/in/cliente/home_page_cliente.php'); //richiama la home page
     $vd->setErrorFile('../view/in/error_in.php');
    $vd->setFooterFile('../view/in/footer_empty.php'); 
				
     
     // richiamo la vista
     require_once '../view/Master.php';  
      }
      
   
      
      
      
         break;   
/*
 * ================================SHOW PROFILE AND VOTE================================================
 */                  
         //permette di entrare nel profilo dell'azienda e di, votare, inserire 
         //l'azienda nella lista dei preferiti, di inserire dei commenti
                    case "profileandvote": 
             self::showProfileAndVote();
                  break;
 /*
 * ================================BACK HOME PAGE================================================
 */                      
              //ritorna nella home page
                     case "back_home_page": 
                         //pulizia dalle vecchie ricerche
 $_SESSION['citta_cliente']=NULL;
$_SESSION['tipo_attivita_id_cliente']=NULL;
             self::ShowHomePageCliente();
                  break;
                    
   /*
 * =============================VOTA===================================================
 */                    
              //permette di votare e dare la propria preferenza a un'azienda
     case 'vota': 
                  self::vota();
                  break;               
 /*
 * ==========================INSERISCI TRA I PREFERITI======================================================
 */         
              //permette di inserire un'azienda tra le preferite
     case 'inseriscitraipreferiti': 
                  self::inserisciTraIPreferiti();
                  break;          
  /*
 * ==========================RAPPORTO QUALITA PREZZO=====================================================
 */               
              //permette dare un giudizio al rapporto qualità prezzo
       case 'rapporto_qualita_prezzo': 
                  self::rapportoQualitaPrezzo();
                  break;     
  /*
 * ============================COMMENTA====================================================
 */       
              //permette di dare una recensione, un commento o un'opinione 
              //sull'azienda
       case 'commenta': 
             
           
           
           
           
           self::commenta();
           
           
                     
                  break;     
              
              
 /*
 * ============================CANCELLA IL PROFILO DI UN CLIENTE====================================================
 */  
                 //cancella il profilo del cliente  
      case 'cancella':         
                self::cancella();
                break;               
              
   /*
 * ============================SEGNALAZIONE RECENSIONE====================================================
 */  
                 //segnala un commento inopportuno
      case 'segnalazionerecensione':         
              
          $id=$_REQUEST['id'];
        
                self::segnalazione($id);
                break;            
              
              
            
    /*
 * ============================MOSTRA I PREFERITI====================================================
 */  
                 //cancella il profilo del cliente  
      case 'show_preferiti':         
         
        
                self::showPreferiti();
                break;           
            
            
  /*
 * ============================CANCELLA PREFERITO====================================================
 */  
                 //cancella un'azienda inserita nella lista dei preferiti 
      case 'cancellapreferito':         
         
         self::deleteFavorite();
                break;  
                    
      /*
 * ============================RICERCA PREFERITO====================================================
 */  
                 //effettua una ricerca sulle aziende nella lista dei preferiti
            
          
            
          case 'ricercapreferiti':
              
 
  
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
     
          //se non ci sono errori richiama la funzione ricercaPreferiti
       
           self::ricercaPreferiti($tipo_attivita_id,$citta);
          }
      else{
          //sono presenti caratteri non validi
         
           $_SESSION['errore'] = 1;
             
             //richiama la home page
    $vd = new ViewDescriptor();
  
     $vd->setTitolo("Benvenuto in SardiniaInFood");
     $vd->setLogoFile('../view/in/logo.php');
      $vd->setMenuFile('../view/in/menu_cliente.php'); 
     $vd->setContentFile('../view/in/cliente/show_favorites.php'); //richiama alla pagine dei preferiti
     $vd->setErrorFile('../view/in/error_in.php');
    $vd->setFooterFile('../view/in/footer_empty.php'); 
				
     
     // richiamo la vista
     require_once '../view/Master.php';  
      }
  
  

                break;        
                      
      /*            
    
 * ============================INDIETRO====================================================
 */  
       //ritorna alla home page dopo essere entrato in un profilo      
            case 'indietro':
                 self::ShowHomePageCliente();
                 break;    
            
            
            
            
          /*   
             case 'paginazionerecensioni':
                 if(isset($_POST['page']))
                 {
                     $page=$_POST['page'];
                 }
 else {$page=1;}
                 self::paginazioneRecensioni($page);
                 break;
            
            */
                }
                }
                
            /*    public static function paginazioneRecensioni($page)
		{
                    UtenteFactory::paginazioneRecensioni($page);
		}
            */
                
                
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
                   //pulizia
                        $_SESSION['risultati_cliente']='ZERO'; 
              $_SESSION['citta_cliente']=NULL;
             $_SESSION['tipo_attivita_id_cliente']=NULL;
               }      
    
               //se $errore==0 non sono passato per il caso non valido
               if($errore==0)
               { 
                 //parametri arrivati correttamente
                   $_SESSION['citta_cliente']= $citta;
                   $_SESSION['tipo_attivita_id_cliente']=$tipo_attivita_id;
   
  
                 
//funzione che ricerca in un certo luogo una certa categoria di aziende
$risultati = UtenteFactory::cercaDoveCosa($citta, $tipo_attivita_id);


if($risultati!='ZERO')
{
    //passaggio dei risultati ottenuti
$_SESSION['risultati_cliente']=  $risultati;
    

}
else
{
   //errore nessun risultato trovato
    $_SESSION['errore']=3;
    //pulizia
     $_SESSION['risultati_cliente']='ZERO';
   $_SESSION['citta_cliente']=NULL; 
   $_SESSION['tipo_attivita_id_cliente']=NULL;
   
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
     
    
                //ritorna alla home page del cliente
     public static function ShowHomePageCliente()
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
                
     /*
* ================================VOTA==============================================
*/                  
                   
                
                //permette di votare 
   public static function vota() 
   { 
         
       UtenteFactory::vota();
 
   } 
                
          /*
* ==============================INSERISCI TRA I PREFERITI=========================================
*/              
                
    //permette di inserire l'azienda tra i preferiti
  public static function inserisciTraIPreferiti() 
   {
     
     UtenteFactory::inserisciTraIPreferiti();

  }            
         /*
* ==========================RAPPORTO QUALITA PREZZO==================================
*/               
          //permette di esprimere un voto sul rapporto qualità prezzo
   public static function rapportoQualitaPrezzo() 
   { 
         
       UtenteFactory::rapportoQualitaPrezzo();
 
   }  
   
       /*
* =============================COMMENTA=========================================
*/    
    //permette di inserire una recensione o commento
   public static function commenta() 
   { 
         
       UtenteFactory::commenta();
 
   }                
     /*
* =============================CANCELLA IL PROFILO DI UN CLIENTE========================================
*/    
   //permette di cancellare il profilo il profilo di un cliente
                public static function cancella()
    {

    $delete_id = $_SESSION['current_user']->getId();

   
    UtenteFactory::cancellaCliente($delete_id);
    
    }
    
   /*
* =============================SEGNALA========================================
*/    
   //segnala un commento inappropriato
                public static function segnalazione($id)
    {

    UtenteFactory::segnalazione($id);
    
    }  
    
    
    
     /*
* ================================MOSTRA PREFERITI==============================================
*/                  
     
    
                //mostra le aziende inserite nella lista dei preferiti
     public static function showPreferiti()
    {
         
         
         $vd = new ViewDescriptor();
       $vd->setTitolo("SardiniaInFood: Profilo");
       $vd->setLogoFile("../view/in/logo.php");  
       $vd->setMenuFile("../view/in/menu_cliente.php");
       $vd->setContentFile("../view/in/cliente/show_favorites.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
         
         
    }
     
       /*
* ================================CANCELLA PREFERITI==============================================
*/                    
    
    
     //permette di cancellare un'azienda inserita nella lista dei preferiti
   public static function deleteFavorite() 
   {
      
       UtenteFactory::deleteFavorite();
      
  }
  
         /*
* ================================RICERCA TRA  PREFERITI==============================================
*/    

                      
  
    //permette di fare una ricerca tra le aziende della lista dei preferiti
   public static function ricercaPreferiti($tipo_attivita_id,$citta) 
   {
     
       
           //flag per controllare la presenza di errori
          $errore=0;
         
          
          
  //le possibili combinazioni citta / tipo attivita sono

           // citta=='UNDEFINE' / tipo_attivita_id == -1  => CASO NON VALIDO
           // citta=='stringa' / tipo_attivita_id == -1 => CASO VALIDO
           // citta=='UNDEFINE' / tipo_attivita_id >= 1 => CASO VALIDO
           // citta=='stringa' / tipo_attivita_id >= 1 => CASO VALIDO        
          
    
          
         //caso in cui non inserisco nulla
         if($citta=='UNDEFINE' AND $tipo_attivita_id==-1)
             {
             
                   $_SESSION['errore']=4;
                   $errore++;
                   //pulizia
                    $_SESSION['risultati_cliente_preferiti']=NULL; 
                    $_SESSION['tipo_attivita_id_preferiti']=NULL;
  $_SESSION['citta_preferiti']=NULL;
               }      
    
               //se $errore==0 non sono passato per il caso non valido
               if($errore==0)
               { 
                

                 
//funzione che ricerca in un certo luogo una certa categoria di aziende
$aziende_preferite = UtenteFactory::cercaAziendePreferite($tipo_attivita_id, $citta);


if($aziende_preferite!='ZERO')
{
    //passaggio dei risultati ottenuti
$_SESSION['risultati_cliente_preferiti']=$aziende_preferite;
    


}
else
{
   //errore nessun risultato trovato
    $_SESSION['errore']=3;
    //pulizia
    $_SESSION['risultati_cliente_preferiti']='ZERO';
    
  $_SESSION['tipo_attivita_id_preferiti']=NULL;
  $_SESSION['citta_preferiti']=NULL;
               }      

}
     
      
      //in qualunque caso richiamo la home page
    $vd = new ViewDescriptor();
     
     $vd->setTitolo("Benvenuto in SardiniaInFood");
   
   $vd->setLogoFile('../view/in/logo.php');
     $vd->setMenuFile('../view/in/menu_cliente.php');
     $vd->setContentFile('../view/in/cliente/show_favorites.php');
     $vd->setErrorFile('../view/in/error_in.php');
     $vd->setFooterFile('../view/in/footer_empty.php');   
     
     // richiamo la vista
     require_once '../view/Master.php';  
      
      
      
      
      
  }
}
?>
