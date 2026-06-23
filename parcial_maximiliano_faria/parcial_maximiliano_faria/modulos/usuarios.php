<?php
/*
Programador: Maximiliano Faria
Fecha de desarrollo: Junio/2026
Materia: Programacion 3 de la TSDS
Curso: Tecnicatura Superior en Desarrollo de Software
*/
require_once "../includes/auth.php";
solo_administrativo();
require_once "../includes/conexion.php";
require_once "../includes/funciones.php";

$perfiles = ["Administrativo", "Operador"];

function guardar_usuario($conexion) {
    $usuario = limpiar($_POST["usuario"]);
    $clave = limpiar($_POST["clave"]);
    $nombre = limpiar($_POST["nombre_completo"]);
    $perfil = limpiar($_POST["perfil"]);
    $sql = "INSERT INTO usuarios(usuario, clave, nombre_completo, perfil) VALUES(?,?,?,?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $usuario, $clave, $nombre, $perfil);
    mysqli_stmt_execute($stmt);
}

if (isset($_POST["guardar"])) {
    guardar_usuario($conexion);
}

if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);
    mysqli_query($conexion, "DELETE FROM usuarios WHERE id_usuario=$id");
}

$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY nombre_completo");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Control de acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/usuarios.css">
</head>
<body>
<div class="container py-4">
    <h1>Control de acceso</h1>
    <section class="panel mb-4">
        <form method="post" class="row g-3">
            <div class="col-md-3"><input class="form-control" name="usuario" placeholder="Usuario" required></div>
            <div class="col-md-3"><input class="form-control" name="clave" placeholder="Clave" required></div>
            <div class="col-md-4"><input class="form-control" name="nombre_completo" placeholder="Nombre completo" required></div>
            <div class="col-md-2">
                <select class="form-select" name="perfil">
                    <?php foreach ($perfiles as $perfil) { ?>
                        <option value="<?php echo $perfil; ?>"><?php echo $perfil; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12"><button class="btn btn-primary" name="guardar">Crear usuario</button></div>
        </form>
    </section>

    <table class="table table-bordered table-striped">
        <tr><th>Usuario</th><th>Nombre completo</th><th>Perfil</th><th>Accion</th></tr>
        <?php while ($u = mysqli_fetch_assoc($usuarios)) { ?>
            <tr>
                <td><?php echo $u["usuario"]; ?></td>
                <td><?php echo $u["nombre_completo"]; ?></td>
                <td><?php echo $u["perfil"]; ?></td>
                <td><a class="btn btn-sm btn-danger" href="?eliminar=<?php echo $u["id_usuario"]; ?>">Eliminar</a></td>
            </tr>
        <?php } ?>
    </table>
    <?php volver_principal(); ?>
</div>
</body>
</html>

