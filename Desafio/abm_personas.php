<?php
include("conexion.php");

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_nom  = $_POST["nom"];
    $form_dni  = $_POST["dni"];
    $form_edad = $_POST["edad"];
    $form_gen  = $_POST["genero"];
    
    if (isset($_POST["id_editar"]) && !empty($_POST["id_editar"])) {
        // Es una Modificación (UPDATE)
        $id_edit = $_POST["id_editar"];
        $consulta = "UPDATE persona SET nombre='$form_nom', dni='$form_dni', edad=$form_edad, genero='$form_gen' WHERE id=$id_edit";
        $txt_exito = "Persona modificada con éxito.";
    } else {
        // Es un Alta (INSERT)
        $consulta = "INSERT INTO persona (nombre, dni, edad, genero) VALUES ('$form_nom', '$form_dni', $form_edad, '$form_gen')";
        $txt_exito = "Persona registrada con éxito.";
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
   
    $consulta_baja_relacion = "DELETE FROM realiza WHERE persona_id = $id_eliminar";
    mysqli_query($enlace, $consulta_baja_relacion);

    $consulta_baja = "DELETE FROM persona WHERE id = $id_eliminar";
    
    if (mysqli_query($enlace, $consulta_baja)) {
        $mensaje = "Persona eliminada con éxito.";
        $tipo_alerta = "warning";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($enlace);
        $tipo_alerta = "danger";
    }
}

$persona_editar = null;
if (isset($_GET["editar"])) {
    $id_editar = $_GET["editar"];
    $consulta_buscar = "SELECT * FROM persona WHERE id = $id_editar";
    $res_buscar = mysqli_query($enlace, $consulta_buscar);
    if ($res_buscar && mysqli_num_rows($res_buscar) > 0) {
        $persona_editar = mysqli_fetch_assoc($res_buscar);
    }
}

$consulta_lista = "SELECT * FROM persona ORDER BY id DESC";
$resultado_lista = mysqli_query($enlace, $consulta_lista);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ABM Personas - Desafío</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<?php include("menu.php"); ?>

    <h2 class="text-center mb-4"><?php echo $persona_editar ? "Modificar Persona" : "Alta de Persona"; ?></h2>
    
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="abm_personas.php" method="POST" class="card p-4 shadow mb-5">
        <?php if ($persona_editar): ?>
            <input type="hidden" name="id_editar" value="<?php echo $persona_editar['id']; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Nombre Completo:</label>
            <input type="text" name="nom" class="form-control" required value="<?php echo $persona_editar ? $persona_editar['nombre'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">DNI:</label>
            <input type="text" name="dni" class="form-control" required value="<?php echo $persona_editar ? $persona_editar['dni'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Edad:</label>
            <input type="number" name="edad" class="form-control" required value="<?php echo $persona_editar ? $persona_editar['edad'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Género:</label>
            <select name="genero" class="form-select">
                <option value="masculino" <?php echo ($persona_editar && $persona_editar['genero'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                <option value="femenino" <?php echo ($persona_editar && $persona_editar['genero'] == 'femenino') ? 'selected' : ''; ?>>Femenino</option>
            </select>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn <?php echo $persona_editar ? 'btn-warning' : 'btn-primary'; ?>">
                <?php echo $persona_editar ? "Guardar Cambios" : "Registrar Persona"; ?>
            </button>
            <?php if ($persona_editar): ?>
                <a href="abm_personas.php" class="btn btn-secondary">Cancelar Edición</a>
            <?php endif; ?>
        </div>
    </form>

    <h3 class="mb-3">Personas Registradas</h3>
    <div class="table-responsive card p-3 shadow-sm mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Edad</th>
                    <th>Género</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado_lista && mysqli_num_rows($resultado_lista) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado_lista)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['dni']; ?></td>
                            <td><?php echo $row['edad']; ?></td>
                            <td><?php echo ucfirst($row['genero']); ?></td>
                            <td class="text-center">
                                <a href="abm_personas.php?editar=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white">Editar</a>
                                <a href="abm_personas.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar a esta persona?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay registros cargados.</td>
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
<?php mysqli_close($enlace); ?>