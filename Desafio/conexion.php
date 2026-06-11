<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nombre = "desafio";

$datos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

if (!$datos) {
    echo "Error: No se pudo conectar a la base de datos " . $db_nombre . PHP_EOL;
    exit();
}
?>
