<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 2 - Selección Simple</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f3ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            border-radius: 14px;
            padding: 40px 50px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            max-width: 460px;
            width: 100%;
            text-align: center;
        }
        h1 { color: #44337a; font-size: 1.5rem; margin-bottom: 4px; }
        .subtitulo { color: #a0aec0; font-size: 0.85rem; margin-bottom: 30px; }

        .paso {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #f3f0ff;
            border-radius: 10px;
            padding: 14px 18px;
            margin: 10px 0;
            text-align: left;
        }
        .num {
            background: #6b46c1;
            color: white;
            border-radius: 50%;
            width: 30px; height: 30px;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 0.9rem;
            flex-shrink: 0;
        }
        .paso p { margin: 0; color: #2d3748; font-size: 0.95rem; }
        .paso code {
            background: #e9d8fd;
            color: #553c9a;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .flecha { font-size: 1.4rem; color: #b794f4; margin: 4px 0; }

        .resultado-final {
            background: linear-gradient(135deg, #6b46c1, #9f7aea);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-top: 16px;
        }
        .resultado-final .etiqueta { font-size: 0.8rem; opacity: 0.8; margin-bottom: 4px; }
        .resultado-final .numero   { font-size: 3rem; font-weight: bold; }
    </style>
</head>
<body>
<div class="card">
    <h1>🔢 Selección Simple</h1>
    <p class="subtitulo">Ejemplo 2 — Estructura <strong>if</strong></p>

    <?php
        $nro = 10;

        echo '<div class="paso">';
        echo '  <div class="num">1</div>';
        echo '  <p>Valor inicial: <code>$nro = ' . $nro . '</code></p>';
        echo '</div>';
        echo '<div class="flecha">↓</div>';

        echo '<div class="paso">';
        echo '  <div class="num">2</div>';
        echo '  <p>Condición evaluada: <code>$nro &gt; 0</code>  →  <code>' . $nro . ' &gt; 0</code> ✅ Verdadero</p>';
        echo '</div>';
        echo '<div class="flecha">↓</div>';

        if ($nro > 0) {
            $nro = $nro + 100;

            echo '<div class="paso">';
            echo '  <div class="num">3</div>';
            echo '  <p>El número es positivo → se le suma 100: <code>$nro = $nro + 100</code></p>';
            echo '</div>';
            echo '<div class="flecha">↓</div>';

            echo '<div class="resultado-final">';
            echo '  <div class="etiqueta">Resultado final de $nro</div>';
            echo '  <div class="numero">' . $nro . '</div>';
            echo '</div>';
        }
    ?>
</div>
</body>
</html>
