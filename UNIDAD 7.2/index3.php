<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3</title>
</head>
<body>
    <?php
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "supermercado";

        $datos = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        $sql = "SELECT * FROM alumno";
        $resultado = mysqli_query($datos, $sql);

        if (!$datos) {
            echo "Error de conexión: " . mysqli_connect_error();
        } else {
            echo "Conexión exitosa a la base de datos Supermercado";
            echo "<p>informacion del host: " . mysqli_get_host_info($datos) . "</p>";

        }

        mysqli_close($datos);

echo "<table border='1'>";
    echo"<tr>";
        echo "<th>ID</th>";
        echo "<th>Horas</th>";
        echo "<th>Fecha</th>";
        echo "<th>Monto</th>";
        echo "<th>Patente</th>";
    echo "</tr>";

while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td>" . $row[4] . "</td>";
            echo "</tr>";
        }
echo "</table>";



    ?>
</body>
</html>