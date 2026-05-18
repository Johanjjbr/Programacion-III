<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
</head>
<body>
    <?php
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "playa";

        $enlace = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$enlace) {
            echo "Error de conexión: " . mysqli_connect_error();
        } else {
            echo "Conexión exitosa a la base de datos Playa";
            echo "<p>informacion del host: " . mysqli_get_host_info($enlace) . "</p>";
        }

        mysqli_close($enlace);





    ?>
</body>
</html>