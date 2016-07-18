<!--form di ricerca
form della home page cliente che permette di effettuare delle ricerche
-->


<?php 
    
   
    
   
    
    
    include_once '/home/amm/development/SardiniaInFood/php/model/Utente.php';
    
    include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';

    include_once '/home/amm/development/SardiniaInFood/php/model/Azienda.php';
   
   

    
    
    if (session_status() != 2) session_start();
    ?>





<article>
    <h1>HOME PAGE CLIENTE</h1>
      <img src="/SardiniaInFood/images/cliente.png" alt="Smiley face" height="256" width="256"> 
</article>




<article>

 <form action="/SardiniaInFood/php/controller/ClienteController.php" method="POST">

<input type="text" name="citta" value="<?php if (isset($_POST['citta'])) echo $_POST['citta']; else echo "Dove";?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare">
                
<?php

if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
	{
	$id_attivita = $_POST['tipo_attivita_id'];
	$nome_attivita = UtenteFactory::mostraAttivita($id_attivita);
?> 
    <option value="<?php
	echo $id_attivita; ?>" ><?php
	echo $nome_attivita; ?></option>
  
<?php
	} ?> 
     
    


<?php

if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1"))
	{
    ?> <option value="-1">Cosa</option> <?php
	$attivita = UtenteFactory::mostraElencoAttivita(0);
	
	}
elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
	{
	$not_show = $_POST['tipo_attivita_id'];

	// uso la stessa funzione di prima ma invece di passare 0 (id non assegnato ad alcuna attività  )
	// passo l'id dell'attività da non mostrare (gli id 'validi' vanno da 1 in poi)
	// Lo faccio perchè le query si differenziano solo per la clausola WHERE

	$attivita = UtenteFactory::mostraElencoAttivita($not_show);
	
}
while ($row = $attivita->fetch_row())
	{ ?> 
 
            <option value="<?php
		echo $row[0]; ?>"><?php
		echo $row[1]; ?></option>
                
      <?php
	}

?>
 
 
            </select>  
          
  <input type="hidden" name="cmd" value="cercadovecosa">
  <input type="submit" value="Cerca">
</form> 
</article>

<article>
    
   <!--visualizzazione dei risultati della ricerca
   work in progress
   -->
    <?php

    
    
    //se ho dei risultati li mostra
    if (isset($_SESSION['risultati_cliente']))
	{

	// passaggio dei risultati

	$aziende = $_SESSION['risultati_cliente'];
   
 
   foreach($aziende as $azienda)
   {

       
   //di ogni risultato mostro un mini-profilo
    $nome_azienda = $azienda->getNomeAzienda();
    $citta = $azienda->getCitta();
    $indirizzo = $azienda->getIndirizzo();     
     $id_azienda = $azienda->getId();
     $id_attivita=$azienda->getTipo_attivita_id();
     
     
  //cerca a seconda dell'id attivita l'effettiva attività svolta   
  $attivita = UtenteFactory::mostraAttivita($id_attivita);

   //creazione dell'istruzione per visualizzare una
  //immagine di una specifica attività
  //con mostraAttivita ottengo:
  //-l'attività svolta
  //-il nome dell'immagine
  //-il titolo del tag img
  $url = '<img src="/SardiniaInFood/images/';
  $url .= UtenteFactory::mostraAttivita($id_attivita); //!!!!!!!uso cercaAttività e non un'altra funzione perchè altrimenti creerei sostanzialemente due funzioni identiche 
  $url .= '" alt="Immagine attivit&agrave;"';
  $url .= 'title=';
  $url .= UtenteFactory::mostraAttivita($id_attivita);
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
  
     
   
   
   
   echo "<div id='voto' title='$titolo_m'>";
		echo "<div class='voto' title='$titolo_m'>";
                echo $media_voto;
                echo '</div>';
		echo '<br />';
		echo 'Sulla base di ';
		echo $numero_voti;
		if ($media_voto >= 4) echo " voti <br />Alle persone piace questo posto";
		else
		if ($media_voto >= 3 AND $media_voto < 4) echo " <br />voti Le persone hanno pareri contrastanti su questo posto";
		else echo " voti <br />Alle persono non piace questo posto";
		
                echo '</div>';






    //nome azienda
echo '<br>';

echo "$nome_azienda";
   

    echo '<br />';
                echo '<img src="/SardiniaInFood/images/address.png" alt="indirizzo" title="indirizzo" height="16" width="16">';
		echo " $indirizzo";
		echo ' , ';
		echo $citta;
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
 $recensione= UtenteFactory::ultimaRecensione($id_azienda);
 //Recuperara valori come oggetti
while($row =$recensione->fetch_object()){
    
 echo'<img src="/SardiniaInFood/images/user.png" alt="Immagine utente" title="ultimo commento" height="16" width="16">';
  echo ' ';
echo $nome=UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
echo ' ';

    
echo "$row->data<br>$row->recensione<br><br>";
}
   echo '</div>';
   
   //entra nel profilo
    echo "<a href='/SardiniaInFood/php/controller/ClienteController.php?cmd=profileandvote&id_azienda=$id_azienda'>MAGGIORI DETTAGLI</a>";
    
  
   
   
echo '</div>';        
       
   }

    
    
        }
    ?>
     
</article>