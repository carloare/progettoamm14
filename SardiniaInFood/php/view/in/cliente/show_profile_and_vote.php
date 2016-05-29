<article>
<?php 
/*
 * in questa pagina viene mostrato il profilo di un'azienda.
 */


include_once '../model/UtenteFactory.php';
include_once '../model/Azienda.php';
include_once '../model/Utente.php';


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

  //creare una funzione
  
  $url = '<img src="/SardiniaInFood/images/';
  $url .=  UtenteFactory::cercaAttivita($id_attivita);  
  $url .= '" alt="Immagine attività">';

    
   //creare una funzione
  
  //test media voto 4/5
  $media_v = 4.3; 
  $media_voto=(int)$media_v;  
  
  if($media_voto>=4) $titolo_voto="Alle persone piace questo posto";
  else if($media_voto>=3 AND $media_voto<4) $titolo_voto="Le persone hanno pareri contrastanti su questo posto";
  else $titolo_voto="Alle persono non piace questo posto";
  
  //test prezzo 3/5
  $rapporto_qp = 3.1;
  $rapporto_qualita_prezzo= (int)$rapporto_qp; //prende la parte intera
  if($rapporto_qualita_prezzo>=4) $titolo_prezzo="Costoso";
  else if($rapporto_qualita_prezzo>=3 AND $rapporto_qualita_prezzo<4) $titolo_prezzo="Moderato";
  else $titolo_prezzo="Economico";
  
  
  
  
  
  
        
    //visualizzo i risultati
    echo '<div class="results">';
    
    
    
   echo $url; //immagine
   
   //nome azienda
echo '<br>';
    echo $nome_azienda;

    //descrizione
    echo '<br>';
    echo $descrizione;
    
    
    //indirizzo, citta
    echo '<br>';
    echo "$indirizzo"; echo' , '; echo $citta;
    //tipo attività
    echo '<br>';
    echo $attivita;
   echo ' &#8226; ';
     //voto qualità prezzo
    
    echo "<div title='$titolo_prezzo'>";
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
   
//servizi
    
    UtenteFactory::cercaServiziAzienda($id_azienda);
   
    
   //voto
echo "<div title='$titolo_voto'>";
echo $media_v;
echo "</div>";

    
echo '</div>';   
    ?>
    
</article> 

