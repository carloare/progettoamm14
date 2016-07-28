<?php
//controller del cliente
include_once '../view/ViewDescriptor.php';
include_once '../model/UtenteFactory.php';
include_once '../model/Cliente.php';
include_once '../model/Utente.php';
include_once '/home/amm/development/SardiniaInFood/php/Settings.php';

if (session_status() != 2)
    session_start();

if (isset($_REQUEST['cmd']))
    ClienteController::handleInput();

class ClienteController
{
    //a seconda del compito da eseguire viene richiamata la funzione associata         
    public static function handleInput()
    {
        switch ($_REQUEST["cmd"]) {
                   
            
/* CERCA DOVE-COSA
========================================================================== */
            //analizza i parametri passati dal form per effettuare una ricerca
            case 'cercadovecosa':
                //flag per controllare la presenza di errori
                $errore = 0;
                //espressione regolare 
                define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
                //parametri inseriti nel form di ricerca
                $citta_request    = $_REQUEST['citta'];
                //'pulizia'
                $citta = trim($citta_request);
                $tipo_attivita_id = $_REQUEST['tipo_attivita_id'];
                //gestione di $citta:
                //se $citta è uguale a "Dove": l'utente non ha inserito nulla nel campo form "citta"
                //se $citta è uguale a "": l'utente ha lasciato uno spazio bianco nel campo form "citta"
                //in questi due casi $citta viene considerato UNDEFINE
                if ($citta == "Dove" || strlen($citta) == 0) {
                    $citta = 'UNDEFINE';
                }
                //in caso contrario si va a controllare il contenuto di $citta
                //affinchè rispetti l'espressione regolare
                else {
                    if (!(1 === preg_match(citta_regexpr, $citta))) {
                        $errore++;
                    }
                }
                //se non ci sono errori      
                if ($errore == 0) {
                    //richiama la funzione cercaDoveCosa
                    self::cercaDoveCosa($citta, $tipo_attivita_id);
                } else {
                    //sono presenti caratteri non validi
                    $_SESSION['errore'] = 1;
                    //richiama la home page
                    $vd  = new ViewDescriptor();
                    $vd->setTitolo("Benvenuto in SardiniaInFood");
                    $vd->setLogoFile('../view/in/logo.php');
                    $vd->setMenuFile('../view/in/menu_home_cliente.php');
                    $vd->setContentFile('../view/in/cliente/home_page_cliente.php');
                    $vd->setErrorFile('../view/in/error_in.php');
                    $vd->setFooterFile('../view/in/footer_home_clienti.php');
                
                    require_once '../view/Master.php';
                }
                break;
                
                
/* SHOW PROFILE AND VOTE
========================================================================== */
            //permette di entrare nel profilo dell'azienda e di votare, inserire 
            //l'azienda nella lista dei preferiti, di inserire dei commenti
            case "profileandvote":
                self::showProfileAndVote();
                break;
                
                
/* VOTA
========================================================================== */
            //permette di dare il proprio voto a un'azienda
            case 'vota':
                self::vota();
                break;
            
            
            
/* INSERISCI TRA I PREFERITI
========================================================================== */
            //permette di inserire un'azienda tra le preferite
            case 'inseriscitraipreferiti':
                self::inserisciTraIPreferiti();
                break;

            
/* RAPPOPRTO QUALITA - PREZZO
========================================================================== */
            //permette dare un giudizio al rapporto qualità prezzo
            case 'rapporto_qualita_prezzo':
                self::rapportoQualitaPrezzo();
                break;

            
/* COMMENTA
========================================================================== */
            //permette di dare una recensione, un commento o un'opinione 
            //sull'azienda
            case 'commenta':
                self::commenta();
                break;

            
            
/* CANCELLA UN PROFILO DI UN CLIENTE
========================================================================== */
            //cancella il profilo del cliente  
            case 'cancella':
                self::cancella();
                break;

            
            
/* SEGNALAZIONE RECENSIONE
========================================================================== */
            //segnala un commento inopportuno
            case 'segnalazionerecensione':
                self::segnalazione();
                break;

            
 /* SHOW PREFERITI
========================================================================== */
            //cancella il profilo del cliente  
            case 'show_preferiti':
                self::showPreferiti();
                break;

            
/* CAMCELLA PREFERITO
========================================================================== */
            //cancella un'azienda inserita nella lista dei preferiti 
            case 'cancellapreferito':
                self::deleteFavorite();
                break;

            
            
/* RICERCA PREFERITO
========================================================================== */
            //effettua una ricerca sulle aziende nella lista dei preferiti
            case 'ricercapreferiti':
                //flag per controllare la presenza di errori
                $errore = 0;
                //espressione regolare 
                define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
                //parametri inseriti nel form di ricerca
                $citta_request    = $_REQUEST['citta_preferiti'];
                //'pulizia' del parametro city
                $citta = trim($citta_request);
                $tipo_attivita_id = $_REQUEST['tipo_attivita_id_preferiti'];
                //gestione di $citta:
                //se $citta è uguale a "Dove": l'utente non ha inserito nulla nel campo form "citta"
                //se $citta è uguale a "": l'utente ha lasciato uno spazio bianco nel campo form "citta"
                //in questi due casi $citta viene considerato UNDEFINE
                if ($citta == "Dove" || strlen($citta) == 0) {
                    $citta = 'UNDEFINE';
                }
                //in caso contrario si va a controllare il contenuto di $citta
                //affinchè rispetti l'espressione regolare
                else {
                    if (!(1 === preg_match(citta_regexpr, $citta))) {
                        $errore++;
                    }
                }
                //se non ci sono errori      
                if ($errore == 0) {
                    //se non ci sono errori richiama la funzione ricercaPreferiti
                    self::ricercaPreferiti($tipo_attivita_id, $citta);
                } else {
                    //sono presenti caratteri non validi
                    $_SESSION['errore'] = 1;
                    //richiama la home page
                    $vd                 = new ViewDescriptor();
                    $vd->setTitolo("Benvenuto in SardiniaInFood");
                    $vd->setLogoFile('../view/in/logo.php');
                    $vd->setMenuFile('../view/in/menu_favorites_cliente.php');
                    $vd->setContentFile('../view/in/cliente/mostra_preferiti.php'); //richiama alla pagine dei preferiti
                    $vd->setErrorFile('../view/in/error_in.php');
                    $vd->setFooterFile('../view/in/footer_empty.php');
                  
                    require_once '../view/Master.php';
                }
                break;
                
                
/* INDIETRO
========================================================================== */
            //ritorna alla home page dopo essere entrato in un profilo      
            case 'indietro':
                self::showHomePageCliente();
                break;

            
/* INDIETRO ALLA HOME PACE (CANCELLA SESSIONE)
========================================================================== */
            //ritorna alla home page dopo essere entrato in un profilo      
            case 'back_clear_home_page':
             
                if (isset($_SESSION['risultati_cliente'])) {
                    unset($_SESSION['risultati_cliente']);
                }
                if (isset($_SESSION['risultati_cliente_preferiti'])) {
                    unset($_SESSION['risultati_cliente_preferiti']);
                }
                self::showHomePageCliente();
                break;
               
        }
    }
    
    
    
/*                             FUNZIONI
========================================================================== */
    
/* CERCA DOVE - COSA
========================================================================== */    
    //l'utente può ricercare un certo tipo di azienda in un certo luogo
    public static function cercaDoveCosa($citta, $tipo_attivita_id)
    {
        //flag per controllare la presenza di errori
        $errore = 0;
        //le possibili combinazioni citta / tipo attivita sono
        // citta=='UNDEFINE' / tipo_attivita_id == -1  => CASO NON VALIDO
        // citta=='stringa' / tipo_attivita_id == -1 => CASO VALIDO
        // citta=='UNDEFINE' / tipo_attivita_id >= 1 => CASO VALIDO
        // citta=='stringa' / tipo_attivita_id >= 1 => CASO VALIDO        
        //verifica che non ci si trovi nel caso non valido
        if ($citta == 'UNDEFINE' AND $tipo_attivita_id == -1) {
            $_SESSION['errore'] = 2;
            $errore++;
            //pulizia
            unset($_SESSION['risultati_cliente']);
        }
        //se $errore==0 non sono passato per il caso non valido
        if ($errore == 0) {
            //funzione che ricerca in un certo luogo una certa categoria di aziende
            $risultati = UtenteFactory::cercaDoveCosa($citta, $tipo_attivita_id);
            if ($risultati != 'ZERO') {
                //passaggio dei risultati ottenuti
                $_SESSION['risultati_cliente'] = $risultati;
            } else {
                //errore nessun risultato trovato
                $_SESSION['errore'] = 3;
                //pulizia
                unset($_SESSION['risultati_cliente']);
            }
        }
        //in qualunque caso richiamo la home page
        $vd = new ViewDescriptor();
        $vd->setTitolo("Benvenuto in SardiniaInFood");
        $vd->setLogoFile('../view/in/logo.php');
        $vd->setMenuFile('../view/in/menu_home_cliente.php');
        $vd->setContentFile('../view/in/cliente/home_page_cliente.php');
        $vd->setErrorFile('../view/in/error_in.php');
        $vd->setFooterFile('../view/in/footer_home_clienti.php');
    
        require_once '../view/Master.php';
    }

    
/* SHOW PROFILE AND VOTE
========================================================================== */
    //mostra il profilo dell"azienda selezionata
    public static function showProfileAndVote()
    {
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood: Profilo");
        $vd->setLogoFile("../view/in/logo.php");
        $vd->setMenuFile("../view/in/menu_mostra_profilo_e_vota_cliente.php");
        $vd->setContentFile("../view/in/cliente/mostra_profilo_e_vota.php");
        $vd->setErrorFile("../view/in/error_in.php");
        $vd->setFooterFile("../view/in/footer_empty.php");
      
        require_once "../view/Master.php";
    }

    
    
/* SHOW HOME PAGE CLIENTE
========================================================================== */
    //ritorna alla home page del cliente
    public static function ShowHomePageCliente()
    {
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood: Profilo");
        $vd->setLogoFile("../view/in/logo.php");
        $vd->setMenuFile("../view/in/menu_home_cliente.php");
        $vd->setContentFile("../view/in/cliente/home_page_cliente.php");
        $vd->setErrorFile("../view/in/error_in.php");
        $vd->setFooterFile("../view/in/footer_home_clienti.php");
     
        require_once "../view/Master.php";
    }

    
 
/* VOTA
========================================================================== */
    //permette di votare 
    public static function vota()
    {
        $voto = $_REQUEST['voto'];
        $id_azienda = $_REQUEST['id_azienda'];
        UtenteFactory::vota($voto, $id_azienda);
    }

    
    
/* INSERISCI TRA I PREFERITI
========================================================================== */
    //permette di inserire l'azienda tra i preferiti
    public static function inserisciTraIPreferiti()
    {
        $id_azienda = $_REQUEST['id_azienda'];
        UtenteFactory::inserisciTraIPreferiti($id_azienda);
    }

    
/* RAPPORTO QUALITA - PREZZO
========================================================================== */
    //permette di esprimere un voto sul rapporto qualità prezzo
    public static function rapportoQualitaPrezzo()
    {
        $voto_qp = $_REQUEST['voto_qp'];
        $id_azienda = $_REQUEST['id_azienda'];
        UtenteFactory::rapportoQualitaPrezzo($voto_qp, $id_azienda);
    }

    
    
/* COMMENTA
========================================================================== */
    //permette di inserire una recensione o commento
    public static function commenta()
    {
        $id_azienda=$_REQUEST['azienda'];
        
        $comments = htmlentities($_REQUEST['comments']);
     
        if(strlen($comments) > 0)
        {        
        UtenteFactory::commenta($comments, $id_azienda);        
        }
        //funzione che fa il fix del numero delle visualizzazioni.
        //Di norma al caricamento di 'mostra_profilo_e_vota.php' viene aggiornato il numero delle visualizzazioni dell'azienda corrispondente.
        //Ricaricando la pagina all'inserimento di un commento deve essere diminuito di 1 il numero delle visualizzazioni
        UtenteFactory::fixVisualizzazioni($id_azienda);
        
        $_SESSION['id_azienda'] = $id_azienda;
 
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood: Profilo");
        $vd->setLogoFile("../view/in/logo.php");
        $vd->setMenuFile("../view/in/menu_mostra_profilo_e_vota_cliente.php");
        $vd->setContentFile("../view/in/cliente/mostra_profilo_e_vota.php");
        $vd->setErrorFile("../view/in/error_in.php");
        $vd->setFooterFile("../view/in/footer_empty.php");
      
        require_once "../view/Master.php";
        
    }

    
    
/* CANCELLA PROFILO CLIENTE
========================================================================== */
    //permette di cancellare il profilo il profilo di un cliente
    public static function cancella()
    {
        $delete_id = $_SESSION['current_user']->getId();
        UtenteFactory::cancellaCliente($delete_id);
    }

    
 
/* SEGNALA
========================================================================== */
    //segnala un commento inappropriato
    public static function segnalazione()
    {
        $id_recensione = $_REQUEST['id'];
        UtenteFactory::segnalazione($id_recensione);
    }

    
    
/* SHOW PREFERITI
========================================================================== */
    //mostra le aziende inserite nella lista dei preferiti
    public static function showPreferiti()
    {
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood: Profilo");
        $vd->setLogoFile("../view/in/logo.php");
        $vd->setMenuFile("../view/in/menu_favorites_cliente.php");
        $vd->setContentFile("../view/in/cliente/mostra_preferiti.php");
        $vd->setErrorFile("../view/in/error_in.php");
        $vd->setFooterFile("../view/in/footer_empty.php");
 
        require_once "../view/Master.php";
    }

    
    
/* CANCELLA PREFERITI
========================================================================== */
    //permette di cancellare un'azienda inserita nella lista dei preferiti
    public static function deleteFavorite()
    {
        $id_azienda = $_REQUEST['id_azienda'];
        UtenteFactory::deleteFavorite($id_azienda);
    }

    
    
/* RICERCA PREFERITI
========================================================================== */
    //permette di fare una ricerca tra le aziende della lista dei preferiti
    public static function ricercaPreferiti($tipo_attivita_id, $citta)
    {
        //flag per controllare la presenza di errori
        $errore = 0;
        //le possibili combinazioni citta / tipo attivita sono
        // citta=='UNDEFINE' / tipo_attivita_id == -1  => CASO NON VALIDO
        // citta=='stringa' / tipo_attivita_id == -1 => CASO VALIDO
        // citta=='UNDEFINE' / tipo_attivita_id >= 1 => CASO VALIDO
        // citta=='stringa' / tipo_attivita_id >= 1 => CASO VALIDO        
        //caso in cui non inserisco nulla
        if ($citta == 'UNDEFINE' AND $tipo_attivita_id == -1) {
            $_SESSION['errore'] = 2;
            $errore++;
        }
        //se $errore==0 non sono passato per il caso non valido
        if ($errore == 0) {
            //funzione che ricerca in un certo luogo una certa categoria di aziende
            $aziende_preferite = UtenteFactory::cercaAziendePreferite($tipo_attivita_id, $citta);
            if ($aziende_preferite != 'ZERO') {
                //passaggio dei risultati ottenuti
                $_SESSION['risultati_cliente_preferiti'] = $aziende_preferite;
            } else {
                //errore nessun risultato trovato
                $_SESSION['errore']= 3;
                //pulizia
                $_SESSION['risultati_cliente_preferiti'] = 'ZERO';
            }
        }
        //in qualunque caso richiamo la home page
        $vd = new ViewDescriptor();
        $vd->setTitolo("Benvenuto in SardiniaInFood");
        $vd->setLogoFile('../view/in/logo.php');
        $vd->setMenuFile('../view/in/menu_favorites_cliente.php');
        $vd->setContentFile('../view/in/cliente/mostra_preferiti.php');
        $vd->setErrorFile('../view/in/error_in.php');
        $vd->setFooterFile('../view/in/footer_empty.php');
  
        require_once '../view/Master.php';
    }
}
?>
