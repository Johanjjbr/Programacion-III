<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 4 - Factorial</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            padding: 40px 20px;
        }
        h1 { color: #742a2a; font-size: 1.5rem; margin-bottom: 4px; text-align: center; }
        .subtitulo { color: #a0aec0; font-size: 0.85rem; margin-bottom: 28px; text-align: center; }

        .pasos {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-width: 420px;
            width: 100%;
            margin-bottom: 24px;
        }
        .paso-row {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border-radius: 10px;
            padding: 12px 18px;
            border: 1px solid #fed7d7;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }
        .iter {
            background: #e53e3e;
            color: white;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 0.78rem;
            font-weight: bold;
            flex-shrink: 0;
        }
        .operacion {
            flex: 1;
            font-size: 0.95rem;
            color: #2d3748;
        }
        .operacion code {
            background: #fff5f5;
            color: #c53030;
            padding: 2px 6px;
            border-radius: 4px;
        }
        .parcial {
            font-weight: bold;
            color: #742a2a;
            font-size: 1rem;
        }

        .resultado-final {
            background: linear-gradient(135deg, #c53030, #e53e3e);
            color: white;
            border-radius: 14px;
            padding: 24px 40px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(229,62,62,0.3);
            max-width: 420px;
            width: 100%;
        }
        .resultado-final .formula { font-size: 0.95rem; opacity: 0.85; margin-bottom: 8px; }
        .resultado-final .numero  { font-size: 4rem; font-weight: bold; line-height: 1; }
        .resultado-final .label   { font-size: 0.8rem; opacity: 0.75; margin-top: 4px; }
    </style>
</head>
<body>
    <h1>🧮 Factorial con For</h1>
    <p class="subtitulo">Ejemplo 4 — Cálculo de 5!</p>

    <div class="pasos">
        <?php
            $numero    = 5;
            $factorial = 1;

            for ($i = $numero; $i >= 1; $i--) {
                $anterior  = $factorial;
                $factorial = $factorial * $i;

                echo '<div class="paso-row">';
                echo '  <span class="iter">i = ' . $i . '</span>';
                echo '  <span class="operacion"><code>' . $anterior . ' × ' . $i . '</code> = </span>';
                echo '  <span class="parcial">' . $factorial . '</span>';
                echo '</div>';
            }
        ?>
    </div>

    <div class="resultado-final">
        <div class="formula">5 × 4 × 3 × 2 × 1</div>
        <div class="numero"><?php echo $factorial; ?></div>
        <div class="label">5! = <?php echo $factorial; ?></div>
    </div>
</body>
</html>
