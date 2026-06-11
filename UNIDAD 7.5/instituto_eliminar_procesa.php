<html>
<head>
    <title>Borrar Instituto</title>
</head>
<body >
    <h1>Borrar Alumnos del Instituto</h1>
    <?php
    $form_id = $_POST["id"]; 

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_nombre = "instituto";

    $datos = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);

    $consulta = "DELETE FROM alumno WHERE id='$form_id'";

    if (mysqli_query($datos, $consulta)) {
        echo "<p>Conexión a la base de datos $db_nombre </p>";
        echo "<p>El alumno ha sido eliminado</p>";
    } else {
        echo "Error al eliminar: " . mysqli_error($datos);
    }

    mysqli_close($datos);

    ?>
    <br>
    <a href="instituto_eliminar_formulario.php">Volver al listado</a>

    <footer style='position: fixed; bottom: 0; width: 100%; text-align: center;'>
        <p> Johan Brito</p>
        <p> Programacion 3 | TSDS</p>
        <p>Curso: 2da 1ra | Mayo 2026</p>
    </footer>
</body>
</html>