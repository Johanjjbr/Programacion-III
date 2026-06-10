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

$perfil = $_SESSION['perfil'];

include("conexion.php");

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_alumno = mysqli_real_escape_string($enlace, $_POST["id_alumno"]);
    $form_mesa   = mysqli_real_escape_string($enlace, $_POST["id_mesa"]);

    $verificar = "SELECT id FROM inscripciones WHERE id_alumno = $form_alumno AND id_mesa = $form_mesa";
    $res_verif = mysqli_query($enlace, $verificar);
    if ($res_verif && mysqli_num_rows($res_verif) > 0) {
        $mensaje = "El alumno ya está inscripto en esta mesa.";
        $tipo_alerta = "warning";
    } else {
        $consulta = "INSERT INTO inscripciones (id_alumno, id_mesa, asistencia, nota) VALUES ($form_alumno, $form_mesa, NULL, NULL)";
        if (mysqli_query($enlace, $consulta)) {
            $mensaje = "Inscripción registrada correctamente.";
            $tipo_alerta = "success";
        } else {
            $mensaje = "Error al inscribir: " . mysqli_error($enlace);
            $tipo_alerta = "danger";
        }
    }
}

if (isset($_GET["eliminar"])) {
    $id_eliminar = $_GET["eliminar"];
    $consulta_baja = "DELETE FROM inscripciones WHERE id = $id_eliminar";
    if (mysqli_query($enlace, $consulta_baja)) {
        $mensaje = "Inscripción eliminada";
        $tipo_alerta = "warning";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

$alumnos = mysqli_query($enlace, "SELECT id, nombre, apellido, dni FROM alumnos ORDER BY apellido, nombre");
$mesas   = mysqli_query($enlace, "SELECT id, fecha, materia, tipo FROM mesas_examen ORDER BY fecha DESC");

$inscripciones = mysqli_query($enlace, "
    SELECT i.id, a.apellido, a.nombre, a.dni, m.fecha, m.materia, m.tipo, i.asistencia, i.nota
    FROM inscripciones i
    INNER JOIN alumnos a ON i.id_alumno = a.id
    INNER JOIN mesas_examen m ON i.id_mesa = m.id
    ORDER BY i.id DESC
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripciones</title>
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
                <?php if ($perfil == 'Administrativo'): ?>
                <li><a href="mod_alumnos.php" class="nav-link text-white"><i class="bi bi-people me-2"></i> Alumnos</a></li>
                <li><a href="mod_mesas.php" class="nav-link text-white"><i class="bi bi-calendar-event me-2"></i> Mesas de Examen</a></li>
                <?php endif; ?>
                <li><a href="mod_inscripciones.php" class="nav-link text-white active"><i class="bi bi-pencil-square me-2"></i> Inscripciones</a></li>
                <?php if ($perfil == 'Administrativo'): ?>
                <li><a href="carga_notas.php" class="nav-link text-white"><i class="bi bi-star me-2"></i> Carga de Notas</a></li>
                <li><a href="listados.php" class="nav-link text-white"><i class="bi bi-list-ul me-2"></i> Listados</a></li>
                <?php endif; ?>
            </ul>
            <hr>
            <a href="index.php?cerrar_sesion=1" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
        </div>

        <div class="container-fluid p-4">
            <h2 class="mb-4">Inscribir Alumno a Mesa de Examen</h2>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="mod_inscripciones.php" method="POST" class="card p-4 shadow mb-5">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Alumno:</label>
                        <select name="id_alumno" class="form-select" required>
                            <option value="">-- Seleccionar Alumno --</option>
                            <?php if ($alumnos): ?>
                                <?php while ($a = mysqli_fetch_assoc($alumnos)): ?>
                                    <option value="<?php echo $a['id']; ?>"><?php echo $a['apellido'] . ', ' . $a['nombre'] . ' (DNI: ' . $a['dni'] . ')'; ?></option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mesa de Examen:</label>
                        <select name="id_mesa" class="form-select" required>
                            <option value="">-- Seleccionar Mesa --</option>
                            <?php if ($mesas): ?>
                                <?php while ($m = mysqli_fetch_assoc($mesas)): ?>
                                    <option value="<?php echo $m['id']; ?>"><?php echo $m['materia'] . ' - ' . date('d/m/Y', strtotime($m['fecha'])) . ' (' . ucfirst($m['tipo']) . ')'; ?></option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Inscribir</button>
                </div>
            </form>

            <h3 class="mb-3">Inscripciones Registradas</h3>
            <div class="table-responsive card p-3 shadow-sm mb-5">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>DNI</th>
                            <th>Materia</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Asistencia</th>
                            <th>Nota</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($inscripciones && mysqli_num_rows($inscripciones) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($inscripciones)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['apellido'] . ', ' . $row['nombre']; ?></td>
                                    <td><?php echo $row['dni']; ?></td>
                                    <td><?php echo $row['materia']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['fecha'])); ?></td>
                                    <td><span class="badge bg-<?php echo ($row['tipo'] == 'libre') ? 'danger' : 'primary'; ?>"><?php echo ucfirst($row['tipo']); ?></span></td>
                                    <td><?php echo $row['asistencia'] ? $row['asistencia'] : '<span class="text-muted">—</span>'; ?></td>
                                    <td><?php echo $row['nota'] !== null ? $row['nota'] : '<span class="text-muted">—</span>'; ?></td>
                                    <td class="text-center">
                                        <a href="mod_inscripciones.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta inscripción?')"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No hay inscripciones registradas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

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
