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
    $form_nom  = mysqli_real_escape_string($enlace, $_POST["nom"]);
    $form_ape  = mysqli_real_escape_string($enlace, $_POST["ape"]);
    $form_dni  = mysqli_real_escape_string($enlace, $_POST["dni"]);
    $form_dir  = mysqli_real_escape_string($enlace, $_POST["dir"]);
    $form_tel  = mysqli_real_escape_string($enlace, $_POST["tel"]);
    $form_mail = mysqli_real_escape_string($enlace, $_POST["mail"]);

    if (isset($_POST["editado"]) && !empty($_POST["editado"])) {
        $id_edit = $_POST["editado"];
        $consulta = "UPDATE alumnos SET nombre='$form_nom', apellido='$form_ape', dni='$form_dni', direccion='$form_dir', telefono='$form_tel', email='$form_mail' WHERE id=$id_edit";
        $txt_exito = "Alumno modificado";
    } else {
        $consulta = "INSERT INTO alumnos (nombre, apellido, dni, direccion, telefono, email) VALUES ('$form_nom', '$form_ape', '$form_dni', '$form_dir', '$form_tel', '$form_mail')";
        $txt_exito = "Alumno registrado";
    }

    if (mysqli_query($enlace, $consulta)) {
        $mensaje = $txt_exito;
        $tipo_alerta = "success";
    } else {
        $mensaje = "Error en la operación: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

if (isset($_GET["eliminar"])) {
    $id_eliminar = $_GET["eliminar"];
    $consulta_baja = "DELETE FROM alumnos WHERE id = $id_eliminar";
    if (mysqli_query($enlace, $consulta_baja)) {
        $mensaje = "Alumno eliminado";
        $tipo_alerta = "warning";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

$alumno_editar = null;
if (isset($_GET["editar"])) {
    $editado = $_GET["editar"];
    $consulta_buscar = "SELECT * FROM alumnos WHERE id = $editado";
    $res_buscar = mysqli_query($enlace, $consulta_buscar);
    if ($res_buscar && mysqli_num_rows($res_buscar) > 0) {
        $alumno_editar = mysqli_fetch_assoc($res_buscar);
    }
}

$consulta_lista = "SELECT * FROM alumnos ORDER BY id DESC";
$resultado_lista = mysqli_query($enlace, $consulta_lista);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
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
                <li><a href="mod_alumnos.php" class="nav-link text-white active"><i class="bi bi-people me-2"></i> Alumnos</a></li>
                <li><a href="mod_mesas.php" class="nav-link text-white"><i class="bi bi-calendar-event me-2"></i> Mesas de Examen</a></li>
                <li><a href="mod_inscripciones.php" class="nav-link text-white"><i class="bi bi-pencil-square me-2"></i> Inscripciones</a></li>
                <li><a href="carga_notas.php" class="nav-link text-white"><i class="bi bi-star me-2"></i> Carga de Notas</a></li>
                <li><a href="listados.php" class="nav-link text-white"><i class="bi bi-list-ul me-2"></i> Listados</a></li>
            </ul>
            <hr>
            <a href="index.php?cerrar_sesion=1" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
        </div>

        <div class="container-fluid p-4">
            <h2 class="mb-4"><?php echo $alumno_editar ? "Modificar Alumno" : "Alta de Alumno"; ?></h2>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="mod_alumnos.php" method="POST" class="card p-4 shadow mb-5">
                <?php if ($alumno_editar): ?>
                    <input type="hidden" name="editado" value="<?php echo $alumno_editar['id']; ?>">
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre:</label>
                        <input type="text" name="nom" class="form-control" required value="<?php echo $alumno_editar ? $alumno_editar['nombre'] : ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellido:</label>
                        <input type="text" name="ape" class="form-control" required value="<?php echo $alumno_editar ? $alumno_editar['apellido'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DNI:</label>
                        <input type="text" name="dni" class="form-control" required value="<?php echo $alumno_editar ? $alumno_editar['dni'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Teléfono:</label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $alumno_editar ? $alumno_editar['telefono'] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email:</label>
                        <input type="email" name="mail" class="form-control" value="<?php echo $alumno_editar ? $alumno_editar['email'] : ''; ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Dirección:</label>
                        <input type="text" name="dir" class="form-control" value="<?php echo $alumno_editar ? $alumno_editar['direccion'] : ''; ?>">
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn <?php echo $alumno_editar ? 'btn-warning' : 'btn-primary'; ?>">
                        <?php echo $alumno_editar ? "Guardar Cambios" : "Registrar Alumno"; ?>
                    </button>
                    <?php if ($alumno_editar): ?>
                        <a href="mod_alumnos.php" class="btn btn-secondary">Cancelar Edición</a>
                    <?php endif; ?>
                </div>
            </form>

            <h3 class="mb-3">Alumnos Registrados</h3>
            <div class="table-responsive card p-3 shadow-sm mb-5">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado_lista && mysqli_num_rows($resultado_lista) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($resultado_lista)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['apellido']; ?></td>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['dni']; ?></td>
                                    <td><?php echo $row['telefono']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td class="text-center">
                                        <a href="mod_alumnos.php?editar=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white">Editar</a>
                                        <a href="mod_alumnos.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar a este alumno?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">No hay alumnos registrados.</td>
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
