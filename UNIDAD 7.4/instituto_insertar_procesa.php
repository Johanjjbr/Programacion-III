<html>
<head>
    <title>Insertar Instituto</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body >
    <h1> Carga de Alumnos del Instituto </h1>
    
    <?php
    $nom = $_POST["nom"]; 
    $dni = $_POST["dni"]; 
    $cel = $_POST["cel"]; 
    $mail = $_POST["mail"]; 
    $dir = $_POST["dir"]; 

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = ""; 
    $db_nombre = "instituto";

    $datos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

    if (!$datos) {
        echo "Error: No se pudo conectar a la base de datos $db_nombre." . PHP_EOL;
        exit();
    }

    $consulta = "INSERT INTO alumno (nombre, dni, telefono, mail, direccion) 
                 VALUES ('$nom', '$dni', '$cel', '$mail', '$dir')";

    if (!mysqli_query($datos, $consulta)) {
        echo "<p>Error: La consulta sql tiene problema, verificar.</p> <br>";
        echo "<p>$consulta</p>";
        exit();
    }
    
    echo "<p> Conexión a la base de datos $db_nombre y consulta correcta. </p>";
    ?>

    <p>Se ha registrado correctamente</p>

    <table border="1" width="90%">
        <tr>
            <td>Nombre</td>
            <td>DNI</td>
            <td>Telefono</td>
            <td>Mail</td>
            <td>Dirección</td>
        </tr>
        <?php
        echo "<tr>";
        echo "<td>$nom</td>";
        echo "<td>$dni</td>";
        echo "<td>$cel</td>";
        echo "<td>$mail</td>";
        echo "<td>$dir</td>";
        echo "</tr>";

        mysqli_close($datos); 
        ?>
    </table>

    <a href="listado_instituto.php"> Ir al Listado de alumnos </a> <br>
    <a href="instituto_insertar_formulario.html"> Seguir cargando alumnos </a>

</body>
</html>