<!--terza parte della registrazione di una nuova azienda.
Permette di selezionare tutti gli eventuali servizi offerti-->
<script type="text/javascript" src="http://spano.sc.unica.it/amm2014/aresuCarlo/SardiniaInFood/js/eliminasfondo.js"></script>
<div id="box-form">
    <h1 class="white">
        Registrazione nuova azienda
    </h1>
    <h3 class="white" >
        Spunta i servizi offerti
    </h3>
    <div>
        <div class="form-generic">
            <form action="/home/amm/repoAmm/amm2014/aresuCarlo/SardiniaInFood/php/controller/BaseController.php" method="POST">
                <?php $servizi = UtenteFactory::listaServizi();
                while ($row = $servizi->fetch_row()) {
                    ?>
                    <input type="checkbox" name="servizi[]" value="<?php echo $row[0]; ?>" /><span class="submitrec" ><?php echo $row[1]; ?></span><br>       
<?php } ?>
                <input type="hidden" name="cmd" value="registrazione_azienda">
                <input type="hidden" name="part" value="3">
                <input class="submitrec" type="submit" value="ISCRIVITI">
            </form>
        </div>
    </div>
</div>
