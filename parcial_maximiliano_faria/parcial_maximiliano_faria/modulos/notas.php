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

$asistencias = ["Presente", "Ausente"];
$mensaje = "";

function cargar_nota($conexion) {
    $id = intval($_POST["id_inscripcion"]);
    $asistencia = limpiar($_POST["asistencia"]);
    $nota = intval($_POST["nota"]);
    $sql = "UPDATE inscripciones SET asistencia=?, nota=? WHERE id_inscripcion=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $asistencia, $nota, $id);
    mysqli_stmt_execute($stmt);
}

if (isset($_POST["guardar"])) {
    cargar_nota($conexion);
    $mensaje = "Nota cargada correctamente.";
}

$inscripciones = mysqli_query($conexion, "SELECT i.*, a.dni, a.apellido, a.nombre, m.materia, m.fecha_mesa
    FROM inscripciones i
    INNER JOIN alumnos a ON i.id_alumno = a.id_alumno
    INNER JOIN mesas m ON i.id_mesa = m.id_mesa
    WHERE m.fecha_mesa < CURDATE()
    ORDER BY m.fecha_mesa DESC");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Carga de notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inscripciones.css">
</head>
<body>
<div class="container py-4">
    <h1>Carga de notas</h1>
    <?php mostrar_mensaje($mensaje); ?>
    <p>Solo aparecen inscripciones cuya fecha de mesa ya paso.</p>

    <table class="table table-bordered table-striped">
        <tr><th>Alumno</th><th>Mesa</th><th>Fecha mesa</th><th>Asistencia</th><th>Nota</th><th>Guardar</th></tr>
        <?php while ($i = mysqli_fetch_assoc($inscripciones)) { ?>
            <tr>
                <form method="post">
                    <td><?php echo $i["dni"] . " - " . $i["apellido"] . " " . $i["nombre"]; ?></td>
                    <td><?php echo $i["materia"]; ?></td>
                    <td><?php echo $i["fecha_mesa"]; ?></td>
                    <td>
                        <select class="form-select" name="asistencia">
                            <?php foreach ($asistencias as $asis) { ?>
                                <option value="<?php echo $asis; ?>" <?php if ($i["asistencia"] == $asis) echo "selected"; ?>><?php echo $asis; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input class="form-control" type="number" min="1" max="10" name="nota" value="<?php echo $i["nota"]; ?>" required></td>
                    <td>
                        <input type="hidden" name="id_inscripcion" value="<?php echo $i["id_inscripcion"]; ?>">
                        <button class="btn btn-primary btn-sm" name="guardar">Guardar</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <?php volver_principal(); ?>
</div>
</body>
</html>

