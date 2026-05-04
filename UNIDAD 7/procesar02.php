<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ejercicio 1 - Procesar formulario</title>
</head>
<body>
    <h3>Ejercicio 1: Procesamiento de Datos</h3>
    <h1>Datos recibidos desde página formulario02</h1>

    <?php
    // Se reciben los datos del formulario usando el array global $_POST
    $a = $_POST["mail"];
    echo "<p>El correo es $a </p>";

    $b = $_POST["pass"];
    echo "<p>La contraseña es $b </p>";
    ?>

    <br>
    <h3>Alumno: Johan Brito | Materia: Programación III</h3>
</body>
</html>