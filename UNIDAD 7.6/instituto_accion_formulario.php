<html>
<head>
    <title>Listado Instituto - Acciones</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body bgcolor="#DDE0F0">
    <h1>Listado de Alumnos</h1>
    <?php
    $enlace = mysqli_connect("localhost", "root", "", "instituto");
    $resultado = mysqli_query($enlace, "SELECT * FROM alumno");
    echo "<h3>Total de alumnos cargados: " . mysqli_num_rows($resultado) . "</h3>";
    ?>
    <table border="1" >
        <tr>
            <td>Identificador</td><td>Nombre</td><td>DNI</td>
            <td>Celular</td><td>Mail</td><td>Dirección</td><td>Acciones</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>";
            echo "<td>$row[0]</td><td>$row[1]</td><td>$row[5]</td><td>$row[3]</td><td>$row[4]</td><td>$row[2]</td>";
            echo "<td>
                    <form method='post' action='instituto_modificar_alumno.php'>
                        <input type='hidden' name='id' value='$row[0]'>
                        <input type='submit' value='Editar datos Alumno'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        mysqli_close($enlace);
        ?>
    </table>
    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
    </footer>
</body>
</html>