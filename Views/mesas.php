<?php
require_once __DIR__ . '/../Models/Prueba.php';

$prueba = new Prueba();
$resultado = $prueba->mesasDisponibles();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mesas Disponibles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        pre {
            background-color: #f4f4f4;
            padding: 15px;
            border: 1px solid #ccc;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <h1>Mesas Disponibles</h1>
    <pre><?php echo htmlspecialchars($resultado); ?></pre>
</body>
</html>
