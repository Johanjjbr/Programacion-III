<?php
$id = $_POST["id"];
$pat = $_POST["pat"];
$fec = $_POST["fec"];
$hs = $_POST["hs"];
$mon = $_POST["mon"];

$enlace = mysqli_connect("localhost", "root", "", "playa");

$consulta = "UPDATE turno SET patente='$pat', fecha='$fec', horas='$hs', monto='$mon' WHERE id_turno='$id'";

if (mysqli_query($enlace, $consulta)) {
    echo "<div class='container mt-5 alert alert-success text-center'>";
    echo "<h2>Turno modificado </h2>";
    echo "<a href='playa_accion_formulario.php' class='btn btn-outline-success'>Volver al Listado</a>";
    echo "</div>";
} else {
    echo "Error al actualizar: " . mysqli_error($enlace);
}

mysqli_close($enlace);
?>