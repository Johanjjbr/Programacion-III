<html>
<head>
    <title>Listado Supermercado | Eliminar</title>
</head>
<body>
    <h1>Eliminar Productos del Supermercado</h1>
    <?php
    $enlace = mysqli_connect("localhost", "root", "", "supermercado");
    $resultado = mysqli_query($enlace, "SELECT * FROM producto");
    ?>
    <table border="1">
        <tr>
            <td>ID</td><td>Nombre</td><td>Precio</td><td>cant</td><td>Acción</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>";
            echo "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>";
            echo "<td>
                    <form method='post' action='productos_eliminar_procesa.php'>
                        <input type='hidden' name='id' value='$row[0]'>
                        <input type='submit' value='Eliminar'>
                    </form>
                  </td>";
            echo "</tr>";
        }
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