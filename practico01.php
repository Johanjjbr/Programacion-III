<?php
        echo '<h1>Actividad 1</h1> ';

        $nombre = "Johan";
        $edad = 26;
        $altura = 1.70;

        echo '<h3>Mi nombre es ' . $nombre . ' tengo ' . $edad . ' años y mido ' . $altura . ' metros.</h3>';


        echo '<h1>Actividad 2</h1> ';

        $a = 5;
        $b = 12;
        echo '<h3>Suma: ' . ($a + $b) . '</h3>'; 
        echo '<h3>Resta: ' . ($a - $b) . '</h3>';
        echo '<h3>Multiplicación: ' . ($a * $b) . '</h3>';
        echo '<h3>División: ' . ($a / $b) . '</h3>';
        echo '<h3>Resto: ' . ($a % $b) . '</h3>';


        echo '<h1>Actividad 3</h1> ';

        $a = 5;
        $b = 12;
        echo '<h3>División: ' . (int)($a / $b) . '</h3>';


        echo '<h1>Actividad 4</h1> ';

       
        $nombreP = "Monitor Gamer"; // tipo string
        $precio = 12500.50;              // tipo float [2]
        $cant = 2; 

        $total = $precio * $cant;

        echo '<h3>Producto: ' . $nombreP . '</h3>';
        echo '<h3>Precio unitario: $' . $precio . '</h3>';
        echo '<h3>Cantidad: ' . $cant . '</h3>';        

        echo '<h1>Actividad 5</h1> ';


?>
    
