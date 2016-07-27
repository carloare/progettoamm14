<script type="text/javascript" src="/SardiniaInFood/js/vota.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/rapporto_qualita_prezzo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/aggiungi_ai_preferiti.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/commenta.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/segnalazione.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>


    <?php
    /*
     * in questa pagina viene mostrato il profilo di un'azienda.
     */


    include_once '../model/UtenteFactory.php';
    include_once '../model/Azienda.php';
    include_once '../model/Utente.php';
    include_once '../model/Cliente.php';


    if (session_status() != 2)
        session_start();


    $current_id = $_SESSION['current_user']->getId();

//cerca l'azienda usando il suo id
    $azienda_to_show = UtenteFactory::cercaAziendaPerId($_REQUEST['id_azienda']);

    $nome_azienda = $azienda_to_show->getNomeAzienda();
    $descrizione = $azienda_to_show->getDescrizione();
    $citta = $azienda_to_show->getCitta();
    $indirizzo = $azienda_to_show->getIndirizzo();

    $telefono = $azienda_to_show->getTelefono();
    $email = $azienda_to_show->getEmail();
    $sitoweb = $azienda_to_show->getSitoWeb();


    $id_attivita = $azienda_to_show->getTipo_attivita_id();
    //cerca a seconda dell'id attivita l'effettiva attività svolta   
    $attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
    //verifica che l'azienda offra dei servizi
    $numero_servizi = UtenteFactory::verificaServiziOfferti($_REQUEST['id_azienda']);
    //cerca i servizi offerti dall'azienda
    $result = UtenteFactory::cercaServiziAzienda($_REQUEST['id_azienda']);



    //creazione del titolo della media_voto in funzione del valore di media_voto
    $media_voto = UtenteFactory::mediaVoto($_REQUEST['id_azienda']);


    //creazione del titolo media voto

    $rapporto_qp = UtenteFactory::rapportoQP($_REQUEST['id_azienda']);



    $titolo_m = '';
    if ($media_voto >= 4)
        $titolo_m = "Alle persone piace questo posto";
    else if ($media_voto >= 3 AND $media_voto < 4)
        $titolo_m = "Le persone hanno pareri contrastanti su questo posto";
    else
        $titolo_m = "Alle persono non piace questo posto";

    //creazione del titolo rapporto_qp 


    $titolo_qp = '';
    if ($rapporto_qp >= 4)
        $titolo_qp = "Economico";
    else if ($rapporto_qp >= 3 AND $rapporto_qp < 4)
        $titolo_qp = "Moderato";
    else
        $titolo_qp = "Costoso";





    //recensioni
    $recensioni = UtenteFactory::ultimeRecensioni($_REQUEST['id_azienda']);



    //numero recensioni
    $numero_recensioni = UtenteFactory::contaRecensioni($_REQUEST['id_azienda']);

    //conta i voti ricevuti dall'azienda 
    $numero_voti = UtenteFactory::contaVoti($_REQUEST['id_azienda']);

    if($numero_voti==0) {$titolo_m = 'nessun voto ricevuto';}
    

    //conta i voti del rapporto qualità prezzo ricevuti dall'azienda 
    $numero_voti_qp = UtenteFactory::contaVotiQP($_REQUEST['id_azienda']);

    if($numero_voti_qp==0) {$titolo_qp = 'nessun voto ricevuto';}
    
    
    //aggiorna il numero delle visualizzazioni nella tabella Statistiche
    UtenteFactory::updateViewsAzienda($_REQUEST['id_azienda']);

//verfica che l'utente non abbia già votato
    $voto_valido = UtenteFactory::votoValido($_REQUEST['id_azienda']); 
    
    $rapporto_valido = UtenteFactory::rapportoValido($_REQUEST['id_azienda']);
    
    //verifica che l'azienda non sia già stata inserita nella lista dei preferiti
    //in tal caso non visualizza l'immagine del pulsante
    $preferito_valido = 0;

$preferito_valido = UtenteFactory::preferitoValido($_REQUEST['id_azienda']);
    
   // $_SESSION['id_azienda']=$_REQUEST['id_azienda'];
    
    
    $current_id = $_SESSION['current_user']->getId();
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
          
         
          
          <?php if($preferito_valido=='VALID') { ?>
          
          
          <div id="bottone-preferiti<?php echo $_REQUEST['id_azienda']; ?>">
         <div class="bottone-preferiti">
             <input type="button" value = "AGGIUNGI AI PREFERITI" alt="Aggiungi ai preferiti" id="<?php echo $_REQUEST['id_azienda']; ?>" />
          </div>
              
          </div>
          <?php } else {} ?>
          
          
          <div class="box-services">
              
             <h3>SERVIZI</h3>
           
            <div class="box-gray">
            
             <?php if($numero_servizi == 1) { ?>
                
             <?php while($row = $result->fetch_row()) { 
                 
              if($row[1]==1) { ?>
                
              <div class="service green"><?php  echo $row[0]; ?></div>   
              
              <?php } 
              
              if($row[1]==0) {  ?>
              
                <div class="service"><?php  echo $row[0]; ?></div>  
                
              <?php } 
              
              } 
              
              } 
            
            if($numero_servizi == 0) { 
                
              $services =  UtenteFactory::listaServizi(); ?>
             
            
             
                 <?php  while ($row = $services->fetch_row()) { ?>
              
               <div class="service"><?php  echo $row[1]; ?></div>
               
              <?php } }?>
               
               
             
             </div>
             
          </div>
          
          
          <div class="box-feedback">
   
              
              <div class="box-sx">VOTO</div>
   
              
              <div class="box-dx" title="<?php echo $titolo_m; ?>"><?php if($numero_voti != 0) { echo number_format($media_voto, 1);} else {echo '-';} ?> / 5</div>
              
       
    <?php  if($voto_valido=='VALID') { ?>
   <!--rating che corrisponde al voto che si vuole dare a un'azienda-->
   <div class="box-byrating">
      <div id="vota_hearts">
         <div class="product">
            <div id="rating_1" class="ratings">
               <div class="star_1 ratings_stars" title="scarso"></div>
               <div class="star_2 ratings_stars" title="mediocre"></div>
               <div class="star_3 ratings_stars" title="sufficiente"></div>
               <div class="star_4 ratings_stars" title="buono"></div>
               <div class="star_5 ratings_stars" title="ottimo"></div>
            </div>
         </div>
      </div>
       </div>
      <?php }
         else
         {}  ?>
   
</div>
          
          
        <div class="box-feedback dx">
            
                            <div class="box-sx">RAPPORTO QUALIT&Agrave; / PREZZO</div>
                                                  
              <div class="box-dx dx" title="<?php echo $titolo_qp; ?>"><?php if($numero_voti_qp != 0) { echo number_format($rapporto_qp, 1);} else {echo '-';} ?> / 5</div>
              
            
<?php 


if($rapporto_valido=='VALID') { ?>
                    <!--rating che corrisponde al voto che si vuole dare a un'azienda-->
                    
                    
                    <div class="box-byrating dx">
                  
                        <div id= "rapporto_qualita_prezzo">
    
        
        <div class="product2">         
            <div id="rating_2" class="rapporto_qualita_prezzo">
                <div class="dollar_1 rapporto_qualita_prezzo_dollars" title="scarso"></div>
                <div class="dollar_2 rapporto_qualita_prezzo_dollars" title="mediocre"></div>
                <div class="dollar_3 rapporto_qualita_prezzo_dollars" title="sufficiente"></div>
                <div class="dollar_4 rapporto_qualita_prezzo_dollars" title="buono"></div>
                <div class="dollar_5 rapporto_qualita_prezzo_dollars" title="ottimo"></div>
        </div>
         </div>
</div>
</div>
<?php }
else
{} ?>
                        
                        
            
                    
                    
                    
                    
            </div> 

          
          
           <div class="box-reviews">
            <?php if( $numero_recensioni > 0 ) { ?>
              
              
            <h3><?php echo $numero_recensioni; ?> RECENSIONI</h3>
       
            <div class="box-gray">
                
                <?php  while($row =$recensioni->fetch_object()){ ?>
                
              <div class="review">
               
                <div class="userplusdate">
                    
                  <?php echo $nome=UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername(); ?> 
                    &bull; 
                        <?php echo $row->data; ?>
                </div>
                <div class="text">
                  <p><?php echo $row->recensione; ?></p> 
                </div>
                  
                  
                  
                   <?php     
      if($current_id!=$row->id_clienti)//non permettere a un cliente di segnalare un proprio messaggio
    {
     ?><!--se la recensione conetiene messaggi offensivi può essere segnalata con il flag
     la segnalazione va nella funzione "segnalazione" qui sotto che aggiorna
     la tabella Recensioni e la tabella Segnalazioni-->
     
     
     <?php 
    
     $id_recensione= $row->id; $segnalato = UtenteFactory::segnalato($id_recensione, $current_id);
 
   if($segnalato==0) {?>
     
     <div id="<?php echo $row->id; ?>">
     <input type="image" src="/SardiniaInFood/images/flag.png" id="<?php echo $row->id;?>" alt="questa relazione contiene parole offensive" height="24" width="24" title="segnala questa recensione" onclick ="return confirm('Conferma la segnalazione?');"> 
     </div>
     
         <?php } else {}
    }          ?>    
                </div>
                 <?php    }?>
                  
                  
                  
              
               </div>

            
            <?php } 
            
            if( $numero_recensioni == 0 ) { ?>
            
            <h3>RECENSIONI</h3>
            <div class="review">
                <div class="userplusdate">
                    
                 
                </div>
                <div class="text">
                  <i>nessuna recensione inserita</i> 
                </div>
              </div>
              <?php } ?>
                
                
                <!--inserimento di una recensione, commento o un'opinione riguardante l'azienda-->
 
                
                
                
              <div class="write-a-review">
                <h3>SCRIVI UNA RECENSIONE</h3>
                <i>Gli autori dei commenti, e non SardiniaInFood, sono responsabili dei contenuti da loro inseriti</i>
                
               <!--inserimento di una recensione, commento o un'opinione riguardante l'azienda-->
 <form id="recensione">
    
  <div>
 <textarea  name="comments"  id="comments" rows="5" cols="20" maxlength="150" title="Voui inserire una tua recensione?"></textarea>
  <?php if (isset($_SESSION['recensione'])) echo $_SESSION['recensione']; ?> </div>
     <div>
<span><input type="button" value="INVIA RECENSIONE" name="submit" id="submit"></span>
     </div>
</form>
                
                
                
              </div>
           
          </div> 
 </div> 
