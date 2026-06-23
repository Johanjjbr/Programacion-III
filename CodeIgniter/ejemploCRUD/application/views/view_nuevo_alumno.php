<?php
	  echo '<center>';
	  echo '<table border=0 class="ventanas" width="650" cellspacing="0" cellpadding="0">';
	  echo '<tr>';
	  echo "<td height='10' class='tabla_ventanas_login' height='10' colspan='3'><legend align='center'>.: Alumno :.</legend></td>";
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
	'value'		  => set_value('NOMBRE',@$datos_alumno[0]->NOMBRE),
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
	
	$Apellido = array(
	'name'        => 'APELLIDO',
	'id'          => 'APELLIDO',
	'size'        => 50,
	'value'		  => set_value('APELLIDO',@$datos_alumno[0]->APELLIDO),
	'placeholder' => 'Apellido',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Apellido:",'APELLIDO').'</td>';
	echo '<td>';
	echo form_input($Apellido);
	echo '</td>';
	echo '<td><font color="red">'.form_error('APELLIDO').'</font></td>';
	echo '</tr>';
	
	$Dni = array(
	'name'        => 'DNI',
	'id'          => 'DNI',
	'size'        => 50,
	'value'		  => set_value('DNI',@$datos_alumno[0]->DNI),
	'placeholder' => 'DNI',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("DNI:",'DNI').'</td>';
	echo '<td>';
	echo form_input($Dni);
	echo '</td>';
	echo '<td><font color="red">'.form_error('DNI').'</font></td>';
	echo '</tr>';
	
	$Mail = array(
	'name'        => 'MAIL',
	'id'          => 'MAIL',
	'size'        => 50,
	'value'		  => set_value('MAIL',@$datos_alumno[0]->MAIL),
	'placeholder' => 'Mail',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Mail:",'MAIL').'</td>';
	echo '<td>';
	echo form_input($Mail);
	echo '</td>';
	echo '<td><font color="red">'.form_error('MAIL').'</font></td>';
	echo '</tr>';
	
	$Telefono = array(
	'name'        => 'TELEFONO',
	'id'          => 'TELEFONO',
	'size'        => 50,
	'value'		  => set_value('TELEFONO',@$datos_alumno[0]->TELEFONO),
	'placeholder' => 'Telefono',
	'type'        => 'text',
	);
	echo '<tr>';
	echo '<td>'.form_label("Telefono:",'TELEFONO').'</td>';
	echo '<td>';
	echo form_input($Telefono);
	echo '</td>';
	echo '<td><font color="red">'.form_error('TELEFONO').'</font></td>';
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