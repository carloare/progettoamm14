<?php
   include_once 'ViewDescriptor.php';
   include_once basename(__DIR__) . '/../Settings.php';
   ?> 
<!DOCTYPE html>
<html lang="it">
   <head>
      <meta html-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>
         <?php echo $vd->getTitolo() ?>
      </title>
      <meta name="author" content="Carlo Aresu">
      <meta name="keywords" content="ProgettoAMM AMM SardiniaInFood">
      <meta name="description" content="pagina master di SardiniaInFood">
      <link rel="stylesheet" type="text/css" href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/css/fogliodistile.css">
      <script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
      <script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/menu-responsive.js"></script>
      <link rel="icon" href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/images/favicon.png" sizes="16x16" type="image/png">
   </head>
   <body>
      <div class="fullbackgroundimage home"></div>
      <div id="top-header">
         <div class="container clearfix">
             
             
            <ul class="main-menu-top">
               <?php    
             
               //azienda, amministratore o un cliente che non è bannato
               if (isset($_SESSION['visible_logout']) AND (($_SESSION['visible_logout']==0) OR ($_SESSION['visible_logout']==1) OR ($_SESSION['visible_logout']==2)))
                {
               ?>                
               <li>
                  <a href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/?page=0&logout" title="Logout" >LOGOUT</a>
               </li>
               <?php }
               //altrimenti
                    else { ?>
               <li>
                  <a href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/?page=2" title="Login clienti" >LOGIN</a>
               </li>
               <li>
                  <a href="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/php/?page=1" title="Iscriviti" >ISCRIVITI</a>
               </li>
              <?php } ?>
            </ul>
         </div>
      </div>
      
      
      <header id="header">
         <div class="container clearfix">
            <div id="logo">
               <?php
                  $logo = $vd->getLogoFile();
                  require "$logo";
                   ?>
            </div>
            <nav id="nav">
               <div id="mobnav-btn"></div>
               <ul class="main-menu">
                  <?php
                     $menu = $vd->getMenuFile();
                     require "$menu";
                      ?>
               </ul>
            </nav>
         </div>
      </header>
      
      
      <section id="wrapper-content">
         <div class="container clearfix">
            <?php
               $content = $vd->getContentFile();
               require "$content";
                ?>
            <?php
               $error = $vd->getErrorFile();
               require "$error";
                ?>
         </div>
      </section>
      
      
      <?php
             
         if (!(isset($_GET['page']))) { $_GET['page'] = 1000;}         
                   
         if((isset($_GET['page']) AND ($_GET['page']==0) AND ($_GET['page']!=1000)) || (isset($_SESSION['visible_logout']) AND ($_SESSION['visible_logout']==2)))
         { ?>
      <footer id="footer">
      <?php } 
         else
         { ?>
      <footer id="footer" class="no-fixed">
         <?php } ?>
         <div class="container clearfix">
            <?php $content=$vd->getFooterFile(); require "$content"; ?>
            <ul class="main-menu-footer right">
               <li>
                  <a class="validCSS3" href="http://validator.w3.org/check/referer" class="xhtml" title="Questa pagina contiene HTML valido"></a>
               </li>
               <li>
                  <a class="validHTML5"  href="http://jigsaw.w3.org/css-validator/check/referer" class="css" title="Questa pagina ha CSS validi"></a>
               </li>
            </ul>
         </div>
      </footer>
   </body>
</html>
