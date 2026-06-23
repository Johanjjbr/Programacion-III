<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
session_start();

if (!isset($_SESSION["id_usuario"])) {
    $login = (strpos($_SERVER["SCRIPT_NAME"], "/modulos/") !== false) ? "../login.html" : "login.html";
    header("Location: " . $login);
    exit;
}

function solo_administrativo() {
    if ($_SESSION["perfil"] != "Administrativo") {
        header("Location: ../principal.php");
        exit;
    }
}
?>
