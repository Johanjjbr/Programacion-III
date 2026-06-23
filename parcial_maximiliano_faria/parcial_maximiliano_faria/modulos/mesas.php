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

$tipos_mesa = ["Regular", "Libre"];

function guardar_mesa($conexion) {
    $fecha = limpiar($_POST["fecha_mesa"]);
    $materia = limpiar($_POST["materia"]);
    $tipo = limpiar($_POST["tipo_mesa"]);
    $titular = limpiar($_POST["profesor_titular"]);
    $vocal1 = limpiar($_POST["profesor_vocal1"]);
    $vocal2 = limpiar($_POST["profesor_vocal2"]);

    $sql = "INSERT INTO mesas(fecha_mesa, materia, tipo_mesa, profesor_titular, profesor_vocal1, profesor_vocal2)
            VALUES(?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $fecha, $materia, $tipo, $titular, $vocal1, $vocal2);
    mysqli_stmt_execute($stmt);
}

if (isset($_POST["guardar"])) {
    guardar_mesa($conexion);
}

if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);
    mysqli_query($conexion, "DELETE FROM mesas WHERE id_mesa=$id");
}

$mesas = mysqli_query($conexion, "SELECT * FROM mesas ORDER BY fecha_mesa DESC");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mesas de examen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/mesas.css">
</head>
<body>
<div class="container py-4">
    <h1>Mesas de examen</h1>
    <section class="panel mb-4">
        <form method="post" class="row g-3">
            <div class="col-md-2"><input type="date" class="form-control" name="fecha_mesa" required></div>
            <div class="col-md-3"><input class="form-control" name="materia" placeholder="Materia" required></div>
            <div class="col-md-2">
                <select class="form-select" name="tipo_mesa">
                    <?php foreach ($tipos_mesa as $tipo) { ?>
                        <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3"><input class="form-control" name="profesor_titular" placeholder="Profesor titular" required></div>
            <div class="col-md-3"><input class="form-control" name="profesor_vocal1" placeholder="Profesor vocal 1" required></div>
            <div class="col-md-3"><input class="form-control" name="profesor_vocal2" placeholder="Profesor vocal 2" required></div>
            <div class="col-12"><button class="btn btn-primary" name="guardar">Crear mesa</button></div>
        </form>
    </section>

    <table class="table table-bordered table-striped">
        <tr><th>Fecha</th><th>Materia</th><th>Tipo</th><th>Titular</th><th>Vocal 1</th><th>Vocal 2</th><th>Accion</th></tr>
        <?php while ($m = mysqli_fetch_assoc($mesas)) { ?>
            <tr>
                <td><?php echo $m["fecha_mesa"]; ?></td>
                <td><?php echo $m["materia"]; ?></td>
                <td><?php echo $m["tipo_mesa"]; ?></td>
                <td><?php echo $m["profesor_titular"]; ?></td>
                <td><?php echo $m["profesor_vocal1"]; ?></td>
                <td><?php echo $m["profesor_vocal2"]; ?></td>
                <td><a class="btn btn-sm btn-danger" href="?eliminar=<?php echo $m["id_mesa"]; ?>">Eliminar</a></td>
            </tr>
        <?php } ?>
    </table>
    <?php volver_principal(); ?>
</div>
</body>
</html>

