<html>
<head>
    <title>Listado Playa - Eliminar</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <h1>Listado de PLaya</h1>
    <?php
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_nombre = "playa";

    $enlace = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);
    if (!$enlace) {
        echo "Error: No se pudo conectar a $db_nombre ." . PHP_EOL;
        exit();
    }

    $consulta = "SELECT * FROM turno"; 
    $resultado = mysqli_query($enlace, $consulta);

    echo "<h3>Total de vehículos en playa: " . mysqli_num_rows($resultado) . "</h3>";
    ?>

    <table border="1">
        <tr >
            <td>ID</td>
            <td>Horas</td>
            <td>Fecha</td>
            <td>Monto</td>
            <td>Patente</td>
            <td>Acción</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[4]</td>";
            echo "<td>
                    <form method='post' action='playa_eliminar_procesa.php'>
                        <input type='hidden' name='id' value='$row[0]'>
                        <input type='submit' value='Borrar Auto'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        mysqli_free_result($resultado);
        mysqli_close($enlace);
        ?>
    
    </table>

    <footer style='position: fixed; bottom: 0; width: 100%; text-align: center;'>
        <p> Johan Brito</p>
        <p> Programacion 3 | TSDS</p>
        <p>Curso: 2da 1ra | Mayo 2026</p>
    </footer>

</body>
</html>