<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 - Procesar Login</title>
    <style>
        .exito { border-color: green; color: green; }
        .error { border-color: red; color: red; }
    </style>
</head>
<body>
    <h2>Ejercicio 4: Resultado del Acceso</h2>

    <?php
    // Recibimos los datos del formulario
    $user = $_POST["usuario"];
    $pass = $_POST["clave"];

    // Validación simple (puedes cambiar "admin123" por la clave que desees)
    if ($pass == "123456") {
        echo "<div class='exito'>";
        echo "<h3>¡Bienvenido al sistema, $user!</h3>";
        echo "<p>Acceso concedido</p>";
        echo "</div>";
    } else {
        echo "<div class='error'>";
        echo "<h3>Error de autenticación</h3>";
        echo "<p>La clave ingresada es incorrecta.</p>";
        echo "</div>";
    }
    ?>

    <br><br>
    <a href="form_login.html">Volver al formulario</a>

    <br><br>
    <hr>
  <footer>
    <h3>Johan Brito | Materia: Programación III</h3>
    <h3>Año: 2026</h3>
  </footer>
</body>
</html>