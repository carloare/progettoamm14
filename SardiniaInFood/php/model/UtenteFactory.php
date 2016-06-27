<?php

include_once 'Azienda.php';

//apro la sessione solo per memorizzare i servizi offerti dell'azienda (creaUtente)
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
    //Funzione inserire un nuovo cliente
    
    public static function creaUtente($utente)
    {
        //connessione al database
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("[creaUtente] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            }
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
 //inizio transizione
 
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
     $query2 ="SELECT COUNT(*) FROM Aziende WHERE email = \"$company_mail_azienda\"";
  
       
      $result2 = $mysqli->query($query2);
     
     if(!$result2)
         {
             $mysqli->rollback(); 
         }
      
      
     $risultato = $result2->fetch_row();

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
       
            
            
     //il primo id non utilizzato lo associto all'azienda appena registrata
            //e inizializzo la tabella Statistiche
          
      $query1 = ("INSERT INTO Statistiche(id_aziende, visualizzazioni, media_voto, rapporto_qualita_prezzo, numero_preferenze) VALUES ($id_nuova_azienda, 0, 0, 0, 0)");

      $result1 = $mysqli->query($query1);
      
 }
    
      
               
   
 
       //inserisce i servizi offetti dall'azienda nella tabella Azienda_Servizi
      //mette a 1 se si vuole specificare che il servizio è offerto
      //mette a 0 se si vuole specificar che il servizio non è offerto
 //alla fine viene pulita la SESSION
          
          if(isset($_SESSION['accesso_disabili'])){
              if($_SESSION['accesso_disabili']==1)
              {
              $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,1,1)");
              }
              else
              {
              $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,1,0)"); 
              }
              $result3 = $mysqli->query($query3);
     if(!$result3)
         {
             $mysqli->rollback();
         }
         $_SESSION['accesso_disabili'] = NULL;
          }
          
          
           if(isset($_SESSION['accetta_carde_di_credito'])){
               if($_SESSION['accetta_carde_di_credito']==1)
               {
              $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,2,1)");
               }
               else
               {
                   $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,2,0)");
               }
              $result3 = $mysqli->query($query3);
     if(!$result3)
         {
             $mysqli->rollback();
         }
         $_SESSION['accetta_carde_di_credito'] = NULL;
          }
          
          
          
          if(isset($_SESSION['accetta_prenotazioni'])){
              if($_SESSION['accetta_prenotazioni']==1)
              {
              $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,3,1)");
              }
              else
                  {
                  $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,3,0)");
              }
              $result3 = $mysqli->query($query3);
     if(!$result3)
         {
             $mysqli->rollback();
         }
         $_SESSION['accetta_prenotazioni'] = NULL;
          }
          

       if(isset($_SESSION['bagno_disponibile'])){
           if($_SESSION['bagno_disponibile']==1)
           {
              $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,4,1)");
           }
           else
           {
               $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,4,0)");
           }
              $result3 = $mysqli->query($query3);
     if(!$result3)
         {
             $mysqli->rollback();
         }
         $_SESSION['bagno_disponibile'] = NULL;
          }
          
          
          
          
           if(isset($_SESSION['bancomat'])){
               if($_SESSION['bancomat']==1)
               {
              $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,5,1)");
               }
               else
               {
                $query3 =("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,5,0)");   
               }
              $result3 = $mysqli->query($query3);
     if(!$result3)
         {
             $mysqli->rollback();
         }
         $_SESSION['bancomat'] = NULL;
          }
          
          
          
          
          
          
           if (isset($_SESSION['bevande_alcoliche'])) {
               if($_SESSION['bevande_alcoliche']==1)
               {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,6,1)");
               }
               else
               {
                    $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,6,0)");
               }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['bevande_alcoliche'] = NULL;
            }
          
            
            
            
            
          
           if (isset($_SESSION['catering'])) {
               if($_SESSION['catering']==1)
               {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,7,1)");
               }
               else
               {
                   $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,7,0)");
               }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['catering'] = NULL;
            }
            
            
            
            
          
           if (isset($_SESSION['consegna_a_domicilio'])) {
               if($_SESSION['consegna_a_domicilio']==1)
               {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,8,1)");
               }
               else
               {
               $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,8,0)");
               }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['consegna_a_domicilio'] = NULL;
            }
          
            
            
            
            
            
          
           if (isset($_SESSION['da_asporto'])) {
               if($_SESSION['da_asporto']==1)
               {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,9,1)");
               }
               else
               {
                  $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,9,0)");  
               }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['da_asporto'] = NULL;
            }
            
            
            
            
          
           if (isset($_SESSION['guardaroba_disponibile'])) {
               if($_SESSION['guardaroba_disponibile']==1)
               {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,10,1)");
               }
                else 
                    {
                    $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,10,0)");
                    }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['guardaroba_disponibile'] = NULL;
            }
          
            
            
            
          
            if (isset($_SESSION['musica'])) {
                if($_SESSION['musica']==1)
                {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,11,1)");
                }
                else
                {
                    $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,11,0)");
                }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['musica'] = NULL;
            }
          
            
            
            
          
          if (isset($_SESSION['parcheggio_auto'])) {
              if($_SESSION['parcheggio_auto']==1)
              {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,12,1)");
              }
              else
              {
                   $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,12,0)");
              }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['parcheggio_auto'] = NULL;
            }
          
            
            
            
            
          if (isset($_SESSION['parcheggio_bici'])) {
              if($_SESSION['parcheggio_bici']==1)
              {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,13,1)");
              }
              else
              {
         $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,13,0)");
              }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['parcheggio_bici'] = NULL;
            }
          
          
          if (isset($_SESSION['per_fumatori'])) {
              if($_SESSION['per_fumatori']==1)
              {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,14,1)");
              }
 else {
                     $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,14,0)");

 }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['per_fumatori'] = NULL;
            }
          
            
            
            
            
            
             if (isset($_SESSION['posti_sedere_aperto'])) {
                 if($_SESSION['posti_sedere_aperto']==1)
                 {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,15,1)");
                 }
 else
     {
                     $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,15,0)");

 }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['posti_sedere_aperto'] = NULL;
            }
            
            
            
            
            
              if (isset($_SESSION['stanza_privata'])) {
                  if($_SESSION['stanza_privata']==1)
                  {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,16,1)");
                  }
                  else
                  {
   $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,16,0)");
                  }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['stanza_privata'] = NULL;
            }
            
            
            
            
            
            
              if (isset($_SESSION['tv'])) {
                  if($_SESSION['tv']==1)
                  {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,17,1)");
                  }
                  else
                  {
                     $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,17,0)"); 
                  }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['tv'] = NULL;
            }
            
            
            
            
            
            
                   if (isset($_SESSION['wifi'])) {
                       if($_SESSION['wifi']==1)
                       {
                $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,18,1)");
                       }
                       else
                       {
      $query3 = ("INSERT INTO Aziende_Servizi (id_aziende, id_servizi,valore) VALUES ($id_nuova_azienda,18,0)");
                       }
                $result3 = $mysqli->query($query3);
                if (!$result3) {
                    $mysqli->rollback();
                }
                $_SESSION['wifi'] = NULL;
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
            return null;
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
            return null;
             }
   
            //esecuzione dello statement      
            $ctrl = $stmt->execute();
            
            //eventuali errori
            if(!$ctrl) {
            error_log("[cercaCliente] errore nell'esecuzione dello statement");
            $mysqli->close();
            return null;
            }
     
           
                $ctrl = $stmt->bind_result 
                     ($id, $nome_completo, $username, $password, $email_conferma, $ruolo, $numero_richiami);
            
                
            if(!$ctrl) {
            error_log("[cercaCliente] errore nel bind dei parametri in output");
            $mysqli->close();
            return null;
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
            return null;
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
            return null;
             }
        
            //esecuzione dello statement      
            $ctrl = $stmt->execute();
      
            //eventuali errori
            if(!$ctrl) {
            error_log("[cercaAzienda] errore nell'esecuzione dello statement");
            $mysqli->close();
            return null;
            }
     
          
                $ctrl = $stmt->bind_result 
                     ($id, $nome_completo,$tipo_incarichi_id, $email_conferma,$username, $password, $nome_azienda, $citta, $indirizzo, $tipo_attivita_id, 
                        $descrizione, $telefono, $email, $sito_web, $ruolo);
              
                
                
                
                
                
                
            if(!$ctrl) {
            error_log("[cercaAzienda] errore nel bind dei parametri in output");
            $mysqli->close();
            return null;
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
            return null;
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
            return null;  
       
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
     public static function cercaAziendaPerId($id_azienda)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaAziendaPerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
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
 public static function cercaServiziAzienda($id_azienda)
 {
    
 //connessione al database
    $mysqli = new mysqli();
    
    $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name); 
    
    // suppongo di aver creato mysqli e di aver chiamato la connect
    if (!isset($mysqli)) {
            error_log("[cercaServiziAzienda] impossibile inizializzare il database");
            $mysqli->close();
            return null;
            }
        else 
            {                                                                  
           
        $query = "SELECT Servizi.tipo, Aziende_Servizi.valore FROM Aziende_Servizi JOIN Servizi ON Servizi.id = Aziende_Servizi.id_servizi AND Aziende_Servizi.id_aziende =$id_azienda";
        
               
        
       //Risultato query
$result = $mysqli->query($query);
if (!isset($result)) {
            error_log("[cercaServiziAzienda] errore");
            $mysqli->close();
            return null;
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
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  
/*
 * =============================================================================
 * -----------------------------------------------------------------
 * =============================================================================
 */  

























































































































































































































































































































































































}
?>
