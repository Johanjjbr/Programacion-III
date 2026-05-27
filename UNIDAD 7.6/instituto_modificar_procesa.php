<?php
$form_id = $_POST["id"];
$form_nom = $_POST["nom"];
$form_dni = $_POST["dni"];
$form_cel = $_POST["cel"];
$form_mail = $_POST["mail"];
$form_dir = $_POST["dir"];

$enlace = mysqli_connect("localhost", "root", "", "instituto");

$consulta = "UPDATE alumno SET nombre='$form_nom', dni='$form_dni', telefono='$form_cel', mail='$form_mail', direccion='$form_dir' WHERE id='$form_id'";

if (mysqli_query($enlace, $consulta)) {
    echo "<h1>Los datos han sido modificados con éxito</h1>";
    echo "<table border='1'>
            <tr><td>Nombre</td><td>DNI</td><td>Celular</td><td>Mail</td><td>Dirección</td></tr>
            <tr><td>$form_nom</td><td>$form_dni</td><td>$form_cel</td><td>$form_mail</td><td>$form_dir</td></tr>
          </table>";
} else {
    echo "Error en la consulta: " . mysqli_error($enlace);
}
mysqli_close($enlace);
?>
<br>
<a href="instituto_accion_formulario.php">Volver al listado</a>
    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
    </footer>