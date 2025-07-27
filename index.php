<?php
require_once __DIR__ . '/Models/Prueba.php';


$prueba = new Prueba();
$prueba->mesasDisponibles();

// header("location: Views/Home/login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="views/mesas.php">Ver mesas disponibles</a>

</html>
</body>

</html>
<html>