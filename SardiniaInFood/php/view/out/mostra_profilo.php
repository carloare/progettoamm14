<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>
<?php
   include_once '../model/UtenteFactory.php';
   include_once '../model/Azienda.php';
   include_once '../model/Utente.php';
   
   /*
    * in questa pagina viene mostrato il profilo di un'azienda.
    */
   
   //cerca l'azienda usando il suo id
   $azienda_to_show = UtenteFactory::cercaAziendaPerId($_REQUEST['id_azienda']); 
   $nome_azienda = $azienda_to_show->getNomeAzienda();
   $descrizione = $azienda_to_show->getDescrizione();
   $citta = $azienda_to_show->getCitta();
   $indirizzo = $azienda_to_show->getIndirizzo(); 
   $telefono = $azienda_to_show->getTelefono();
   $email = $azienda_to_show->getEmail();
   $sitoweb =$azienda_to_show->getSitoWeb();
   
   $id_attivita=$azienda_to_show->getTipo_attivita_id();
   //cerca a seconda dell'id attivita l'effettiva attività svolta   
   $attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
   //verifica che l'azienda offra dei servizi
   $numero_servizi = UtenteFactory::verificaServiziOfferti($_REQUEST['id_azienda']);
   //cerca i servizi offerti dall'azienda
   $result = UtenteFactory::cercaServiziAzienda($_REQUEST['id_azienda']);
   //creazione del titolo della media_voto in funzione del valore di media_voto
   $media_voto=UtenteFactory::mediaVoto($_REQUEST['id_azienda']);  
   //creazione del titolo media voto
   $rapporto_qp = UtenteFactory::rapportoQP($_REQUEST['id_azienda']); 
     
   
     $titolo_m='';
     if($media_voto>=4) $titolo_m="Alle persone piace questo posto";
     else if($media_voto>=3 AND $media_voto<4) $titolo_m="Le persone hanno pareri contrastanti su questo posto";
     else $titolo_m="Alle persono non piace questo posto";
     
     //creazione del titolo rapporto_qp 
   
     
     $titolo_qp='';
     $rapporto_qualita_prezzo= (int)$rapporto_qp; //prende la parte intera
     if($rapporto_qualita_prezzo>=4) $titolo_qp="Economico";
     else if($rapporto_qualita_prezzo>=3 AND $rapporto_qualita_prezzo<4) $titolo_qp="Moderato";
     else $titolo_qp="Costoso";
     
     
     
     //ultima recensione inserita
     $recensione= UtenteFactory::ultimaRecensione($_REQUEST['id_azienda']);
     
     
     
     //numero recensioni
     $numero_recensioni = UtenteFactory::contaRecensioni($_REQUEST['id_azienda']);
       
    //conta i voti ricevuti dall'azienda 
     $numero_voti = UtenteFactory::contaVoti($_REQUEST['id_azienda']);
     
     
     //conta i voti del rapporto qualità prezzo ricevuti dall'azienda 
     $numero_voti_qp = UtenteFactory::contaVotiQP($_REQUEST['id_azienda']);
     
         //aggiorna il numero delle visualizzazioni nella tabella Statistiche
    UtenteFactory::updateViewsAzienda($_REQUEST['id_azienda']);
     
   ?>
<div id="card">
   <div class="box-img"><a href=""><img src="/SardiniaInFood/images/no_img.png" alt="" /></a></div>
   <div class="box-contacts">
      <h2><?php echo $attivita; ?></h2>
      <h1><?php echo $nome_azienda; ?></h1>
      <h6><i>Indirizzo</i></h6>
      <h3><?php echo $citta; echo ' ';echo $indirizzo; ?></h3>
      <h6><i>Telefono</i></h6>
      <p class="format"><?php echo $telefono; ?></p>
      <h6><i>Email</i></h6>
      <p class="format"><a href="#"><?php echo $email; ?></a></p>
      <h6><i>Sito Web</i></h6>
      <p class="format"><a href="#"><?php echo $sitoweb; ?></a></p>
      <h6><i>Descrizione</i></h6>
      <p class="format"><?php echo $descrizione; ?></p>
   </div>
   <div class="box-services">
      <h3>SERVIZI</h3>
      <div class="box-gray">
         <?php if($numero_servizi == 1) {?>
         <?php while($row = $result->fetch_row()) { 
            if($row[1]==1)
            {
            ?>
         <div class="service green"><?php  echo $row[0]; ?></div>
         <?php }
            else 
             {?>
         <div class="service"><?php  echo $row[0]; ?></div>
         <?php }
            } 
             ?>
         <?php } else { 
            $services =  UtenteFactory::listaServizi();
            
            while ($row = $services->fetch_row()) { ?>
         <div class="service"><?php  echo $row[1]; ?></div>
         <?php } }?>
      </div>
   </div>
   <div class="box-feedback">
      <div class="box-sx">VOTO</div>
      <?php if ($numero_voti > 0) { ?>
      <div class="box-dx" title="<?php echo $titolo_m; ?>"><?php echo number_format($media_voto,1); ?> / 5</div>
      <?php } else {?>
      <div class="box-dx" title="nessun voto ricevuto"> - / 5</div>
      <?php } ?>
   </div>
   <div class="box-feedback dx">
      <div class="box-sx">RAPPORTO QUALIT&Agrave; / PREZZO</div>
      <?php if ($numero_voti_qp > 0) { ?>            
      <div class="box-dx dx"title="<?php echo $titolo_qp; ?>"><?php echo number_format($rapporto_qp,1); ?> / 5</div>
      <?php } else {?>
      <div class="box-dx dx"title="nessun voto ricevuto"> - / 5</div>
      <?php } ?>
   </div>
   <div class="box-reviews">
      <?php if( $numero_recensioni > 0 ) { ?>
      <h3>ULTIMA RECENSIONE DI <?php echo $numero_recensioni; ?></h3>
      <div class="box-gray">
         <div class="review">
            <?php  while($row =$recensione->fetch_object()){ ?>
            <div class="userplusdate">
               <?php echo $nome=UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername(); ?> 
               &bull; 
               <?php echo $row->data; ?>
            </div>
            <div class="text">
               <p><?php echo $row->recensione; ?></p>
               <?php }?>
            </div>
         </div>
         <?php } 
            if( $numero_recensioni == 0 ) { ?>
         <h3>ULTIMA RECENSIONE</h3>
         <div class="review">
            <div class="userplusdate">
            </div>
            <div class="text">
               <i>nessuna recensione inserita</i> 
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
</div>