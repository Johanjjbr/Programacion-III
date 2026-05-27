<html>
<head>
    <title>Formulario</title>
    <meta charset="utf-8">
</head>
<body bgcolor="#D2EBF7">
    <h1>Modificar datos de Alumno del Instituto</h1>
    <?php
    $form_id = $_POST["id"];
    $enlace = mysqli_connect("localhost", "root", "", "instituto");
    $resultado = mysqli_query($enlace, "SELECT * FROM alumno WHERE id='$form_id'");
    $row = mysqli_fetch_row($resultado);
    ?>
    <form method="post" action="instituto_modificar_procesa.php">
        <table width="300" border="1">
            <input type="hidden" name="id" value="<?php echo $row[0] ?>">
            <tr><td><b>Nombre</b></td><td><input type="text" name="nom" value="<?php echo $row[1] ?>" required></td></tr>
            <tr><td><b>DNI</b></td><td><input type="text" name="dni" value="<?php echo $row[5] ?>" required></td></tr>
            <tr><td><b>Celular</b></td><td><input type="text" name="cel" value="<?php echo $row[3] ?>" required></td></tr>
            <tr><td><b>Mail</b></td><td><input type="text" name="mail" value="<?php echo $row[4] ?>" required></td></tr>
            <tr><td><b>Dirección</b></td><td><input type="text" name="dir" value="<?php echo $row[2] ?>" required></td></tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Modificar Alumno" onclick="return confirm('¿Está seguro de modificar los datos?')">
                </td>
            </tr>
        </table>
    </form>
    <?php mysqli_close($enlace); ?>
    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
    </footer>
</body>
</html>