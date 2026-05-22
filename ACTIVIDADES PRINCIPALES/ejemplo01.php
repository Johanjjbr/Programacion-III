<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 1</title>
   
</head>
<body>
<div class="card">

    <?php
        $a = 8;
        $b = 3;

        if ($a < $b) {
            echo '<div>Verdadero: $a es MENOR que $b.</div>';
        } else {
            echo '<div>Falso: $a NO es menor que $b.</div>';
        }
    ?>
</div>
</body>
</html>
