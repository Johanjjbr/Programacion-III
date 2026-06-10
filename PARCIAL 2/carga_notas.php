<?php
/*
 * Nombre y apellido del programador: Johan Brito
 * Fecha de desarrollo: Junio 2026
 * Materia: Programación 3 de la TSDS
 * Curso: 2da 1ra
 */

session_start();
if (!isset($_SESSION['perfil'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['perfil'] != 'Administrativo') {
    header("Location: index.php");
    exit();
}

include("conexion.php");

$mensaje = "";
$tipo_alerta = "";
$row = null;
$bloqueado = false;

if (isset($_GET["buscar"]) && !empty($_GET["buscar"])) {
    $id_buscar = intval($_GET["buscar"]);

    $consulta = "
        SELECT i.id as insc_id, i.asistencia, i.nota, i.id_alumno, i.id_mesa,
               a.apellido, a.nombre, a.dni,
               m.fecha, m.materia, m.tipo, m.titular
        FROM inscripciones i
        INNER JOIN alumnos a ON i.id_alumno = a.id
        INNER JOIN mesas_examen m ON i.id_mesa = m.id
        WHERE i.id = $id_buscar
    ";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);

        $fecha_mesa = $row['fecha'];
        if ($fecha_mesa < date('Y-m-d')) {
            $bloqueado = false;
        } else {
            $bloqueado = true;
        }
    } else {
        $mensaje = "No se encontró ninguna inscripción con ese ID.";
        $tipo_alerta = "danger";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insc_id"])) {
    $insc_id  = intval($_POST["insc_id"]);
    $asistencia = mysqli_real_escape_string($enlace, $_POST["asistencia"]);
    $nota     = mysqli_real_escape_string($enlace, $_POST["nota"]);

    $verif = "SELECT m.fecha FROM inscripciones i INNER JOIN mesas_examen m ON i.id_mesa = m.id WHERE i.id = $insc_id";
    $res_verif = mysqli_query($enlace, $verif);
    if ($res_verif && mysqli_num_rows($res_verif) > 0) {
        $datos = mysqli_fetch_assoc($res_verif);
        if ($datos['fecha'] < date('Y-m-d')) {
            $update = "UPDATE inscripciones SET asistencia = '$asistencia', nota = '$nota' WHERE id = $insc_id";
            if (mysqli_query($enlace, $update)) {
                $mensaje = "Nota y asistencia actualizadas correctamente.";
                $tipo_alerta = "success";
            } else {
                $mensaje = "Error al actualizar: " . mysqli_error($enlace);
                $tipo_alerta = "danger";
            }
        } else {
            $mensaje = "No se puede cargar la nota porque la fecha de la mesa aún no ha pasado.";
            $tipo_alerta = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="d-flex" style="min-height: 100vh;">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px;">
            <a href="index.php" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <span class="fs-5 fw-bold">Sistema Exámenes</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li><a href="index.php" class="nav-link text-white"><i class="bi bi-house-door me-2"></i> Dashboard</a></li>
                <li><a href="mod_alumnos.php" class="nav-link text-white"><i class="bi bi-people me-2"></i> Alumnos</a></li>
                <li><a href="mod_mesas.php" class="nav-link text-white"><i class="bi bi-calendar-event me-2"></i> Mesas de Examen</a></li>
                <li><a href="mod_inscripciones.php" class="nav-link text-white"><i class="bi bi-pencil-square me-2"></i> Inscripciones</a></li>
                <li><a href="carga_notas.php" class="nav-link text-white active"><i class="bi bi-star me-2"></i> Carga de Notas</a></li>
                <li><a href="listados.php" class="nav-link text-white"><i class="bi bi-list-ul me-2"></i> Listados</a></li>
            </ul>
            <hr>
            <a href="index.php?cerrar_sesion=1" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
        </div>

        <div class="container-fluid p-4">
            <h2 class="mb-4">Carga de Notas y Asistencia</h2>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card p-4 shadow mb-4">
                <form action="carga_notas.php" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label class="form-label">Buscar Inscripción por ID:</label>
                        <input type="number" name="buscar" class="form-control" placeholder="Ingrese el ID de la inscripción..." required value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i> Buscar</button>
                    </div>
                </form>
            </div>

            <?php if ($row): ?>
                <div class="card shadow mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Datos de la Inscripción</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"><strong>Alumno:</strong> <?php echo $row['apellido'] . ', ' . $row['nombre']; ?></div>
                            <div class="col-md-2"><strong>DNI:</strong> <?php echo $row['dni']; ?></div>
                            <div class="col-md-3"><strong>Materia:</strong> <?php echo $row['materia']; ?></div>
                            <div class="col-md-2"><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($row['fecha'])); ?></div>
                            <div class="col-md-2">
                                <strong>Tipo:</strong>
                                <span class="badge bg-<?php echo ($row['tipo'] == 'libre') ? 'danger' : 'primary'; ?>"><?php echo ucfirst($row['tipo']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($bloqueado): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Acción bloqueada:</strong> No se puede cargar la nota porque la fecha de la mesa (<?php echo date('d/m/Y', strtotime($row['fecha'])); ?>) es igual o posterior a la fecha actual. Debe esperar a que la mesa haya finalizado.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php else: ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>La fecha de la mesa ya ha pasado. Puede cargar la nota y asistencia.
                    </div>
                    <form action="carga_notas.php" method="POST" class="card p-4 shadow">
                        <input type="hidden" name="insc_id" value="<?php echo $row['insc_id']; ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Asistencia:</label>
                                <select name="asistencia" class="form-select" required>
                                    <option value="Si" <?php echo ($row['asistencia'] == 'Si') ? 'selected' : ''; ?>>Presente</option>
                                    <option value="No" <?php echo ($row['asistencia'] == 'No') ? 'selected' : ''; ?>>Ausente</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nota (0.00 - 10.00):</label>
                                <input type="number" name="nota" class="form-control" step="0.01" min="0" max="10" value="<?php echo $row['nota'] !== null ? $row['nota'] : ''; ?>" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i> Guardar Nota y Asistencia</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php elseif (isset($_GET['buscar']) && empty($row)): ?>
                <div class="alert alert-warning">No se encontró la inscripción. Verifique el ID ingresado.</div>
            <?php endif; ?>

            <footer class="mt-5 py-3 bg-light text-center border-top rounded">
                <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Junio 2026</p>
                <p>Programación 3 - TSDS | Curso: 2da 1ra</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($enlace); ?>
