<article>
<?php 
/*
 * in questa pagina viene mostrato il profilo di un'azienda.
 */


include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/UtenteFactory.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Azienda.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Utente.php';


if (session_status() != 2) session_start();




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
    
    
    
   echo $url; //immagine
   
   //nome azienda
echo '<br>';
    echo $nome_azienda;

    //descrizione
    echo '<br>/descrizione';
    echo $descrizione;
     echo '<br>descrizione/';
    
    //indirizzo, citta
    echo '<br>';
    echo "$indirizzo"; echo' , '; echo $citta;
    //tipo attività
    echo '<br>';
    echo $attivita;
   echo ' &#8226; ';
     //voto qualità prezzo
    
     echo "<div title='$titolo_qp'>";
    for($i=0; $i<$rapporto_qualita_prezzo; $i++)
    {
        echo '$';
    }
    for(; $i<5; $i++)
    {
        echo '&#8364;';
    }
    echo '</div>';
    
    
    
    
   
   //recapiti
   echo '<br> tel:';
    echo "$telefono"; 
    echo'  email:'; 
    echo $email;
    echo '  sito web: ';
    echo $sitoweb;
   
//servizi offerti dall'azienda
    
    UtenteFactory::cercaServiziAzienda($id_azienda);
   
    
   //voto medio
echo "<div title='$titolo_m'>";
echo $media_voto;
echo "</div>";




 echo '<div class="last_comment">';
 UtenteFactory::ultimaRecensione($id_azienda);
   echo '</div>';




    
echo '</div>'; 


  
    ?>
    
</article> 
