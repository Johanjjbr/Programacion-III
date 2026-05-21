<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1</title>
</head>
<body>
    <?php
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "instituto";

        $enlace = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        $sql = "SELECT * FROM alumno";
        $resultado = mysqli_query($enlace, $sql);

        if (!$enlace) {
            echo "Error de conexión: " . mysqli_connect_error();
        } else {
            echo "Conexión exitosa a la base de datos Instituto";
            echo "<p>informacion del host: " . mysqli_get_host_info($enlace) . "</p>";

        }

echo "<table border='1'> ";
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
        mysqli_close($enlace);





    ?>
</body>
</html>