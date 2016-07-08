<script type="text/javascript" src="/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/cancelladaipreferiti.js"></script>


<?php
   $mysqli = new mysqli();
   $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
    
?>


<h2>Filtra tra i preferiti</h2>
 <form action="/SardiniaInFood/php/controller/ClienteController.php" method="POST">

     
     
 <input type="text" name="citta" value="<?php if (isset($_POST['citta'])) echo $_POST['citta']; else echo "Dove";?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attività">
                
              
<?php 


if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1")) {

    $pinco=$_POST['tipo_attivita_id'];
    $query="SELECT tipo FROM Attivita WHERE id='$pinco'";   
    $result = $mysqli->query($query);      
    $pallino=$result->fetch_row();      
    $nome_attivita=$pallino[0];
    
    
?> 
     
     <option value="<?php echo $pinco;?>" ><?php echo $nome_attivita; ?></option>
         
         
<?php } ?> 

     
 <option value="-1">Cosa</option>    


<?php



if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1"))
{
          
     $query="SELECT id, tipo FROM Attivita ORDER BY tipo ASC"; 
     
} 
elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
{
    
     $id_fffff = $_POST['tipo_attivita_id'];
          
     $query="SELECT id, tipo FROM Attivita WHERE (id != $id_fffff) ORDER BY tipo ASC"; 
     
}    
     $result = $mysqli->query($query);
     
     while ($row = $result->fetch_row()) { ?> 
 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                
      <?php }  ?>


            
            </select>  
 
     
     
     
     
       
 <input type="hidden" name="cmd" value="ricercapreferiti">
  <input type="submit" value="Cerca" onclick="return thisserchcliente(this.form)">
</form> 
     
<br><br><br>

<?php



 if (session_status() != 2) session_start();
 
 
 
           //salva l'utente corrente
    $id_cliente = $_SESSION['current_user']->getId();

    
   
    
    //al primo avvio mostro tutti i preferiti
    if(!isset($_SESSION['risultati_cliente_preferiti'])) 

    {
 $citta = "UNDEFINE";
    $tipo_attivita_id = -1;
    $aziende_preferite = UtenteFactory::cercaAziendePreferite($tipo_attivita_id, $citta);
    
    }
    
    //caso in cui nella ricerca trova almeno un risultato
    if(isset($_SESSION['risultati_cliente_preferiti']) AND $_SESSION['risultati_cliente_preferiti']!='ZERO')
    {
 
  
       
   //passaggio dei risultati
 $aziende_preferite= $_SESSION['risultati_cliente_preferiti'];
  

  
  }
 
      
//caso in cui non trova alcun risultato
 if(isset($_SESSION['risultati_cliente_preferiti']) AND $_SESSION['risultati_cliente_preferiti']=='ZERO')
 {
     $aziende_preferite=NULL;
     $_SESSION['risultati_cliente_preferiti']=NULL;
      //$citta = NULL;
    //$tipo_attivita_id = NULL;
 }
 
 
 
 
 //visualizza i risultati
    if(isset($aziende_preferite)) {
        
 
 
foreach($aziende_preferite as $azienda_preferita)
{

 
  
  $nome_azienda = $azienda_preferita->getNomeAzienda();
$descrizione = $azienda_preferita->getDescrizione();
    $citta = $azienda_preferita->getCitta();
    $indirizzo = $azienda_preferita->getIndirizzo();     
     $id_azienda = $azienda_preferita->getId();
     $id_attivita=$azienda_preferita->getTipo_attivita_id();
     
     $telefono = $azienda_preferita->getTelefono();
     $email = $azienda_preferita->getEmail();
     $sitoweb =$azienda_preferita->getSitoWeb();
     
  $attivita = UtenteFactory::cercaAttivita($id_attivita);

  
    //id_azienda in sessione per poter eseguire nelle funzioni UtenteFactory
    //corrispondenti ai servizi offerti sotto
    $_SESSION['id_azienda'] = $id_azienda;
   
   
  
   //creazione dell'istruzione per visualizzare una
  //immagine di una specifica attività
  //con cercaAttivita ottengo:
  //-l'attività svolta
  //-il nome dell'immagine
  //-il titolo del tag img
  $url = '<img src="/SardiniaInFood/images/';
  $url .= UtenteFactory::cercaAttivita($id_attivita); //!!!!!!!uso cercaAttività e non un'altra funzione perchè altrimenti creerei sostanzialemente due funzioni identiche 
  $url .= '" alt="Immagine attivit&agrave;"';
  $url .= 'title=';
  $url .= UtenteFactory::cercaAttivita($id_attivita);
  $url .= '>';

    
  //creazione del titolo della media_voto in funzione del valore di media_voto
  $media_voto=UtenteFactory::mediaVotoInStatistiche($id_azienda);  
  
  if($media_voto>=4) $titolo_m="Alle persone piace questo posto";
  else if($media_voto>=3 AND $media_voto<4) $titolo_m="Le persone hanno pareri contrastanti su questo posto";
  else $titolo_m="Alle persono non piace questo posto";
  
  //creazione del titolo rapporto_qp in funzione del valore di rapporto_qp

  $rapporto_qp = UtenteFactory::rapportoQualitaPrezzoInStatistiche($id_azienda); 
  
  $rapporto_qualita_prezzo= (int)$rapporto_qp; //prende la parte intera
  if($rapporto_qualita_prezzo>=4) $titolo_qp="Costoso";
  else if($rapporto_qualita_prezzo>=3 AND $rapporto_qualita_prezzo<4) $titolo_qp="Moderato";
  else $titolo_qp="Economico";
  
   
  
  echo "    
        <div id=profile$id_azienda> 
            
$url 
        <h2>
        $nome_azienda     
        </h2>    
        <p>
        $indirizzo         
       
        $citta 
            <br>
    $attivita

<br>
$telefono
<br>
$email
<br>
$sitoweb

    
    
        ";  
  ?>          

<input type="image" src="/SardiniaInFood/images/arrows.png" id="<?php echo $id_azienda;?>" alt="cancella dai preferiti" height="32" width="32" title="Cancella dai preferiti">
 
<?php    
echo "</div>";
  
  
 
//azzero il filtro
$tipo_attivita_id = NULL;
$citta = NULL;

}
}
?>

