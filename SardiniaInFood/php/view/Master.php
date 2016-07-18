<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta html-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        <?= $vd->getTitolo() ?></title>
    <meta name="author" content="Carlo Aresu">
    <meta name="keywords" content="ProgettoAMM AMM SardiniaInFood">
    <meta name="description" content="pagina master di SardiniaInFood">
    <link href="../css/stile.css" rel="stylesheet" type="text/css">


</head>

<body>
    <div id="page">
        
        <header> 
            <div id="header">
                <div id="logo">
                    <?php $logo=$vd->getLogoFile(); require "$logo"; ?>
                </div>
            </div>
        </header>
        
        <div id="nav">
            <div id="menu">
                <?php $menu=$vd->getMenuFile(); require "$menu"; ?>
            </div>
        </div>
        
        <div id="content">
            <?php $content=$vd->getContentFile(); require "$content"; ?>
            <?php $error=$vd->getErrorFile(); require "$error"; ?>
        </div>
        
        <footer> 
            <div id="footer">
                <div id="nav_footer">
                    <div id="footer_menu">
                        <?php $content=$vd->getFooterFile(); require "$content"; ?>
                    </div>
                </div>
                <div class="validator">
                    <p id="validator">
                        <a href="http://validator.w3.org/check/referer" class="xhtml" title="Questa pagina contiene HTML valido">
                    HTML Valido                    
                    </a>
                        <a href="http://jigsaw.w3.org/css-validator/check/referer" class="css" title="Questa pagina ha CSS validi">
                    CSS Valido                    
                    </a>
                    </p>
                </div>
            </div>
        </footer>
        
    </div>
</body>

</html>

