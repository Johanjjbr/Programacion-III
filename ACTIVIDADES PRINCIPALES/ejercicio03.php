<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 03</title>
   
</head>
<body>


<?php
    $nombre   = "Johan Brito";
    $materia  = "Programación III";
    $ano     = 2026;
    $promedio = 8.5;

    echo '
    <div>
        <h3>Nombre del alumno</h3>
        <p>' . $nombre . '</p>
    </div>';

    echo '
    <div>
        <h3>Materia</h3>
        <p>' . $materia . '</p>
    </div>';

    echo '
    <div>
        <h3>Año lectivo</h3>
        <p>' . $ano . '</p>
    </div>';

    echo '
    <div>
        <h3>Promedio actual</h3>
        <p>' . $promedio . '</p>
    </div>';

    echo '
    <div >
        <h3>Frase completa</h3>
        <p>' . $nombre . ' cursa ' . $materia . ' en el año ' . $ano . '.</p>
    </div>';
?>

</body>
</html>
