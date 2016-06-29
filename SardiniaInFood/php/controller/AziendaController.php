<?php

//controller dell'azienda


include_once '../view/ViewDescriptor.php';
include_once '../model/UtenteFactory.php';
include_once '../model/Azienda.php';
include_once '../model/Utente.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';


if(session_status()!=2)
            session_start();

if(isset($_REQUEST['cmd']))
    AziendaController::handleInput();


class AziendaController{ 
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
       $vd->setMenuFile("../view/in/menu_azienda.php");
       $vd->setContentFile("../view/in/azienda/pagina_modifica.php");
       $vd->setErrorFile("../view/in/error_in.php"); 
       $vd->setFooterFile("../view/in/footer_empty.php");
     
        // richiamo la vista
        require_once "../view/Master.php"; 
    }
      /*
* =============================MODIFICA IL PROFILO DELL'AZIENDA========================================
*/    
   //permette di cancellare il profilo il profilo di un'azienda
    /*
    public static function modifica() {   
    
    define("nickname_regexpr", "/^[A-Za-z0-9 ]{3,20}$/");
            define("email_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");   
            define("password_regexpr", "/^[a-zA-Z0-9]+$/"); 
            define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
            define("indirizzo_regexpr", "/^[a-zA-Z0-9\s,'-]*$/");   
            define("telefono_regexpr", "/^[0-9]{5,15}$/"); 
            define("sitoweb_regexpr", "/^((?:http(?:s)?\:\/\/)?[a-zA-Z0-9_-]+(?:.[a-zA-Z0-9_-]+)*.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$/");
            define("descrizione_regexpr", "/^[A-Za-z0-9., \xE0\xE8\xE9\xEC\xF2\xF9]{1,150}$/");
            
           $utente = $_SESSION['current_user'];    
               
            $nick = $_REQUEST['nickname'];
            $mail = $_REQUEST['email'];
            $pass = $_REQUEST['password'];
            $city = $_REQUEST['citta'];
            $address = $_REQUEST['indirizzo'];
            $phone = $_REQUEST['telefono'];
            $web = $_REQUEST['sitoweb'];
            $desc = $_REQUEST['descrizione'];
            $type = $_REQUEST['tipo_attivita_id'];
              
  
            $id_azienda = $_REQUEST['id_azienda'];
            



  if($nick!="") {
                    
                    if( 1 === preg_match(nickname_regexpr, $nick)){
                        
                    $nickname = self::test_input($nick);
                    $utente->setNickname($nickname);     
        
                } else {  
                    $SESSION['nickmod'] = '<br>Il nickname contiene caratteri non validi';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['nickmod'] = '<br>Il campo nickname &egrave; vuoto';
                    $error_rec++;
                }        
                
                
              if($mail!="") {
                    
                    if( 1 === preg_match(email_regexpr, $mail)){
            
                    
                    $email = self::test_input($mail);
                    
                    
                    $utente->setEmail($email);     
        
                } else {     
                    $SESSION['mailmod'] = '<br>L\'email non &egrave; valido. email@esempio.com';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['mailmod'] = '<br>Il campo email &egrave; vuoto';
                    $error_rec++;
                }      
                
                
                if($pass!="") {
                    
                    if( 1 === preg_match(password_regexpr, $pass)){
            
                    
                    $password = self::test_input($pass);
                    
                    
                    $utente->setPassword($password);     
        
                } else {       
                    $SESSION['passmod'] = '<br>La password non &egrave; valido.';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['passmod'] = '<br>Il campo password &egrave; vuoto';
                    $error_rec++;
                }      
                

              if($city!="") {
                    
                    if( 1 === preg_match(citta_regexpr, $city)){
            
                    
                    $citta = self::test_input($city);
                    
                    
                    $utente->setCitta($citta);     
        
                } else {       
                    $SESSION['citymod'] = '<br>Il nome della citt&agrave; non &egrave; valido.';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['citymod'] = '<br>Il campo citt&agrave; &egrave; vuoto';
                    $error_rec++;
                }                     
                
                
                
               if($address!="") {
                    
                    if( 1 === preg_match(indirizzo_regexpr, $address)){
            
                    
                    $indirizzo = self::test_input($address);
                    
                    
                    $utente->setIndirizzo($indirizzo);     
        
                } else {         
                    $SESSION['addressmod'] = '<br>L\'indirizzo non &egrave; valido.';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['addressmod'] = '<br>Il campo indirizzo &egrave; vuoto';
                    $error_rec++;
                }     
                
                
                
                 if($phone!="") {
                    
                    if( 1 === preg_match(telefono_regexpr, $phone)){
            
                    
                    $telefono = self::test_input($phone);
                    
                    
                    $utente->setTelefono($telefono);     
        
                } else {        
                    $SESSION['phonemod'] = '<br>Il telefono non &egrave; valido. <br> Inserire il numero senza spazi o caratteri speciali.';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['phonemod'] = '<br>Il campo telefono &egrave; vuoto';
                    $error_rec++;
                }  
                
                
                 if($web!="") {
                    
                    if( 1 === preg_match(sitoweb_regexpr, $web)){
            
                    
                    $sitoweb = self::test_input($web);
                    
                    
                    $utente->setSitoWeb($sitoweb);     
        
                } else {        
                    $SESSION['sitowebmod'] = '<br>Il sito web non &egrave; valido.';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['sitowebmod'] = '<br>Il campo sitoweb &egrave; vuoto';
                    $error_rec++;
                }  
                
                
                
                
                  if($desc!="") {
                    
                    if( 1 === preg_match(descrizione_regexpr, $desc)){
            
                    
                    $descrizione = self::test_input($desc); 
                    $utente->setDescrizione($descrizione);     
        
                } else {      
                     $SESSION['descmod'] = '<br>La descrizione non &egrave; contiene caratteri non validi.';
                    $error_rec++; 
                } 
                
                } else { 
                    $SESSION['descmod'] = '<br>Il campo descrizione &egrave; vuoto';
                    $error_rec++;
                }  
     
  
                
$update = UtenteFactory::modifica($id_azienda);

            if($update =='INSUCCESSO')
            {
                $_SESSION['errore'] = 2;
            }
            elseif($update =='SUCCESSO')
            {
                $_SESSION['errore'] = 1;
            }
            
            
    
    $vd = new ViewDescriptor();
    
        $vd->setLogoFile('../view/in/logo.php');
        $vd->setMenuFile('../view/in/menu_logout_azienda.php');
        $vd->setErrorFile('../view/in/error_in.php');
        $vd->setContentFile('../view/in/azienda/home_page_azienda.php');
        $vd->setFooterFile('../view/in/footer_empty.php');
                      
        // richiamo la vista
        require_once '../view/Master.php';       
    
}

    
    
    
    
    
    */

}

?>
