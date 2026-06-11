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

include("conexion.php");

$perfil = $_SESSION['perfil'];
$nombre = $_SESSION['nombre_completo'];

if (isset($_GET["cerrar_sesion"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

function mostrar ($d){
    if ($d = 1) {
        echo "Hola mundo";
    }   }
  
mostrar(1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Exámenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="d-flex" style="min-height: 100vh;">

        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px;">
            <a href="index.php" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <span class="fs-5 fw-bold">Sistema Exámenes</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-white active">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <?php if ($perfil == 'Administrativo'): ?>
                <li>
                    <a href="mod_alumnos.php" class="nav-link text-white">
                        <i class="bi bi-people me-2"></i> Alumnos
                    </a>
                </li>
                <li>
                    <a href="mod_mesas.php" class="nav-link text-white">
                        <i class="bi bi-calendar-event me-2"></i> Mesas de Examen
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="mod_inscripciones.php" class="nav-link text-white">
                        <i class="bi bi-pencil-square me-2"></i> Inscripciones
                    </a>
                </li>
                <?php if ($perfil == 'Administrativo'): ?>
                <li>
                    <a href="carga_notas.php" class="nav-link text-white">
                        <i class="bi bi-star me-2"></i> Carga de Notas
                    </a>
                </li>
                <li>
                    <a href="listados.php" class="nav-link text-white">
                        <i class="bi bi-list-ul me-2"></i> Listados
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <strong><?php echo $nombre; ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><span class="dropdown-item-text"><span class="badge bg-info"><?php echo $perfil; ?></span></span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="index.php?cerrar_sesion=1">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Panel Principal</h2>
                <a href="index.php?cerrar_sesion=1" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-people fs-1"></i>
                            <h5 class="card-title mt-2">Alumnos</h5>
                            <?php
                            $res = mysqli_query($datos, "SELECT COUNT(*) as total FROM alumnos");
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <p class="card-text display-6"><?php echo $row['total']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-event fs-1"></i>
                            <h5 class="card-title mt-2">Mesas</h5>
                            <?php
                            $res = mysqli_query($datos, "SELECT COUNT(*) as total FROM mesas_examen");
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <p class="card-text display-6"><?php echo $row['total']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-pencil-square fs-1"></i>
                            <h5 class="card-title mt-2">Inscripciones</h5>
                            <?php
                            $res = mysqli_query($datos, "SELECT COUNT(*) as total FROM inscripciones");
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <p class="card-text display-6"><?php echo $row['total']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-star fs-1"></i>
                            <h5 class="card-title mt-2">Con Notas</h5>
                            <?php
                            $res = mysqli_query($datos, "SELECT COUNT(*) as total FROM inscripciones WHERE nota IS NOT NULL");
                            $row = mysqli_fetch_assoc($res);
                            ?>
                            <p class="card-text display-6"><?php echo $row['total']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Bienvenido</h5>
                        </div>
                        <div class="card-body">
                            <h4>¡Hola, <?php echo $nombre; ?>!</h4>
                            <p class="text-muted">Tu perfil es: <span class="badge bg-<?php echo ($perfil == 'Administrativo') ? 'primary' : 'secondary'; ?>"><?php echo $perfil; ?></span></p>
                            <p>Selecciona una opción del menú lateral para comenzar a trabajar.</p>
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
<?php mysqli_close($datos); ?>
