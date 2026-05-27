<html>
<head>
    <title>Editar Turno</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4" style="background-color: #D2EBF7;">
    <h1>Modificar datos del Turno</h1>
    <?php
    $form_id = $_POST["id"];
    $enlace = mysqli_connect("localhost", "root", "", "playa");
    $resultado = mysqli_query($enlace, "SELECT * FROM turno WHERE id_turno='$form_id'");
    $row = mysqli_fetch_row($resultado);
    ?>

    <div class="card p-4 shadow-sm">
        <form method="post" action="playa_modificar_procesa.php">
            <div class="mb-3">
                <label class="form-label"><b>ID Turno (No modificable)</b></label>
                <input type="text" class="form-control" name="id" value="<?php echo $row; ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Patente</b></label>
                <input type="text" class="form-control" name="pat" value="<?php echo $row[4]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Fecha</b></label>
                <input type="date" class="form-control" name="fec" value="<?php echo $row[5]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Horas</b></label>
                <input type="number" class="form-control" name="hs" value="<?php echo $row[6]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Monto ($)</b></label>
                <input type="text" class="form-control" name="mon" value="<?php echo $row[7]; ?>" required>
            </div>
            <button type="submit" class="btn btn-success" onclick="return confirm('¿Confirmar cambios?')">Guardar Cambios</button>
        </form>
    </div>
    <?php mysqli_close($enlace); ?>
</body>
</html>