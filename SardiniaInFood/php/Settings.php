<?php

//Classe con le credenziali per l'accesso al database


$conn = mysqli_connect("localhost", "aresuCarlo", "falco808", "amm14_aresuCarlo");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else echo "ciao";


$sql = "CREATE TABLE IF NOT EXISTS `Servizi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8";

if (mysqli_query($conn, $sql)) {
    echo "Table Servizi created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

    
if ($result = mysqli_query($conn, "SELECT * FROM Servizi")) {
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
