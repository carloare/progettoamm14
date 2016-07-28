<!--home page amministratore che contiene alcune statistiche-->
<script type="text/javascript" src="/SardiniaInFood/js/eliminasfondo.js"></script>
<script type="text/javascript" src="/SardiniaInFood/js/customize-amm.js"></script>
<?php
   include_once '/home/amm/development/SardiniaInFood/php/model/UtenteFactory.php';
   ?>
<div class="page-administration">
   <h1>AMMINISTRAZIONE</h1>
   <div class="element odd">
      <div class="sx">Numero aziende registrate</div>
      <div class="dx"><?php //numero aziende registrate 
         $aziende_registrate = UtenteFactory::contaAziende(); echo $aziende_registrate;?></div>
   </div>
   <div class="element">
      <div class="sx">Numero clienti registrate</div>
      <div class="dx"><?php //numero clienti registrati
         $clienti_registrate = UtenteFactory::contaClienti(); echo $clienti_registrate;?></div>
   </div>
   <div class="element odd">
      <div class="sx">Numero totale recensioni</div>
      <div class="dx"><?php //numero commenti (il nome contaRecensioni è già stato usato)
         $numero_recensioni = UtenteFactory::contaCommenti(); echo $numero_recensioni;?> </div>
   </div>
   <div class="element">
      <div class="sx">Numero schede visualizzate</div>
      <div class="dx"> <?php //numero degli accessi alle schede delle aziende registrte
         $numero_accessi = UtenteFactory::contaVisualizzazioni(); echo $numero_accessi;?></div>
   </div>
   <div class="element odd">
      <div class="sx">Media recensioni per azienda</div>
      <div class="dx"><?php //media recensioni per azienda
         $media = $numero_recensioni/$aziende_registrate; echo number_format($media,1); ?></div>
   </div>
   <div class="element">
      <div class="sx">Media recensioni per cliente</div>
      <div class="dx"> <?php //media recensioni per cliente
         $media = $numero_recensioni/$clienti_registrate; echo number_format($media,2); ?></div>
   </div>
</div>