<?php
//controller dell'amministratore
include_once '../view/ViewDescriptor.php';
include_once '../model/UtenteFactory.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';

if (session_status() != 2)
    session_start();

if (isset($_REQUEST['cmd']))
    AmministratoreController::handleInput();

class AmministratoreController
{
    //a seconda del compito da eseguire viene richiamata la funzione associata         
    public static function handleInput()
    {
        switch ($_REQUEST["cmd"]) {
            //moderazione clienti  
            case 'mod':
                self::moderazione();
                break;
            //mostra la home page
            case 'home':
                self::showHomePageAmministratore();
                break;
            //mostra segnalazioni
            case 'showsegnalazioni':
                self::moderazione();
                break;
            //richiama il cliente che ha scritto la recensione
            case 'richiama':
                self::richiama();
                break;
            //banna il cliente che ha scritto la recensione
            case 'banna':
                self::banna();
                break;
            //falsa segnalazione
            case 'falsa_segnalazione':
                self::falsa_segnalazione();
                break;
        }
    }
    
    
    
/* MODERAZIONE
========================================================================== */
    //pagina dove è possibile fare una moderazione delle recensioni segnalate come 'offensive'
    public static function moderazione()
    {
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood");
        $vd->setLogoFile("../view/in/amministratore/logo.php");
        $vd->setMenuFile("../view/in/amministratore/menu_mod_amministratore.php");
        $vd->setErrorFile("../view/in/amministratore/error_amministratore.php");
        $vd->setContentFile("../view/in/amministratore/mod_amministratore.php");
        $vd->setFooterFile("../view/in/amministratore/footer_empty.php");
       
        require_once "../view/Master.php";
    }
    
    
    
/* SHOW HOME PAGE AMMINISTRATORE
========================================================================== */
    //home page dell'amministratore
    public static function showHomePageAmministratore()
    {
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood");
        $vd->setLogoFile("../view/in/amministratore/logo.php");
        $vd->setMenuFile("../view/in/amministratore/menu_home_amministratore.php");
        $vd->setErrorFile("../view/in/amministratore/error_amministratore.php");
        $vd->setContentFile("../view/in/amministratore/home_page_amministratore.php");
        $vd->setFooterFile("../view/in/amministratore/footer_empty.php");
     
        require_once "../view/Master.php";
    }
    
    
/* RICHIAMA
========================================================================== */
    //effettua un richjiamo
    public static function richiama()
    {
        echo 'ciao';
        $id_recensione = $_REQUEST['id_recensione'];
      
        $id_cliente = UtenteFactory::cercaAutoreRecensione($id_recensione);
        
        UtenteFactory::richiama($id_cliente);
        
        UtenteFactory::cancellaRecensione($id_recensione);
    }

    
  
/* BANNA
========================================================================== */
    //banna direttamente un cliente
    public static function banna()
    {
        $id_cliente = $_REQUEST['id_cliente'];
        
        UtenteFactory::banna($id_cliente);
    }

    
    
/* FALSA SEGNALAZIONE
========================================================================== */
    //gestisce il caso in cui il messaggio è stato segnalato ma questo non risulta essere 'offensivo'
    public static function falsa_segnalazione()
    {
        $id_recensione = $_REQUEST['id_recensione'];

        $id_cliente = UtenteFactory::cercaAutoreRecensione($id_recensione);
        
        UtenteFactory::cancellaSegnalazione($id_recensione);
        
        UtenteFactory::resetSegnalato($id_recensione);
    }
}
?>
