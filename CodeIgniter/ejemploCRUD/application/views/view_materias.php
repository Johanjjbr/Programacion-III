<script type="text/javascript">
            $(document).ready(function() {
                $('#materias').dataTable( {
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                } );
            } );
</script>

<div id="container">
	<h2 align="center">Listado de Materias</h2>
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
<table id="materias" border="0" cellpadding="0" cellspacing="0" class="pretty">
<thead>
<tr>
<th>ACCION</th>
<th>NOMBRE</th>
<th>CARGA HORARIA</th>
<th>AÑO</th>
<th>CARRERA</th>
<th>TIPO</th>
<th>CURSADO</th>
</tr>
</thead>
<tbody>
 <?php 
 if(!empty($materias)){
 	foreach($materias as $materia){
 		echo '<tr>';
		echo '<td>'
?>
		<a href="<?php echo base_url();?>index.php/materias/editar/<?php echo $materia->ID;?>/" class="btn btn-success">Editar</a>
		<a href="<?php echo base_url();?>index.php/materias/eliminar/<?php echo $materia->ID ?>" class="btn btn-danger">Eliminar</a>
<?php		
		echo '</td>';
 		echo '<td>'.$materia->NOMBRE.'</td>';
		echo '<td>'.$materia->CARGA_HORARIA.'</td>';
		echo '<td>'.$materia->ANO.'</td>';
		echo '<td>'.$materia->CARRERA.'</td>';
		echo '<td>'.$materia->TIPO.'</td>';
		echo '<td>'.$materia->CURSADO.'</td>';
 		echo '</tr>';
 	} 
 }
 ?>
</tbody>
</table>
</center>
</div>