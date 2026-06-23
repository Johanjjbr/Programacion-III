<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
function limpiar($dato) {
    return trim(htmlspecialchars($dato));
}

function volver_principal() {
    echo '<a class="btn btn-secondary mt-3" href="../principal.php">Volver al principal</a>';
}

function mostrar_mensaje($texto, $tipo = "success") {
    if ($texto != "") {
        echo '<div class="alert alert-' . $tipo . '">' . $texto . '</div>';
    }
}

function fecha_actual() {
    return date("Y-m-d");
}
?>

