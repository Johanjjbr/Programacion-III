<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
session_start();
require_once "includes/conexion.php";
require_once "includes/funciones.php";

$usuario = limpiar($_POST["usuario"] ?? "");
$clave = limpiar($_POST["clave"] ?? "");

$sql = "SELECT * FROM usuarios WHERE usuario = ? AND clave = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "ss", $usuario, $clave);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$fila = mysqli_fetch_assoc($resultado);

if ($fila) {
    $_SESSION["id_usuario"] = $fila["id_usuario"];
    $_SESSION["nombre_completo"] = $fila["nombre_completo"];
    $_SESSION["perfil"] = $fila["perfil"];
    header("Location: principal.php");
    exit;
}

header("Location: login.html");
exit;
?>

