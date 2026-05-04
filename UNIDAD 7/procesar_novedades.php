<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - Confirmación</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 40px; }
    </style>
</head>
<body>
    <h2>Ejercicio 5: Procesamiento de Suscripción</h2>

    <div >
        <h1>¡Registro Exitoso!</h1>
        <?php
        $nombre = $_POST["nombre"];
        $depto = $_POST["depto"];
        $mail = $_POST["mail"];

        echo "<p>Hola <strong>$nombre</strong></p>";
        echo "<p>Hemos registrado tu correo: <em>$mail</em></p>";
        echo "<p>Departamento seleccionado: $depto </p>";
        ?>
    </div>

    <br><br>
    <a href="form_novedades.html">Registrar otro usuario</a>

    <br><br>
    <hr>
  <footer>
    <h3>Johan Brito | Materia: Programación III</h3>
    <h3>Año: 2026</h3>
  </footer>
</body>
</html>