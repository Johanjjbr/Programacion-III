<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3 - Ciclo For</title>
  
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
