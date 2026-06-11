<?php
/*
 * Nombre y apellido del programador: Johan Brito
 * Fecha de desarrollo: Junio 2026
 * Materia: Programación 3 de la TSDS
 * Curso: 2da 1ra
 */

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nombre = "sistema_examenes";

$datos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

if (!$datos) {
    echo "Error: No se pudo conectar a la base de datos " . $db_nombre . PHP_EOL;
    exit();
}
?>
