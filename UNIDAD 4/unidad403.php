<?php 
function resta(&$a){
    $a -=5;
    echo "dentro de la funcion $a = $a\n";
}

$x =10;

echo   "antes de llamar a la funcion x = $x\n";
resta($x);
echo "despues de llamar a la funcion x = $x\n"; 

?>
