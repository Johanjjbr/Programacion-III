<?php
$mensaje = "";
$tipo_alerta = "";

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_id_per = $_POST["id_per"];
    $form_id_dep = $_POST["id_dep"];

    if (isset($_POST["old_id_per"]) && isset($_POST["old_id_dep"])) {
        $old_per = $_POST["old_id_per"];
        $old_dep = $_POST["old_id_dep"];

        $consulta = "UPDATE realiza 
                     SET persona_id = $form_id_per, deporte_id = $form_id_dep 
                     WHERE persona_id = $old_per AND deporte_id = $old_dep";
        $txt_exito = "Vínculo modificado con éxito.";
    } else {
        // Es un Alta
        $consulta = "INSERT INTO realiza (persona_id, deporte_id) VALUES ($form_id_per, $form_id_dep)";
        $txt_exito = "Vínculo creado con éxito. Se ha asignado el deporte a la persona.";
    }

    if (mysqli_query($enlace, $consulta)) {
        $mensaje = $txt_exito;
        $tipo_alerta = "success";
    } else {
        $mensaje = "Error en la consulta (posiblemente la persona ya realiza este deporte): " . mysqli_error($enlace);
        $tipo_alerta = "danger"; 
    }
}

if (isset($_GET["del_per"]) && isset($_GET["del_dep"])) {
    $del_per = $_GET["del_per"];
    $del_dep = $_GET["del_dep"];
    
    $consulta_baja = "DELETE FROM realiza WHERE persona_id = $del_per AND deporte_id = $del_dep";
    
    if (mysqli_query($enlace, $consulta_baja)) {
        $mensaje = "Vínculo eliminado con éxito.";
        $tipo_alerta = "warning";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

$edit_per = null;
$edit_dep = null;
if (isset($_GET["edit_per"]) && isset($_GET["edit_dep"])) {
    $edit_per = $_GET["edit_per"];
    $edit_dep = $_GET["edit_dep"];
}

$consulta_personas = "SELECT id, nombre, dni FROM persona ORDER BY nombre ASC";
$resultado_personas = mysqli_query($enlace, $consulta_personas);

$consulta_deportes = "SELECT id, nombre, categoria FROM deporte ORDER BY nombre ASC";
$resultado_deportes = mysqli_query($enlace, $consulta_deportes);

$consulta_lista = "SELECT r.persona_id, r.deporte_id, p.nombre AS persona_nom, p.dni, d.nombre AS deporte_nom, d.categoria 
                   FROM realiza r
                   INNER JOIN persona p ON r.persona_id = p.id
                   INNER JOIN deporte d ON r.deporte_id = d.id
                   ORDER BY p.nombre ASC";
$resultado_lista = mysqli_query($enlace, $consulta_lista);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    
 <?php include("menu.php"); ?>
 
    <h2 class="text-center mb-4"><?php echo ($edit_per && $edit_dep) ? "Modificar Vínculo" : "Vincular Persona con Deporte"; ?></h2>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="abm_realiza.php" method="POST" class="card p-4 shadow mb-5">
        
        <?php if ($edit_per && $edit_dep): ?>
            <input type="hidden" name="old_id_per" value="<?php echo $edit_per; ?>">
            <input type="hidden" name="old_id_dep" value="<?php echo $edit_dep; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Seleccionar Persona:</label>
            <select name="id_per" class="form-select" required>
                <option value="" disabled <?php echo (!$edit_per) ? 'selected' : ''; ?>>-- Elija una persona --</option>
                <?php
                if ($resultado_personas && mysqli_num_rows($resultado_personas) > 0) {
                    mysqli_data_seek($resultado_personas, 0); 
                    while ($persona = mysqli_fetch_assoc($resultado_personas)) {
                        $selected = ($edit_per == $persona['id']) ? 'selected' : '';
                        echo "<option value='" . $persona['id'] . "' $selected>" . $persona['nombre'] . " (DNI: " . $persona['dni'] . ")</option>";
                    }
                } else {
                    echo "<option value='' disabled>No hay personas registradas</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Seleccionar Deporte:</label>
            <select name="id_dep" class="form-select" required>
                <option value="" disabled <?php echo (!$edit_dep) ? 'selected' : ''; ?>>-- Elija un deporte --</option>
                <?php
                if ($resultado_deportes && mysqli_num_rows($resultado_deportes) > 0) {
                    mysqli_data_seek($resultado_deportes, 0);
                    while ($deporte = mysqli_fetch_assoc($resultado_deportes)) {
                        $selected = ($edit_dep == $deporte['id']) ? 'selected' : '';
                        echo "<option value='" . $deporte['id'] . "' $selected>" . $deporte['nombre'] . " - " . ucfirst($deporte['categoria']) . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No hay deportes registrados</option>";
                }
                ?>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn <?php echo ($edit_per && $edit_dep) ? 'btn-info text-white' : 'btn-warning'; ?>">
                <?php echo ($edit_per && $edit_dep) ? "Guardar Cambios" : "Crear Vínculo"; ?>
            </button>
            <?php if ($edit_per && $edit_dep): ?>
                <a href="abm_realiza.php" class="btn btn-secondary">Cancelar</a>
            <?php endif; ?>
        </div>
    </form>

    <h3 class="mb-3">Vínculos Existentes</h3>
    <div class="table-responsive card p-3 shadow-sm mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Persona</th>
                    <th>Deporte</th>
                    <th>Categoría</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado_lista && mysqli_num_rows($resultado_lista) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado_lista)): ?>
                        <tr>
                            <td><?php echo $row['persona_nom'] . " <small class='text-muted'>(" . $row['dni'] . ")</small>"; ?></td>
                            <td class="fw-bold"><?php echo $row['deporte_nom']; ?></td>
                            <td><?php echo ucfirst($row['categoria']); ?></td>
                            <td class="text-center">
                                <a href="abm_realiza.php?edit_per=<?php echo $row['persona_id']; ?>&edit_dep=<?php echo $row['deporte_id']; ?>" class="btn btn-sm btn-info text-white">Editar</a>
                                <a href="abm_realiza.php?del_per=<?php echo $row['persona_id']; ?>&del_dep=<?php echo $row['deporte_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Desvincular esta persona de este deporte?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay vínculos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
        <--- Todos los estilos fueron hecho con IA >

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($enlace);
?>