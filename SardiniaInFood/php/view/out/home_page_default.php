<!--form di ricerca-->



<?php
   $mysqli = new mysqli();
   $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("impossibile inizializzare il database");
            $mysqli->close();
            return NULL;
            }
    
?>



<article>

 <form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" method="POST">

<input type="text" name="citta" value="<?php if (isset($_POST['citta'])) echo $_POST['citta']; else echo "Dove";?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare">
                
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
          
  <input type="hidden" name="cmd" value="cercadovecosa">
  <input type="submit" value="Cerca">
</form> 

</article>



<article>
    
   <!--visualizzazione dei risultati
   work in progress
   -->
    <?php 
    
   
    
    
include_once 'model/Utente.php';
    
    
include_once 'model/UtenteFactory.php';

    
include_once 'model/Azienda.php';
   
   

    
    
    if (session_status() != 2) session_start();


          
                  
                   //parametri dell'ultima ricerca
                  //sono stati salvati in sessione nel BaseCongroller nella funzione cercaDoveCosa
                  //dopo che entrambi hanno superato i vari controlli
                  //sono quindi certo che sono valori accettabili
    //in questo modo riesco a visualizzare l'ultima ricerca effettuata dopo che esco dal profilo di un'azienda
if(isset($_POST['citta']) AND isset($_POST['tipo_attivita_id']) AND $_SESSION['risultati']!='ZERO') 
    {
    
    $citta = $_POST['citta'];
    $tipo_attivita_id = $_POST['tipo_attivita_id'];
    $aziende = UtenteFactory::cercaDoveCosa($citta, $tipo_attivita_id);
            
    }



    //alla prima ricerca verifico che nel BaseControllor
    //siano arrivati i risultati dell'UtenteFactory
    //e in tal caso li porto qui nella home page
    if(isset($_SESSION['risultati']) AND $_SESSION['risultati']!='ZERO')
    {
 
        
   //passaggio dei risultati
  $aziende= $_SESSION['risultati'];
   
  
    }
    
   
    //visualizza i risultati
    if(isset($aziende)) {
 
        
        
   foreach($aziende as $azienda)
   {

       
   //di ogni risultato mostro un mini-profilo
    $nome_azienda = $azienda->getNomeAzienda();
    $citta = $azienda->getCitta();
    $indirizzo = $azienda->getIndirizzo();     
     $id_azienda = $azienda->getId();
     $id_attivita=$azienda->getTipo_attivita_id();
     
     
  //cerca a seconda dell'id attivita l'effettiva attività svolta   
  $attivita = UtenteFactory::cercaAttivita($id_attivita);

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
  
  $numero_voti = UtenteFactory::numeroVoti($id_azienda);
  
  $titolo_m="";
  $titolo_qp="";
  
  $titolo_m.= $media_voto;
  $titolo_m.= " / 5 ";
  if($media_voto>=4) $titolo_m.=" Alle persone piace questo posto";
  else if($media_voto>=3 AND $media_voto<4) $titolo_m.=" Le persone hanno pareri contrastanti su questo posto";
  else $titolo_m.=" Alle persono non piace questo posto";
  
  
  //creazione del titolo rapporto_qp in funzione del valore di rapporto_qp
  $rapporto_qp = UtenteFactory::rapportoQualitaPrezzoInStatistiche($id_azienda); 
  
  $numero_voti_qp = UtenteFactory::numeroVotiQualitaPrezzo($id_azienda);
  
  $titolo_qp.= $rapporto_qp;
  $titolo_qp.= " / 5 ";
  
  
  $rapporto_qualita_prezzo= (int)$rapporto_qp; //prende la parte intera
  if($rapporto_qualita_prezzo>=4) $titolo_qp.=" costoso";
  else if($rapporto_qualita_prezzo>=3 AND $rapporto_qualita_prezzo<4) $titolo_qp.=" moderato";
  else $titolo_qp.= " economico";
  
   
    //visualizzo i risultati
    echo '<div class="results">';
    
    
    
   echo $url; //immagine
  
     
   
   
   
   //voto medio
   echo "<div class='voto' title='$titolo_m'>";
echo $media_voto;
echo'<br>';
echo 'Sulla base di ';
echo $numero_voti;
if($media_voto>=4) echo " voti Alle persone piace questo posto";
  else if($media_voto>=3 AND $media_voto<4) echo " voti Le persone hanno pareri contrastanti su questo posto";
  else echo " voti Alle persono non piace questo posto";
echo '</div>';






    //nome azienda
echo '<br>';
//entra nel profilo dell'azienda
    echo "<a  href='/SardiniaInFood/php/controller/BaseController.php?cmd=profile&id_azienda=$id_azienda'>$nome_azienda</a>";

    //indirizzo, citta
    echo '<br>';
    echo "$indirizzo"; echo' , '; echo $citta;
    //tipo attività
    echo '<br>';
    echo $attivita;
    
    //rapporto qualità prezzo
    echo ' &#8226; ';
    echo "<div title='$titolo_qp'>";
    for($i=0; $i<$rapporto_qualita_prezzo; $i++)
    {
        echo '$';
    }
    for(; $i<5; $i++)
    {
        echo '&#8364;';
    }
    
    echo'<br>';
echo 'Sulla base di ';
echo $numero_voti_qp;
if($rapporto_qualita_prezzo>=4) echo " voti Le persone ritengono che sia costoso";
  else if($rapporto_qualita_prezzo>=3 AND $media_voto<4) echo " voti Le persone ritengono che sia moderato";
  else echo " voti Le persone ritengono che sia economico";

    
    
    
    
    echo '</div>';
    
  echo "<br><br>";
     
  //numero visualizzazioni 
     echo '<div>';
   echo '<input type="image" src="/SardiniaInFood/images/view.png" alt="numero visualizzazioni" height="16" width="16" title="numero visualizzazioni");">'; 
   $visualizzazioni=UtenteFactory::numeroVisualizzazioni($id_azienda);
   echo $visualizzazioni;
    echo '</div>';
   
    //ultima recensione scritta
   echo '<div class="last_comment">';
 UtenteFactory::ultimaRecensione($id_azienda);
   echo '</div>';
   
   
   
   
   
   
echo '</div>';        
       
   

    }
    }
    ?>
     
</article>
