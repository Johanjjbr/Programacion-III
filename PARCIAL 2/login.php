<?php
/*
 * Nombre y apellido del programador: Johan Brito
 * Fecha de desarrollo: Junio 2026
 * Materia: Programación 3 de la TSDS
 * Curso: 2da 1ra
 */

session_start();

if (isset($_SESSION['perfil'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_usuario = mysqli_real_escape_string($enlace, $_POST["usuario"]);
    $form_clave   = mysqli_real_escape_string($enlace, $_POST["clave"]);

    $consulta = "SELECT * FROM usuarios WHERE usuario = '$form_usuario' AND clave = '$form_clave'";
    $resultado = mysqli_query($enlace, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $user = mysqli_fetch_assoc($resultado);
        $_SESSION['perfil']          = $user['perfil'];
        $_SESSION['nombre_completo'] = $user['nombre_completo'];
        $_SESSION['usuario_id']      = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        $mensaje    = "Usuario o clave incorrectos.";
        $tipo_alerta = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Exámenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Sistema de Inscripción a Mesa de Examen</h3>
                        <p class="text-center text-muted mb-4">Ingrese sus credenciales</p>

                        <?php if (!empty($mensaje)): ?>
                            <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
                                <?php echo $mensaje; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Usuario:</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Clave:</label>
                                <input type="password" name="clave" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                        </form>
                    </div>
                </div>
                <footer class="mt-4 py-3 text-center text-muted">
                    <p><strong>Programador:</strong> Johan Brito | <strong>Fecha:</strong> Junio 2026</p>
                    <p>Programación 3 - TSDS | Curso: 2da 1ra</p>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($enlace); ?>
