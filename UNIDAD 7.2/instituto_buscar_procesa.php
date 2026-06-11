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

        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "instituto";

        $datos = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        $sql = "SELECT * FROM alumno where dni = $dni";
        $resultado = mysqli_query($datos, $sql);

        if (!$datos) {
            echo "Error de conexión: " . mysqli_connect_error();
        } 


          if(mysqli_num_rows($resultado) == 0){
        echo "<h1>No se encontraron resultados para la patente ingresada</h1>";
    } else {


            echo "<table border='1'>";
                echo"<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Direccion</th>";
                    echo "<th>Telefono</th>";
                    echo "<th>Email</th>";
                    echo "<th>DNI</th>";
                echo "</tr>";

            while ($row = mysqli_fetch_row($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $row[0] . "</td>";
                        echo "<td>" . $row[1] . "</td>";
                        echo "<td>" . $row[2] . "</td>";
                        echo "<td>" . $row[3] . "</td>";
                        echo "<td>" . $row[4] . "</td>";
                        echo "<td>" . $row[5] . "</td>";
                        echo "</tr>";
                    }
            echo "</table>";

                    mysqli_free_result($resultado);
                    mysqli_close($datos);


    }


    ?>
</body>
</html>