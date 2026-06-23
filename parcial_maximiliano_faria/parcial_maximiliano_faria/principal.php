<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
require_once "includes/auth.php";
$perfil = $_SESSION["perfil"];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
<div class="container py-4">
    <header class="encabezado">
        <div>
            <h1>Sistema de Mesas de Examen</h1>
            <p>Bienvenido/a, <?php echo $_SESSION["nombre_completo"]; ?> - Perfil: <?php echo $perfil; ?></p>
        </div>
        <a class="btn btn-outline-danger" href="logout.php">Salir</a>
    </header>

    <nav class="menu-principal">
        <?php if ($perfil == "Administrativo") { ?>
            <a href="modulos/mesas.php">Mesas de examen</a>
            <a href="modulos/alumnos.php">Gestion alumnos</a>
            <a href="modulos/usuarios.php">Control de acceso</a>
            <a href="modulos/notas.php">Carga de notas</a>
            <a href="modulos/listados.php">Listados</a>
        <?php } ?>
        <a href="modulos/inscripciones.php">Inscripciones</a>
    </nav>
</div>
</body>
</html>

