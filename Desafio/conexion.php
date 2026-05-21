<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nombre = "desafio";

$enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

if (!$enlace) {
    echo "Error: No se pudo conectar a la base de datos " . $db_nombre . PHP_EOL;
    exit();
}
?>
2. Proce