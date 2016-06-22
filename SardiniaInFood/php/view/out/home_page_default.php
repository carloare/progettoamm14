<article>

 <form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">

<input type="text" name="citta" value="<?php if (isset($_POST['citta'])) echo $_POST['citta']; else echo "Dove";?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attività">
                
<?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 1)) { ?> <option value="1" selected>Agriturismo</option><?php } ?> 
    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 2)) { ?> <option value="2" selected>American Bar</option><?php } ?>
        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 3)) { ?> <option value="3" selected>Bar Caff&egrave;</option><?php } ?> 
            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 4)) { ?> <option value="4" selected>Birreria</option><?php } ?>
                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 5)) { ?> <option value="5" selected>Bistrot</option><?php } ?>
                    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 6)) { ?> <option value="6" selected>Fast Food</option><?php } ?> 
                        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 7)) { ?> <option value="7" selected>Gelateria</option><?php } ?>
                            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 8)) { ?> <option value="8" selected>Osteria</option><?php } ?> 
                                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 9)) { ?> <option value="9" selected>Pasticceria</option><?php } ?>
                                    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 10)) { ?> <option value="10" selected>Pizzeria</option><?php } ?>
                                        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 11)) { ?> <option value="11" selected>Pub</option><?php } ?> 
                                            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 12)) { ?> <option value="12" selected>Ristorante</option><?php } ?>
                                                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 13)) { ?> <option value="13" selected>Self Service</option><?php } ?> 
                                                    <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 14)) { ?> <option value="14" selected>Snack Bar</option><?php } ?>
                                                        <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 15)) { ?> <option value="15" selected>Take Away</option><?php } ?>
                                                            <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 16)) { ?> <option value="16" selected>Trattoria</option><?php } ?> 
                                                                <?php if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] == 17)) { ?> <option value="17" selected>Altro</option><?php } ?> 
                                                                    <?php if (!isset($_POST['tipo_attivita_id'])) { ?><option value="-1">Cosa</option><?php } ?>
                    
                <option value="-1">Tutto</option>
                <option value="1">Agriturismo</option> 
                <option value="2">American Bar</option>
                <option value="3">Bar Caff&egrave;</option>
                <option value="4">Birreria</option>
                <option value="5">Bistrot</option>
                <option value="6">Fast Food</option>
                <option value="7">Gelateria</option>
                <option value="8">Osteria</option>
                <option value="9">Pasticceria</option>
                <option value="10">Pizzeria</option>
                <option value="11">Pub</option>
                <option value="12">Ristorante</option>
                <option value="13">Self Service</option>
                <option value="14">Snack Bar</option>
                <option value="15">Tack Away</option>
                <option value="16">Trattoria</option>
                <option value="17">Altro</option>
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
    
   echo $_SERVER["REQUEST_URI"];
    
    
    include_once 'model/Utente.php';
    
    include_once 'model/UtenteFactory.php';

    include_once 'model/Azienda.php';
   
   

    
    
    if (session_status() != 2) session_start();

    
     
    //pulizia dei risultati cliente
$_SESSION['risultati_cliente'] = NULL; 





//analisi dei risultati del form cercaDoveCosa
    if(isset($_SESSION['risultati']))
    {
    
  $aziende = new Azienda();
        
   //passaggio dei risultati
  $aziende= unserialize($_SESSION['risultati']);

 
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
  $url = '<img src="/SardiniaInFood/images/';
  $url .= UtenteFactory::cercaAttivita($id_attivita); //!!!!!!!uso cercaAttività e non un'altra funzione perchè altrimenti creerei sostanzialemente due funzioni identiche 
  $url .= '" alt="Immagine attività">';

 
  //creazione del titolo della media_voto in funzione del valore di media_voto
  //test media voto 4/5
  $media_voto=4;  
  
  if($media_voto>=4) $titolo="Alle persone piace questo posto";
  else if($media_voto>=3 AND $media_voto<4) $titolo="Le persone hanno pareri contrastanti su questo posto";
  else $titolo="Alle persono non piace questo posto";
  
  //creazione del titolo rapporto_qp in funzione del valore di rapporto_qp
  //test prezzo 3/5
  $rapporto_qp = 3.1;
  $rapporto_qualita_prezzo= (int)$rapporto_qp; //prende la parte intera
  if($rapporto_qualita_prezzo>=4) $titolo_prezzo="Costoso";
  else if($rapporto_qualita_prezzo>=3 AND $rapporto_qualita_prezzo<4) $titolo_prezzo="Moderato";
  else $titolo_prezzo="Economico";
  
   
    //visualizzo i risultati
    echo '<div class="results">';
    
    
    
   echo $url; //immagine
   
   //voto
   echo "<div class='voto' title='$titolo'";
echo '<p>5.9</p>';
echo '</div>';






    //nome azienda
echo '<br>';
    echo "<a  href='/SardiniaInFood/php/controller/BaseController.php?cmd=profile&id_azienda=$id_azienda'>$nome_azienda</a>";

    //indirizzo, citta
    echo '<br>';
    echo "$indirizzo"; echo' , '; echo $citta;
    //tipo attività
    echo '<br>';
    echo $attivita;
    
    //voto qualità prezzo
    echo ' &#8226; ';
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
    
    ?>
         
   <?php echo "<br><br>";
     
echo '</div>';        
       
   }

    }

    ?>
     
</article>
