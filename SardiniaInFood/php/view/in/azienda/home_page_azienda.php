<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<?php
   include_once '/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/model/UtenteFactory.php';
   ?>
<?php 
   if (session_status() != 2) session_start();
   $azienda = $_SESSION['current_user'];
   ?>
<section id="wrapper-content">
   <div class="container clearfix">
      <div id="company">
         <h1><?php echo $azienda->getNomeAzienda(); ?></h1>
         <div class="box-user-interaction">
            <div class="box-user-activity preferiti">
               <h2>PREFERITI</h2>
               <p>
                  <?php
                     //numero preferneze
                       $preferenze = UtenteFactory::contaPreferenze();
                       echo $preferenze;
                       
                      ?>  
               </p>
            </div>
            <div class="box-user-activity views">
               <h2>VIEWS</h2>
               <p>
                  <?php
                     $id_azienda = $azienda->getId();
                     //numero visualizzazioni
                     $views = UtenteFactory::numeroVisualizzazioni($id_azienda);
                     echo $views;
                     ?>       
               </p>
            </div>
            <div class="box-user-activity votoazienda">
               <h2>VOTO</h2>
               <p>
                  <?php
                     //nella tabella Voti vado a ricercare tutti i voti dati per una stessa azienda
                        $giudizio = UtenteFactory::mediaVoto($id_azienda);    
                     if($giudizio==0)
                     {
                        
                            echo '-';
                            
                     }
                     else
                     {
                       
                     echo $giudizio;
                      
                     }
                     echo ' / 5';
                     
                     ?>                  
               </p>
            </div>
            <div class="box-user-activity rapportoqualitaprezzo">
               <h2>QUALIT&Agrave; / PREZZO</h2>
               <p><?php
                  //nella tabella Voti vado a ricercare tutti i voti dati per una stessa azienda
                     $giudizio = UtenteFactory::rapportoQP($id_azienda);
                     if($giudizio==0)
                  {
                     
                         echo ' -';
                   
                  }
                  else
                  {
                     echo $giudizio;
                   
                  }
                  echo ' / 5';
                  ?></p>
            </div>
         </div>
         <?php         
            //conta il numero delle recensioni
            $numero_recensioni = UtenteFactory::contaRecensioni($id_azienda);
            
            $commenti_per_pagina = 10;
            
            $pagine_totali = ceil($numero_recensioni/10);
            
            $pagina_corrente=(!(isset($_REQUEST['pagex'])) ? 1 : (int)$_REQUEST['pagex']);
            
            $primo = ($pagina_corrente - 1) * $commenti_per_pagina;
            
            ?>
         <div id="top-recensioni" class="box-reviews">
            <h3><?php echo $numero_recensioni; ?> RECENSIONI</h3>
            <?php
               $risultati=UtenteFactory::showRecensioni($id_azienda, $primo, $commenti_per_pagina);
                  
               while($row = $risultati->fetch_object()) {
               
                   ?>
            <div class="box-gray">
               <div class="review">
                  <div class="userplusdate">
                     <?php $name = UtenteFactory::cercaClientePerId($row->id_clienti)->getUsername();
                        echo $name; ?> &bull; <?php echo $data= $row->data; ?> 
                  </div>
                  <div class="text">
                     <p>
                        <?php
                           $recensione= $row->recensione;
                           echo $recensione;
                           ?>
                     </p>
                  </div>
               </div>
            </div>
            <?php
               }
               ?>
            <br><br>
            <div id="paginazione" class="showcase_pagination">
               <?php
                  if($commenti_per_pagina>0 AND $pagine_totali>0 )
                  {
                  //link delle pagine
                  for($pagina=1; $pagina<=$pagine_totali; $pagina++)
                  {
                      if($pagina_corrente==$pagina)
                      {
                          ?> 
               <div id="current-page"><?php echo $pagina; ?></div>
               <?php
                  }
                  else
                  {                      
                  ?>
               <form class="bottom-pagination" action="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/controller/AziendaController.php#top-recensioni" method="POST">
                  <input type="hidden" name="cmd" value="showrecensioni">
                  <input type="hidden" name="pagex" value="<?php echo $pagina; ?>">
                  <div class="other-page"><input type="submit" value="<?php echo $pagina; ?>"></div>
               </form>
               <?php    
                  }
                  }
                  }        
                  ?>
            </div>
         </div>
      </div>
   </div>
</section>
