<?php

function saludar($n){
    echo "<div>Hola $n </div>";
}

function suma($a,$b){
    $c = $a+ $b;
    echo "<div>$c</div>";
}

function doble($a){
    $c = $a * $a;
    echo "<div>$c</div>";
}

function edad($n){
    echo "<div>Tu edad es $n </div>";
}

function mayor($a, $b){
    if($a > $b){
        echo "<div>$a es mayor</div>";
    } elseif($b > $a){
        echo "<div>$b es mayor</div>";
    } else {
        echo "<div>Son iguales</div>";
    }
}

$n = "Johan";
$a = 5;
$b = 8;


saludar($n);
suma($a, $b);
doble($a);
edad(26);
mayor(28, 55);

?>