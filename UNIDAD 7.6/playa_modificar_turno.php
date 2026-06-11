<html>
<head>
    <title>Editar Turno</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body">
    <h1>Modificar</h1>
    <?php
    $form_id = $_POST["id"];
    $datos = mysqli_connect("localhost", "root", "", "playa");
    $resultado = mysqli_query($datos, "SELECT * FROM turno WHERE id_turno='$form_id'");
    $row = mysqli_fetch_row($resultado);
    ?>

    <div >
        <form method="post" action="playa_modificar_procesa.php" class="m-3">
            <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
            <div >
                <label ><b>Patente</b></label>
                <input type="text"  name="pat" value="<?php echo $row[4]; ?>" required>
            </div>
            <div >
                <label ><b>Fecha</b></label>
                <input type="date"  name="fec" value="<?php echo $row[2]; ?>" required>
            </div>
            <div >
                <label ><b>Horas</b></label>
                <input type="number"  name="hs" value="<?php echo $row[1]; ?>" required>
            </div>
            <div >
                <label ><b>Monto ($)</b></label>
                <input type="text"  name="mon" value="<?php echo $row[3]; ?>" required>
            </div>
            <button type="submit" onclick="return confirm('¿Confirmar cambios?')">Guardar Cambios</button>
        </form>
    </div>
    <?php mysqli_close($datos); ?>
    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
    </footer>
</body>
</html>