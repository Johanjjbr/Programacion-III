<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARREGLOS - Unidad 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body >

    <div>
        <h1>Manejo de Arreglos</h1>
        <p>Ejemplo días de la Semana</p>

        <?php
        $semana[] = "Domingo";   
        $semana[] = "Lunes";      
        $semana[] = "Martes";     
        $semana[] = "Miércoles"; 
        $semana[] = "Jueves";    
        $semana[] = "Viernes";   
        $semana[] = "Sábado";    

        echo "<p >Muestra el segundo día del arreglo: <strong>" . $semana[2] . "</strong></p>";
        echo "<p >Muestra el tercer día del arreglo: <strong>" . $semana[3] . "</strong></p>";
        ?>
    </div>
<footer class="mt-5 text-center text-muted">    
    <p>Johan Brito - Programación III</p>
</footer>


</body>
</html>