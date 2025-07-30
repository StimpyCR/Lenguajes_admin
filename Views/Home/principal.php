<?php
// principal.php
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante Kerat</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Estilos/estilos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!-- NAVBAR -->
    <?php include_once '../Layout/navbar.php'; ?>

    <!-- VIDEO DE FONDO -->
    <header class="header">
        <video autoplay muted loop class="video-background">
            <source src="../../Views/Videos/fondo.mp4" type="video/mp4">
        </video>
        <div class="content text-center text-white">
            <h1 class="display-4">Bienvenido a Kerat</h1>
            <p class="lead">Donde cada plato cuenta una historia</p>
        </div>


    </header>



    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>


    <!-- FOOTER -->


</body>

</html>