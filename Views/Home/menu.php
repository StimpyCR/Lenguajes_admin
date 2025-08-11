<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
    
    // Validación de si el usuario inició sesión (NO ELIMINAR, SOLO COMENTAR DE SER NECESARIO)
    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menu.css">
<link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menuModal.css"> <!-- CSS del modal -->

<?php
AddCss();
?>

<body>
    <div id="main-wrapper">
        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- Encabezado del Menú -->
                <div class="menu-header text-center">
                    <h1>Menú de Platillos</h1>
                    <p>Descubre nuestras opciones deliciosas</p>
                    <!-- <div class="menu-search">
                        <input type="text" placeholder="Buscar platillo...">
                        <button><i class="fas fa-search"></i></button>
                    </div> -->
                </div>

                <!-- Contenedor de Categorías -->
                <div class="menu-container">
                    <?php foreach($categoriasActivas as $categoria): ?>
                        <form action="/LENGUAJES_ADMIN/index.php?controller=home&action=listado" method="POST" style="display:inline-block; position:relative;">
                            <input type="hidden" name="categoria" value="<?= $categoria['descripcion'] ?>">

                            <div class="menu-card" style="cursor:pointer;">
                                <img src="<?= $categoria["rutaImagen"] ?>" alt="">
                                <h3><?= $categoria["descripcion"] ?></h3>
                            </div>

                            <button type="submit" style="
                                position:absolute;
                                top:0; left:0;
                                width:100%; height:100%;
                                background:none;
                                border:none;
                                cursor:pointer;
                                opacity:0;
                            "></button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>