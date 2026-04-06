<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 04 - Comando ECHO</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fffbf0;
            margin: 0;
            padding: 40px 20px;
        }
        h1 {
            text-align: center;
            color: #744210;
            font-size: 1.7rem;
            margin-bottom: 6px;
        }
        .subtitulo {
            text-align: center;
            color: #975a16;
            font-size: 0.9rem;
            margin-bottom: 36px;
        }
        .contenedor {
            max-width: 560px;
            margin: 0 auto;
        }
        .msg {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: white;
            border: 1px solid #fbd38d;
            border-radius: 10px;
            padding: 16px 20px;
            margin: 12px 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        .icono {
            font-size: 1.5rem;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .msg p {
            margin: 0;
            color: #2d3748;
            font-size: 1rem;
            line-height: 1.5;
        }
        .msg small {
            display: block;
            color: #a0aec0;
            font-size: 0.78rem;
            margin-bottom: 4px;
        }
        .seccion {
            text-align: center;
            color: #dd6b20;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 28px 0 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
    // ============================================================
    // EJERCICIO 04 — Todos los mensajes usando exclusivamente ECHO
    // ============================================================

    echo '<h1>📢 Mensajes con ECHO</h1>';
    echo '<p class="subtitulo">Actividad N° 3 — Ejercicio 04</p>';
    echo '<div class="contenedor">';

    // --- Bloque 1: Mensajes de presentación ---
    echo '<p class="seccion">Presentación</p>';

    echo '<div class="msg">';
    echo '<span class="icono">👋</span>';
    echo '<div><small>echo N° 1</small><p>¡Bienvenido a mi página web en PHP!</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">👤</span>';
    echo '<div><small>echo N° 2</small><p>Mi nombre es Juan Pérez.</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">🏫</span>';
    echo '<div><small>echo N° 3</small><p>Estoy cursando el 3° año de la carrera de Programación.</p></div>';
    echo '</div>';

    // --- Bloque 2: Datos de la materia ---
    echo '<p class="seccion">Datos académicos</p>';

    echo '<div class="msg">';
    echo '<span class="icono">📚</span>';
    echo '<div><small>echo N° 4</small><p>Materia: Programación Web.</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">📅</span>';
    echo '<div><small>echo N° 5</small><p>Año lectivo: 2025.</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">🧑‍🏫</span>';
    echo '<div><small>echo N° 6</small><p>Docente a cargo: Prof. García.</p></div>';
    echo '</div>';

    // --- Bloque 3: Mensajes informativos ---
    echo '<p class="seccion">Sobre PHP</p>';

    echo '<div class="msg">';
    echo '<span class="icono">🐘</span>';
    echo '<div><small>echo N° 7</small><p>PHP es un lenguaje de programación del lado del servidor.</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">💡</span>';
    echo '<div><small>echo N° 8</small><p>El comando ECHO permite mostrar texto o HTML en la página.</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">🔤</span>';
    echo '<div><small>echo N° 9</small><p>Podemos usar comillas simples o dobles con ECHO.</p></div>';
    echo '</div>';

    echo '<div class="msg">';
    echo '<span class="icono">✅</span>';
    echo '<div><small>echo N° 10</small><p>¡Ejercicio completado exitosamente!</p></div>';
    echo '</div>';

    echo '</div>'; // cierre .contenedor
?>

</body>
</html>
