<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
require_once "../includes/auth.php";
solo_administrativo();
require_once "../includes/conexion.php";
require_once "../includes/funciones.php";

function guardar_alumno($conexion) {
    $id = intval($_POST["id_alumno"] ?? 0);
    $dni = limpiar($_POST["dni"]);
    $apellido = limpiar($_POST["apellido"]);
    $nombre = limpiar($_POST["nombre"]);
    $telefono = limpiar($_POST["telefono"]);
    $email = limpiar($_POST["email"]);

    if ($id > 0) {
        $sql = "UPDATE alumnos SET dni=?, apellido=?, nombre=?, telefono=?, email=? WHERE id_alumno=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $dni, $apellido, $nombre, $telefono, $email, $id);
    } else {
        $sql = "INSERT INTO alumnos(dni, apellido, nombre, telefono, email) VALUES(?,?,?,?,?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $dni, $apellido, $nombre, $telefono, $email);
    }
    mysqli_stmt_execute($stmt);
}

if (isset($_POST["guardar"])) {
    guardar_alumno($conexion);
}

if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);
    mysqli_query($conexion, "DELETE FROM alumnos WHERE id_alumno=$id");
}

$editar = null;
if (isset($_GET["editar"])) {
    $id = intval($_GET["editar"]);
    $editar = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos WHERE id_alumno=$id"));
}

$alumnos = mysqli_query($conexion, "SELECT * FROM alumnos ORDER BY apellido, nombre");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Gestion alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/alumnos.css">
</head>
<body>
<div class="container py-4">
    <h1>Gestion alumnos</h1>
    <section class="panel mb-4">
        <form method="post" class="row g-3">
            <input type="hidden" name="id_alumno" value="<?php echo $editar["id_alumno"] ?? 0; ?>">
            <div class="col-md-2"><input class="form-control" name="dni" placeholder="DNI" required value="<?php echo $editar["dni"] ?? ""; ?>"></div>
            <div class="col-md-3"><input class="form-control" name="apellido" placeholder="Apellido" required value="<?php echo $editar["apellido"] ?? ""; ?>"></div>
            <div class="col-md-3"><input class="form-control" name="nombre" placeholder="Nombre" required value="<?php echo $editar["nombre"] ?? ""; ?>"></div>
            <div class="col-md-2"><input class="form-control" name="telefono" placeholder="Telefono" value="<?php echo $editar["telefono"] ?? ""; ?>"></div>
            <div class="col-md-2"><input class="form-control" name="email" placeholder="Email" value="<?php echo $editar["email"] ?? ""; ?>"></div>
            <div class="col-12"><button class="btn btn-primary" name="guardar">Guardar alumno</button></div>
        </form>
    </section>

    <table class="table table-bordered table-striped">
        <tr><th>DNI</th><th>Apellido</th><th>Nombre</th><th>Telefono</th><th>Email</th><th>Acciones</th></tr>
        <?php while ($a = mysqli_fetch_assoc($alumnos)) { ?>
            <tr>
                <td><?php echo $a["dni"]; ?></td>
                <td><?php echo $a["apellido"]; ?></td>
                <td><?php echo $a["nombre"]; ?></td>
                <td><?php echo $a["telefono"]; ?></td>
                <td><?php echo $a["email"]; ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="?editar=<?php echo $a["id_alumno"]; ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="?eliminar=<?php echo $a["id_alumno"]; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php volver_principal(); ?>
</div>
</body>
</html>

