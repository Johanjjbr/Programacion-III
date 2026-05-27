<?php
include("conexion.php");

$dni_buscado = "";
$deportes_por_dni = null;
$cant_deportes = 0;
$nombre_persona_dni = "";
$deporte_seleccionado = "";
$personas_por_deporte = null;

if (isset($_GET["dni_buscar"]) && !empty($_GET["dni_buscar"])) {
    $dni_buscado = $_GET["dni_buscar"];
    
    $q_per = "SELECT nombre FROM persona WHERE dni = '$dni_buscado'";
    $res_per = mysqli_query($enlace, $q_per);
    if($res_per && mysqli_num_rows($res_per) > 0) {
        $p_data = mysqli_fetch_assoc($res_per);
        $nombre_persona_dni = $p_data['nombre'];
        
        $dnibuscar = "SELECT d.nombre, d.categoria 
                        FROM realiza r
                        INNER JOIN persona p ON r.persona_id = p.id
                        INNER JOIN deporte d ON r.deporte_id = d.id
                        WHERE p.dni = '$dni_buscado'";
        $deportes_por_dni = mysqli_query($enlace, $dnibuscar);
        $cant_deportes = mysqli_num_rows($deportes_por_dni);
    } else {
        $nombre_persona_dni = "No encontrada";
    }
}

if (isset($_GET["deporte_id"]) && !empty($_GET["deporte_id"])) {
    $deporte_seleccionado = $_GET["deporte_id"];
    
    $deportebuscar = "SELECT p.nombre, p.dni, p.edad 
                    FROM realiza r
                    INNER JOIN deporte d ON r.deporte_id = d.id
                    INNER JOIN persona p ON r.persona_id = p.id
                    WHERE d.id = $deporte_seleccionado";
    $personas_por_deporte = mysqli_query($enlace, $deportebuscar);
}

$deportemas = "SELECT d.nombre, COUNT(r.deporte_id) as total
                FROM realiza r
                INNER JOIN deporte d ON r.deporte_id = d.id
                GROUP BY r.deporte_id
                ORDER BY total DESC
                LIMIT 1";
$res_4c = mysqli_query($enlace, $deportemas);
$deporte_top = ($res_4c && mysqli_num_rows($res_4c) > 0) ? mysqli_fetch_assoc($res_4c) : null;

$listado_deportes_select = mysqli_query($enlace, "SELECT id, nombre FROM deporte ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listados e Informes - Desafío</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <?php include("menu.php"); ?>

    <h2 class="text-center mb-5 text-primary">Panel de Listados e Informes</h2>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card text-center bg-light shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <strong>Estadísticas Globales</strong>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Deporte más Practicado actualmente:</h4>
                    <?php if ($deporte_top): ?>
                        <p class="display-6 text-success fw-bold"><?php echo $deporte_top['nombre']; ?></p>
                        <p class="card-text text-muted">Practicado por un total de: <strong><?php echo $deporte_top['total']; ?></strong> persona(s).</p>
                    <?php else: ?>
                        <p class="text-muted">Aún no hay ningún vínculo guardado en el sistema.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">Deportes que realiza una Persona</h5>
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="dni_buscar" class="form-control" placeholder="Ingrese DNI..." required value="<?php echo htmlspecialchars($dni_buscado); ?>">
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>
                    </form>

                    <?php if (!empty($dni_buscado)): ?>
                        <?php if ($nombre_persona_dni == "No encontrada"): ?>
                            <div class="alert alert-danger py-2">No existe una persona registrada con el DNI ingresado.</div>
                        <?php else: ?>
                            <div class="bg-light p-3 rounded mb-2 border">
                                <strong>Persona:</strong> <?php echo $nombre_persona_dni; ?><br>
                                <strong>Total de deportes:</strong> <span class="badge bg-info text-dark fs-6"><?php echo $cant_deportes; ?></span>
                            </div>
                            
                            <?php if ($cant_deportes > 0): ?>
                                <ul class="list-group">
                                    <?php while ($dep = mysqli_fetch_assoc($deportes_por_dni)): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?php echo $dep['nombre']; ?>
                                            <span class="badge bg-secondary"><?php echo ucfirst($dep['categoria']); ?></span>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted italic small mt-2">Esta persona aún no tiene deportes asignados.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">Personas por Deporte en Particular</h5>
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <select name="deporte_id" class="form-select" required>
                                <option value="" disabled selected>-- Elija Deporte --</option>
                                <?php if ($listado_deportes_select): ?>
                                    <?php while ($d_sel = mysqli_fetch_assoc($listado_deportes_select)): ?>
                                        <option value="<?php echo $d_sel['id']; ?>" <?php echo ($deporte_seleccionado == $d_sel['id']) ? 'selected' : ''; ?>>
                                            <?php echo $d_sel['nombre']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                            <button class="btn btn-outline-success" type="submit">Listar</button>
                        </div>
                    </form>

                    <?php if ($personas_por_deporte): ?>
                        <h6 class="mt-3">Personas inscritas:</h6>
                        <?php if (mysqli_num_rows($personas_por_deporte) > 0): ?>
                            <div class="list-group list-group-numbered">
                                <?php while ($per = mysqli_fetch_assoc($personas_por_deporte)): ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><?php echo $per['nombre']; ?></div>
                                            <small class="text-muted">DNI: <?php echo $per['dni']; ?></small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill"><?php echo $per['edad']; ?> años</span>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-secondary py-2 mt-2">Nadie practica este deporte todavía.</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 py-3 bg-light text-center border-top">
        <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Mayo 2026</p>
        <p>Programación 3 - TSDS</p>
        <!-- Todos los estilos fueron hechos con IA -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($enlace); ?>