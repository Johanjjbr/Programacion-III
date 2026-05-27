<html>
<head>
    <title>Listado Playa - Modificar</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4" style="background-color: #DDE0F0;">
    <h1>Gestión de Turnos - Playa de Estacionamiento</h1>
    <?php
    $enlace = mysqli_connect("localhost", "root", "", "playa");
    $resultado = mysqli_query($enlace, "SELECT * FROM turno");
    ?>
    
    <table class="table table-bordered table-striped mt-3 bg-white">
        <thead class="table-warning">
            <tr>
                <th>ID</th><th>Patente</th><th>Fecha</th><th>Horas</th><th>Monto</th><th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_row($resultado)) {
                echo "<tr>";
                echo "<td>$row[0]</td><td>$row[2]</td><td>$row[5]</td><td>$row[1]</td><td>$row[3]</td>";
                echo "<td>
                        <form method='post' action='playa_modificar_turno.php'>
                            <input type='hidden' name='id' value='$row[0]'>
                            <input type='submit' class='btn btn-primary btn-sm' value='Editar Turno'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            mysqli_close($enlace);
            ?>
        </tbody>
    </table>

    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p>Johan Brito | Programacion 3 | TSDS 2da 1ra | Mayo 2026</p>
    </footer>
</body>
</html>