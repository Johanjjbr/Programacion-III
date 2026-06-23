<?php
	  echo '<center>';
	  echo '<table border=0 class="ventanas" width="650" cellspacing="0" cellpadding="0">';
	  echo '<tr>';
	  echo "<td height='10' class='tabla_ventanas_login' height='10' colspan='3'><legend align='center'>.: Materia :.</legend></td>";
	  echo '</tr>';
	  echo '<tr><td colspan=3>';
	  $attributes = array("class" => "form-horizontal", "id" => "form", "name" => "form");
	  echo form_open();
	  echo '<center>';
	  echo '<table border=0>';
	  
	$Nombre = array(
	'name'        => 'NOMBRE',
	'id'          => 'NOMBRE',
	'size'        => 50,
	'value'		  => set_value('NOMBRE',@$datos_materia[0]->NOMBRE),
	'placeholder' => 'Nombre',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Nombre:",'NOMBRE').'</td>';
	echo '<td>';
	echo form_input($Nombre);
	echo '</td>';
	echo '<td><font color="red">'.form_error('NOMBRE').'</font></td>';
	echo '</tr>';
	
	$CargaHoraria = array(
	'name'        => 'CARGA_HORARIA',
	'id'          => 'CARGA_HORARIA',
	'size'        => 50,
	'value'		  => set_value('CARGA_HORARIA',@$datos_materia[0]->CARGA_HORARIA),
	'placeholder' => 'Carga Horaria',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Carga Horaria:",'CARGA_HORARIA').'</td>';
	echo '<td>';
	echo form_input($CargaHoraria);
	echo '</td>';
	echo '<td><font color="red">'.form_error('CARGA_HORARIA').'</font></td>';
	echo '</tr>';
	
	$ANO = array(
	'name'        => 'ANO',
	'id'          => 'ANO',
	'size'        => 50,
	'value'		  => set_value('ANO',@$datos_materia[0]->ANO),
	'placeholder' => 'Año',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Año:",'ANO').'</td>';
	echo '<td>';
	echo form_input($ANO);
	echo '</td>';
	echo '<td><font color="red">'.form_error('ANO').'</font></td>';
	echo '</tr>';
	
	$Carrera = array(
	'name'        => 'CARRERA',
	'id'          => 'CARRERA',
	'size'        => 50,
	'value'		  => set_value('CARRERA',@$datos_materia[0]->CARRERA),
	'placeholder' => 'Carrera',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Carrera:",'CARRERA').'</td>';
	echo '<td>';
	echo form_input($Carrera);
	echo '</td>';
	echo '<td><font color="red">'.form_error('CARRERA').'</font></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td colspan=3>'.$this->session->flashdata('msg').'</td>';
	echo '</tr>';
	echo '<tr><td colspan=3><hr/></td></tr>';
	echo '<tr>';
	echo '<td colspan=3><center>';
	echo '<input type="submit" class="btn btn-success" value="Guardar">';
    echo '</center></td></tr>';
    echo '</table></center>';
    echo form_close(); 
    echo '</td></tr>';
    echo '</table>';
    echo '</center>';
?>