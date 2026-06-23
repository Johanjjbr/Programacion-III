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

function listar_mesas_habilitadas($conexion) {
    return mysqli_query($conexion, "SELECT * FROM mesas WHERE fecha_mesa <= CURDATE() ORDER BY fecha_mesa DESC");
}

function buscar_alumnos_por_mesa($conexion, $id_mesa) {
    return mysqli_query($conexion, "SELECT a.*, i.asistencia, i.nota
        FROM inscripciones i
        INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
        WHERE i.id_mesa = $id_mesa
        ORDER BY a.apellido, a.nombre");
}

function buscar_mesas_por_dni($conexion, $dni) {
    $dni = mysqli_real_escape_string($conexion, $dni);
    return mysqli_query($conexion, "SELECT m.*, i.fecha_inscripcion, i.asistencia, i.nota
        FROM inscripciones i
        INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
        INNER JOIN mesas m ON i.id_mesa = m.id_mesa
        WHERE a.dni = '$dni'
        ORDER BY m.fecha_mesa DESC");
}

$mesas = mysqli_query($conexion, "SELECT * FROM mesas ORDER BY fecha_mesa DESC");
$alumnos = mysqli_query($conexion, "SELECT * FROM alumnos ORDER BY apellido, nombre");
$mesas_habilitadas = listar_mesas_habilitadas($conexion);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Listados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/listados.css">
</head>
<body>
<div class="container py-4">
    <h1>Listados</h1>

    <section class="panel">
        <h2>1. Mesas habilitadas con tribunal</h2>
        <table class="table table-bordered">
            <tr><th>Fecha</th><th>Materia</th><th>Tipo</th><th>Titular</th><th>Vocal 1</th><th>Vocal 2</th></tr>
            <?php while ($m = mysqli_fetch_assoc($mesas_habilitadas)) { ?>
                <tr>
                    <td><?php echo $m["fecha_mesa"]; ?></td>
                    <td><?php echo $m["materia"]; ?></td>
                    <td><?php echo $m["tipo_mesa"]; ?></td>
                    <td><?php echo $m["profesor_titular"]; ?></td>
                    <td><?php echo $m["profesor_vocal1"]; ?></td>
                    <td><?php echo $m["profesor_vocal2"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>

    <section class="panel">
        <h2>2. Alumnos inscriptos en una mesa</h2>
        <form method="get" class="row g-2 mb-3">
            <div class="col-md-8">
                <select class="form-select" name="mesa">
                    <?php while ($m = mysqli_fetch_assoc($mesas)) { ?>
                        <option value="<?php echo $m["id_mesa"]; ?>"><?php echo $m["fecha_mesa"] . " - " . $m["materia"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4"><button class="btn btn-primary">Buscar</button></div>
        </form>
        <?php if (isset($_GET["mesa"])) {
            $res = buscar_alumnos_por_mesa($conexion, intval($_GET["mesa"])); ?>
            <table class="table table-bordered">
                <tr><th>DNI</th><th>Apellido</th><th>Nombre</th><th>Asistencia</th><th>Nota</th></tr>
                <?php while ($a = mysqli_fetch_assoc($res)) { ?>
                    <tr><td><?php echo $a["dni"]; ?></td><td><?php echo $a["apellido"]; ?></td><td><?php echo $a["nombre"]; ?></td><td><?php echo $a["asistencia"]; ?></td><td><?php echo $a["nota"]; ?></td></tr>
                <?php } ?>
            </table>
        <?php } ?>
    </section>

    <section class="panel">
        <h2>3. Mesas por DNI de alumno</h2>
        <form method="get" class="row g-2 mb-3">
            <div class="col-md-8"><input class="form-control" name="dni" placeholder="Ingrese DNI"></div>
            <div class="col-md-4"><button class="btn btn-primary">Buscar</button></div>
        </form>
        <?php if (isset($_GET["dni"])) {
            $res = buscar_mesas_por_dni($conexion, limpiar($_GET["dni"])); ?>
            <table class="table table-bordered">
                <tr><th>Fecha mesa</th><th>Materia</th><th>Tipo</th><th>Fecha inscripcion</th><th>Asistencia</th><th>Nota</th></tr>
                <?php while ($m = mysqli_fetch_assoc($res)) { ?>
                    <tr><td><?php echo $m["fecha_mesa"]; ?></td><td><?php echo $m["materia"]; ?></td><td><?php echo $m["tipo_mesa"]; ?></td><td><?php echo $m["fecha_inscripcion"]; ?></td><td><?php echo $m["asistencia"]; ?></td><td><?php echo $m["nota"]; ?></td></tr>
                <?php } ?>
            </table>
        <?php } ?>
    </section>

    <section class="panel">
        <h2>4. Alumnos registrados</h2>
        <table class="table table-bordered">
            <tr><th>DNI</th><th>Apellido</th><th>Nombre</th><th>Telefono</th><th>Email</th></tr>
            <?php while ($a = mysqli_fetch_assoc($alumnos)) { ?>
                <tr><td><?php echo $a["dni"]; ?></td><td><?php echo $a["apellido"]; ?></td><td><?php echo $a["nombre"]; ?></td><td><?php echo $a["telefono"]; ?></td><td><?php echo $a["email"]; ?></td></tr>
            <?php } ?>
        </table>
    </section>
    <?php volver_principal(); ?>
</div>
</body>
</html>

