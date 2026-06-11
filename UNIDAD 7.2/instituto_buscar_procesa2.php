<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1</title>
</head>
<body>
    <?php

        $dni= $_POST["dni"];
        $nombre= $_POST["nombre"];
        $direccion= $_POST["direccion"];
        $telefono= $_POST["telefono"];
        $email= $_POST["mail"];

        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "instituto";

        $datos = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        $sql = "SELECT * FROM alumno where dni = $dni";

        if (!$datos) {
            echo "Error de conexión: " . mysqli_connect_error();
        } 

    $consulta = "INSERT INTO alumno (nombre, direccion, telefono, mail, dni) VALUES ('$nombre', '$direccion', '$telefono', '$email', '$dni')";

    if (mysqli_query($datos, $consulta)) {
        echo "Nuevo registro creado exitosamente";
           echo "<table border='1'>";
                echo"<tr>";
                    echo "<th>Nombre</th>";
                    echo "<th>Direccion</th>";
                    echo "<th>Telefono</th>";
                    echo "<th>Email</th>";
                    echo "<th>DNI</th>";
                echo "</tr>";

          echo "<tr>";
                        echo "<td>" . $nombre . "</td>";
                        echo "<td>" . $direccion . "</td>";
                        echo "<td>" . $telefono . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $dni . "</td>";
                        echo "</tr>";
            echo "</table>";
    } else {
        echo "Error al crear el registro: " . mysqli_error($datos);
    }


                    mysqli_close($datos);


    


    ?>
</body>
</html>