<?php
$nom = $_POST["nombre"];
$pre = $_POST["precio"];
$cant = $_POST["cant"];

$datos = mysqli_connect("localhost", "root", "", "supermercado");
$consulta = "INSERT INTO producto (nombre, precio, cant) VALUES ('$nom', $pre, $cant)";

if (mysqli_query($datos, $consulta)) {
    echo "<h1>Producto registrado con éxito</h1>";
    echo "<a href='productos_insertar_formulario.html'>Cargar otro</a>";
} else {
    echo "Error: " . mysqli_error($datos);
}
mysqli_close($datos);

?>
    <footer style='position: fixed; bottom: 0; width: 100%; text-align: center;'>
        <p> Johan Brito</p>
        <p> Programacion 3 | TSDS</p>
        <p>Curso: 2da 1ra | Mayo 2026</p>
    </footer>