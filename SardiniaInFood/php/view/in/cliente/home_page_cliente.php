<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>

<?php 
    
    include_once '/home/amm/development/SardiniaInFood/php/model/Utente.php';
    
    include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';

    include_once '/home/amm/development/SardiniaInFood/php/model/Azienda.php';
   
   
    if (session_status() != 2) session_start();
    ?>


 




<div id="box-form-cliente">
<h1 class="white">

  <?php  $nome_completo= $_SESSION['current_user']->getNomeCompleto();?>
    <?php echo 'Benvenuto '. $nome_completo; ?>

</h1>
<p class="center white">

    Gregorio Samsa, svegliandosi una mattina da sogni agitati, si trovò trasformato, nel suo letto, in un enorme insetto immondo. Riposava sulla schiena, dura come una corazza, e sollevando un poco il capo vedeva il suo ventre arcuato, bruno e diviso in tanti segmenti ricurvi, in cima a cui la coperta da letto, vicina a scivolar giù tutta, si manteneva a fatica.
</p>


<!--article che riguarda la ricerca-->
<div class="form-cliente">   

 <form action="/SardiniaInFood/php/controller/ClienteController.php" method="POST">

<input type="text" name="citta" value="<?php if (isset($_POST['citta'])) echo $_POST['citta']; else echo "Dove";?> " title="inserisci il luogo dove fare la ricerca" size="24" onFocus="this.value=''">    
        
 <select name="tipo_attivita_id" id="tipo_attivita_id" title="scegli il tipo di attivit&agrave; che vuoi cercare">
                
<?php

if ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
	{
	$id_attivita = $_POST['tipo_attivita_id'];
	$nome_attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);
?> 
    <option value="<?php
	echo $id_attivita; ?>" ><?php
	echo $nome_attivita; ?></option>
  
<?php
	} ?> 
     
    


<?php

if ((!isset($_POST['tipo_attivita_id'])) OR ($_POST['tipo_attivita_id'] == "-1"))
	{
    ?> <option value="-1">Cosa</option> <?php
	$attivita = UtenteFactory::listaAttivita(0);
	
	}
elseif ((isset($_POST['tipo_attivita_id'])) AND ($_POST['tipo_attivita_id'] != "-1"))
	{
	$not_show = $_POST['tipo_attivita_id'];

	// uso la stessa funzione di prima ma invece di passare 0 (id non assegnato ad alcuna attività  )
	// passo l'id dell'attività da non mostrare (gli id 'validi' vanno da 1 in poi)
	// Lo faccio perchè le query si differenziano solo per la clausola WHERE

	$attivita = UtenteFactory::listaAttivita($not_show);
	
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
</div>
</div>

    
    
 
    
   <!--visualizzazione dei risultati della ricerca
   work in progress
   -->
    <?php

    
    
    //se ho dei risultati li mostra
    if (isset($_SESSION['risultati_cliente']) AND $_SESSION['risultati_cliente'] != 'ZERO')
	{

	// passaggio dei risultati

	$aziende = $_SESSION['risultati_cliente'];
   
 
     foreach($aziende as $azienda)
         {?>
<div class="preview-card no-trasparent">
        <?php
       
   //di ogni risultato mostro un mini-profilo
    $nome_azienda = $azienda->getNomeAzienda(); 
    $citta = $azienda->getCitta();
    $indirizzo = $azienda->getIndirizzo();     
    $id_azienda = $azienda->getId();
    $visualizzazioni=UtenteFactory::numeroVisualizzazioni($id_azienda); 
    $id_attivita=$azienda->getTipo_attivita_id(); 


    //cerca a seconda dell'id attivita l'effettiva attività svolta   
    $attivita = UtenteFactory::mostraAttivitaSelezionata($id_attivita);

    //creazione del titolo della media_voto in funzione del valore di media_voto
    $media_voto=UtenteFactory::mediaVoto($id_azienda);  
    $rapporto_qp = UtenteFactory::rapportoQP($id_azienda); 
    $numero_recensioni = UtenteFactory::contaRecensioni($id_azienda);
    
    $numero_voti = UtenteFactory::numeroVoti($id_azienda);
    $numero_voti_qp = UtenteFactory::numeroVotiQP($id_azienda);
    
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
            
             
          <div class="box-img"><a href=""><img src="/SardiniaInFood/images/no_img.png" alt="" /></a></div>
          <div class="box-text">
            <h2><?php echo $attivita; ?></h2>
            <h3><a href="/SardiniaInFood/php/controller/ClienteController.php?cmd=profileandvote&id_azienda=<?php echo $id_azienda; ?>"><?php echo $nome_azienda; ?></a></h3>
            <h3><?php echo $citta; echo ' ';echo $indirizzo; ?></h3>
            <div class="box-statistiche">
              <div class="visualizzazioni">VISUALIZZAZIONI: <?php echo $visualizzazioni; ?></div>
              <div class="recensioni">RECENSIONI: <?php echo $numero_recensioni; ?></div>
              <div class="media-voto" title="<?php echo $titolo_m; ?>">MEDIA VOTO: <?php echo $media_voto; ?> / 5</div>
              <div class="rapporto-qualita-prezzo" title="<?php echo $titolo_qp; ?>">RAPPORTO QUALIT&Agrave; PREZZO: <?php echo $rapporto_qp; ?> / 5</div>
            </div>
            <a class="readmore" href='/SardiniaInFood/php/controller/ClienteController.php?cmd=profileandvote&id_azienda=<?php echo $id_azienda; ?>'>+ DETTAGLI</a>
          </div>
        </div>
            
          <?php  
         }
}
?>
     
