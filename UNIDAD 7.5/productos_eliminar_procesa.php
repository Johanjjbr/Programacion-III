<?php
$form_id = $_POST["id"];
$datos = mysqli_connect("localhost", "root", "", "supermercado");

$consulta = "DELETE FROM producto WHERE id='$form_id'";

if (mysqli_query($datos, $consulta)) {
    echo "<h1>Producto eliminado</h1>";
} else {
    echo "Error al eliminar: " . mysqli_error($datos);
}
mysqli_close($datos);


?>
<br><a href="productos_eliminar_formulario.php">Volver al listado</a>

    <footer style='position: fixed; bottom: 0; width: 100%; text-align: center;'>
        <p> Johan Brito</p>
        <p> Programacion 3 | TSDS</p>
        <p>Curso: 2da 1ra | Mayo 2026</p>
    </footer>