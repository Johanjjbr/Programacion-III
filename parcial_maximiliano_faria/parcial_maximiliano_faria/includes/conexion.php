<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
$servidor = "localhost";
$usuario_db = "root";
$clave_db = "";
$base = "parcial_n2_2026";

$conexion = mysqli_connect($servidor, $usuario_db, $clave_db, $base);

if (!$conexion) {
    die("Error de conexion: " . mysqli_connect_error());
}
?>

