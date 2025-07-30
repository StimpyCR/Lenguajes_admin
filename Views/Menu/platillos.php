<?php
$nombre = $_GET['nombre'] ?? 'Platillo';
$desc = $_GET['desc'] ?? 'Descripción no disponible';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $nombre; ?></title>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menu.css">
    <style>
        body {
            font-family: 'EB Garamond', serif;
            background: #f8f8f8;
            margin: 0;
            padding: 40px;
            text-align: center;
        }

        .platillo-container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
        }

        p {
            font-size: 1.4rem;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background: #333;
            padding: 10px 20px;
            border-radius: 6px;
        }

        a:hover {
            background: #FFD700;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="platillo-container">
        <h1><?php echo $nombre; ?></h1>
        <p><?php echo $desc; ?></p>
        <a href="menu.php">Volver al Menú</a>
    </div>
</body>

</html>