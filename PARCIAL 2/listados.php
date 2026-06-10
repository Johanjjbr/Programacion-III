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

$perfil = $_SESSION['perfil'];

$tab_activa = isset($_GET['tab']) ? $_GET['tab'] : 'mesas';

$dni_buscado = "";
$info_alumno = null;
$inscripciones_alumno = null;

$mesa_seleccionada = "";
$inscriptos_por_mesa = null;

$listado_mesas_habilitadas = mysqli_query($enlace, "
    SELECT id, fecha, materia, tipo, titular, pvocal1, pvocal2
    FROM mesas_examen
    WHERE fecha <= CURDATE()
    ORDER BY fecha ASC
");

$listado_mesas_select = mysqli_query($enlace, "
    SELECT id, fecha, materia, tipo FROM mesas_examen ORDER BY fecha DESC
");

$listado_alumnos = mysqli_query($enlace, "
    SELECT id, nombre, apellido, dni, direccion, telefono, email
    FROM alumnos
    ORDER BY apellido ASC, nombre ASC
");

if (isset($_GET["dni_buscar"]) && !empty($_GET["dni_buscar"])) {
    $dni_buscado = mysqli_real_escape_string($enlace, $_GET["dni_buscar"]);
    $tab_activa = 'dni';

    $q_alum = "SELECT id, nombre, apellido, dni FROM alumnos WHERE dni = '$dni_buscado'";
    $res_alum = mysqli_query($enlace, $q_alum);
    if ($res_alum && mysqli_num_rows($res_alum) > 0) {
        $info_alumno = mysqli_fetch_assoc($res_alum);
        $id_alumno = $info_alumno['id'];

        $inscripciones_alumno = mysqli_query($enlace, "
            SELECT i.id, m.fecha, m.materia, m.tipo, i.asistencia, i.nota
            FROM inscripciones i
            INNER JOIN mesas_examen m ON i.id_mesa = m.id
            WHERE i.id_alumno = $id_alumno
            ORDER BY m.fecha DESC
        ");
    }
}

if (isset($_GET["id_mesa"]) && !empty($_GET["id_mesa"])) {
    $mesa_seleccionada = intval($_GET["id_mesa"]);
    $tab_activa = 'mesa_insc';

    $inscriptos_por_mesa = mysqli_query($enlace, "
        SELECT i.id, a.apellido, a.nombre, a.dni, i.asistencia, i.nota
        FROM inscripciones i
        INNER JOIN alumnos a ON i.id_alumno = a.id
        WHERE i.id_mesa = $mesa_seleccionada
        ORDER BY a.apellido ASC, a.nombre ASC
    ");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listados - Sistema de Exámenes</title>
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
                <li><a href="carga_notas.php" class="nav-link text-white"><i class="bi bi-star me-2"></i> Carga de Notas</a></li>
                <li><a href="listados.php" class="nav-link text-white active"><i class="bi bi-list-ul me-2"></i> Listados</a></li>
            </ul>
            <hr>
            <a href="index.php?cerrar_sesion=1" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
        </div>

        <div class="container-fluid p-4">
            <h2 class="mb-4">Listados e Informes</h2>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="listadosTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo ($tab_activa == 'mesas') ? 'active' : ''; ?>" id="tab-mesas" href="listados.php?tab=mesas" role="tab">
                        <i class="bi bi-calendar-check me-1"></i> Mesas Habilitadas
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo ($tab_activa == 'mesa_insc') ? 'active' : ''; ?>" id="tab-mesa-insc" href="listados.php?tab=mesa_insc" role="tab">
                        <i class="bi bi-people me-1"></i> Inscriptos por Mesa
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo ($tab_activa == 'dni') ? 'active' : ''; ?>" id="tab-dni" href="listados.php?tab=dni" role="tab">
                        <i class="bi bi-search me-1"></i> Buscar por DNI
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo ($tab_activa == 'alumnos') ? 'active' : ''; ?>" id="tab-alumnos" href="listados.php?tab=alumnos" role="tab">
                        <i class="bi bi-person-lines-fill me-1"></i> Alumnos (A-Z)
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- 1. Mesas Habilitadas -->
                <div class="tab-pane fade <?php echo ($tab_activa == 'mesas') ? 'show active' : ''; ?>" id="content-mesas">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Mesas de Examen Habilitadas</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Materia</th>
                                            <th>Tipo</th>
                                            <th>Titular</th>
                                            <th>Vocal 1</th>
                                            <th>Vocal 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($listado_mesas_habilitadas && mysqli_num_rows($listado_mesas_habilitadas) > 0): ?>
                                            <?php while ($m = mysqli_fetch_assoc($listado_mesas_habilitadas)): ?>
                                                <tr>
                                                    <td><?php echo $m['id']; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($m['fecha'])); ?></td>
                                                    <td><?php echo $m['materia']; ?></td>
                                                    <td><span class="badge bg-<?php echo ($m['tipo'] == 'libre') ? 'danger' : 'primary'; ?>"><?php echo ucfirst($m['tipo']); ?></span></td>
                                                    <td><?php echo $m['titular']; ?></td>
                                                    <td><?php echo $m['pvocal1']; ?></td>
                                                    <td><?php echo $m['pvocal2']; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr><td colspan="7" class="text-center text-muted">No hay mesas habilitadas.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Inscriptos por Mesa -->
                <div class="tab-pane fade <?php echo ($tab_activa == 'mesa_insc') ? 'show active' : ''; ?>" id="content-mesa-insc">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-people me-2"></i>Alumnos Inscriptos en una Mesa</h5>
                        </div>
                        <div class="card-body">
                            <form action="listados.php" method="GET" class="row g-3 mb-4">
                                <input type="hidden" name="tab" value="mesa_insc">
                                <div class="col-md-8">
                                    <select name="id_mesa" class="form-select" required>
                                        <option value="">-- Seleccionar Mesa --</option>
                                        <?php if ($listado_mesas_select): ?>
                                            <?php while ($m = mysqli_fetch_assoc($listado_mesas_select)): ?>
                                                <option value="<?php echo $m['id']; ?>" <?php echo ($mesa_seleccionada == $m['id']) ? 'selected' : ''; ?>>
                                                    <?php echo $m['materia'] . ' - ' . date('d/m/Y', strtotime($m['fecha'])) . ' (' . ucfirst($m['tipo']) . ')'; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-list me-1"></i> Listar Inscriptos</button>
                                </div>
                            </form>

                            <?php if ($inscriptos_por_mesa): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Apellido</th>
                                                <th>Nombre</th>
                                                <th>DNI</th>
                                                <th>Asistencia</th>
                                                <th>Nota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (mysqli_num_rows($inscriptos_por_mesa) > 0): ?>
                                                <?php while ($ins = mysqli_fetch_assoc($inscriptos_por_mesa)): ?>
                                                    <tr>
                                                        <td><?php echo $ins['id']; ?></td>
                                                        <td><?php echo $ins['apellido']; ?></td>
                                                        <td><?php echo $ins['nombre']; ?></td>
                                                        <td><?php echo $ins['dni']; ?></td>
                                                        <td><?php echo $ins['asistencia'] ? $ins['asistencia'] : '<span class="text-muted">—</span>'; ?></td>
                                                        <td><?php echo $ins['nota'] !== null ? $ins['nota'] : '<span class="text-muted">—</span>'; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr><td colspan="6" class="text-center text-muted">No hay alumnos inscriptos en esta mesa.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- 3. Buscar por DNI -->
                <div class="tab-pane fade <?php echo ($tab_activa == 'dni') ? 'show active' : ''; ?>" id="content-dni">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="bi bi-search me-2"></i>Buscar Alumno por DNI</h5>
                        </div>
                        <div class="card-body">
                            <form action="listados.php" method="GET" class="row g-3 mb-4">
                                <input type="hidden" name="tab" value="dni">
                                <div class="col-md-8">
                                    <input type="text" name="dni_buscar" class="form-control" placeholder="Ingrese el DNI del alumno..." required value="<?php echo htmlspecialchars($dni_buscado); ?>">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-warning w-100"><i class="bi bi-search me-1"></i> Buscar</button>
                                </div>
                            </form>

                            <?php if ($info_alumno): ?>
                                <div class="alert alert-info">
                                    <strong>Alumno:</strong> <?php echo $info_alumno['apellido'] . ', ' . $info_alumno['nombre']; ?> (DNI: <?php echo $info_alumno['dni']; ?>)
                                </div>

                                <?php if ($inscripciones_alumno && mysqli_num_rows($inscripciones_alumno) > 0): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Materia</th>
                                                    <th>Fecha</th>
                                                    <th>Tipo</th>
                                                    <th>Asistencia</th>
                                                    <th>Nota</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($ins = mysqli_fetch_assoc($inscripciones_alumno)): ?>
                                                    <tr>
                                                        <td><?php echo $ins['id']; ?></td>
                                                        <td><?php echo $ins['materia']; ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($ins['fecha'])); ?></td>
                                                        <td><span class="badge bg-<?php echo ($ins['tipo'] == 'libre') ? 'danger' : 'primary'; ?>"><?php echo ucfirst($ins['tipo']); ?></span></td>
                                                        <td><?php echo $ins['asistencia'] ? $ins['asistencia'] : '<span class="text-muted">—</span>'; ?></td>
                                                        <td><?php echo $ins['nota'] !== null ? $ins['nota'] : '<span class="text-muted">—</span>'; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-secondary">El alumno no tiene inscripciones registradas.</div>
                                <?php endif; ?>
                            <?php elseif (!empty($dni_buscado)): ?>
                                <div class="alert alert-danger">No se encontró ningún alumno con el DNI ingresado.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- 4. Alumnos Alfabético -->
                <div class="tab-pane fade <?php echo ($tab_activa == 'alumnos') ? 'show active' : ''; ?>" id="content-alumnos">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Listado General de Alumnos (Orden Alfabético)</h5>
                        </div>
                        <div class="card-body">
                            <?php if ($listado_alumnos && mysqli_num_rows($listado_alumnos) > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Apellido</th>
                                                <th>Nombre</th>
                                                <th>DNI</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($a = mysqli_fetch_assoc($listado_alumnos)): ?>
                                                <tr>
                                                    <td><?php echo $a['id']; ?></td>
                                                    <td><?php echo $a['apellido']; ?></td>
                                                    <td><?php echo $a['nombre']; ?></td>
                                                    <td><?php echo $a['dni']; ?></td>
                                                    <td><?php echo $a['direccion']; ?></td>
                                                    <td><?php echo $a['telefono']; ?></td>
                                                    <td><?php echo $a['email']; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-secondary">No hay alumnos registrados.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
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
