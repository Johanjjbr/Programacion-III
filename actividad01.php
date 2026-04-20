<?php
/* Ejercicio de programacion para el dia Lunes:

Desarrollar un programa que permita ingresar a traves de un formulario 3 notas correspondientes a los parciales de programacion 3.

Se pide: 
* Crear una funcion que reciba las 3 notas y permita calcular el promedio
* Mostrar el promedio calculado en el programa principal
* Si el promedio es mayor o igual a 6 mostrar el cartel "Alumno aprobado"; si el promedio es menor a 6 mostrar el cartel "Alumno desaprobado"*/

function promedio($n1, $n2, $n3){
    $promedio = ($n1 + $n2 + $n3) / 3;
    return (int)$promedio;
}   

$n1 = 7;
$n2 = 8;        
$n3 = 5;
$promedio = promedio($n1, $n2, $n3);
echo "<div>El promedio es: $promedio</div>";
if($promedio >= 6){
    echo "<div>Alumno aprobado</div>";
} else {
    echo "<div>Alumno desaprobado</div>";
}
?>
