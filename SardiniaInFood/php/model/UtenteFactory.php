<?php

include_once 'Azienda.php';
include_once 'Cliente.php';
include_once 'Utente.php';


if (session_status() != 2) session_start();

//pulizia dei vari risultati conservati dentro la sessione
$_SESSION['risultati']=NULL;
$_SESSION['risultati_cliente']=NULL;
/*
 * Classe che contiene tutti quei servizi necessari a un generico utente (cliente o azienda)
 */

class UtenteFactory {
    
/*
 * =============================================================================
 * ------------------------------CREA UTENTE-----------------------------------
 * =============================================================================
 */    
    //funzione che registra un nuovo utente
    
    public static function creaUtente($utente)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("[creaUtente] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
 else {
            //estrazione del ruolo dell'utente
      $ruolo=$utente->getRuolo();
        
        //cliente
     if($ruolo==0)
        {
         //valori dell'oggetto creato tramite il form
$nome_completo = $utente->getNomeCompleto(); 
$username = $utente->getUsername();
$password =$utente->getPassword();
$email_conferma =$utente->getEmailConferma();
$ruolo = $utente->getRuolo();
$numero_richiami = $utente->getNumeroRichiami();      

        
 //inizializzazione del prepared statement
 $stmt = $mysqli->stmt_init(); 
 //inizio transizione+
 
        $mysqli->autocommit(FALSE);        
    
      //verifica se nella tabella Cliente è presente l'email digitata 
        //(l'email è unica per ogni persona)
 $query ="SELECT COUNT(*) FROM Clienti WHERE email_conferma = \"$email_conferma\"";
   
    $result = $mysqli->query($query);
    
     if(!$result)
         {
             $mysqli->rollback();
         }
    
    
     $risultato = $result->fetch_row();
           
     if($risultato[0] > 0)
     {
                $mysqli->rollback();
                return 'PRESENTE';    
     }            
        
      else
      {
        
        //effettiva registrazione del nuovo cliente nella tabella Clienti
    $stmt = $mysqli->prepare("INSERT INTO Clienti (nome_completo, username, password, email_conferma, ruolo, numero_richiami) VALUES (?, ?, ?, ?, ?, ?)");
    
    
    $ctrl = $stmt->bind_param('ssssii', $nome_completo, $username, $password, $email_conferma,$ruolo, $numero_richiami);
         
    if(!$ctrl)
         {
             $mysqli->rollback();
         }
    
    $ctrl=$stmt->execute();
    
     
    if(!$ctrl)
         {
             $mysqli->rollback();
         }
   


    }
    
     $mysqli->commit();
 $mysqli->autocommit(TRUE);
 
 
$mysqli->close();

}


//azienda
if($ruolo==1)
    {       
    
    
          //valori dell'oggetto creato tramite il form
  $nome_completo_azienda =$utente->getNomeCompleto();
          $tipo_incarichi_id =$utente->getTipo_incarichi_id();
          $email_conferma_azienda=$utente->getEmailConferma();
          $username_azienda=$utente->getUsername();
          $password_azienda=$utente->getPassword();
          $name_azienda =$utente->getNomeAzienda();
          $city_azienda=$utente->getCitta();
          $address_azienda=$utente->getIndirizzo();
          $tipo_attivita_id=$utente->getTipo_attivita_id();
          $descrizione_azienda=$utente->getDescrizione();
          $phone_azienda=$utente->getTelefono();
          $company_mail_azienda =$utente->getEmail();
          $sito_web_azienda=$utente->getSitoWeb();
          $ruolo=$utente->getRuolo();
          
        //verifica che l'email dell'azienda non sia già presente nel database
          //(l'email è unica)
     $query ="SELECT COUNT(*) FROM Aziende WHERE email = \"$company_mail_azienda\"";
  
       
      $result = $mysqli->query($query);
     
     if(!$result)
         {
             $mysqli->rollback(); 
         }
      
      
     $risultato = $result->fetch_row();

          if($risultato[0] > 0)
          {
                $mysqli->rollback(); 
                return 'PRESENTE';    
          }    
          
 else {
          
          //effettua la registrazione nel database
$stmt = $mysqli->prepare("INSERT INTO Aziende (nome_completo, tipo_incarichi_id, email_conferma, username, password, nome_azienda, citta, indirizzo, tipo_attivita_id, descrizione, telefono, email, sito_web, ruolo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

     $ctrl = $stmt->bind_param('sissssssissssi', $nome_completo_azienda, $tipo_incarichi_id, $email_conferma_azienda, $username_azienda, $password_azienda, $name_azienda, $city_azienda, $address_azienda, $tipo_attivita_id, $descrizione_azienda, $phone_azienda, $company_mail_azienda, $sito_web_azienda, $ruolo );
 
     if(!$ctrl)
         {
             $mysqli->rollback();
         }
     $ctrl=$stmt->execute();
     
      if(!$ctrl)
         {
             $mysqli->rollback();
         }
         
         //cerca il primo id non utilizzato
     $query ="SELECT id AS id FROM Aziende ORDER BY id DESC ";

     $last_id = $mysqli->query($query);
            
            $row = $last_id->fetch_array();

            $id_nuova_azienda = $row[0];
       
            echo $id_nuova_azienda;
            
     //il primo id non utilizzato lo associto all'azienda appena registrata
            //e inizializzo la tabella Statistiche
          
      $query = ("INSERT INTO Statistiche(id_aziende, visualizzazioni, media_voto, numero_voti, media_rapporto_qualita_prezzo, numero_voti_qualita_prezzo, numero_preferenze) VALUES ($id_nuova_azienda, 0, 0, 0, 0, 0, 0)");

      $result = $mysqli->query($query);
      echo $query;
      var_dump($result);
      
      
      
 }
    
      
               
   
 
       //inserisce i servizi offetti dall'azienda nella tabella Azienda_Servizi
      //mette a 1 se si vuole specificare che il servizio è offerto
      //mette a 0 se si vuole specificar che il servizio non è offerto
 //alla fine viene pulita la SESSION
          
          if(isset($_SESSION['accesso_disabili'])){
              if($_SESSION['accesso_disabili']==1)
              {
              $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,1,1)");
              }
              else
              {
              $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,1,0)"); 
              }
              $result = $mysqli->query($query);
     if(!$result)
         {
             $mysqli->rollback();
         }
         $_SESSION['accesso_disabili'] = NULL;
          }
          
          
           if(isset($_SESSION['accetta_carde_di_credito'])){
               if($_SESSION['accetta_carde_di_credito']==1)
               {
              $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,2,1)");
               }
               else
               {
                   $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,2,0)");
               }
              $result = $mysqli->query($query);
     if(!$result)
         {
             $mysqli->rollback();
         }
         $_SESSION['accetta_carde_di_credito'] = NULL;
          }
          
          
          
          if(isset($_SESSION['accetta_prenotazioni'])){
              if($_SESSION['accetta_prenotazioni']==1)
              {
              $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,3,1)");
              }
              else
                  {
                  $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,3,0)");
              }
              $result = $mysqli->query($query);
     if(!$result)
         {
             $mysqli->rollback();
         }
         $_SESSION['accetta_prenotazioni'] = NULL;
          }
          

       if(isset($_SESSION['bagno_disponibile'])){
           if($_SESSION['bagno_disponibile']==1)
           {
              $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,4,1)");
           }
           else
           {
               $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,4,0)");
           }
              $result = $mysqli->query($query);
     if(!$result)
         {
             $mysqli->rollback();
         }
         $_SESSION['bagno_disponibile'] = NULL;
          }
          
          
          
          
           if(isset($_SESSION['bancomat'])){
               if($_SESSION['bancomat']==1)
               {
              $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,5,1)");
               }
               else
               {
                $query =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,5,0)");   
               }
              $result = $mysqli->query($query);
     if(!$result)
         {
             $mysqli->rollback();
         }
         $_SESSION['bancomat'] = NULL;
          }
          
          
          
          
          
          
           if (isset($_SESSION['bevande_alcoliche'])) {
               if($_SESSION['bevande_alcoliche']==1)
               {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,6,1)");
               }
               else
               {
                    $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,6,0)");
               }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['bevande_alcoliche'] = NULL;
            }
          
            
            
            
            
          
           if (isset($_SESSION['catering'])) {
               if($_SESSION['catering']==1)
               {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,7,1)");
               }
               else
               {
                   $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,7,0)");
               }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['catering'] = NULL;
            }
            
            
            
            
          
           if (isset($_SESSION['consegna_a_domicilio'])) {
               if($_SESSION['consegna_a_domicilio']==1)
               {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,8,1)");
               }
               else
               {
               $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,8,0)");
               }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['consegna_a_domicilio'] = NULL;
            }
          
            
            
            
            
            
          
           if (isset($_SESSION['da_asporto'])) {
               if($_SESSION['da_asporto']==1)
               {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,9,1)");
               }
               else
               {
                  $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,9,0)");  
               }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['da_asporto'] = NULL;
            }
            
            
            
            
          
           if (isset($_SESSION['guardaroba_disponibile'])) {
               if($_SESSION['guardaroba_disponibile']==1)
               {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,10,1)");
               }
                else 
                    {
                    $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,10,0)");
                    }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['guardaroba_disponibile'] = NULL;
            }
          
            
            
            
          
            if (isset($_SESSION['musica'])) {
                if($_SESSION['musica']==1)
                {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,11,1)");
                }
                else
                {
                    $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,11,0)");
                }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['musica'] = NULL;
            }
          
            
            
            
          
          if (isset($_SESSION['parcheggio_auto'])) {
              if($_SESSION['parcheggio_auto']==1)
              {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,12,1)");
              }
              else
              {
                   $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,12,0)");
              }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['parcheggio_auto'] = NULL;
            }
          
            
            
            
            
          if (isset($_SESSION['parcheggio_bici'])) {
              if($_SESSION['parcheggio_bici']==1)
              {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,13,1)");
              }
              else
              {
         $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,13,0)");
              }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['parcheggio_bici'] = NULL;
            }
          
          
          if (isset($_SESSION['per_fumatori'])) {
              if($_SESSION['per_fumatori']==1)
              {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,14,1)");
              }
 else {
                     $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,14,0)");

 }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['per_fumatori'] = NULL;
            }
          
            
            
            
            
            
             if (isset($_SESSION['posti_sedere_aperto'])) {
                 if($_SESSION['posti_sedere_aperto']==1)
                 {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,15,1)");
                 }
 else
     {
                     $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,15,0)");

 }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['posti_sedere_aperto'] = NULL;
            }
            
            
            
            
            
              if (isset($_SESSION['stanza_privata'])) {
                  if($_SESSION['stanza_privata']==1)
                  {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,16,1)");
                  }
                  else
                  {
   $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,16,0)");
                  }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['stanza_privata'] = NULL;
            }
            
            
            
            
            
            
              if (isset($_SESSION['tv'])) {
                  if($_SESSION['tv']==1)
                  {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,17,1)");
                  }
                  else
                  {
                     $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,17,0)"); 
                  }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['tv'] = NULL;
            }
            
            
            
            
            
            
                   if (isset($_SESSION['wifi'])) {
                       if($_SESSION['wifi']==1)
                       {
                $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,18,1)");
                       }
                       else
                       {
      $query = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,18,0)");
                       }
                $result = $mysqli->query($query);
                if (!$result) {
                    $mysqli->rollback();
                }
                $_SESSION['wifi'] = NULL;
            }
    
    }
    }

}

/*
 * =============================================================================
 * ------------------------------CERCA CLIENTE-----------------------------------
 * =============================================================================
 */  


 
 //cerco l'utente nel database in base usando username e password
    public static function cercaCliente($username, $password) {
       
    //connessione al database
    $mysqli = new mysqli();
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);  

    // suppongo di aver creato mysqli e di aver chiamato la connect
   if (!isset($mysqli)) {
            error_log("[cercaCliente] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            } 
            
            else 
                {                                                                  
  
               
        
        //formulazione della query SQL  
        $query = "SELECT * FROM Clienti WHERE username = ? AND password = ?";
               
   
       
            //inizializzazione del prepared statement
            $stmt = $mysqli->stmt_init();
      
            $stmt->prepare($query);
               
   
            //bind      
            $ctrl = $stmt->bind_param('ss', $username, $password);
        
            //in caso di errore
            if(!$ctrl) {
            error_log("[cercaCliente] impossibile effettuare il binding in input");
            $mysqli->close();
            return NULL;
             }
   
            //esecuzione dello statement      
            $ctrl = $stmt->execute();
            
            //eventuali errori
            if(!$ctrl) {
            error_log("[cercaCliente] errore nell'esecuzione dello statement");
            $mysqli->close();
            return NULL;
            }
     
           
                $ctrl = $stmt->bind_result 
                     ($id, $nome_completo, $username, $password, $email_conferma, $ruolo, $numero_richiami);
            
                
            if(!$ctrl) {
            error_log("[cercaCliente] errore nel bind dei parametri in output");
            $mysqli->close();
            return NULL;
            }

            //fetch del risultato          
            $ctrl = $stmt->fetch();
            
            //eventuali errori
            if(!$ctrl)
            {
            error_log("[cercaCliente] errore nel fetch dello statement");
            $mysqli->close();
            //nessun risultato trovato
            return 'NOTFOUND';
            }
       
            //crea un oggetto Cliente da restituire
           
            
            $utente = new Cliente();
            $utente->setId($id);
            $utente->setNomeCompleto($nome_completo);
            $utente->setUsername($username);
            $utente->setPassword($password);
            $utente->setEmailConferma($email_conferma);
            $utente->setRuolo($ruolo);
            $utente->setNumeroRichiami($numero_richiami);      
            $mysqli->close();
            return $utente;
         
            
        
        }    
    }
 
 
/*
 * =============================================================================
 * ------------------------------CERCA AZIENDA-----------------------------------
 * =============================================================================
 */  
//cerco l'utente nel database in base all'email e la password passati
    public static function cercaAzienda($username, $password) {
     
    //connessione al database
    $mysqli = new mysqli();
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);  

    // suppongo di aver creato mysqli e di aver chiamato la connect
   if (!isset($mysqli)) {
            error_log("[cercaAzienda] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            } 
            else {                                                                  
  
               
        
        //formulazione della query SQL  
        $query = "SELECT * FROM Aziende WHERE username = ? AND password = ?";
               
      
       
            //inizializzazione del prepared statement
            $stmt = $mysqli->stmt_init();
     
            $stmt->prepare($query);
             
       
            //bind      
            $ctrl = $stmt->bind_param('ss', $username, $password);
           
            //in caso di errore
            if(!$ctrl) {
            error_log("[cercaAzienda] impossibile effettuare il binding in input");
            $mysqli->close();
            return NULL;
             }
        
            //esecuzione dello statement      
            $ctrl = $stmt->execute();
      
            //eventuali errori
            if(!$ctrl) {
            error_log("[cercaAzienda] errore nell'esecuzione dello statement");
            $mysqli->close();
            return NULL;
            }
     
          
                $ctrl = $stmt->bind_result 
                     ($id, $nome_completo,$tipo_incarichi_id, $email_conferma,$username, $password, $nome_azienda, $citta, $indirizzo, $tipo_attivita_id, 
                        $descrizione, $telefono, $email, $sito_web, $ruolo);
              
                
                
                
                
                
                
            if(!$ctrl) {
            error_log("[cercaAzienda] errore nel bind dei parametri in output");
            $mysqli->close();
            return NULL;
            }

            //fetch del risultato          
            $ctrl = $stmt->fetch();
           
            //eventuali errori
            if(!$ctrl)
            {
            error_log("[cercaAzienda] errore nel fetch dello statement");
            $mysqli->close();
            //nessun risultato trovato
            return 'NOTFOUND';
            }
       
            //creiamo un oggetto Azienda da restituire
        
            
            $utente = new Azienda();
            $utente->setId($id);
            $utente->setNomeCompleto($nome_completo);
            $utente->setTipo_incarichi_id($tipo_incarichi_id);
                    $utente->setEmailConferma($email_conferma);
                    $utente->setUsername($username);
                    $utente->setPassword($password);
                    $utente->setNomeAzienda($nome_azienda);
                    $utente->setCitta($citta);
                    $utente->setIndirizzo($indirizzo);
                    $utente->setTipo_attivita_id($tipo_attivita_id);
                    $utente->setDescrizione($descrizione);
                    $utente->setTelefono($telefono);
                    $utente->setEmail($email);
                    $utente->setSitoWeb($sito_web);
                    $utente->setRuolo($ruolo);        
           
            
                    
                    
            $mysqli->close();
           
            return $utente;
         
                        
           
        
        }    
    }
/*
 * =============================================================================
 * ---------------------------------CERCA DOVE COSA--------------------------------
 * =============================================================================
 */   
 

//funzione che ricerca in un certo luogo una certa categoria di aziende
public static function cercaDoveCosa($citta, $tipo_attivita_id) {
    
  
    
    //connessione al database
    $mysqli = new mysqli();
    //$mysqli->connect("localhost","root","davide","amm14_aresuCarlo");
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaDoveCosa] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
           else
           {
         
     
               
            //gestisce le combinazioni citta / tipo_attivita_id
   if($citta!="UNDEFINE" AND $tipo_attivita_id!=-1)            
            {
  
        $query = "SELECT * FROM Aziende WHERE citta LIKE CONCAT('%', ?, '%') AND tipo_attivita_id = ?";
            }          
    
     if($citta!="UNDEFINE" AND $tipo_attivita_id==-1)
            {
      
                $query = "SELECT * FROM Aziende WHERE citta LIKE CONCAT('%', ?, '%')";
            }           
       if($citta=="UNDEFINE" AND $tipo_attivita_id!=-1)
            {
          
           
                $query = "SELECT * FROM Aziende WHERE tipo_attivita_id = ?";
            }         
            
        
            
          
            
            //inizializzazione del prepared statement
            $stmt = $mysqli->stmt_init();
            $ctrl = $stmt->prepare($query);
            
            //errore nello statement
           
            
             if (!$ctrl) {
              error_log("[cercaDoveCosa] errore nella inizializzazione dello statement");
            $mysqli->close();
            return NULL;  
       
        }
            
        
        if($citta!="UNDEFINE" AND $tipo_attivita_id!=-1) 
            {
            //bind      
                $ctrl = $stmt->bind_param('si', $citta, $tipo_attivita_id);
            }
            
             if($citta!="UNDEFINE" AND $tipo_attivita_id==-1)
            {
            //bind      
                $ctrl = $stmt->bind_param('s', $citta);
            } 
             if($citta=="UNDEFINE" AND $tipo_attivita_id!=-1)
            {
            //bind      
                $ctrl = $stmt->bind_param('i', $tipo_attivita_id);
            }
       
            
            //esecuzione dello statement      
            $ctrl = $stmt->execute();
            //eventuali errori
            if(!$ctrl)
            {
               error_log("[cercaDoveCosa] errore nell'esecuzione dello statement");
            $mysqli->close();
            return NULL; 
            }
     
            
            
            $row_result=array();
            $ctrl = $stmt->bind_result( 
                    $row_result['id'],
                    $row_result['nome_completo'],      
                    $row_result['tipo_incarichi_id'], 
                    $row_result['email_conferma'],
                    $row_result['username'],
                    $row_result['password'],
                    $row_result['nome_azienda'],
                    $row_result['citta'],
                    $row_result['indirizzo'],
                    $row_result['tipo_attivita_id'],
                    $row_result['descrizione'],
                    $row_result['telefono'],
                    $row_result['email'],
                    $row_result['sito_web'],
                    $row_result['ruolo']
                    );
    
         

            //fetch del risultato          
            while($stmt->fetch())
            { 
            $attivita[] = self::risultatiDoveCosa($row_result);
            }
            
           $mysqli->close();  
           
                    if(isset($attivita) AND $attivita!=0)
                          {
              
                        
                        
                      return $attivita;
           
                     }
           else 
           {
               
               return 'ZERO';
               }
                 
           }
    
    $mysqli->close();
                
                
            }      
             
          

/*
 * =============================================================================
 * ---------------------------------CERCA ATTIVITA--------------------------------
 * =============================================================================
 */  
         //funzione che a seconda del valore tipo_attività_id restituisce 
         //una stringa che contiene l'attività svolta
    
    
     public static function cercaAttivita($tipo_attivita_id)
     {
         
        
         
         if($tipo_attivita_id==1)
         {
             return 'Agriturismo';
         }
         if($tipo_attivita_id==2)
         {
             return 'American Bar';
         }
         if($tipo_attivita_id==3)
         {
             return 'Bar Caff&egrave;';
         }
         if($tipo_attivita_id==4)
         {
             return 'Birreria';
         }
         if($tipo_attivita_id==5)
         {
             return 'Bistrot';
         }
         if($tipo_attivita_id==6)
         {
             return 'Fast Food';
         }
         if($tipo_attivita_id==7)
         {
             return 'Gelateria';
         }
         if($tipo_attivita_id==8)
         {
             return 'Osteria';
         }
         if($tipo_attivita_id==9)
         {
             return 'Pasticceria';
         }
         if($tipo_attivita_id==10)
         {
             return 'Pizzeria';
         }
         if($tipo_attivita_id==11)
         {
             return 'Pub';
         }
         if($tipo_attivita_id==12)
         {
             return 'Ristorante';
         }
         if($tipo_attivita_id==13)
         {
             return 'Self Service';
         }
         if($tipo_attivita_id==14)
         {
             return 'Snack Bar';
         }
         if($tipo_attivita_id==15)
         {
             return 'Tack Away';
         }
         if($tipo_attivita_id==16)
         {
             return 'Trattoria';
         }
          if($tipo_attivita_id==17)
         {
             return 'Altro';
         }
     }
           
           
           
           
/*
 * =============================================================================
 * --------------------------------CERCA AZIENDA PER ID---------------------------------
 * =============================================================================
 */
     //restituisce l'azienda associata a un id
     public static function cercaAziendaPerId($id_azienda)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaAziendaPerId] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
        else 
            {                                                                  
            // nessun errore
            //formulazione della query SQL  
            $result = $mysqli->query("SELECT * FROM Aziende WHERE id = $id_azienda");
  
          while ($row = $result->fetch_object())
            { 
            $utente = new Azienda();
            $utente->setId($row->id);
            $utente->setNomeCompleto($row->nome_completo);  
            $utente->setTipo_incarichi_id($row->tipo_incarichi_id);
            $utente->setEmailConferma($row->email_conferma);
            $utente->setUsername($row->username);
            $utente->setPassword($row->password);
            $utente->setNomeAzienda($row->nome_azienda);
            $utente->setCitta($row->citta);
            $utente->setIndirizzo($row->indirizzo); 
            $utente->setTipo_attivita_id($row->tipo_attivita_id); 
            $utente->setDescrizione($row->descrizione);
            $utente->setTelefono($row->telefono);
            $utente->setEmail($row->email);
            $utente->setSitoWeb($row->sito_web);
            $utente->setRuolo($row->ruolo);
            
          
            
        
            }
        return $utente;    
          }
          $mysqli->close();
 }

/*
 * =============================================================================
 * --------------------------------CERCA SERVIZI AZIENDA---------------------------------
 * =============================================================================
 */  
 //restituisce i servizi offerti dall'azienda
 public static function cercaServiziAzienda($id_azienda)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaServiziAzienda] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
        else 
            {                                                                  
           
        $query = "SELECT Servizi.tipo, Aziende_Servizi.valore FROM Aziende_Servizi JOIN Servizi ON Servizi.id = Aziende_Servizi.id_servizi AND Aziende_Servizi.id_aziende =$id_azienda";
        
               
        
       //Risultato query
$result = $mysqli->query($query);
if (!isset($result)) {
            error_log("[cercaServiziAzienda] errore");
            $mysqli->close();
            return NULL;
            }
else
{
    echo "<br>";

//Recuperara valori come oggetti
while($row = $result->fetch_object()){
echo "$row->tipo :";
        if($row->valore==1)
            echo " Si";
       else
           echo " No";
echo "<br>";
}

}

$mysqli->close();
    }
 
 

}
/*
 * =============================================================================
 * ---------------------------------VOTA-------------------------------
 * =============================================================================
 */  
//funzione che permette di dare un voto a un'azienda
    public static function vota() { 
        
        $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        $voto = $_REQUEST['voto'];
        
        $nuova_media = 0;
        
   
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        
        // suppongo di aver creato mysqli e di aver chiamato la connect
       if (!isset($mysqli)) {
            error_log("[vota] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
            else
            {
             
$mysqli->autocommit(FALSE);

         $query = ("INSERT INTO Voti (id_aziende , id_clienti, voto) VALUES ( $id_azienda, $id_cliente, $voto)");
 $ctrl = $mysqli->query($query);
 
       
        if(!$ctrl)
         {
         
             $mysqli->rollback();
         }
       
       else
       {
           
        $media_voto = $mysqli->query("SELECT media_voto FROM Statistiche WHERE id_aziende = $id_azienda");     
             
        $row = $media_voto->fetch_array();

        $media_voto = $row[0];
        
          if(!$media_voto)
         {
             $mysqli->rollback();
         }
        
            if($media_voto==0)
            {
                $nuova_media = $voto;
            }
            else
            {
            
        $nuova_media = ($nuova_media + $voto) / 2;
            }

        $ctrl = $mysqli->query("UPDATE Statistiche SET media_voto = $nuova_media WHERE id_aziende = $id_azienda");

    

        if(!$ctrl)
         {
             $mysqli->rollback();
             echo ' Si è verificato un errore';
         }
       
       $ctrl = $mysqli->query("UPDATE Statistiche SET numero_voti = numero_voti + 1 WHERE id_aziende = $id_azienda");

    

        if(!$ctrl)
         {
             $mysqli->rollback();
             echo ' Si è verificato un errore';
         }
       
       else
        {
            echo ' Grazie per aver inserito il tuo voto';
           
       }
         $mysqli->commit();
 $mysqli->autocommit(TRUE);
        $mysqli->close();
    }
    }
    }
    
   
           
/*
 * =============================================================================
 * ----------------------------------INSERISCI TRA I PREFERITI -------------------------------
 * =============================================================================
 */  
  //funzione che inserisce un'azienda tra i preferiti
    public static function inserisciTraIPreferiti() {
        
        
        $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        
        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[favorites] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
       
            else
            {

       $mysqli->autocommit(FALSE);

         $query = ("INSERT INTO Preferiti (id_aziende , id_clienti) VALUES ($id_azienda , $id_cliente)");

       $ctrl = $mysqli->query($query);
       
        if(!$ctrl)
         {
             $mysqli->rollback();
         }


$query = ("UPDATE Statistiche SET numero_preferenze = numero_preferenze + 1 WHERE id_aziende = $id_azienda");
            
             $result = $mysqli->query($query);

            
            
            if (!$result) {
                $mysqli->rollback();
                }
                else
                {
            echo ' È stata inserita nella lista dei preferiti';
                }
            
          
            }
                 $mysqli->commit();
 $mysqli->autocommit(TRUE);
        $mysqli->close();
        
    }
    
    /*
 * =============================================================================
 * ---------------------------------QUALITA PREZZO-------------------------------
 * =============================================================================
 */  
//funzione che inserisce il voto sul rapporto qualità prezzo
    public static function rapportoQualitaPrezzo() { 
        
        $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        $voto = $_REQUEST['voto_qp']; 
        
        $nuova_madia_qp=0;
        

        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        
        // suppongo di aver creato mysqli e di aver chiamato la connect
       if (!isset($mysqli)) {
            error_log("[rapportoQualitaPrezzo] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
 else {
             
$mysqli->autocommit(FALSE);

        $query=("INSERT INTO `Qualita_Prezzo`(`id_aziende`, `id_clienti`, `voto`) VALUES ($id_azienda, $id_cliente, $voto)");


         $ctrl = $mysqli->query($query);
        
        if(!$ctrl)
         {
            
             $mysqli->rollback();
         }
       
       else
       {
           
           
        $media_qp = $mysqli->query("SELECT media_rapporto_qualita_prezzo FROM Statistiche WHERE id_aziende = $id_azienda");     
             
       
        
                
        $row =$media_qp->fetch_array();

        $media_qp = $row[0];
        
          if(!$media_qp)
         {
             $mysqli->rollback();
         }
        
            if($media_qp==0)
            {
                $nuova_madia_qp = $voto;
            }
            else
            {
            
        $nuova_madia_qp = ($nuova_madia_qp + $voto) / 2;
            }

       $ctrl = $mysqli->query("UPDATE Statistiche SET media_rapporto_qualita_prezzo = $nuova_madia_qp WHERE id_aziende = $id_azienda");

     
        if(!$ctrl)
         {
             $mysqli->rollback();
             echo ' Si è verificato un errore';
         }
       
         $ctrl = $mysqli->query("UPDATE Statistiche SET numero_voti_qualita_prezzo = numero_voti_qualita_prezzo + 1 WHERE id_aziende = $id_azienda");

    

        if(!$ctrl)
         {
             $mysqli->rollback();
             echo ' Si è verificato un errore';
         }
         
         
       
       
       else
        {
            echo ' Grazie per aver inserito il tuo voto';
           
       }
         $mysqli->commit();
 $mysqli->autocommit(TRUE);
        $mysqli->close();
    }
 }
    }
/*
 * =============================================================================
 * ----------------------------------COMMENTA-------------------------------
 * =============================================================================
 */  
    //funzione inserisce nel database una recensione, commento o opinione sull'azienda
    public static function commenta() { 
        
          
$data = date("d/m/Y");
      $zero = 0;
      
      
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        
        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[commenta] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
       
            else
            {

$stmt= $mysqli->prepare("INSERT INTO Recensioni(id_aziende, id_clienti, data,recensione, numero_segnalazioni) VALUES (?,?,?,?,?)");

$stmt->bind_param('iissi', $_SESSION['id_azienda'],$_SESSION['current_user']->getId(), $data, $_REQUEST['comments'],$zero);
$stmt->execute();
$stmt->close();
        
    }
    }
    
/*
 * =============================================================================
 * ---------------------------------CANCELLA PROFILO CLIENTE--------------------------------
 * =============================================================================
 */  
 //funzione che cancella il profilo di un cliente
    public static function cancellaCliente($delete_id) {

        //connessione al database
        $mysqli = new mysqli();
             $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[cancellaCliente] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }

        $stmt = $mysqli->prepare("DELETE FROM Clienti WHERE id = ?");
        

        $ctrl = $stmt->bind_param('i', $delete_id);
        if (!$ctrl) {
            error_log("[cancellaClienti] impossibile effettuare il binding in input");
            $mysqli->close();
            return NULL;       
        }

        //esecuzione dello statement      
        $ctrl = $stmt->execute();
      
        //eventuali errori
        if (!$ctrl) {
            error_log("[cancellaClienti] errore nell'esecuzione dello statement");
            $mysqli->close();
            return NULL; 
     }
         else {
            header("location: /SardiniaInFood/php/index.php?page=0"); 
        }

        $stmt->close();
    }
    
/*
 * =============================================================================
 * --------------------------------MEDIA VOTO IN STATISTICHE---------------------------------
 * =============================================================================
 */  
    //restituisce la media del voto 
 public static function mediaVotoInStatistiche($id_azienda)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[mediaVotoInStatistiche] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
        else 
            {                                                                  
           
        $query = "SELECT media_voto FROM Statistiche WHERE id_aziende=$id_azienda";
        
               
        

$result = $mysqli->query($query);

         $row = $result->fetch_array();
            
            $mediavoto = $row[0];

          if (!isset($mediavoto)) {
            error_log("[mediaVotoInStatistiche] errore");
            $mysqli->close();
            return NULL;
            }

            $mysqli->close();
            return $mediavoto;
        }
 

}

/*
 * =============================================================================
 * ------------------RAPPORTO QUALITA PREZZO IN STATISTICHE---------------------------------
 * =============================================================================
 */  
    //restituisce il rapporto qualità prezzo 
 public static function rapportoQualitaPrezzoInStatistiche($id_azienda)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[rapportoQualitaPrezzoInStatistiche] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
        else 
            {                                                                  
           
        $query = "SELECT media_rapporto_qualita_prezzo FROM Statistiche WHERE id_aziende=$id_azienda";
        
               
        

$result = $mysqli->query($query);

         $row = $result->fetch_array();
            
            $rapporto_qp = $row[0];

          if (!isset($rapporto_qp)) {
            error_log("[rapportoQualitaPrezzoInStatistiche] errore");
            $mysqli->close();
            return NULL;
            }

            $mysqli->close();
            return $rapporto_qp;
        }
 

}
/*
 * =============================================================================
 * -----------------------------AGGIORNA VIEWS AZIENDA------------------------------------
 * =============================================================================
 */

 //funzione che conta il numero delle views

    public static function updateViewsAzienda() {
       
        $id_azienda = $_SESSION['id_azienda'];
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

        // suppongo di aver creato mysqli e di aver chiamato la connect
       if (!isset($mysqli)) {
            error_log("[updateViewsAzienda] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            } else 
                {
            // nessun errore
            //formulazione della query SQL  
            $query = ("UPDATE Statistiche SET visualizzazioni = visualizzazioni + 1 WHERE id_aziende = $id_azienda");
            $result = $mysqli->query($query);

            
            
            if (!$result) {
                error_log("[updateViewsAzienda] errore");
                $mysqli->close();
                return NULL;
                }
            //else {
             //   return 'UPDATED';
           // }
                
        }
    }



/*
 * =============================================================================
 * -------------------------------ULTIMO COMMENTO----------------------------------
 * =============================================================================
 */  
    //funzione che restituisce l'ultima recensione inserita
    public static function ultimaRecensione($id_azienda) {
       //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
       
       
         if (!isset($mysqli)) {
            error_log("[ultimaRecensione] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            }

else
{

        $query = "SELECT * FROM Recensioni WHERE id_aziende = $id_azienda ORDER BY id DESC LIMIT 1";

       //Risultato query
$result = $mysqli->query($query);
 if (!isset($result)) {
            error_log("[ultimaRecensione] errore");
            $mysqli->close();
            return null;
            }
else
{
    echo "<br>";




//Recuperara valori come oggetti
while($row = $result->fetch_object()){
    
 echo'<img src="/SardiniaInFood/images/user.png" alt="Immagine utente" title="ultimo commento" height="16" width="16">';
  echo ' ';
echo $nome=UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
echo ' ';

    
echo "$row->data<br>$row->recensione<br><br>";
}

}
}
$mysqli->close();
    }
/*
 * =============================================================================
 * ---------------------------------CERCA CLIENTE PER ID--------------------------------
 * =============================================================================
 */  
    //restituisce il cliente associata a un id
     public static function cercaClientePerId($id_cliente)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaClientePerId] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
        else 
            {                                                                  
            // nessun errore
            //formulazione della query SQL  
            $result = $mysqli->query("SELECT * FROM Clienti WHERE id = $id_cliente");
  
          while ($row = $result->fetch_object())
            { 
            $utente = new Cliente();
           
            $utente->setId($row->id);
            $utente->setNomeCompleto($row->nome_completo);  
            $utente->setUsername($row->username);
           $utente->setPassword($row->password);
 $utente->setEmailConferma($row->email_conferma);
 $utente->setRuolo($row->ruolo);
$utente->setNumeroRichiami($row->numero_richiami);

            
          
            
        
            }
        return $utente;    
          }
          $mysqli->close();
 }
 /*
 * =============================================================================
 * -------------------------------ULTIMI COMMENTI----------------------------------
 * =============================================================================
 */   
 
    //funzione che restituisce le ultime 5 recensioni
     public static function cercaUltimeRecensioni($id_azienda) 
            {
   //connessione al database
    $mysqli = new mysqli();
    
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
  
//??????????????????????????????????????????????????????????????????????????
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


$results = $mysqli->query("SELECT * FROM Recensioni WHERE id_aziende = $id_azienda ORDER BY id DESC LIMIT 5");

//pe ogni risultato mostra data chi ha recensito e la recensione
while($row = $results->fetch_object()) {

    echo '<div class="recensione">';
   echo'<img src="/SardiniaInFood/images/user.png" alt="Immagine utente" title="ultimo commento" height="16" width="16">';
   // print $row->id;
   // print $row->id_aziende;
    
    print $row->data;
    echo ' ';
   echo $name = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
   echo ' ha scritto: ';
    print $row->recensione;
    //echo ' ';
    //print $row->numero_segnalazioni;
    
     ?><!--se la recensione conetiene messaggi offensivi può essere segnalata con il flag
     la segnalazione va nella funzione "segnalazione" qui sotto che aggiorna
     la tabella Recensioni e la tabella Segnalazioni-->
     <input type="image" src="/SardiniaInFood/images/flag.png" id="<?php echo $row->id;?>" alt="questa relazione contiene parole offensive" height="16" width="16" title="segnala" onclick ="return confirm('Conferma la segnalazione?');"> 
     <?php 
     
   echo '</div>';
       
   
   
   
   
   
   
   
}  



// close connection
$mysqli->close();

    
    
    
    
    

           
 }
 
   

/*
 * =============================================================================
 * -----------------------------AGGIORNA VIEWS AZIENDA------------------------------------
 * =============================================================================
 */

 //funzione che conta il numero delle views

    public static function segnalazione($id) {
       
        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

        // suppongo di aver creato mysqli e di aver chiamato la connect
       if (!isset($mysqli)) {
            error_log("[segnalazione] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            } else 
                {
            //aggiornare Recensioni 
            $query = ("UPDATE Recensioni SET numero_segnalazioni = numero_segnalazioni + 1 WHERE id = $id");
            $result = $mysqli->query($query);

            
            
            if (!$result) {
                error_log("[segnalazione] errore");
                $mysqli->close();
                return NULL;
                }
            //else {
             //   return 'UPDATED';
           // }
                
                //aggiornare Segnalazioni
                $query=("INSERT INTO Segnalazioni(id_recensioni) VALUES ($id)");
   
   
   $result = $mysqli->query($query);

            
            
            if (!$result) {
                error_log("[segnalazione] errore");
                $mysqli->close();
                return NULL;
                }
                
        }
    }
    
/*
 * =============================================================================
 * ---------------------------------NUMERO VISUALIZZAZIONI--------------------------------
 * =============================================================================
 */  
//funzine che restituisce il numeo di visualizzazioni di un'azienda
    public static function numeroVisualizzazioni($id_azienda) {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[views] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            
           
            $query = ("SELECT visualizzazioni FROM Statistiche WHERE id_aziende = $id_azienda");

            $result = $mysqli->query($query);
            
            
            
            $row = $result->fetch_array();

            $views = $row[0];


            if (!isset($views)) {
            error_log("[views] errore");
            $mysqli->close();
            return null;
            }

            $mysqli->close();
            return $views;
        }
    }
    
    
   /*
 * =============================================================================
 * ---------------------------------NUMERO VISUALIZZAZIONI--------------------------------
 * =============================================================================
 */  
//funzine che restituisce il numeo di visualizzazioni di un'azienda
    public static function numeroVoti($id_azienda) {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[views] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            
           
            $query = ("SELECT numero_voti FROM Statistiche WHERE id_aziende = $id_azienda");

            $result = $mysqli->query($query);
            
            
            
            $row = $result->fetch_array();

            $numero_voti = $row[0];


            if (!isset($numero_voti)) {
            error_log("[views] errore");
            $mysqli->close();
            return null;
            }

            $mysqli->close();
            return $numero_voti;
        }
    } 
    
    /*
 * =============================================================================
 * ---------------------------------NUMERO VISUALIZZAZIONI--------------------------------
 * =============================================================================
 */  
//funzine che restituisce il numeo di visualizzazioni di un'azienda
    public static function numeroVotiQualitaPrezzo($id_azienda) {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[views] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            
           
            $query = ("SELECT numero_voti_qualita_prezzo FROM Statistiche WHERE id_aziende = $id_azienda");

            $result = $mysqli->query($query);
            
            
            
            $row = $result->fetch_array();

            $numero_voti_qp = $row[0];


            if (!isset($numero_voti_qp)) {
            error_log("[views] errore");
            $mysqli->close();
            return null;
            }

            $mysqli->close();
            return $numero_voti_qp;
        }
    }
    /*
 * =============================================================================
 * -------------------------------VISUALIZZA PREFERITI----------------------------------
 * =============================================================================
 */   
 
    
        //funzione cerca quali sono i preferiti di un'azienda
    public static function cercaAziendePreferite($tipo_attivita_id, $citta)                                          
    {
        
   
        
    $id_cliente = $_SESSION['current_user']->getId();
        
    //connessione al database
    $mysqli = new mysqli();
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaIdAziendeInPreferiti] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            }
        else 
        {                                                                  
        // nessun errore
        //scegliere la query in base al filtro
        if ($tipo_attivita_id==-1 AND $citta=="UNDEFINE")             
        {
            $query = "SELECT 
                
Aziende.id,
Aziende.nome_completo,
Aziende.tipo_incarichi_id,
Aziende.email_conferma,
Aziende.username,
Aziende.password,
Aziende.nome_azienda,
Aziende.citta,
Aziende.indirizzo,
Aziende.tipo_attivita_id,
Aziende.descrizione,
Aziende.telefono,
Aziende.email,
Aziende.sito_web,
Aziende.ruolo


FROM Aziende JOIN Preferiti ON Aziende.id=Preferiti.id_aziende WHERE Preferiti.id_clienti=?";
        }
       
        
        
        if ($tipo_attivita_id!=-1 AND $citta=="UNDEFINE")
        {
           $query = "SELECT Aziende.id,
Aziende.nome_completo,
Aziende.tipo_incarichi_id,
Aziende.email_conferma,
Aziende.username,
Aziende.password,
Aziende.nome_azienda,
Aziende.citta,
Aziende.indirizzo,
Aziende.tipo_attivita_id,
Aziende.descrizione,
Aziende.telefono,
Aziende.email,
Aziende.sito_web,
Aziende.ruolo FROM Aziende JOIN Preferiti ON Aziende.id=Preferiti.id_aziende WHERE Preferiti.id_clienti=? AND Aziende.tipo_attivita_id=?"; 
        }
       
        
        
        
        if ($tipo_attivita_id==-1 AND $citta!="UNDEFINE" )
        {
           $query = "SELECT Aziende.id,
Aziende.nome_completo,
Aziende.tipo_incarichi_id,
Aziende.email_conferma,
Aziende.username,
Aziende.password,
Aziende.nome_azienda,
Aziende.citta,
Aziende.indirizzo,
Aziende.tipo_attivita_id,
Aziende.descrizione,
Aziende.telefono,
Aziende.email,
Aziende.sito_web,
Aziende.ruolo FROM Aziende JOIN Preferiti ON Aziende.id=Preferiti.id_aziende WHERE Preferiti.id_clienti=? AND Aziende.citta LIKE CONCAT('%', ?, '%')"; 
        }
      
        
        
        
        
        if ($tipo_attivita_id!=-1 AND $citta!="UNDEFINE")
        {
           $query = "SELECT Aziende.id,
Aziende.nome_completo,
Aziende.tipo_incarichi_id,
Aziende.email_conferma,
Aziende.username,
Aziende.password,
Aziende.nome_azienda,
Aziende.citta,
Aziende.indirizzo,
Aziende.tipo_attivita_id,
Aziende.descrizione,
Aziende.telefono,
Aziende.email,
Aziende.sito_web,
Aziende.ruolo FROM Aziende JOIN Preferiti ON Aziende.id=Preferiti.id_aziende WHERE Preferiti.id_clienti=? AND Aziende.tipo_attivita_id=? AND Aziende.citta LIKE CONCAT('%', ?, '%')"; 
        }
     
        
        
        
        
        
        if($mysqli->errno > 0)
            {
            
            error_log("[cercaIdAziendeInPreferiti] errore nella esecuzione della query");
            $mysqli->close();
            return null;
            }
        
            //inizializzazione del prepared statement
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($query);
            
            //errore nello statement
            if(!$stmt)
            {
             error_log("[cercaIdAziendeInPreferiti] errore nella inizializzazione dello statement");
            $mysqli->close();
            return null;
            }      
        
            //bind      
            if ($tipo_attivita_id==-1 AND $citta=="UNDEFINE")
           { 
               $ctrl = $stmt->bind_param('i', $id_cliente);
            }
           
           
            
            if ($tipo_attivita_id!=-1 AND $citta=="UNDEFINE")
            {
                $ctrl = $stmt->bind_param('ii', $id_cliente, $tipo_attivita_id);
            }
         
            
            
            if ($tipo_attivita_id==-1 AND $citta!="UNDEFINE")
            {
                $ctrl = $stmt->bind_param('is', $id_cliente, $citta);
            }
            
            
            
            
             if ($tipo_attivita_id!=-1 AND $citta!="UNDEFINE")
            {
                $ctrl = $stmt->bind_param('iis', $id_cliente, $tipo_attivita_id, $citta);
            }
           
            
            
            if(!$ctrl)
            {
               
             error_log("[cercaIdAziendeInPreferiti] errore nel bind dei parametri in input");
            $mysqli->close();
            return null;
            }

            //esecuzione dello statement      
            $ctrl = $stmt->execute();
            //eventuali errori
            if(!$ctrl)
            {
                
            error_log("[cercaIdAziendeInPreferiti] errore nell'esecuzione dello statement");
            $mysqli->close();
            return null;
            }
       
            $row_result=array();
            $ctrl = $stmt->bind_result( 
                    $row_result['id'],  
                    $row_result['nome_completo'],
                    $row_result['tipo_incarichi_id'],
                    $row_result['email_conferma'],
                    $row_result['username'],
                    $row_result['password'],
                    $row_result['nome_azienda'],
                    $row_result['citta'],
                    $row_result['indirizzo'],
                    $row_result['tipo_attivita_id'],
                    $row_result['descrizione'],
                    $row_result['telefono'],
                    $row_result['email'],
                    $row_result['sito_web'],
                    $row_result['ruolo']   
                    
                    
             
                    );
            
            
            
            
       
            
  //fetch del risultato          
            while($stmt->fetch())
            { 
                
            $attivita[] = self::risultatiDoveCosa($row_result);
           
            }
            
           $mysqli->close();  
           
                    if(isset($attivita) AND $attivita!=0)
                          {
              
                        
                        
                        return $attivita;
                    
                     }
           else 
           {
               
               return 'ZERO';
               }
                 
           }
    
    $mysqli->close();
                
                
            }   
            
            
            
            
            public function risultatiDoveCosa($row_result)
            { 
           $utente = new Azienda();
           $utente->setId($row_result['id']);
            $utente->setNomeCompleto($row_result['nome_completo']);
           $utente->setTipo_incarichi_id($row_result['tipo_incarichi_id']);
           $utente->setEmailConferma($row_result['email_conferma']);
           $utente->setUsername($row_result['username']);
           $utente->setPassword($row_result['password']);
           $utente->setNomeAzienda($row_result['nome_azienda']);
           $utente->setCitta($row_result['citta']);
           $utente->setIndirizzo($row_result['indirizzo']);
           $utente->setTipo_attivita_id($row_result['tipo_attivita_id']);
           $utente->setDescrizione($row_result['descrizione']);
           $utente->setTelefono($row_result['telefono']);
           $utente->setEmail($row_result['email']);
           $utente->setSitoWeb($row_result['sito_web']);
           $utente->setRuolo($row_result['ruolo']);
           
           return $utente;
           }     
            
/*
 * =============================================================================
 * ---------------------------------CANCELLA AZIENDA PREFERITA--------------------------------
 * =============================================================================
 */  
            //funzione che cancella il profilo dell'azienda
    public static function deleteFavorite() {
        
       $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        // suppongo di aver creato mysqli e di aver chiamato la connect
       if (!isset($mysqli)) {
            error_log("[deleteFavorite] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            }
 else {
                
 
    
    
    
//MySqli Delete Query
    
$results = $mysqli->query("DELETE FROM Preferiti WHERE id_clienti=$id_cliente AND id_aziende=$id_azienda");

if($results){
    print 'La cancellazione è avvenuta in modo corretto';
    
}else{
     echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            echo 'Si è verificato un errore';
          
            return null;
}
$mysqli->close();
 }

    }
            
/*
 * =============================================================================
 * --------------------------------VOTO VALIDO---------------------------------
 * =============================================================================
 */  
    //controlla che l'utente corrente non abbia già espressio il proprio voto
    
       public static function votoValido() 
            {
        
        $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        
        
        
        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

    // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[votoValido] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            // nessun errore
            //formulazione della query SQL  	
            $query = ("SELECT COUNT(*) FROM Voti WHERE id_clienti = $id_cliente AND id_aziende = $id_azienda");

         $result = $mysqli->query($query);
      
           $risultato = $result->fetch_row();

           if (!isset($risultato)) {
            error_log("[votoValido] errore");
            $mysqli->close();
            return null;
            }
           
           
            if($risultato[0] > 0)
                return 'NOVALID';
            else
            {

                return 'VALID';
            }
    } 
            }
    
    
    

/*
 * =============================================================================
 * -----------------VOTO RAPPORTO QUALITA PREZZO VALIDO-----------------------------------
 * =============================================================================
 */  
            
            //controlla che l'utente corrente non abbia già espressio il proprio voto
    
       public static function rapportoValido() 
            {
        
       $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        
        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

    // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[rapportoValido] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            // nessun errore
            //formulazione della query SQL  	
            $query = ("SELECT COUNT(*) FROM Qualita_Prezzo WHERE id_clienti = $id_cliente AND id_aziende = $id_azienda");

         $result = $mysqli->query($query);
      
           $risultato = $result->fetch_row();

           if (!isset($risultato)) {
            error_log("[rapportoValido] errore");
            $mysqli->close();
            return null;
            }
           
           
            if($risultato[0] > 0)
                return 'NOVALID';
            else
            {

                return 'VALID';
            }
    } 
            }
            /*
 * =============================================================================
 * -------------------------------PREFERITO VALIDO-----------------------------------
 * =============================================================================
 */  
            
            //controlla che l'utente non abbia inserito l'azienda nella lista dei preferiti
    
       public static function preferitoValido() 
            {
        
        $id_azienda = $_SESSION['id_azienda'];
        $id_cliente = $_SESSION['current_user']->getId();
        
        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

    // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[preferitoValido] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            // nessun errore
            //formulazione della query SQL  	
            $query = ("SELECT COUNT(*) FROM Preferiti WHERE id_clienti = $id_cliente AND id_aziende = $id_azienda");

         $result = $mysqli->query($query);
      
           $risultato = $result->fetch_row();

           if (!isset($risultato)) {
            error_log("[preferitoValido] errore");
            $mysqli->close();
            return null;
            }
           
           
            if($risultato[0] > 0)
                return 'NOVALID';
            else
            {

                return 'VALID';
            }
    } 
            }
/*
 * =============================================================================
 * ----------------------------CONTA PREFERENZE-------------------------------------
 * =============================================================================
 */  
       public static function contaPreferenze() 
            {
        
           $id_azienda = $_SESSION['current_user']->getId();
        
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
        

    // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[votoValido] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            } else {
            // nessun errore
            //formulazione della query SQL  	
            $query = ("SELECT COUNT(*) FROM Preferiti WHERE id_aziende = $id_azienda");

         $result = $mysqli->query($query);
      
           $risultato = $result->fetch_row();

           return $risultato[0];
            }

}


  
/*
 * =============================================================================
 * ---------------------------------CANCELLA PROFILO AZIENDA--------------------------------
 * =============================================================================
 */  
 //funzione che cancella il profilo di un cliente
    public static function cancellaAzienda($delete_id) {

        //connessione al database
        $mysqli = new mysqli();
             $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);   
        // suppongo di aver creato mysqli e di aver chiamato la connect
        if (!isset($mysqli)) {
            error_log("[cancellaAzienda] impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }

        $stmt = $mysqli->prepare("DELETE FROM Aziende WHERE id = ?");
        

        $ctrl = $stmt->bind_param('i', $delete_id);
        if (!$ctrl) {
            error_log("[cancellaAzienda] impossibile effettuare il binding in input");
            $mysqli->close();
            return NULL;       
        }

        //esecuzione dello statement      
        $ctrl = $stmt->execute();
      
        //eventuali errori
        if (!$ctrl) {
            error_log("[cancellaAzienda] errore nell'esecuzione dello statement");
            $mysqli->close();
            return NULL; 
     }
         else {
            header("location: /SardiniaInFood/php/index.php?page=0"); 
        }

        $stmt->close();
    }


















}
?>
