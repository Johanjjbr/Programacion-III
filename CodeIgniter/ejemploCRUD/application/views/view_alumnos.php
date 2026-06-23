<script type="text/javascript">
            $(document).ready(function() {
                $('#alumnos').dataTable( {
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                } );
            } );
</script>

<div id="container">
	<h2 align="center">Listado de Alumnos</h2>
	<?php
if(isset($_GET['save'])){
	echo '<div class="alert alert-success text-center">La Informacion se Almaceno Correctamente</div>';
}
if(isset($_GET['delete'])){
	echo '<div class="alert alert-warning text-center">La Informacion se ha Eliminado Correctamente</div>';
}
if(isset($_GET['update'])){
	echo '<div class="alert alert-success text-center">La Informacion se Actualizo Correctamente</div>';
}
?>
<center>
<table id="alumnos" border="0" cellpadding="0" cellspacing="0" class="pretty">
<thead>
<tr>
<th>ACCION</th>
<th>NOMBRE</th>
<th>APELLIDO</th>
<th>DNI</th>
<th>MAIL</th>
<th>TELEFONO</th>
</tr>
</thead>
<tbody>
 <?php 
 if(!empty($alumnos)){
 	foreach($alumnos as $alumno){
 		echo '<tr>';
		echo '<td>'
?>
		<a href="<?php echo base_url();?>index.php/alumnos/editar/<?php echo $alumno->ID;?>/" class="btn btn-success">Editar</a>
		<a href="<?php echo base_url();?>index.php/alumnos/eliminar/<?php echo $alumno->ID ?>" class="btn btn-danger">Eliminar</a>
<?php		
		echo '</td>';
 		echo '<td>'.$alumno->NOMBRE.'</td>';
		echo '<td>'.$alumno->APELLIDO.'</td>';
		echo '<td>'.$alumno->DNI.'</td>';
		echo '<td>'.$alumno->MAIL.'</td>';
		echo '<td>'.$alumno->TELEFONO.'</td>';
 		echo '</tr>';
 	} 
 }
 ?>
</tbody>
</table>
</center>
</div>