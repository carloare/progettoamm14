<?php

//Classe con le credenziali per l'accesso al database

$mysqli = new mysqli("localhost", "aresuCarlo", "falco808", "amm14_aresuCarlo");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else echo "ciao";

if ($result = $mysqli->query("SELECT * FROM Servizi")) {
    $number_servizi = $result->num_rows;
    echo "Numero servizi: ".$number_servizi;
}
class Settings
{
    public static $db_host = 'localhost';
    public static $db_user = 'aresuCarlo';
    public static $db_password = 'falco808';
    public static $db_name='amm14_aresuCarlo';       
}

?>
