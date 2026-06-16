<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echo con CodeIgniter</title>
    <style type="text/css">     </style>
</head>
<body>
    <div id="container">
        <h1>Alumno de la TSDS</h1>
        <div id="body">
<?php $cantidad = sizeof($alumno);
if ($cantidad >0){ ?>
<table style="border:1px solid black">
    <caption>LISTADO</caption>
    <th></th>
    <th>Nombre</th>
    <th>DNI</th>
    <th>Celular</th>
    <th>Domicilio</th>
    <th>Mail</th>
    <?php for ($x = 0; $x < $cantidad; $x++) { ?>
    <tr>
        <td><?php echo ($x + 1); ?></td>
        <td><?php echo $alumno[$x]['nombre']; ?></td>
        <td><?php echo $alumno[$x]['dni']; ?></td>
        <td><?php echo $alumno[$x]['telefono']; ?></td>
        <td><?php echo $alumno[$x]['direccion']; ?></td>
        <td><?php echo $alumno[$x]['mail']; ?></td>
    </tr>
    <?php } ?>
</table>

<p> Total alumno: <?php echo $cantidad; ?> </p>
<?php } else { ?>
<p> No hay alumno para mostrar </p>
<?php } ?>
        </div>

<p class="footer">Page renderizada en  <strong>{elapsed_time}</strong> segundos. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
   </div>
</body>
</html>