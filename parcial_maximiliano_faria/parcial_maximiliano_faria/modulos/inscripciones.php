<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
require_once "../includes/auth.php";
require_once "../includes/conexion.php";
require_once "../includes/funciones.php";

function guardar_inscripcion($conexion) {
    $id_alumno = intval($_POST["id_alumno"]);
    $id_mesa = intval($_POST["id_mesa"]);
    $fecha = limpiar($_POST["fecha_inscripcion"]);
    $sql = "INSERT INTO inscripciones(id_alumno, id_mesa, fecha_inscripcion, asistencia, nota) VALUES(?,?,?,NULL,NULL)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $id_alumno, $id_mesa, $fecha);
    mysqli_stmt_execute($stmt);
}

if (isset($_POST["guardar"])) {
    guardar_inscripcion($conexion);
}

if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);
    mysqli_query($conexion, "DELETE FROM inscripciones WHERE id_inscripcion=$id");
}

$alumnos = mysqli_query($conexion, "SELECT * FROM alumnos ORDER BY apellido, nombre");
$mesas = mysqli_query($conexion, "SELECT * FROM mesas ORDER BY fecha_mesa DESC");
$inscripciones = mysqli_query($conexion, "SELECT i.*, a.dni, a.apellido, a.nombre, m.materia, m.fecha_mesa
    FROM inscripciones i
    INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
    INNER JOIN mesas m ON i.id_mesa = m.id_mesa
    ORDER BY i.fecha_inscripcion DESC");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Inscripciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inscripciones.css">
</head>
<body>
<div class="container py-4">
    <h1>Inscripciones a mesas</h1>
    <section class="panel mb-4">
        <form method="post" class="row g-3">
            <div class="col-md-4">
                <select class="form-select" name="id_alumno" required>
                    <option value="">Seleccione alumno</option>
                    <?php while ($a = mysqli_fetch_assoc($alumnos)) { ?>
                        <option value="<?php echo $a["id_alumno"]; ?>"><?php echo $a["dni"] . " - " . $a["apellido"] . " " . $a["nombre"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="id_mesa" required>
                    <option value="">Seleccione mesa</option>
                    <?php while ($m = mysqli_fetch_assoc($mesas)) { ?>
                        <option value="<?php echo $m["id_mesa"]; ?>"><?php echo $m["fecha_mesa"] . " - " . $m["materia"] . " - " . $m["tipo_mesa"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2"><input type="date" class="form-control" name="fecha_inscripcion" value="<?php echo fecha_actual(); ?>" required></div>
            <div class="col-md-2"><button class="btn btn-success w-100" name="guardar">Inscribir</button></div>
        </form>
    </section>

    <table class="table table-bordered table-striped">
        <tr><th>Alumno</th><th>Mesa</th><th>Fecha mesa</th><th>Fecha inscripcion</th><th>Asistencia</th><th>Nota</th><th>Accion</th></tr>
        <?php while ($i = mysqli_fetch_assoc($inscripciones)) { ?>
            <tr>
                <td><?php echo $i["dni"] . " - " . $i["apellido"] . " " . $i["nombre"]; ?></td>
                <td><?php echo $i["materia"]; ?></td>
                <td><?php echo $i["fecha_mesa"]; ?></td>
                <td><?php echo $i["fecha_inscripcion"]; ?></td>
                <td><?php echo $i["asistencia"] ?? "Sin cargar"; ?></td>
                <td><?php echo $i["nota"] ?? "Sin cargar"; ?></td>
                <td><a class="btn btn-sm btn-danger" href="?eliminar=<?php echo $i["id_inscripcion"]; ?>">Eliminar</a></td>
            </tr>
        <?php } ?>
    </table>
    <?php volver_principal(); ?>
</div>
</body>
</html>

