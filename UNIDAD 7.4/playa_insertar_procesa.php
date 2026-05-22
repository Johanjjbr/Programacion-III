<html>
<head>
    <title>Insertar Auto - Playa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <h1> Registro de Autos en la Playa </h1>
    
    <?php
    $pat = $_POST["patente"]; 
    $h   = $_POST["horas"]; 
    $fecha   = $_POST["fecha"]; 
    $mont   = $_POST["monto"]; 

    $db_host   = "localhost";
    $db_user   = "root";
    $db_pass   = "";
    $db_nombre = "playa"; 

    $enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

    if (!$enlace) {
        echo "Error: No se pudo conectar a la base de datos $db_nombre." . PHP_EOL;
        exit();
    }

    $consulta = "INSERT INTO turno (patente, monto, horas, fecha) 
                 VALUES ('$pat', '$mont', '$h', '$fecha')";

    if (!mysqli_query($enlace, $consulta)) {
        echo "<p>Error: La consulta sql tiene problema, verificar.</p> <br>";
        echo "<p>$consulta</p>";
        exit();
    }
    
    echo "<p> Conexión a la base de datos $db_nombre y consulta correcta. </p>";
    ?>

    <p>El vehículo ha sido registrado con éxito</p>

    <table border="1" width="90%">
        <tr>
            <td>Patente</td>
            <td>Monto</td>
            <td>Horas</td>
            <td>Fecha</td>
        </tr>
        <?php
        echo "<tr>";
        echo "<td>$pat</td>";
        echo "<td>$mont</td>";
        echo "<td>$h</td>";
        echo "<td>$fecha</td>";
        echo "</tr>";

        mysqli_close($enlace); 
        ?>
    </table>

    <br>
    <a href="listado_playa.php"> Ir al Listado de autos </a> <br>
    <a href="playa_insertar_formulario.html"> Seguir registrando autos </a>

</body>
</html>