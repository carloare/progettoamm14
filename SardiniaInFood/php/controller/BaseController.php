<?php
//controller utente non loggato
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/view/ViewDescriptor.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Utente.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/UtenteFactory.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Azienda.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Cliente.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/Settings.php';

if (session_status() != 2)
    session_start();

if (isset($_REQUEST['cmd']))
    BaseController::handleInput();

class BaseController
{
    //a seconda del compito da eseguire (cmd) viene richiamata la funzione corrispondente
    public static function handleInput()
    {
        switch ($_REQUEST['cmd']) {
            
            
/* REGISTRAZIONE CLIENTE
========================================================================== */
            //registra un nuovo cliente nell'applicazione
            case 'registrazione_cliente':
                //definizione delle espressioni regolari
                define("nome_completo_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");
                define("username_regexpr", "/^[A-Za-z0-9\xE0\xE8\xE9\xEC\xF2\xF9]{3,64}$/");
                define("password_regexpr", "/^[a-zA-Z0-9\xE0\xE8\xE9\xEC\xF2\xF9]+$/");
                define("email_personale_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");
                //valori inseriti dall'utente che si vuole registrare come cliente
                $name = trim($_REQUEST['nome_completo']);
                $username = trim($_REQUEST['username']);
                $pass = trim($_REQUEST['password']);
                $pass_conferma = trim($_REQUEST['password_conferma']);
                $email = trim($_REQUEST['email_personale']);
                $ruolo = $_REQUEST['ruolo'];
                
                //flag che gestiscono gli errori
                $error_rec = 0; //errori nei campi
                $error_form = 0; //errore username/password
                
                $utente = new Cliente();
                
                //imposta il ruolo a 0
                $utente->setRuolo($ruolo);
                
                //imposta il numero dei richiami a 0
                $utente->setNumeroRichiami(0);
                
                //verifica la correttezza dei valori inseriti nella compliazione del form
                if (!empty($name)) {
                    if (1 === preg_match(nome_completo_regexpr, $name)) {
                        unset($_SESSION['nome_completo_cliente']);
                        $utente->setNomeCompleto($name);
                    } else {
                        $_SESSION['nome_completo_cliente'] = "<br><div class='messaggio-errore'>Il campo 'Nome Completo' contiene caratteri non validi</div>";
                        $error_rec++;
                    }
                } else {
                    $_SESSION['nome_completo_cliente'] = "<br> <div class='messaggio-errore'>Il campo 'Nome Completo' &egrave; vuoto</div>";
                    $error_rec++;
                }
                if (!empty($email)) {
                    if (1 === preg_match(email_personale_regexpr, $email)) {
                        $valido = UtenteFactory::cercaEmail($email, 0);
                        if ($valido == 'BANNATO') {
                            //in caso di errore
                            $vd = new ViewDescriptor();
                            $vd->setTitolo("Benvenuto");
                            //si è verificato un errore (campo vuoto o caratteri non validi) nel form di registrazione
                            $_SESSION['errore'] = 7;
                            $vd->setLogoFile("../view/out/logo.php");
                            $vd->setMenuFile('../view/out/menu_home_page.php'); //menu 
                            $vd->setContentFile('../view/out/home_page_default.php'); //home page default
                            $vd->setErrorFile('../view/out/error_out.php'); //specifica la presenza di eventuali errori
                            $vd->setFooterFile('../view/out/footer_home_page.php'); //footer
                           
                            require_once '../view/Master.php';
                        }
                        if ($valido == 'SI') {
                            unset($_SESSION['email_cliente']);
                            $utente->setEmailPersonale($email);
                        } else {
                            $_SESSION['email_cliente'] = "<div class='messaggio-errore'>Questa email &egrave; gi&agrave; stato utilizzata</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['email_cliente'] = "<div class='messaggio-errore'>Questo indirizzo email non &egrave; valido<br>Esempio di email valida: email@esempio.com</div>";
                        $error_rec++;
                    }
                } else {
                    $_SESSION['email_cliente'] = "<div class='messaggio-errore'>Il campo 'Email' &egrave; vuoto</div>";
                    $error_rec++;
                }
                if (!empty($username)) {
                    if (1 === preg_match(username_regexpr, $username)) {
                        $valido = UtenteFactory::cercaUsername($username, 0); //non sono ammessi username uguali
                        if ($valido == 'SI') {
                            unset($_SESSION['username_cliente']);
                            $utente->setUsername($username);
                        } else {
                            $_SESSION['username_cliente'] = "<div class='messaggio-errore'>Username non valido</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['username_cliente'] = "<div class='messaggio-errore'>Il campo username contiene caratteri non validi</div>";
                        $error_rec++;
                    }
                } else {
                    $_SESSION['username_cliente'] = "<div class='messaggio-errore'>Il campo 'Username' &egrave; vuoto</div>";
                    $error_rec++;
                }
                if (!empty($pass)) {
                    if ($pass == $pass_conferma) {
                        if (1 === preg_match(password_regexpr, $pass)) {
                            unset($_SESSION['password_cliente']);
                            $utente->setPassword($pass);
                        } else {
                            $_SESSION['password_cliente'] = "<div class='messaggio-errore'>Il campo password non &egrave; valido</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['password_cliente'] = "<div class='messaggio-errore'>Errore nell'inserimento della password</div>";
                        $error_rec++;
                    }
                } else {
                    $_SESSION['password_cliente'] = "<div class='messaggio-errore'>Il campo 'Password' &egrave; vuoto</div>";
                    $error_rec++;
                }
                //nessun cliente può registrarsi con nome uguale a 'Username' e password uguale a 'Password'                    
                if ($username == 'Username' AND $pass == 'Password') { //gestire l'errore
                    $error_form++;
                    $error_rec++;
                }
                if ($error_rec == 0) {
                    //se non si sono verificati errori
                    self::registrazione_cliente($utente);
                } else {
                    //esaminare che tipo di errore si è verificato
                    if ($error_form == 0) //errore sui campi
                        {
                        $_SESSION['errore'] = 2;
                    } else //errore username/password
                        {
                        $_SESSION['errore'] = 8;
                    }
                                        
                    $vd = new ViewDescriptor();
                    $vd->setTitolo("Benvenuto");
                    $vd->setLogoFile("../view/out/logo.php");
                    $vd->setMenuFile("../view/out/menu_back.php");
                    $vd->setContentFile("../view/out/form_registrazione_cliente.php"); //ritorna al form di registrazione cliente
                    $vd->setErrorFile("../view/out/error_out.php");
                    $vd->setFooterFile("../view/out/footer_empty.php");

                    require_once '../view/Master.php';                    
                    
                }
                break;
                
                
/* LOGIN CLIENTE
========================================================================== */
            //effettua il login del cliente
            case 'login_cliente':
                //flag per controllare la presenza di errori
                $error = 0;
                //username e password che vengono dal form di login o dopo che un cliente si registra
                $user_cliente = $_REQUEST['username_cliente'];
                $pass_cliente = $_REQUEST['password_cliente'];
                //definiamo le espressioni regolari
                define('username_regexpr', '/^[A-Za-z0-9\xE0\xE8\xE9\xEC\xF2\xF9]{3,64}$/');
                define('password_regexpr', '/^[a-zA-Z0-9\xE0\xE8\xE9\xEC\xF2\xF9]+$/');
                //verifica la correttezza dei valori inseriti nella compliazione del form
                if (!(1 === preg_match(username_regexpr, $user_cliente))) {
                    $error++;
                }
                if (!(1 === preg_match(password_regexpr, $pass_cliente))) {
                    $error++;
                }
                // si è verificato un errore (campo vuoto o caratteri non validi) nel form di login
                //!!!NON è consentito registrarsi con username uguale a 'Username' e password uguale a 'Password'
                if ($error != 0 OR ($user_cliente == 'Username' AND $pass_cliente == 'Password')) {
                    // errore in fase di login
                    $_SESSION['errore'] = 4;
                    
                    $vd = new ViewDescriptor();
                    $vd->setTitolo("SardiniaInFood");
                    $vd->setLogoFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/logo.php");
                    $vd->setMenuFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/menu_back.php");
                    $vd->setContentFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/login_cliente.php"); //ritorna al form di login
                    $vd->setErrorFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/error_out.php");
                    $vd->setFooterFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/footer_empty.php");
                   
                    require_once "http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/Master.php";
                        
                } else {
                    //se non si sono verificati errori
                    self::login_cliente($user_cliente, $pass_cliente);
                }
                break;
                
                
/* REGISTRAZIONE AZIENDA
========================================================================== */
            //registra una nuova azienda nell'applicazione
            case 'registrazione_azienda':
                //definizione delle espressioni regolari
                define("nome_completo_regexpr", "/^[a-zA-Z \xE0\xE8\xE9\xEC\xF2\xF9]{3,64}/");
                define("email_personale_regexpr", "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/");
                define("username_regexpr", "/^[A-Za-z0-9\xE0\xE8\xE9\xEC\xF2\xF9 ]{3,64}$/");
                define("password_regexpr", "/^[a-zA-Z0-9\xE0\xE8\xE9\xEC\xF2\xF9]+$/");
                define("nome_azienda_regexpr", "/^[a-zA-Z\xE0\xE8\xE9\xEC\xF2\xF9 ]{3,64}/");
                define("descrizione_regexpr", "/^[A-Za-z0-9.,' \xE0\xE8\xE9\xEC\xF2\xF9]{1,250}$/");
                define("citta_regexpr", "/^[a-zA-Z\xE0\xE8\xE9\xEC\xF2\xF9-\s]+$/");
                define("indirizzo_regexpr", "/^[a-zA-Z0-9\xE0\xE8\xE9\xEC\xF2\xF9\s,'-]*$/");
                define("telefono_regexpr", "/^[0-9]{5,15}$/");
                define("sito_web_regexpr", "/^((?:http(?:s)?\:\/\/)?[a-zA-Z0-9_-]+(?:.[a-zA-Z0-9_-]+)*.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$/");
                //valori inseriti dall'utente
                if ($_POST['part'] == 1) {
                    if (isset($_SESSION['step2'])) {
                        session_destroy();
                        session_start();
                    }
                    $name = trim($_REQUEST['nome_completo_azienda']);
                    $task = trim($_REQUEST['tipo_incarichi_id']);
                    $email = trim($_REQUEST['email_personale_azienda']);
                    $username = trim($_REQUEST['username_azienda']);
                    $pass = trim($_REQUEST['password_azienda']);
                    $pass_conferma = trim($_REQUEST['password_conferma']);
                    $ruolo = $_REQUEST['ruolo'];
                    
                    //flag che gestiscono gli errori
                    $error_rec = 0; //errori nei campi
                    $error_form = 0; //errore username/password

                    $utente = new Azienda();
                    
                    //impostazione del ruolo
                    $utente->setRuolo($ruolo);
                    
                    //verifica la correttezza dei valori inseriti 
                    if (!empty($name)) {
                        if (1 === preg_match(nome_completo_regexpr, $name)) {
                            unset($_SESSION['nome_completo_azienda']);
                            $utente->setNomeCompleto($name);
                        } else {
                            $_SESSION['nome_completo_azienda'] = "<div class='messaggio-errore'>Il campo 'Nome Completo' contiene caratteri non validi</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['nome_completo_azienda'] = "<div class='messaggio-errore'>Il campo 'Nome Completo' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($task)) {
                        unset($_SESSION['tipo_incarichi_id']);
                        $utente->setTipo_incarichi_id($task);
                    }
                    if ($task == "-1") {
                        $_SESSION['tipo_incarichi_id'] = "<div class='messaggio-errore'>Il 'Tipo di incarico' non &egrave; stato scelto</div>";
                        $error_rec++;
                    }
                    if (!empty($email)) {
                        if (1 === preg_match(email_personale_regexpr, $email)) {
                            $valido = UtenteFactory::cercaEmail($email, 1);
                            if ($valido == 'SI') {
                                unset($_SESSION['email_personale_azienda']);
                                $utente->setEmailPersonale($email);
                            } else {
                                $_SESSION['email_personale_azienda'] = "<div class='messaggio-errore'>Questa email non &egrave; utilizzabile</div>";
                                $error_rec++;
                            }
                        } else {
                            $_SESSION['email_personale_azienda'] = "<div class='messaggio-errore'>Questo indirizzo email non &egrave; valido<br> Esempio di email valida: email@esempio.com</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['email_personale_azienda'] = "<div class='messaggio-errore'>Il campo 'Email' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($username)) {
                        if (1 === preg_match(username_regexpr, $username)) {
                            $valido = UtenteFactory::cercaUsername($username, 1);
                            if ($valido == 'SI') {
                                unset($_SESSION['username_azienda']);
                                $utente->setUsername($username);
                            } else {
                                $_SESSION['username_azienda'] = "<div class='messaggio-errore'>Questo username &egrave; utilizzato da un altro utente<br>Si prega di sceglierne un altro</div>";
                                $error_rec++;
                            }
                        } else {
                            $_SESSION['username_azienda'] = "<div class='messaggio-errore'>Questo username contiene caratteri non validi</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['username_azienda'] = "<div class='messaggio-errore'>Il campo 'Username' completo &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($pass)) {
                        if ($pass == $pass_conferma) {
                            if (1 === preg_match(password_regexpr, $pass)) {
                                unset($_SESSION['password_azienda']);
                                $utente->setPassword($pass);
                            } else {
                                $_SESSION['password_azienda'] = "<div class='messaggio-errore'>La password non &egrave; valida</div>";
                                $error_rec++;
                            }
                        } else {
                            $_SESSION['password_azienda'] = "<div class='messaggio-errore'>Errore nell'inserimento della password</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['password_azienda'] = "<div class='messaggio-errore'>Il campo 'Password' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    //nessun cliente può registrarsi con nome uguale a 'Username' e password uguale a 'Password'                    
                    if ($username == 'Username' AND $pass == 'Password') { //gestire l'errore
                        $error_form++;
                        $error_rec++;
                    }
                    if ($error_rec == 0) {
                        $_SESSION['azienda'] = $utente;
                        $vd = new ViewDescriptor();
                        $vd->setTitolo("Benvenuto in FoodAdvisor");
                        $vd->setLogoFile('../view/out/logo.php');
                        $vd->setMenuFile('../view/out/menu_back.php');
                        $vd->setContentFile('../view/out/form_registrazione_azienda_part2.php');
                        $vd->setErrorFile('../view/out/error_out.php');
                        $vd->setFooterFile('../view/out/footer_empty.php');
                     
                        require_once '../view/Master.php';
                    } else {
                        // capire di che errore si tratta
                        if ($error_form == 0) //errore sui campi
                            {
                            $_SESSION['errore'] = 2;
                        } else //errore username/password
                            {
                            $_SESSION['errore'] = 8;
                        }
                        $vd = new ViewDescriptor();
                        $vd->setTitolo("Benvenuto in FoodAdvisor");
                        $vd->setLogoFile('../view/out/logo.php');
                        $vd->setMenuFile('../view/out/menu_back.php');
                        $vd->setContentFile('../view/out/form_registrazione_azienda_part1.php');
                        $vd->setErrorFile('../view/out/error_out.php');
                        $vd->setFooterFile('../view/out/footer_empty.php');
                         
                        require_once '../view/Master.php';
                    }
                }
                if ($_POST['part'] == 2) {
                    $company_name = trim($_REQUEST['name_azienda']);
                    $company_type = $_REQUEST['tipo_attivita_id'];
                    $company_mail = $_REQUEST['email_azienda'];
                    $company_description = trim($_REQUEST['descrizione_azienda']);
                    $company_city = trim($_REQUEST['city_azienda']);
                    $company_address = trim($_REQUEST['address_azienda']);
                    $company_phone = trim($_REQUEST['phone_azienda']);
                    $company_web_site = trim($_REQUEST['sito_web_azienda']);
                    $utente = $_SESSION['azienda'];
                    $error_rec = 0; //verifica la presenza di un generico errore
                    // pulizia
                    if (!empty($company_name)) {
                        unset($_SESSION['name_azienda']);
                        if (1 === preg_match(nome_azienda_regexpr, $company_name)) {
                            $utente->setNomeAzienda($company_name);
                        } else {
                            $_SESSION['name_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Nome Azienda' contiene caratteri non validi</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['name_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Nome Azienda' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($company_type)) {
                        unset($_SESSION['tipo_attivita_id']);
                        $utente->setTipo_attivita_id($company_type);
                    }
                    if ($company_type == "-1") {
                        $_SESSION['tipo_attivita_id'] = "<br><div class='messaggio-errore'>Il campo 'Tipo di attivit&agrave;' non &egrave; stata schelta</div>";
                        $error_rec++;
                    }
                    if (!empty($company_mail)) {
                        unset($_SESSION['email_azienda']);
                        if (1 === preg_match(email_personale_regexpr, $company_mail)) {
                            $valido = UtenteFactory::cercaEmail($company_mail, 2);
                            if ($valido == 'SI') {
                                $utente->setEmail($company_mail);
                            } else {
                                $_SESSION['email_azienda'] = "<br><div class='messaggio-errore'>Questa email &egrave; gi&agrave; stato utilizzata</div>";
                                $error_rec++;
                            }
                        } else {
                            $_SESSION['email_azienda'] = "<br><div class='messaggio-errore'>Questo indirizzo email non &egrave; valido<br>Esempio di email valida: email@esempio.com</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['email_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Email' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($company_description)) {
                        unset($_SESSION['descrizione_azienda']);
                        if (1 === preg_match(descrizione_regexpr, $company_description)) {
                            $utente->setDescrizione($company_description);
                        } else {
                            $contacaratteri = strlen($company_description);
                            if ($contacaratteri >= 250) {
                                $_SESSION['descrizione_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Breve Descrizione' non &egrave; valido<br>Il campo contiene $contacaratteri caratteri su 250 permessi</div>";
                            } else {
                                $_SESSION['descrizione_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Breve Descrizione' contiene caratteri non validi</div>";
                            }
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['descrizione_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Breve Descrizione' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($company_city)) {
                        unset($_SESSION['city_azienda']);
                        if (1 === preg_match(citta_regexpr, $company_city)) {
                            $utente->setCitta($company_city);
                        } else {
                            $_SESSION['city_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Citt&agrave;' contiene caratteri non validi</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['city_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Citt&agrave;' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($company_address)) {
                        unset($_SESSION['address_azienda']);
                        if (1 === preg_match(indirizzo_regexpr, $company_address)) {
                            $utente->setIndirizzo($company_address);
                        } else {
                            $_SESSION['address_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Indirizzo' contiene caratteri non validi</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['address_azienda'] = "<br><div class='messaggio-errore'>Il campo Indirizzo' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($company_phone)) {
                        unset($_SESSION['phone_azienda']);
                        if (1 === preg_match(telefono_regexpr, $company_phone)) {
                            $utente->setTelefono($company_phone);
                        } else {
                            $_SESSION['phone_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Telefono' contiene caratteri non validi</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['phone_azienda'] = "<br><div class='messaggio-errore'>Il campo 'Telefono' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if (!empty($company_web_site)) {
                        unset($_SESSION['sito_web_azienda']);
                        if (1 === preg_match(sito_web_regexpr, $company_web_site)) {
                            $utente->setSitoWeb($company_web_site);
                        } else {
                            $_SESSION['sito_web_azienda'] = "<br><div class='messaggio-errore'>Il campo del 'Sito web' non &egrave; valido</div>";
                            $error_rec++;
                        }
                    } else {
                        $_SESSION['sito_web_azienda'] = "<br><div class='messaggio-errore'>Il campo del 'Sito web' &egrave; vuoto</div>";
                        $error_rec++;
                    }
                    if ($error_rec == 0) {
                        $_SESSION['azienda'] = $utente;
                        $vd = new ViewDescriptor();
                        $vd->setTitolo("Benvenuto in FoodAdvisor");
                        $vd->setLogoFile('../view/out/logo.php');
                        $vd->setMenuFile('../view/out/menu_back.php');
                        $vd->setContentFile('../view/out/form_registrazione_azienda_part3.php');
                        $vd->setErrorFile('../view/out/error_out.php');
                        $vd->setFooterFile('../view/out/footer_empty.php');
                        
                        require_once '../view/Master.php';
                    } else {
                        //$_SESSION['errore'] = 1;
                        $_SESSION['errore'] = 2;
                        $vd = new ViewDescriptor();
                        $vd->setTitolo("Benvenuto in FoodAdvisor");
                        $vd->setLogoFile('../view/out/logo.php');
                        $vd->setMenuFile('../view/out/menu_back.php');
                        $vd->setContentFile('../view/out/form_registrazione_azienda_part2.php');
                        $vd->setErrorFile('../view/out/error_out.php');
                        $vd->setFooterFile('../view/out/footer_empty.php');
                     
                        require_once '../view/Master.php';
                    }
                }
                if ($_POST['part'] == 3) {
                    $utente = $_SESSION['azienda'];
                   
                    if (isset($utente)) {
                      
                        if (isset($_REQUEST['servizi'])) {
                            $_SESSION['servizi'] = $_REQUEST['servizi'];
                        }
                        // effettua la registrazione dell'azienda
                        self::registrazione_azienda($utente);
                        
                    } else {                        
                        $_SESSION['errore'] = 1;
                        $vd = new ViewDescriptor();
                        $vd->setTitolo("Benvenuto in FoodAdvisor");
                        $vd->setLogoFile('../view/out/logo.php');
                        $vd->setMenuFile('../view/out/menu_back.php');
                        $vd->setContentFile('../view/out/form_registrazione_azienda_part3.php');
                        $vd->setErrorFile('../view/out/error_out.php');
                        $vd->setFooterFile('../view/out/footer_empty.php');
                        
                        require_once '../view/Master.php';
                    }
                }
                break;
                
                
/* LOGIN AZIENDA
========================================================================== */
            //effettua il login per l'azienda
            case 'login_azienda':
                // flag per controllare la presenza di errori
                $error = 0;
                //username e password
                $user_azienda = $_REQUEST['username_azienda'];
                $pass_azienda = $_REQUEST['password_azienda'];
                //definiamo le espressioni regolari per controllare la correttezza formale di username e password
                define("username_regexpr", "/^[A-Za-z0-9\xE0\xE8\xE9\xEC\xF2\xF9 ]{3,20}$/");
                define("password_regexpr", "/^[a-zA-Z0-9\xE0\xE8\xE9\xEC\xF2\xF9]+$/");
                // verifica la correttezza formale di username e password
                if (!(1 === preg_match(username_regexpr, $user_azienda))) {
                    $error++;
                }
                // verifica la correttezza formale di username e password
                if (!(1 === preg_match(password_regexpr, $pass_azienda))) {
                    $error++;
                }
                // messaggio di errore se i campi sono vuoti o non rispettano l"espressione regolare
                //!!!NON è consentito registrarsi con username uguale a 'Username' e password uguale a 'Password'
                if ($error != 0 OR ($user_azienda == 'Username' AND $pass_azienda == 'Password')) {
                    //errore in fase di login
                    $_SESSION['errore'] = 4;
                    $vd = new ViewDescriptor();
                    $vd->setTitolo("SardiniaInFood");
                    $vd->setLogoFile("../view/out/logo.php");
                    $vd->setMenuFile("../view/out/menu_back.php");
                    $vd->setContentFile("../view/out/login_azienda.php"); //ritorna alla funzione login azienda
                    $vd->setErrorFile("../view/out/error_out.php");
                    $vd->setFooterFile("../view/out/footer_empty.php");
 
                    require_once "../view/Master.php";
                } else {
                    //se non ci sono errori passa alla funzione login_azienda
                    self::login_azienda($user_azienda, $pass_azienda);
                }
                break;
                
/* CERCA DOVE-COSA
========================================================================== */
            //analizza i parametri passati dal form per effettuare una ricerca
            case "cercadovecosa":
                //flag per controllare la presenza di errori
                $errore = 0;
                //espressione regolare
                define("citta_regexpr", "/^[a-zA-Z-\s]+$/");
                // parametri inseriti nel form di ricerca
                $citta_request = $_REQUEST['citta'];
                //"pulizia" del parametro $citta
                $citta = trim($citta_request);
                $tipo_attivita_id = $_REQUEST['tipo_attivita_id'];
                //gestione di $citta:
                //se $citta è uguale a "Dove": l'utente non ha inserito nulla nel campo form "citta"
                //se $citta è uguale a "": l'utente ha lasciato uno spazio bianco nel campo form "citta"
                //in questi due casi $citta viene considerato UNDEFINE
                if ($citta == "Dove" || strlen($citta) == 0) {
                    $citta = 'UNDEFINE';
                }
                //in caso contrario $citta deve rispettare l'espressione regolare
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
                    $_SESSION['errore'] = 5;
                    
                    // richiama la home page
                    $vd = new ViewDescriptor();
                    $vd->setTitolo("Benvenuto in SardiniaInFood");
                    $vd->setLogoFile("../view/out/logo.php");
                    $vd->setMenuFile("../view/out/menu_home_page.php");
                    $vd->setContentFile("../view/out/home_page_default.php");
                    $vd->setErrorFile("../view/out/error_out.php");
                    $vd->setFooterFile("../view/out/footer_home_page.php");
                     
                    require_once "../view/Master.php";
                }
                break;

                
                
/* PROFILO
========================================================================== */
            // mostra il profilo di un'azienda
            case "profilo":
                self::mostraProfilo();
                break;
            
            
            
/* LOGIN AMMINISTRATORE
========================================================================== */
            // effettua il login dell'amministatore
            case 'login_amm':
                //flag per controllare la presenza di errori
                $error = 0;
                //username e password
                $username = $_REQUEST['username_amm'];
                $password = $_REQUEST['password_amm'];
                
                // definiamo le espressioni regolari
                define('username_regexpr', '/^[A-Za-z0-9 ]{3,20}$/');
                define('password_regexpr', '/^[a-zA-Z0-9]+$/');
                
                // verifica la correttezza dei valori inseriti nella compliazione del form
                if (!(1 === preg_match(username_regexpr, $username))) {
                    $error++;
                }
                if (!(1 === preg_match(password_regexpr, $password))) {
                    $error++;
                }
                // si è verificato un errore (campo vuoto o caratteri non validi) nel form di login
                if ($error != 0) {
                    $url = "http://localhost/SardiniaInFood/php/index.php?page=0";
                    header("location:$url");
                } else {
                    
                    // se non si sono verificati errori nel form passa alla funzione login_amministratore
                    self::login_amministratore($username, $password);
                }
                break;

                
/* LOGOUT
========================================================================== */
            case 'logout': //back alla pagina index
                $url = "http://localhost/SardiniaInFood/php/index.php?page=0";
                session_destroy();
                header("location:$url");
                break;
        }
    }
    
      
    
    
/*                             FUNZIONI
========================================================================== */
    
    
/* REGISTRAZIONE CLIENTE
========================================================================== */
    //funzione si occupa della registrazione di un nuovo cliente
    static function registrazione_cliente($utente)
    {
        // funzione di registrazione:
        // 1-verifica che l'utente non sia già registranto andando a confrontare nel database l'indirizzo email inserito nel form

        $test = UtenteFactory::creaUtente($utente);
        
        if ($test == "PRESENTE") {
            //se il cliente è già registrato viene mostrato un messaggio di errore
            $_SESSION['errore'] = 2;
            
            $vd = new ViewDescriptor();
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/out/logo.php");
            $vd->setErrorFile("../view/out/error_out.php");
            $vd->setMenuFile("../view/out/menu_back.php");
            $vd->setContentFile("../view/out/form_registrazione_cliente.php"); //ritorna la form di registrazione cliente
            $vd->setFooterFile("../view/out/footer_empty.php");

            require_once "../view/Master.php";
            
            ?> <script type="text/javascript" src="/SardiniaInFood/js/scroll_lista.js"></script> <?php
            
        } else {
            // in caso la registrazione abbia abuto successo procede con il login diretto
            $username = $utente->getUsername($utente);
            $password = $utente->getPassword($utente);
            
            //richiama la funzione di login
            self::login_cliente($username, $password);
        }
    }
    
    
    
/* LOGIN CLIENTE
========================================================================== */
    // Funzione che permette il login del cliente
    static function login_cliente($username, $password)
    {
        // cerco l"utente nel database in base all"email e la password passati
        $utente = UtenteFactory::cercaCliente($username, $password);
        // creo il descrittore della vista
        $vd = new ViewDescriptor();
        // utente non trovato. Viene visualizzato nuovamente il form di login
        if ($utente == "NOTFOUND") {
            $_SESSION['errore'] = 3;
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/logo.php");
            $vd->setMenuFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/menu_back.php");
            $vd->setContentFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/login_cliente.php"); //ritorno al form di login
            $vd->setErrorFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/error_out.php");
            $vd->setFooterFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/footer_empty.php");
        } elseif ($utente == "BANNATO") {
            // se il cliente Ã¨ giÃƒ  registrato viene mostrato un messaggio di errore
            if (isset($_SESSION['risultati'])) {
                unset($_SESSION['risultati']);
            }
            $_SESSION['errore'] = 7;
            $vd = new ViewDescriptor();
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/logo.php");
            $vd->setMenuFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/menu_home_page.php");
            $vd->setContentFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/home_page_default.php"); //ritorna la form di registrazione cliente
            $vd->setErrorFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/error_out.php");
            $vd->setFooterFile('http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/out/footer_home_page.php');

            require_once "/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/view/Master.php";
        } else {
            // pulizia della vecchia sessione
            // centenente i risultati delle ricerca del cliente
            // !!!!!AGGIUNGERE QUELLO DEI PREFERITI E DI ALTRO SE CE NE
            unset($_SESSION['risultati_cliente']);
            // salvo l'utente in sessione
            $_SESSION['current_user'] = $utente;
            // si sposta nella home page del cliente
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/in/logo.php");
            $vd->setMenuFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/view/in/menu_home_cliente.php");
            $vd->setErrorFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php//view/in/error_in.php");
            $vd->setContentFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php//view/in/cliente/home_page_cliente.php");
            $vd->setFooterFile("http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php//view/in/footer_home_clienti.php");
            
            unset($_SESSION['visible_logout']);
            $_SESSION['visible_logout']=0;
        }

        require_once "/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/view/Master.php";
    }
    
    
    
/* REGISTRAZIONE AZIENDA
========================================================================== */
    // funzione si occupa della registrazione di una nuova azienda
    static function registrazione_azienda($utente)
    {
        // funzione di registrazione creaUtente a seconda del ruolo:
        // 1-verifica che l"utente non sia giÃƒ  registranto
        // andando a confrontare nel database l"indirizzo email inserito durante la
        // registrazione nel form
        // 2-se non risulta che l"utente sia giÃƒ  registrato va effettivamente a
        // registrare il nuovo utente nel database
        //
        // viene usata una transizione
        $test = UtenteFactory::creaUtente($utente);
        if ($test == "PRESENTE") {
            // se l"azienda è già registrata viene mostrato un messaggio di errore
            $_SESSION['errore'] = 2;
            // caricamento pagina
            $vd = new ViewDescriptor();
            $vd->setTitolo("Benvenuto in FoodAdvisor");
            $vd->setLogoFile('../view/out/logo.php');
            $vd->setMenuFile('../view/out/menu_back.php');
            $vd->setContentFile('../view/out/form_registrazione_azienda_part2.php');
            $vd->setErrorFile('../view/out/error_out.php');
            $vd->setFooterFile('../view/out/footer_empty.php');
            // richiamo la vista
            require_once "../view/Master.php";
        } else {
            // in caso la registrazione abbia abuto successo procede con il
            // login diretto
            $username = $utente->getUsername($utente);
            $password = $utente->getPassword($utente);
            // /richiama la funzione di login
            self::login_azienda($username, $password);
        }
    }
    
    
    
/* LOGIN AZIENDA
========================================================================== */
    // Funzione che permette il login dell"azienda
    static function login_azienda($username, $password)
    {
        // cerco l"utente nel database in base all"email e la password passati
        $utente = UtenteFactory::cercaAzienda($username, $password);
        // creo il descrittore della vista
        $vd = new ViewDescriptor();
        // utente non trovato. Viene visualizzato nuovamente il form di login
        if ($utente == "NOTFOUND") {
            $_SESSION['errore'] = 3;
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/out/logo.php");
            $vd->setMenuFile("../view/out/menu_back.php");
            $vd->setErrorFile("../view/out/error_out.php");
            $vd->setContentFile("../view/out/login_azienda.php"); //ritorna al form di login
            $vd->setFooterFile("../view/out/footer_empty.php");
        } else {
            // salvo l"utente in sessione
            $_SESSION['current_user'] = $utente;
            // si sposta nella home page del cliente
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/in/logo.php");
            $vd->setMenuFile("../view/in/menu_home_azienda.php");
            $vd->setErrorFile("../view/in/error_in.php");
            $vd->setContentFile("../view/in/azienda/home_page_azienda.php");
            $vd->setFooterFile("../view/in/footer_empty.php");
            
            unset($_SESSION['visible_logout']);
            $_SESSION['visible_logout']=1;
        }
        // richiamo la vista
        require_once "../view/Master.php";
    }
    
    
    
/* CERCA DOVE-COSA
========================================================================== */
    // l"utente puÃƒÂ² ricercare un certo tipo di azienda in un certo luogo
    static function cercaDoveCosa($citta, $tipo_attivita_id)
    {
        // flag per controllare la presenza di errori
        $errore = 0;
        // le possibili combinazioni citta / tipo attivita sono
        // citta=="UNDEFINE" / tipo_attivita_id == -1 => CASO NON VALIDO
        // citta=="stringa" / tipo_attivita_id == -1 => CASO VALIDO
        // citta=="UNDEFINE" / tipo_attivita_id >= 1 => CASO VALIDO
        // citta=="stringa" / tipo_attivita_id >= 1 => CASO VALIDO
        // verifica che non ci si trovi nel caso non valido
        if ($citta == "UNDEFINE" AND $tipo_attivita_id == -1) {
            $_SESSION['errore'] = 5;
            $errore++;
            // pulizia
            unset($_SESSION['risultati']);
        }
        // se $errore==0 non sono passato per il caso non valido
        if ($errore == 0) {
            // funzione che ricerca in un certo luogo una certa categoria di aziende
            $risultati = UtenteFactory::cercaDoveCosa($citta, $tipo_attivita_id);
            // ho trovato almeno un risultato
            if ($risultati != 'ZERO') {
                // passaggio dei risultati
                $_SESSION['risultati'] = $risultati;
            } else {
                // errore nessun risultato trovato
                $_SESSION['errore'] = 6;
                // pulizia ricerca fallita
                $_SESSION['risultati'] = 'ZERO';
            }
        }
        // in qualunque caso richiamo la home page
        $vd = new ViewDescriptor();
        $vd->setTitolo("Benvenuto in SardiniaInFood");
        $vd->setLogoFile("../view/out/logo.php");
        $vd->setMenuFile("../view/out/menu_home_page.php");
        $vd->setContentFile("../view/out/home_page_default.php");
        $vd->setErrorFile("../view/out/error_out.php");
        $vd->setFooterFile("../view/out/footer_home_page.php");

        require_once "../view/Master.php";
    }
    
    
    
/* MOSTRA PROFILO
========================================================================== */
    // mostra il profilo dell"azienda selezionata
    static function mostraProfilo()
    {
        $vd = new ViewDescriptor();
        $vd->setTitolo("SardiniaInFood: Profilo");
        $vd->setLogoFile("../view/out/logo.php");
        $vd->setMenuFile("../view/out/menu_back.php");
        $vd->setContentFile("../view/out/mostra_profilo.php");
        $vd->setErrorFile("../view/out/error_out.php");
        $vd->setFooterFile("../view/out/footer_empty.php");

        require_once "../view/Master.php";
    }
    
    
    
/* LOGIN AMMINISTRATORE
========================================================================== */
    // Funzione che permette il login del'amministratore
    static function login_amministratore($username, $password)
    {
        // cerco l"utente nel database in base all"email e la password passati
        $utente = UtenteFactory::cercaAmministratore($username, $password);
        // creo il descrittore della vista
        $vd     = new ViewDescriptor();
        // utente non trovato. Viene visualizzato nuovamente il form di login
        if ($utente == "NOTFOUND") {
            $url = "http://localhost/SardiniaInFood/php/index.php?page=0";
            header("location:$url");
        } else {
            // salvo l'utente in sessione
            $_SESSION['current_user'] = $utente;
            // si sposta nella home page del cliente
            $vd->setTitolo("SardiniaInFood");
            $vd->setLogoFile("../view/in/amministratore/logo.php");
            $vd->setMenuFile("../view/in/amministratore/menu_home_amministratore.php");
            $vd->setErrorFile("../view/in/amministratore/error_amministratore.php");
            $vd->setContentFile("../view/in/amministratore/home_page_amministratore.php");
            $vd->setFooterFile("../view/in/amministratore/footer_empty.php");
            
            unset($_SESSION['visible_logout']);
            $_SESSION['visible_logout']=2;
        }

        require_once "../view/Master.php";
    }
}
?>


