<!--mostra_preferiti è la pagina che contiene la lista dei preferiti di un cliente.
è sostanzialmente divisa in due parti: la prima è un form che permette di filtrare i preferiti, 
la seconda contiene i preferiti-->
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/cancella_dai_preferiti.js"></script>
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<?php if (session_status() != 2) session_start();?>
<?php

   //salva l'utente corrente
   $id_cliente = $_SESSION['current_user']->getId();  
      
   if(isset($_SESSION['risultati_cliente_preferiti']) AND $_SESSION['risultati_cliente_preferiti']!='ZERO')
   {
   //il cliente effettua un filtro tra le aziende preferite
   $aziende_preferite = $_SESSION['risultati_cliente_preferiti'];
   }
   if(!isset($_SESSION['risultati_cliente_preferiti']) AND !isset($_SESSION['errore']))
   {
   //appena entrato nella pagina vengono visualizzate, se ci sono, tutte le aziende preferite
   $citta = "UNDEFINE";
   $tipo_attivita_id = -1;
   $aziende_preferite = UtenteFactory::cercaAziendePreferite($tipo_attivita_id, $citta);
   }   
   if(isset($aziende_preferite) AND $aziende_preferite=='ZERO')
   {
   //se il cliente non ha dei preferiti viene mostrato un messaggio
   $_SESSION['errore'] = 7;
   }
   
   ?>

<div id="box-form-preferiti">
   <h1 class="white">
      Filtra tra i preferiti
   </h1>
   <p class="center white">
      Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il capo vedeva il suo ventre arcuato, bruno e diviso in tanti segmenti ricurvi, in cima a cui la coperta da letto, vicina a scivolar giù tutta, si manteneva a fatica.
   </p>
     <div class="form-ricerca">
      <form action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/ClienteController.php" method="POST">
         <input type="text" name="citta_preferiti" value="<?php if (isset($_POST['citta_preferiti'])) echo $_POST['citta_preferiti']; else echo "Dove"; ?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
         <select name="tipo_attivita_id_preferiti" id="tipo_attivita_id_preferiti" title="scegli il tipo di attivit&agrave; che vuoi cercare">
            <?php
               //dopo aver fatto la submit, mostra l'elemento selezionato della select come "primo elemento" visibile
               if ((isset($_POST['tipo_attivita_id_preferiti'])) AND ($_POST['tipo_attivita_id_preferiti'] != "-1")) {
               	$id_attivita = $_POST['tipo_attivita_id_preferiti'];
               	$nome_attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
               ?> 
            <option value="<?php echo $id_attivita; ?>" > <?php	echo $nome_attivita; ?></option>
            <?php
               } 
               ///mostra tutte le attività selezionabili dentro la select
               if ((!isset($_POST['tipo_attivita_id_preferiti'])) OR ($_POST['tipo_attivita_id_preferiti'] == "-1")) {
               ?> 
            <option value="-1">Cosa</option>
            <?php $attivita = UtenteFactory::listaAttivita(0);
               }
               //listaAttivita(0) mostra tutte le attività (0 è un id non assegnato ad alcuna attività)
               elseif ((isset($_POST['tipo_attivita_id_preferiti'])) AND ($_POST['tipo_attivita_id_preferiti'] != "-1")) {
               	$not_show = $_POST['tipo_attivita_id_preferiti'];
                //listaAttivita($not_show) mostra tutte le attività tranne quella con id uguale a $not_show  
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
      </form>
   </div>
</div>

<?php
if(isset($aziende_preferite) AND !isset($_SESSION['errore']))
{
   foreach($aziende_preferite as $azienda_preferita)
   { //per ogniuna delle aziende inserite nella lista dei preferiti
    ?>
<div class="preview-card no-trasparent">
   <?php
      //creazione di un mini-profilo
       $nome_azienda = $azienda_preferita->getNomeAzienda(); 
       $citta = $azienda_preferita->getCitta();
       $indirizzo = $azienda_preferita->getIndirizzo();     
       $id_azienda = $azienda_preferita->getId();
       //ricerca numero di visualizzazioni
       $visualizzazioni=UtenteFactory::numeroVisualizzazioni($id_azienda); 
       $id_attivita=$azienda_preferita->getTipo_attivita_id(); 
       //cerca l'effettiva attività svolta dall'azienda   
       $attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
       ///media voto
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
   <div id=profile<?php echo $id_azienda; ?> >
      <div class="box-img"><a href=""><img src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/no_img.png" alt="" /></a></div>
      <div class="box-text">
         <h3><?php echo $attivita; ?></h3>
         <h1><?php echo $nome_azienda; ?></h1>
         <h3><?php echo $citta; echo ' ';echo $indirizzo; ?></h3>
         <div class="box-statistiche">
            <div class="visualizzazioni">VISUALIZZAZIONI: <?php echo $visualizzazioni; ?></div>
            <div class="recensioni">RECENSIONI: <?php echo $numero_recensioni; ?></div>
            <div class="media-voto" title="<?php echo $titolo_m; ?>">MEDIA VOTO: <?php if($numero_voti>0) {echo $media_voto;} else {echo "-";} ?> / 5</div>
            <div class="rapporto-qualita-prezzo" title="<?php echo $titolo_qp; ?>">RAPPORTO QUALIT&Agrave; PREZZO: <?php if($numero_voti_qp>0) { echo $rapporto_qp;} else {echo "-";} ?> / 5</div>
         </div>
         <!--bottone per la cancellazione dalla lista dei preferiti-->
         <div><input type="image" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/cancel.png" id="<?php echo $id_azienda;?>" class="cancella-preferito" alt="cancella dai preferiti" height="38" width="38" title="Cancella dai preferiti" />
         </div>
      </div>
   </div>
</div>
<?php    
   //azzero il filtro
   $tipo_attivita_id = NULL;
   $citta = NULL;
   }
   }
   ?>

