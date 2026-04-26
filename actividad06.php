<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actividad 6</title>
</head>
<body>
    <?php
    function contenido($sabores) {
        $cantidadFilas = count($sabores);
        for($i = 0; $i < $cantidadFilas; $i++) {
            echo "<p><mark> Fila numero $i </mark></p>";
            echo "<ul>";
            for ($j = 0; $j < 3; $j++) {
                echo "<li>" . $sabores[$i][$j] . "</li>";
            }
            echo "</ul>";
        }
    }

    function helado_BuscarMenor ($sabores){
    $menor = $sabores[0][1];
    $sabormenor = $sabores[0][0];
    for ($i =0; $i < count($sabores); $i++){
        if ($sabores[$i][1]<$menor){
            $menor = $sabores[$i][1];
            $sabormenor = $sabores[$i][0];
        }
    }
    echo "<p>El menor stock es: <strong>" . $sabormenor . "</strong> con un stock de:" . $menor . " </p>";
    }

    

    echo "<p>Fecha: ". date("Y-m-d h:i:sa") ."</p>";


    $sabores= array(
        array("Frutilla", 100, 170),
        array("Chocolate", 120, 200),   
        array("Dulce de Leche", 110, 190),
        array("Vainilla", 90, 150),
    );
echo "<table border='1'>";

echo "<tr><th>Sabor</th><th>En Stock</th><th>Vendido</th></tr>";
    echo "<tr><td>" . $sabores[0][0] . "</td><td>" . $sabores[0][1] . "</td><td>" . $sabores[0][2] . "</td></tr>";
    echo "<tr><td>" . $sabores[1][0] . "</td><td>" . $sabores[1][1] . "</td><td>" . $sabores[1][2] . "</td></tr>";
    echo "<tr><td>" . $sabores[2][0] . "</td><td>" . $sabores[2][1] . "</td><td>" . $sabores[2][2] . "</td></tr>";
    echo "<tr><td>" . $sabores[3][0] . "</td><td>" . $sabores[3][1] . "</td><td>" . $sabores[3][2] . "</td></tr>";
    
echo "</table>";
echo "<br>";


    contenido($sabores);
    helado_BuscarMenor($sabores);
    
    ?>

    <footer class="footer mt-auto py-3 bg-dark text-white text-center">
        <p> Johan Brito | Programacion III | 2do 1ra </p>
    </footer>
</body>
</html>