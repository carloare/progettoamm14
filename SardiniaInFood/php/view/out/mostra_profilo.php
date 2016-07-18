<?php

include_once '../model/UtenteFactory.php';
include_once '../model/Azienda.php';
include_once '../model/Utente.php';

?>





<article>
<?php 
/*
 * in questa pagina viene mostrato il profilo di un'azienda.
 */

//cerca l'azienda usando il suo id
$azienda_to_show = UtenteFactory::cercaAziendaPerId($_REQUEST['id_azienda']); 

$nome_azienda = $azienda_to_show->getNomeAzienda();
$descrizione = $azienda_to_show->getDescrizione();
    $citta = $azienda_to_show->getCitta();
    $indirizzo = $azienda_to_show->getIndirizzo();     
     $id_azienda = $azienda_to_show->getId();
     $id_attivita=$azienda_to_show->getTipo_attivita_id();
     
     $telefono = $azienda_to_show->getTelefono();
     $email = $azienda_to_show->getEmail();
     $sitoweb =$azienda_to_show->getSitoWeb();
     
  // mostraAttivita restituisce una stringa che contiene l'attivita
		// corrispondente all'id passato.

		$attivita = UtenteFactory::mostraAttivita($id_attivita);

		// nell'istruzione sotto viene 'creata' l'immagine di una specifica attività 
		// Con la stringa restituita da mostraAttivita vado a indicare:
		// - l'attività  svolta
		// - il nome dell'immagine png contenuta nella cartella image
		// - il titolo del tag img

		$url_immagine = '<img src="/SardiniaInFood/images/';
		$url_immagine.= UtenteFactory::mostraAttivita($id_attivita);
		$url_immagine.= '" alt="Immagine attivit&agrave;"';
		$url_immagine.= 'title=';
		$url_immagine.= UtenteFactory::mostraAttivita($id_attivita);
		$url_immagine.= '>';

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
  
    //visualizzo i risultati
    echo '<div class="results">';

   echo $url_immagine; //immagine
   
   //nome azienda
echo '<br>';
    echo $nome_azienda;

    //descrizione
    echo '<br>';
    echo $descrizione;

    
    //indirizzo, citta
    echo '<br>';
      echo '<img src="/SardiniaInFood/images/address.png" alt="indirizzo" title="indirizzo" height="16" width="16">';
    echo "  $indirizzo"; echo' , '; echo $citta;
    //tipo attività
    echo '<br>';
    echo $attivita;
  
     //voto qualità prezzo
    
     echo "<div title='$titolo_qp'>";
    for($i=0; $i<$rapporto_qualita_prezzo; $i++)
    {
        echo '$';
    }
    for(; $i<5; $i++)
    {
        echo '-';
    }
    echo '</div>';
   
   //recapiti
   echo '<br>';
     echo '<img src="/SardiniaInFood/images/telephone.png" alt="telefono" title="telefono" height="16" width="16">';
    echo " $telefono"; 
     echo '  <img src="/SardiniaInFood/images/email.png" alt="email" title="email" height="16" width="16">';
    echo " $email";
    echo '  <img src="/SardiniaInFood/images/web.png" alt="sito web" title="sito web" height="16" width="16">';
    echo " $sitoweb";
   
//servizi offerti dall'azienda
    
    $result=UtenteFactory::cercaServiziAzienda($id_azienda);
  
  
   
//Recuperara valori 
while($row = $result->fetch_row()){
echo "$row[0] :";
        if($row[1]==1)
            echo " Si";
       else
           echo " No";
echo "<br>";
}
 

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   //voto medio
echo "<div class='voto' title='$titolo_m'>";
echo $media_voto;
echo "</div>";

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

    ?>
    
</article> 
