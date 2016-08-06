<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/vota.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/rapporto_qualita_prezzo.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/preferiti.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/commenta.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/segnalazione.js"></script>

<article>
<?php 
/*
 * in questa pagina viene mostrato il profilo di un'azienda.
 */


include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/UtenteFactory.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Azienda.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Utente.php';
include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/Cliente.php';


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
     
  $attivita = UtenteFactory::mostraAttivita($id_attivita);

  
    //id_azienda in sessione per poter eseguire nelle funzioni UtenteFactory
    //corrispondenti ai servizi offerti sotto
    $_SESSION['id_azienda'] = $id_azienda;
   
    //aggiorna il numero delle visualizzazioni nella tabella Statistiche
  UtenteFactory::updateViewsAzienda();
  
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
    echo '<br>';
    echo $descrizione;
    
    
    //indirizzo, citta
    echo '<br>';
          echo '<img src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/address.png" alt="indirizzo" title="indirizzo" height="16" width="16">';

    echo "$indirizzo"; echo' , '; echo $citta;
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
        echo '&#8364;';
    }
    echo '</div>';
    
    
    
    
   
  //recapiti
   echo '<br>';
     echo '<img src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/telephone.png" alt="telefono" title="telefono" height="16" width="16">';
    echo " $telefono"; 
     echo '  <img src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/email.png" alt="email" title="email" height="16" width="16">';
    echo " $email";
    echo '  <img src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/web.png" alt="sito web" title="sito web" height="16" width="16">';
    echo " $sitoweb";
     echo "<br>";
//servizi dell'azienda
    
   $result = UtenteFactory::cercaServiziAzienda($id_azienda);
   
  
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
echo "<div title='$titolo_m'>";
echo $media_voto;
echo "</div>";



    //ultime recensioni inserite
    echo '<div class="lasts_comments">';
    
 $recensioni = UtenteFactory::cercaUltimeRecensioni($id_azienda);                                  

 
 
 
 //pe ogni risultato mostra data chi ha recensito e la recensione
while($row = $recensioni->fetch_object()) {

    echo '<div class="recensione">';
   echo'<img src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/user.png" alt="Immagine utente" title="ultimo commento" height="16" width="16">';
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
     <input type="image" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/flag.png" id="<?php echo $row->id;?>" alt="questa relazione contiene parole offensive" height="16" width="16" title="segnala" onclick ="return confirm('Conferma la segnalazione?');"> 
     <?php 
     
   echo '</div>';
       
   
   
   
   
   
   
   
}  
 
 
 
 
 echo'</div>';
   
   
   
   
 
 
 
 
 echo '<section id="hearts">';
echo "<br>";
echo "<br>";
//verifica che l'utente corrente non abbia già espresso il suo voto. 
$voto_valido = 0;

$voto_valido = UtenteFactory::votoValido();

echo $voto_valido;


echo "<br>";
if($voto_valido=='VALID') {
   
    
//rating che corrisponde al voto che si vuole dare a un'azienda
echo '<section">
<div id="vota_hearts">
        <h4>Esprimi il tuo voto</h4>
        <div class="product">         
         <div id="rating_1" class="ratings">
            
                <div class="star_1 ratings_stars" title="scarso"></div>
                <div class="star_2 ratings_stars" title="mediocre"></div>
                <div class="star_3 ratings_stars" title="sufficiente"></div>
                <div class="star_4 ratings_stars" title="buono"></div>
                <div class="star_5 ratings_stars" title="ottimo"></div>
                
            </div>
            </div>
</div>';
       
}
else
{}
echo '</section>';






 echo '<section id="qualityprice">';
echo "<br>";
echo "<br>";
//verifica che l'utente corrente non abbia già espresso il suo voto. 
$rapporto_valido = 0;

$rapporto_valido = UtenteFactory::rapportoValido();

echo $rapporto_valido;

echo "<br>";
if($rapporto_valido=='VALID') {
   
    
//rating che corrisponde al rapporto qualità prezzo che si vuole dare a un'azienda
echo '<section id="vota_dollars">
<div id= "rapporto_qualita_prezzo">
    
        <h4>Esprimi il tuo voto_qp</h4>
        <div class="product2">         
            <div id="rating_2" class="rapporto_qualita_prezzo">
                <div class="dollar_1 rapporto_qualita_prezzo_dollars" title="scarso"></div>
                <div class="dollar_2 rapporto_qualita_prezzo_dollars" title="mediocre"></div>
                <div class="dollar_3 rapporto_qualita_prezzo_dollars" title="sufficiente"></div>
                <div class="dollar_4 rapporto_qualita_prezzo_dollars" title="buono"></div>
                <div class="dollar_5 rapporto_qualita_prezzo_dollars" title="ottimo"></div>
        </div>
         </div>

</div>';
       
}
else
{}
echo '</section>';




echo '<section id="qualityprice">';
echo "<br>";
echo "<br>";
//verifica che l'utente corrente non abbia già espresso il suo voto. 
$preferito_valido = 0;

$preferito_valido = UtenteFactory::preferitoValido();

echo $preferito_valido;



echo "<br>";
if($preferito_valido=='VALID') {
//inserimente dell'azienda nella lista dei preferiti
//e aggiornamento del numero delle preferenze nella tabella
//delle Statistiche
  echo '<section id="stella">
<h4>Inserisci nella lista dei preferiti</h4>
<input id="inserisci_tra_i_preferiti" type="image" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/star.png" title = "aggiungi alla lista dei preferiti" alt="Aggiungi ai preferiti" height=32px width=32px>';
}
else
{}
echo '</section>';

  
  

    ?>
    
<!--inserimento di una recensione, commento o un'opinione riguardante l'azienda-->
 <form id="recensione">
     <h3>Voui inserire una tua recensione?</h3>
  <div>
 <textarea  name="comments"  id="comments" rows="5" cols="20" maxlength="150" title="Voui inserire una tua recensione?"></textarea>
   </div><?php if (isset($_SESSION['recensione'])) echo $_SESSION['recensione']; ?>
<input type="button" value="Invia" name="submit" id="submit"> 

                      </form>
    















</article> 
