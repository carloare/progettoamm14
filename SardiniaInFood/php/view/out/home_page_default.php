<!-- WORK IN PROGRESS -->
<?php
include_once '/home/amm/development/SardiniaInFood/php/model/Utente.php';

include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';

include_once '/home/amm/development/SardiniaInFood/php/model/Azienda.php';

if (session_status() != 2) session_start();



?>

<article>
    

    

<form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">

<input type="text" name="citta" value="<?php

if (isset($_POST['citta']))
{
	echo $_POST['citta'];
}
else
{
	echo "Dove";
} ?> " 
       title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
  
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare">
                
<?php

// rientro dopo il submit, mostra l'attività selezionata

if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
{
	$id_attivita = $_POST['tipo_attivita_id'];
	$nome_attivita = UtenteFactory::mostraAttivita($id_attivita);
?> 
    <option value="<?php
	echo $id_attivita; ?>" > <?php
	echo $nome_attivita; ?></option>
  
<?php
} ?> 



<?php

// alla prima, mostra tutte le attività 

if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1"))
{
?> <option value="-1">Cosa</option> <?php
	$attivita = UtenteFactory::mostraElencoAttivita(0);
	
}

// quando viene selezionato qualcosa, devono essere mostrate tutte le attività tranne quella selezionata

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
    

    <?php

// se ho dei risultati li mostra

if (isset($_SESSION['risultati']) AND $_SESSION['risultati'] != 'ZERO')
{

	// passaggio dei risultati

	$aziende = $_SESSION['risultati'];

	// di ogni risultato mostro un mini-profilo

	foreach($aziende as $azienda)
	{
		$nome_azienda = $azienda->getNomeAzienda();
		$citta = $azienda->getCitta();
		$indirizzo = $azienda->getIndirizzo();
		$id_azienda = $azienda->getId();
		$id_attivita = $azienda->getTipo_attivita_id();

		// mostraAttivita restituisce una stringa che contiene l'attivita
		// corrispondente all'id passato.

		$attivita = UtenteFactory::mostraAttivita($id_attivita);

		// nell'istruzione sotto viene 'creata' l'immagine di una specifica attività 
		// Con la stringa restituita da mostraAttivita vado a indicare:
		// - l'attività   svolta
		// - il nome dell'immagine png contenuta nella cartella image
		// - il titolo del tag img

		$url_immagine = '<img src="/SardiniaInFood/images/';
		$url_immagine.= UtenteFactory::mostraAttivita($id_attivita);
		$url_immagine.= '" alt="Immagine attivit&agrave;"';
		$url_immagine.= 'title=';
		$url_immagine.= UtenteFactory::mostraAttivita($id_attivita);
		$url_immagine.= '>';

		// creazione del title di media_voto in funzione del valore di media_voto presente nelle statistiche

		$media_voto = UtenteFactory::mediaVotoInStatistiche($id_azienda);
		$numero_voti = UtenteFactory::numeroVoti($id_azienda);
		$titolo_m = "";
		$titolo_m.= $media_voto;
		$titolo_m.= " / 5 ";
		if ($media_voto >= 4) $titolo_m.= " Alle persone piace questo posto";
		else
		if ($media_voto >= 3 AND $media_voto < 4) $titolo_m.= " Le persone hanno pareri contrastanti su questo posto";
		else $titolo_m.= " Alle persono non piace questo posto";

		// creazione del title di rapporto_qp in funzione del valore di rapporto_qp presente nelle statistiche

		$rapporto_qp = UtenteFactory::rapportoQualitaPrezzoInStatistiche($id_azienda);
		$numero_voti_qp = UtenteFactory::numeroVotiQualitaPrezzo($id_azienda);
		$titolo_qp = "";
		$titolo_qp.= $rapporto_qp;
		$titolo_qp.= " / 5 ";
		$rapporto_qualita_prezzo = (int)$rapporto_qp; //prende la parte intera
		if ($rapporto_qualita_prezzo >= 4) $titolo_qp.= " Costoso";
		else
		if ($rapporto_qualita_prezzo >= 3 AND $rapporto_qualita_prezzo < 4) $titolo_qp.= " Moderato";
		else $titolo_qp.= " Economico";

		// visualizzazione dei risultati

		echo '<div class="results">';

		// immagine

		echo $url_immagine;

		// voto medio

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

		// nome azienda

		echo '<br />';
		echo "<div class='info_generali'>";

		// nome dell'azienda

		echo "$nome_azienda";

		// indirizzo, città

		echo '<br />';
                echo '<img src="/SardiniaInFood/images/address.png" alt="indirizzo" title="indirizzo" height="16" width="16">';
		echo " $indirizzo";
		echo ' , ';
		echo $citta;

		// tipo attività

		echo '<br />';
		echo $attivita;
		echo "</div>";

		// rapporto qualità  prezzo

		echo "<div class='rapporto_qp' title='$titolo_qp' >";
		for ($i = 0; $i < $rapporto_qualita_prezzo; $i++)
		{
			echo '$';
		}

		for (; $i < 5; $i++)
		{
			echo '-';
		}

		echo '<br />';
		echo 'Sulla base di ';
		echo $numero_voti_qp;
		if ($rapporto_qualita_prezzo >= 4) echo " voti <br />Le persone ritengono che sia costoso";
		else
		if ($rapporto_qualita_prezzo >= 3 AND $media_voto < 4) echo " voti <br />Le persone ritengono che sia moderato";
		else echo " voti <br />Le persone ritengono che sia economico";
		echo '</div>';
		echo "<br /><br />";

		// numero visualizzazioni

		echo "<div class='visualizzazioni'>";
		echo '<input type="image" src="/SardiniaInFood/images/view.png" alt="numero visualizzazioni" height="16" width="16" title="numero visualizzazioni">';
		$visualizzazioni = UtenteFactory::numeroVisualizzazioni($id_azienda);
		echo $visualizzazioni;
		echo '</div>';

		// ultima recensione scritta

		echo '<div class="ultima_recensione">';
		$recensione = UtenteFactory::ultimaRecensione($id_azienda);

		// conta il numero di righe restituite

		$rowcount = mysqli_num_rows($recensione);

		// se non ho ancora recensioni

		if ($rowcount == 0)
		{
			echo 'Non ha ricevuto nessun commonto';
		}
		else
		{ //se ho almeno una recensione
			while ($row = $recensione->fetch_object())
			{
				echo '<img src="/SardiniaInFood/images/user.png" alt="Immagine utente" title="ultimo commento" height="16" width="16">';
				echo ' ';
				echo $nome = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
				echo ' ';
				echo "$row->data<br />$row->recensione<br /><br />";
			}
		}

		echo '</div>';
		echo "<a href='/SardiniaInFood/php/controller/BaseController.php?cmd=profile&id_azienda=$id_azienda'>MAGGIORI DETTAGLI</a>";
		echo '</div>';
	}
}

// se non ci sono risultati ($_SESSION['risultati']==ZERO)

else
{
}

?>
     
</article>

<?php
