<?php
    require_once __DIR__.'/Models/Prueba.php';


    $prueba = new Prueba();
    $prueba -> mesasDisponibles();
    
// header("location: Views/Home/login.php");
?>
<html><!-- index.php -->
<a href="views/mesas.php">Ver mesas disponibles</a>

</html>
