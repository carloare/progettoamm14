<script type="text/javascript" src="/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/cancella_dai_preferiti.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<?php if (session_status() != 2) session_start();?>



<div id="box-form-preferiti">
<h1 class="white">
Filtra tra i preferiti
</h1>
<p class="center white">

    Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il capo vedeva il suo ventre arcuato, bruno e diviso in tanti segmenti ricurvi, in cima a cui la coperta da letto, vicina a scivolar giù tutta, si manteneva a fatica.
</p>


<!--article che riguarda la ricerca-->
<div class="form-ricerca">   
 <form action="/SardiniaInFood/php/controller/ClienteController.php" method="POST">

     
<input type="text" name="citta_preferiti" value="<?php

if (isset($_POST['citta_preferiti'])) echo $_POST['citta_preferiti'];
  else echo "Dove"; ?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id_preferiti" id="tipo_attivita_id_preferiti" title="scegli il tipo di attivit&agrave; che vuoi cercare">
 
     <?php

//dopo aver fatto la submit mostra il tipo di attività selezionato

if ((isset($_POST['tipo_attivita_id_preferiti'])) AND ($_POST['tipo_attivita_id_preferiti'] != "-1")) {
	$id_attivita = $_POST['tipo_attivita_id_preferiti'];
	$nome_attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
?> 
    <option value="<?php echo $id_attivita; ?>" > <?php	echo $nome_attivita; ?></option>
  
<?php
} 

//mostra tutte le attività selezionabili

if ((!isset($_POST['tipo_attivita_id_preferiti'])) OR ($_POST['tipo_attivita_id_preferiti'] == "-1")) {
?> <option value="-1">Cosa</option> <?php $attivita = UtenteFactory::listaAttivita(0);
}

// fatta una selezione, mostro tutte le attività tranne quella appena selezionata

elseif ((isset($_POST['tipo_attivita_id_preferiti'])) AND ($_POST['tipo_attivita_id_preferiti'] != "-1")) {
	$not_show = $_POST['tipo_attivita_id_preferiti'];

	// uso la stessa funzione di prima ma invece di passare 0 (id non assegnato ad alcuna attività)
	// passo l'id dell'attività da non mostrare (gli id 'validi' partono da 1).
	// Le query sono praticamente identiche tranne per il fatto che si differenziano solo per la clausola WHERE

	$attivita = UtenteFactory::listaAttivita($not_show);
}

while ($row = $attivita->fetch_row()) { ?> 
 
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                
      <?php
}

?>
    
      
            </select>  
  
 <input type="hidden" name="cmd" value="ricercapreferiti">
  <input type="submit" value="Cerca" onclick="return thisserchcliente(this.form)">
</form> </div></div>
     

<article>
<?php

           //salva l'utente corrente
    $id_cliente = $_SESSION['current_user']->getId();
   
   
    
   //se ho dei risultati li mostra

if (isset($_SESSION['risultati_cliente_preferiti']) AND $_SESSION['risultati_cliente_preferiti']!='ZERO')
	{

	$aziende_preferite = $_SESSION['risultati_cliente_preferiti'];
        
        }
if (!isset($_SESSION['risultati_cliente_preferiti']))
//se sono alla prima entrata mostro tutti i preferiti
        {
             
 $citta = "UNDEFINE";
    $tipo_attivita_id = -1;
    $aziende_preferite = UtenteFactory::cercaAziendePreferite($tipo_attivita_id, $citta);
    
    }
 
      
//caso in cui non trova alcun risultato
 //if(isset($_SESSION['risultati_cliente_preferiti']) AND $_SESSION['risultati_cliente_preferiti']=='ZERO')
 {
   //  $aziende_preferite=NULL;
   
 }
 
 
 
 if($aziende_preferite=='ZERO')
 {
     $_SESSION['errore']=3;
 }
else {
 //visualizza i risultati
   // if(isset($aziende_preferite) AND $aziende_preferite!= NULL ) {
        
 
 
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
     
  $attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);

  
    //id_azienda in sessione per poter eseguire nelle funzioni UtenteFactory
    //corrispondenti ai servizi offerti sotto
    $_SESSION['id_azienda'] = $id_azienda;
   
   
  
   //creazione dell'istruzione per visualizzare una
  //immagine di una specifica attività
  //con mostraAttivitaSelezionata ottengo:
  //-l'attività svolta
  //-il nome dell'immagine
  //-il titolo del tag img
  $url = '<img src="/SardiniaInFood/images/';
  $url .= UtenteFactory::mostraAttivitaSelezionata($id_attivita); //!!!!!!!uso cercaAttività e non un'altra funzione perchè altrimenti creerei sostanzialemente due funzioni identiche 
  $url .= '" alt="Immagine attivit&agrave;"';
  $url .= 'title=';
  $url .= UtenteFactory::mostraAttivitaSelezionata($id_attivita);
  $url .= '>';

    
  //creazione del titolo della media_voto in funzione del valore di media_voto
  $media_voto=UtenteFactory::mediaVoto($id_azienda);  
  
  if($media_voto>=4) $titolo_m="Alle persone piace questo posto";
  else if($media_voto>=3 AND $media_voto<4) $titolo_m="Le persone hanno pareri contrastanti su questo posto";
  else $titolo_m="Alle persono non piace questo posto";
  
  //creazione del titolo rapporto_qp in funzione del valore di rapporto_qp

  $rapporto_qp = UtenteFactory::rapportoQP($id_azienda); 
  
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
</article>
