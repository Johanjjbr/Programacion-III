<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ARREGLOS - Actividad 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

        <h1>Manejo de Arreglos 2</h1>

        <?php
        $provincia = array("San Juan", "San Luis", "Mendoza", "La Rioja", "Catamarca");

        array_unshift($provincia, "Buenos Aires");
        $provincia[] = "Tierra del Fuego";        

        echo "<p>Provincia agregada al principio: <strong>" . $provincia[0] . "</strong></p>";
        echo "<p>Provincia agregada al final: <strong>" . $provincia[2] . "</strong></p>";

        echo "<p>El elemento que contiene a la provincia de San Juan es: <strong>" . $provincia[3] . "</strong></p>";
        ?>

<footer class="mt-5 text-center text-muted">    
        <div class="container">
            <span>Desarrollador: Johan Brito | Materia: Programación III | Carrera: TS en Desarrollo de Software | Año: 2026</span>
        </div>
    </footer>

</body>
</html>