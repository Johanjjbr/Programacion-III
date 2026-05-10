<doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ejercicio 2 - Procesar formulario</title>
</head>
<body>
    <h2>Ejercicio 2: Validación de Datos</h2>
    <h1>Datos recibidos desde página formulario03</h1>

    <?php
    $a = $_POST["mail"];
    $b = $_POST["pass"];

    if ($b == "programar") {
        echo "<h2>Contraseña correcta</h2>";
        echo "<p>El correo ingresado es: $a </p>";
        echo "<p>La contraseña es ($b) </p>";
    } else {
        echo "<h2>La contraseña es incorrecta: $b </h2>";
    }
    ?>

    <br>
  <footer>
    <h3>Johan Brito | Materia: Programación III</h3>
    <h3>Año: 2026</h3>
  </footer>
</body>
</html>