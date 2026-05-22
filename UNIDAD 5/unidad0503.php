<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda en Arreglos - Actividad 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >

        <?php

        function busqueda_secuencial($arr, $search) {
            for ($i = 0; $i < count($arr); $i++) {
                if ($arr[$i] == $search) {
                    return $i; 
                }
            }
            return -1; 
        }

        $numeros = array(1, 2, 4, 11, 25, 39, 78, 100, 150, 200, 250);

        $res1 = busqueda_secuencial($numeros, 389);
        echo "<p>Buscando 389: <strong>" . $res1 . "</strong></p>"; 

        $res2 = busqueda_secuencial($numeros, 11);
        echo "<p>Buscando 11: <strong>" . $res2 . "</strong></p>";

        $valorABuscar = 200;
        $res3 = busqueda_secuencial($numeros, $valorABuscar);

        echo "<p>Buscando $valorABuscar: <strong>" . $res3 . "</strong></p>";

        ?>

<footer class="mt-5 text-center text-muted">    
        <div class="container">
<span>Johan Brito</span>
        </div>
    </footer>

</body>
</html>