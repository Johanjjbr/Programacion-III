<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 03 - Sintaxis Básica PHP</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #1a202c;
            color: #e2e8f0;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
        }
        h1 {
            text-align: center;
            color: #68d391;
            font-size: 1.6rem;
            margin-bottom: 4px;
        }
        .subtitulo {
            text-align: center;
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 36px;
        }
        .bloque {
            background: #2d3748;
            border-radius: 10px;
            padding: 20px 24px;
            margin: 14px auto;
            max-width: 520px;
            border-left: 4px solid #68d391;
        }
        .bloque h3 {
            margin: 0 0 8px 0;
            color: #68d391;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .bloque p {
            margin: 0;
            font-size: 1.05rem;
            color: #e2e8f0;
        }
        .tag {
            display: inline-block;
            background: #276749;
            color: #9ae6b4;
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>⚙️ Sintaxis Básica de PHP</h1>
<p class="subtitulo">Actividad N° 2 — Ejercicio 03</p>

<?php
    // Variables simples
    $nombre   = "Juan Pérez";
    $materia  = "Programación Web";
    $anio     = 2025;
    $promedio = 8.5;

    echo '
    <div class="bloque">
        <span class="tag">Variable $nombre</span>
        <h3>Nombre del alumno</h3>
        <p>' . $nombre . '</p>
    </div>';

    echo '
    <div class="bloque">
        <span class="tag">Variable $materia</span>
        <h3>Materia</h3>
        <p>' . $materia . '</p>
    </div>';

    echo '
    <div class="bloque">
        <span class="tag">Variable $anio</span>
        <h3>Año lectivo</h3>
        <p>' . $anio . '</p>
    </div>';

    echo '
    <div class="bloque">
        <span class="tag">Variable $promedio</span>
        <h3>Promedio actual</h3>
        <p>' . $promedio . '</p>
    </div>';

    // Concatenación
    echo '
    <div class="bloque">
        <span class="tag">Concatenación con "."</span>
        <h3>Frase completa</h3>
        <p>' . $nombre . ' cursa ' . $materia . ' en el año ' . $anio . '.</p>
    </div>';
?>

</body>
</html>
