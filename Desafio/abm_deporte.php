<?php
// Variables para manejar la notificación
$mensaje = "";
$tipo_alerta = "";

include("conexion.php");

// --- 1. PROCESAR ALTA O MODIFICACIÓN (POST) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_nom = $_POST["nom_deporte"];
    $form_desc = $_POST["desc"];
    $form_cat = $_POST["cat"];

    if (isset($_POST["id_editar"]) && !empty($_POST["id_editar"])) {
        // Es una Modificación (UPDATE)
        $id_edit = $_POST["id_editar"];
        $consulta = "UPDATE deporte SET nombre='$form_nom', descripcion='$form_desc', categoria='$form_cat' WHERE id=$id_edit";
        $txt_exito = "Deporte modificado con éxito.";
    } else {
        // Es un Alta (INSERT)
        $consulta = "INSERT INTO deporte (nombre, descripcion, categoria) VALUES ('$form_nom', '$form_desc', '$form_cat')";
        $txt_exito = "Deporte registrado con éxito.";
    }

    if (mysqli_query($enlace, $consulta)) {
        $mensaje = $txt_exito;
        $tipo_alerta = "success";
    } else {
        $mensaje = "Error en la consulta: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

// --- 2. PROCESAR BAJA / ELIMINAR (GET) ---
if (isset($_GET["eliminar"])) {
    $id_eliminar = $_GET["eliminar"];
    // Al igual que con personas, primero eliminamos las relaciones en 'realiza' para evitar errores de clave foránea
    $consulta_baja_relacion = "DELETE FROM realiza WHERE id_deporte = $id_eliminar";
    mysqli_query($enlace, $consulta_baja_relacion);

    $consulta_baja = "DELETE FROM deporte WHERE id = $id_eliminar";
    
    if (mysqli_query($enlace, $consulta_baja)) {
        $mensaje = "Deporte eliminado con éxito.";
        $tipo_alerta = "warning";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

// --- 3. CARGAR DATOS PARA MODIFICAR (GET) ---
$deporte_editar = null;
if (isset($_GET["editar"])) {
    $id_editar = $_GET["editar"];
    $consulta_buscar = "SELECT * FROM deporte WHERE id = $id_editar";
    $res_buscar = mysqli_query($enlace, $consulta_buscar);
    if ($res_buscar && mysqli_num_rows($res_buscar) > 0) {
        $deporte_editar = mysqli_fetch_assoc($res_buscar);
    }
}

// --- 4. OBTENER TODOS LOS DEPORTES PARA EL LISTADO ---
$consulta_lista = "SELECT * FROM deporte ORDER BY id DESC";
$resultado_lista = mysqli_query($enlace, $consulta_lista);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ABM Deportes - Desafío</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    
<?php include("menu.php"); ?>

    <h2 class="text-center mb-4"><?php echo $deporte_editar ? "Modificar Deporte" : "Alta de Deporte"; ?></h2>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="abm_deporte.php" method="POST" class="card p-4 shadow mb-5">
        <?php if ($deporte_editar): ?>
            <input type="hidden" name="id_editar" value="<?php echo $deporte_editar['id']; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Nombre del Deporte:</label>
            <input type="text" name="nom_deporte" class="form-control" required value="<?php echo $deporte_editar ? $deporte_editar['nombre'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="desc" class="form-control" rows="3"><?php echo $deporte_editar ? $deporte_editar['descripcion'] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría:</label>
            <select name="cat" class="form-select" required>
                <option value="amateur" <?php echo ($deporte_editar && $deporte_editar['categoria'] == 'amateur') ? 'selected' : ''; ?>>Amateur</option>
                <option value="profesional" <?php echo ($deporte_editar && $deporte_editar['categoria'] == 'profesional') ? 'selected' : ''; ?>>Profesional</option>
            </select>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn <?php echo $deporte_editar ? 'btn-warning' : 'btn-success'; ?>">
                <?php echo $deporte_editar ? "Guardar Cambios" : "Registrar Deporte"; ?>
            </button>
            <?php if ($deporte_editar): ?>
                <a href="abm_deporte.php" class="btn btn-secondary">Cancelar Edición</a>
            <?php endif; ?>
        </div>
    </form>

    <h3 class="mb-3">Deportes Registrados</h3>
    <div class="table-responsive card p-3 shadow-sm mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado_lista && mysqli_num_rows($resultado_lista) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado_lista)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td class="fw-bold"><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td>
                                <?php if($row['categoria'] == 'profesional'): ?>
                                    <span class="badge bg-danger">Profesional</span>
                                <?php else: ?>
                                    <span class="badge bg-primary">Amateur</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="abm_deporte.php?editar=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white">Editar</a>
                                <a href="abm_deporte.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este deporte?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay deportes registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
// Cerramos la conexión al final del archivo
mysqli_close($enlace); 
?>