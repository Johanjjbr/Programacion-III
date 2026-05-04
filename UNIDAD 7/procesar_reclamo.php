<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6 - Procesar Reclamo</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; line-height: 1.6; }

    </style>
</head>
<body>
    <h2>Ejercicio 6: Confirmación de Envío</h2>

    <div>
        <h1>Reclamo Recibido</h1>
        <?php
        // Captura de datos mediante el método POST
        $nombre = $_POST["nombre"];
        $tel = $_POST["telefono"];
        $mail = $_POST["mail"];
        $asunto = $_POST["asunto"];
        $detalle = $_POST["detalle"];

        echo "<p><strong>Alumno:</strong> $nombre</p>";
        echo "<p><strong>Contacto:</strong> $mail | Tel: $tel</p>";
        echo "<hr>";
        echo "<p><strong>Reclamo:</strong> $asunto</p>";
        echo "<p><strong>Descripción:</strong><br>" . nl2br($detalle) . "</p>";
        ?>
        <p><em>Su reclamo será procesado por el departamento correspondiente a la brevedad.</em></p>
    </div>

    <br><br>
    <a href="form_reclamo.html">Volver al formulario</a>

    <br><br>
    <hr>
 <footer>
    <h3>Johan Brito | Materia: Programación III</h3>
    <h3>Año: 2026</h3>
  </footer>
</body>
</html>