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
        <h1>Playa de estacionamiento</h1>
        <div id="body">
<?php $cantidad = sizeof($turno);
if ($cantidad >0){ ?>
<table style="border:1px solid black">
    <caption>LISTADO</caption>
    <th>ID</th>
    <th>Horas</th>
    <th>Fecha</th>
    <th>Monto</th>
    <th>Patente</th>
    <?php for ($x = 0; $x < $cantidad; $x++) { ?>
    <tr>
        <td><?php echo ($x + 1); ?></td>
        <td><?php echo $turno[$x]['horas']; ?></td>
        <td><?php echo $turno[$x]['fecha']; ?></td>
        <td><?php echo $turno[$x]['monto']; ?></td>
        <td><?php echo $turno[$x]['patente']; ?></td>
    </tr>
    <?php } ?>
</table>

<p> Total turno: <?php echo $cantidad; ?> </p>
<?php } else { ?>
<p> No hay turno para mostrar </p>
<?php } ?>
        </div>

<p class="footer">Page renderizada en  <strong>{elapsed_time}</strong> segundos. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
   </div>
</body>
</html>