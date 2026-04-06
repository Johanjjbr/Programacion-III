<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3 - Ciclo For</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0fff4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
            padding: 40px 20px;
        }
        h1 { color: #22543d; font-size: 1.5rem; margin-bottom: 4px; text-align: center; }
        .subtitulo { color: #a0aec0; font-size: 0.85rem; margin-bottom: 10px; text-align: center; }

        .sintaxis {
            background: #1a202c;
            color: #68d391;
            border-radius: 10px;
            padding: 14px 24px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            margin-bottom: 28px;
            max-width: 420px;
            width: 100%;
            text-align: left;
        }
        .sintaxis .com { color: #718096; }
        .sintaxis .kw  { color: #f6e05e; }
        .sintaxis .val { color: #fc8181; }

        .grilla {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            max-width: 380px;
            width: 100%;
        }
        .num-box {
            background: white;
            border: 2px solid #9ae6b4;
            border-radius: 10px;
            padding: 18px 0;
            text-align: center;
            font-size: 1.6rem;
            font-weight: bold;
            color: #22543d;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .num-box:nth-child(10) {
            background: #22543d;
            color: white;
            border-color: #22543d;
        }
    </style>
</head>
<body>
    <h1>🔁 Ciclo For</h1>
    <p class="subtitulo">Ejemplo 3 — Números del 1 al 10</p>

    <div class="sintaxis">
        <span class="com">// Estructura del ciclo:</span><br>
        <span class="kw">for</span> ($i = <span class="val">1</span>; $i &lt;= <span class="val">10</span>; $i++) {<br>
        &nbsp;&nbsp;&nbsp;&nbsp;echo $i;<br>
        }
    </div>

    <div class="grilla">
        <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<div class="num-box">' . $i . '</div>';
            }
        ?>
    </div>
</body>
</html>
