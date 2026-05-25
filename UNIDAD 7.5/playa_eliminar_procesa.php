<html>
<head>
    <title>Procesar Borrado</title>
</head>
<body>
    <h1>Eliminación de Vehículo</h1>
    <?php
    $form_id = $_POST["id"];

    $db_host = "localhost"; 
    $db_user = "root"; 
    $db_pass = ""; 
    $db_nombre = "playa";

    $enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

    $consulta = "DELETE FROM turno WHERE id_turno='$form_id'";

    if (mysqli_query($enlace, $consulta)) {
        echo "<p>Conexión exitosa a la base de datos: $db_nombre </p>";
        echo "<p><strong>El vehículo con ID $form_id ha sido borrado</strong></p>";
    } else {
        echo "Error al intentar eliminar: " . mysqli_error($enlace);
    }

    mysqli_close($enlace);
    ?>
    <br>
    <a href="playa_eliminar_formulario.php">Volver al listado de playa</a>

    <footer style='position: fixed; bottom: 0; width: 100%; text-align: center;'>
        <p> Johan Brito</p>
        <p> Programacion 3 | TSDS</p>
        <p>Curso: 2da 1ra | Mayo 2026</p>
    </footer>
</body>
</html>