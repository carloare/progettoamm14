<?php
include_once 'ViewDescriptor.php';

include_once '/home/amm/development/SardiniaInFood/php/Settings.php';

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta html-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        <?php echo $vd->getTitolo() ?></title>
    <meta name="author" content="Carlo Aresu">
    <meta name="keywords" content="ProgettoAMM AMM SardiniaInFood">
    <meta name="description" content="pagina master di SardiniaInFood">
  <!--  <link rel="stylesheet" type="text/css" href="http://localhost/SardiniaInFood/css/fogliodistile.css">-->
  <link rel="stylesheet" type="text/css" href="http://localhost/SardiniaInFood/css/stile.css">
        <script type="text/javascript" src="http://localhost/SardiniaInFood/js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="http://localhost/SardiniaInFood/js/menu-responsive.js"></script>
</head>

<body>
    <div class="fullbackgroundimage home"></div>

<div id="top-header">
    
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
           
                <?php
$menu = $vd->getMenuFile();
require "$menu";
 ?>
           
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
            
            
 <footer id="footer">
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
