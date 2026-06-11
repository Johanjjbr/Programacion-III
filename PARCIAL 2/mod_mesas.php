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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_fec    = mysqli_real_escape_string($datos, $_POST["fec"]);
    $form_mat    = mysqli_real_escape_string($datos, $_POST["mat"]);
    $form_tipo   = mysqli_real_escape_string($datos, $_POST["tipo"]);
    $form_titular = mysqli_real_escape_string($datos, $_POST["titular"]);
    $form_pvocal1 = mysqli_real_escape_string($datos, $_POST["pvocal1"]);
    $form_pvocal2 = mysqli_real_escape_string($datos, $_POST["pvocal2"]);

    if (isset($_POST["editado"]) && !empty($_POST["editado"])) {
        $id_edit = $_POST["editado"];
        $consulta = "UPDATE mesas_examen SET fecha='$form_fec', materia='$form_mat', tipo='$form_tipo', titular='$form_titular', pvocal1='$form_pvocal1', pvocal2='$form_pvocal2' WHERE id=$id_edit";
        $txt_exito = "Mesa modificada";
    } else {
        $consulta = "INSERT INTO mesas_examen (fecha, materia, tipo, titular, pvocal1, pvocal2) VALUES ('$form_fec', '$form_mat', '$form_tipo', '$form_titular', '$form_pvocal1', '$form_pvocal2')";
        $txt_exito = "Mesa registrada";
    }

    if (mysqli_query($datos, $consulta)) {
        $mensaje = $txt_exito;
        $tipo_alerta = "success";
    } else {
        $mensaje = "Error en la operación: " . mysqli_error($datos);
        $tipo_alerta = "danger";
    }
}

if (isset($_GET["eliminar"])) {
    $id_eliminar = $_GET["eliminar"];
    $consulta_baja = "DELETE FROM mesas_examen WHERE id = $id_eliminar";
    if (mysqli_query($datos, $consulta_baja)) {
        $mensaje = "Mesa eliminada";
        $tipo_alerta = "warning";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($datos);
        $tipo_alerta = "danger";
    }
}

$mesa_editar = null;
if (isset($_GET["editar"])) {
    $editado = $_GET["editar"];
    $consulta_buscar = "SELECT * FROM mesas_examen WHERE id = $editado";
    $res_buscar = mysqli_query($datos, $consulta_buscar);
    if ($res_buscar && mysqli_num_rows($res_buscar) > 0) {
        $mesa_editar = mysqli_fetch_assoc($res_buscar);
    }
}

$consulta_lista = "SELECT * FROM mesas_examen ORDER BY fecha DESC";
$resultado_lista = mysqli_query($datos, $consulta_lista);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Mesas de Examen</title>
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
                <li><a href="mod_mesas.php" class="nav-link text-white active"><i class="bi bi-calendar-event me-2"></i> Mesas de Examen</a></li>
                <li><a href="mod_inscripciones.php" class="nav-link text-white"><i class="bi bi-pencil-square me-2"></i> Inscripciones</a></li>
                <li><a href="carga_notas.php" class="nav-link text-white"><i class="bi bi-star me-2"></i> Carga de Notas</a></li>
                <li><a href="listados.php" class="nav-link text-white"><i class="bi bi-list-ul me-2"></i> Listados</a></li>
            </ul>
            <hr>
            <a href="index.php?cerrar_sesion=1" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
        </div>

        <div class="container-fluid p-4">
            <h2 class="mb-4"><?php echo $mesa_editar ? "Modificar Mesa de Examen" : "Alta de Mesa de Examen"; ?></h2>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="mod_mesas.php" method="POST" class="card p-4 shadow mb-5">
                <?php if ($mesa_editar): ?>
                    <input type="hidden" name="editado" value="<?php echo $mesa_editar['id']; ?>">
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha:</label>
                        <input type="date" name="fec" class="form-control" required value="<?php echo $mesa_editar ? $mesa_editar['fecha'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Materia:</label>
                        <input type="text" name="mat" class="form-control" required value="<?php echo $mesa_editar ? $mesa_editar['materia'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipo:</label>
                        <select name="tipo" class="form-select" required>
                            <option value="regular" <?php echo ($mesa_editar && $mesa_editar['tipo'] == 'regular') ? 'selected' : ''; ?>>Regular</option>
                            <option value="libre" <?php echo ($mesa_editar && $mesa_editar['tipo'] == 'libre') ? 'selected' : ''; ?>>Libre</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Titular:</label>
                        <input type="text" name="titular" class="form-control" required value="<?php echo $mesa_editar ? $mesa_editar['titular'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Vocal 1:</label>
                        <input type="text" name="pvocal1" class="form-control" required value="<?php echo $mesa_editar ? $mesa_editar['pvocal1'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Vocal 2:</label>
                        <input type="text" name="pvocal2" class="form-control" required value="<?php echo $mesa_editar ? $mesa_editar['pvocal2'] : ''; ?>">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn <?php echo $mesa_editar ? 'btn-warning' : 'btn-success'; ?>">
                        <?php echo $mesa_editar ? "Guardar Cambios" : "Registrar Mesa"; ?>
                    </button>
                    <?php if ($mesa_editar): ?>
                        <a href="mod_mesas.php" class="btn btn-secondary">Cancelar Edición</a>
                    <?php endif; ?>
                </div>
            </form>

            <h3 class="mb-3">Mesas Registradas</h3>
            <div class="table-responsive card p-3 shadow-sm mb-5">
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
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado_lista && mysqli_num_rows($resultado_lista) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($resultado_lista)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['fecha'])); ?></td>
                                    <td><?php echo $row['materia']; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo ($row['tipo'] == 'libre') ? 'danger' : 'primary'; ?>">
                                            <?php echo ucfirst($row['tipo']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $row['titular']; ?></td>
                                    <td><?php echo $row['pvocal1']; ?></td>
                                    <td><?php echo $row['pvocal2']; ?></td>
                                    <td class="text-center">
                                        <a href="mod_mesas.php?editar=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white">Editar</a>
                                        <a href="mod_mesas.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta mesa?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">No hay mesas registradas.</td>
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
<?php mysqli_close($datos); ?>
