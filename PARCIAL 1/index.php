<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcial 1 </title>
</head>
<body>
    <h1>Consecionaria El Rapido 2.0</h1>

    <?php

    $concesionaria = array(
    array ("Chevrolet", "Aveo", 4700),
    array ("Chevrolet", "Sonic", 5900),
    array ("Citroen", "C3", 35000),
    array ("Fiat", "Cronos", 5600),
    array ("Ford", "Fiesta", 8700),
    array ("Toyota", "Yaris", 8100),
    array ("Volkswagen", "Gol", 6800)
    );

    $taza = 1050;

    function lista($concesionaria, $taza) {
    echo "<h2>1. Listado de todos los autos</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio Pesos</th>
                    <th>Precio Dolares</th>
                </tr>"; 
        for ($i= 0; $i < count($concesionaria); $i++) {
            echo "<tr>
                    <td>".$concesionaria[$i][0]."</td>
                    <td>".$concesionaria[$i][1]."</td>
                    <td>".$concesionaria[$i][2]."</td>
                    <td>".$concesionaria[$i][2]*$taza."</td>
                </tr>";
        }
        echo "</table>";
    }

    function barato($concesionaria, $taza) {
        echo "<h2>2. El Auto más barato</h2>";

        $barato = $concesionaria[0]; 
        for ($i = 1; $i < count($concesionaria); $i++) {
            if ($concesionaria[$i][2] < $barato[2]) {
                $barato = $concesionaria[$i];
            }
        }

        echo "<p>El auto más barato es: " . $barato[0] . " " . $barato[1] . " Pesos: " . $barato[2] . "   Dolares:" . $barato[2]*$taza . "</p>";
    }

        function superar6mil($concesionaria) {
        echo "<h2>3. Autos que no superan los $6000 Dolares</h2>";
        $cantidad= 0;
        for ($i = 0; $i < count($concesionaria); $i++) {
            if ($concesionaria[$i][2] <= 6000) {
                echo "<p>" . $concesionaria[$i][0] . " " . $concesionaria[$i][1] . " (" . $concesionaria[$i][2] . ")</p>";
                $cantidad++;
            }
        }
        echo "<p>Cantidad de autos que no superan los $6000 Dolares: " . $cantidad . "</p>";    
        }
        lista($concesionaria, $taza);
        barato($concesionaria, $taza);
        superar6mil($concesionaria);
            echo "<footer style='position: fixed; bottom: 0; width: 100%; background-color: black; color: white; padding: 10px; text-align: center;'>";
            echo "<p>Parcial 1 - Programación III - Johan Brito</p>";
            echo "</footer>";
    ?>
</body>
</html>