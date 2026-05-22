<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda en Arreglos - Actividad 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >

    <div >
        <h1>Búsqueda Secuencial</h1>

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
        echo "<p>Buscando 389 (no existe): <strong>" . $res1 . "</strong></p>"; 

        $res2 = busqueda_secuencial($numeros, 11);
        echo "<p>Buscando 11 (índice original): <strong>" . $res2 . "</strong></p>";

        $valorABuscar = 200;
        $res3 = busqueda_secuencial($numeros, $valorABuscar);

        echo "<p class='alert alert-success'>Buscando el nuevo valor ($valorABuscar). El resultado en <strong>\$res3</strong> es el índice: <strong>" . $res3 . "</strong></p>";
        ?>
    </div>

    <footer class="footer mt-auto py-3 bg-dark text-white text-center">
        <div class="container">
            <span>Johan Brito | Materia: Programación III</span>
        </div>
    </footer>

</body>
</html>