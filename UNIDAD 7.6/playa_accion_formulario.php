<html>
<head>
    <title>Listado Playa - Modificar</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >
    <h1>Playa</h1>
    <?php
    $enlace = mysqli_connect("localhost", "root", "", "playa");
    $resultado = mysqli_query($enlace, "SELECT * FROM turno");
    ?>
    
    <table class="table table-bordered">
            <tr>
                <th>ID</th><th>Patente</th><th>Fecha</th><th>Horas</th><th>Monto</th><th>Acción</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_row($resultado)) {
                echo "<tr>";
                echo "<td>$row[0]</td><td>$row[4]</td><td>$row[2]</td><td>$row[1]</td><td>$row[3]</td>";
                echo "<td>
                        <form method='post' action='playa_modificar_turno.php'>
                            <input type='hidden' name='id' value='$row[0]'>
                            <input type='submit'  value='Editar Turno'>
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