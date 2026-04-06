<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 1 - Selección Doble</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4f8;
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
        h1 { color: #2d3748; font-size: 1.5rem; margin-bottom: 4px; }
        .subtitulo { color: #a0aec0; font-size: 0.85rem; margin-bottom: 30px; }

        .valores {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 28px;
        }
        .var-box {
            background: #ebf8ff;
            border: 2px solid #90cdf4;
            border-radius: 10px;
            padding: 14px 28px;
        }
        .var-box .label { font-size: 0.8rem; color: #2b6cb0; font-weight: bold; }
        .var-box .valor { font-size: 2rem; font-weight: bold; color: #1a365d; }

        .condicion {
            background: #fefcbf;
            border-left: 4px solid #f6e05e;
            border-radius: 8px;
            padding: 12px 18px;
            font-size: 0.95rem;
            color: #744210;
            margin-bottom: 20px;
            text-align: left;
        }
        .condicion code {
            background: #fef3c7;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
        }

        .resultado {
            border-radius: 10px;
            padding: 16px 20px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .verdadero  { background: #c6f6d5; color: #22543d; border: 2px solid #68d391; }
        .falso      { background: #fed7d7; color: #742a2a; border: 2px solid #fc8181; }
    </style>
</head>
<body>
<div class="card">
    <h1>⚖️ Selección Doble</h1>
    <p class="subtitulo">Ejemplo 1 — Estructura <strong>if...else</strong></p>

    <?php
        $a = 8;
        $b = 3;

        echo '<div class="valores">';
        echo '  <div class="var-box"><div class="label">$a</div><div class="valor">' . $a . '</div></div>';
        echo '  <div class="var-box"><div class="label">$b</div><div class="valor">' . $b . '</div></div>';
        echo '</div>';

        echo '<div class="condicion">Condición evaluada: <code>$a &lt; $b</code>  →  <code>' . $a . ' &lt; ' . $b . '</code></div>';

        if ($a < $b) {
            echo '<div class="resultado verdadero">✅ Verdadero: $a es MENOR que $b.</div>';
        } else {
            echo '<div class="resultado falso">❌ Falso: $a NO es menor que $b.</div>';
        }
    ?>
</div>
</body>
</html>
