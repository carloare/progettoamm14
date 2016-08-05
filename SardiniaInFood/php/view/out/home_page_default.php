<!--home_page_default è la pagina di default a cui si accede all'avvio dell'applicazione.
è sostanzialmente divisa in due parti: la prima è un form che permette di fare una ricerca
fra tutte le aziende registrate in SardiniaInFood, la seconda contiene gli eventuali risultati
della ricerca-->
<?php
   include_once '../model/Utente.php';
   include_once '../model/UtenteFactory.php';
   include_once '../model/Azienda.php';

if (session_status() != 2)
    session_start();

   ?>
<div id="box-form-home">
   <h1 class="white">
      Sardinia in food
   </h1>
   <p class="center white">
      Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il capo vedeva il suo ventre arcuato, bruno e diviso in tanti segmenti ricurvi, in cima a cui la coperta da letto, vicina a scivolar giù tutta, si manteneva a fatica.
   </p>
   <!--form di ricerca tra tutte le aziende iscritte in SardiniaInFood-->
   <div class="form-home">
      <form action="/SardiniaInFood/php/controller/BaseController.php" method="POST">
         <input type="text" name="citta" onfocus="this.value=''" value="<?php if(isset($_POST['citta'])) { echo $_POST['citta']; } else { echo "Dove";} ?> " 
            title="inserisci il luogo dove fare la ricerca" size="24">      
         <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare">
            <?php
               //dopo aver fatto la submit, mostra l'elemento selezionato della select come "primo elemento" visibile
               if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1")) {
               	$id_attivita = $_POST['tipo_attivita_id'];
               	$nome_attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
               ?> 
            <option value="<?php echo $id_attivita; ?>" > <?php	echo $nome_attivita; ?></option>
            <?php
               } 
               //mostra tutte le attività selezionabili dentro la select
               if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1")) {
               ?> 
            <option value="-1">Cosa</option>
            <?php 
                //listaAttivita(0) mostra tutte le attività (0 è un id non assegnato ad alcuna attività)
                $attivita = UtenteFactory::listaAttivita(0);
               }
               //dopo aver fatto la submit, vengono mostrate tutte le attività tranne quella appena selezionata
               elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1")) {
               	$not_show = $_POST['tipo_attivita_id'];
               	//listaAttivita($not_show) mostra tutte le attività tranne quella con id uguale a $not_show                
               	$attivita = UtenteFactory::listaAttivita($not_show);
               }
               while ($row = $attivita->fetch_row()) { ?>  
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php
               }
               ?>            
         </select>
         <input type="hidden" name="cmd" value="cercadovecosa">
         <input type="submit" value="CERCA">
      </form>
   </div>
</div>


<?php 
         
//se ci sono stati dei risultati nella ricerca con il form fatto sopra
   if (isset($_SESSION['risultati']) AND $_SESSION['risultati'] != 'ZERO') {    
   //passaggio dei risultati
   
   	$aziende = $_SESSION['risultati'];        
        //di ogni risultato viene mostrato un mini-profilo con alcune statistiche     
        foreach($aziende as $azienda)
            { ?>
<div class="preview-card">
   <?php
       //creazione mini-profilo
       $nome_azienda = $azienda->getNomeAzienda(); 
       $citta = $azienda->getCitta();
       $indirizzo = $azienda->getIndirizzo();     
       $id_azienda = $azienda->getId();
       //ricerca numero di visualizzazioni
       $visualizzazioni=UtenteFactory::numeroVisualizzazioni($id_azienda); 
       $id_attivita=$azienda->getTipo_attivita_id(); 
       //cerca l'effettiva attività svolta dall'azienda  
       $attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
       //media voto
       $media_voto=UtenteFactory::mediaVoto($id_azienda);  
       //media voto del rapporto qualità / prezzo
       $rapporto_qp = UtenteFactory::rapportoQP($id_azienda); 
       //numero recensioni
       $numero_recensioni = UtenteFactory::contaRecensioni($id_azienda);
       //numero voti per voto e rapporto qualità / prezzo
       $numero_voti = UtenteFactory::numeroVoti($id_azienda);
       $numero_voti_qp = UtenteFactory::numeroVotiQP($id_azienda);
       //titolo che sintetizza il voto ricevuto
       if($numero_voti>0)
       {
      $titolo_m="";
      if($media_voto>=4) $titolo_m.=" Alle persone piace questo posto";
      else if($media_voto>=3 AND $media_voto<4) $titolo_m.=" Le persone hanno pareri contrastanti su questo posto";
      else $titolo_m.=" Alle persono non piace questo posto";
       }
       else
       {
           $titolo_m="Non ha ricevuto nessun voto";
       }  
       //titolo che sintetizza il voto ricevuto
       if($numero_voti_qp>0)
       {
      $titolo_qp="";   
      if($rapporto_qp>=5) $titolo_qp.=" economico";
      else if($rapporto_qp>=3 AND $rapporto_qp<4) $titolo_qp.=" moderato";
      else $titolo_qp.= " costoso";
       }
       else
       {
           $titolo_qp="Non ha ricevuto nessun voto";
       }
               ?>      
    
    
    <!--mini-profilo-->
   <div class="box-img"><a href=""><img src="/SardiniaInFood/images/no_img.png" alt="Immagine azienda" /></a></div>
   <div class="box-text">
      <h2><?php echo $attivita; ?></h2>
      <h3><a href="/SardiniaInFood/php/controller/BaseController.php?cmd=profilo&id_azienda=<?php echo $id_azienda; ?>"><?php echo $nome_azienda; ?></a></h3>
      <h3><?php echo $citta; echo ' ';echo $indirizzo; ?></h3>
      <div class="box-statistiche">
         <div class="visualizzazioni">VISUALIZZAZIONI: <?php echo $visualizzazioni; ?></div>
         <div class="recensioni">RECENSIONI: <?php echo $numero_recensioni; ?></div>
         <div class="media-voto" title="<?php echo $titolo_m; ?>">MEDIA VOTO: <?php if($numero_voti>0) { echo $media_voto; } else { echo "-"; } ?> / 5</div>
         <div class="rapporto-qualita-prezzo" title="<?php echo $titolo_qp; ?>">RAPPORTO QUALIT&Agrave; PREZZO: <?php if($numero_voti_qp>0) { echo $rapporto_qp; } else { echo "-"; } ?> / 5</div>
      </div>
      <a class="readmore" href='/SardiniaInFood/php/controller/BaseController.php?cmd=profilo&id_azienda=<?php echo $id_azienda; ?>' >+ DETTAGLI</a>
   </div>
</div>
<?php  
   }
   }
   ?>
