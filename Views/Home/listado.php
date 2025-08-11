<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html lang="es">

<?php AddCss(); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/perfil.css">
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menu-categoria.css?ver=<?php echo time(); ?>">
    <title>Menú</title>
</head>

<body>
    <div id="main-wrapper">

        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- ===== Encabezado ===== -->
                <section class="mc-hero shadow-sm">
                    <div class="mc-hero__content">
                        <div>
                            <h1 class="mc-title mb-1">Menú · <span id="mcCategoria"><?= $categoriaSeleccionada ?></span></h1>
                            <p class="mc-subtitle">Explora todos los platillos de esta categoría.</p>
                        </div>
                    </div>
                </section>

                <!-- ===== Listado de productos ===== -->
                <section>
                    <div id="gridProductos" class="mc-grid mt-4">
                        <?php foreach($productosActivos as $producto): ?>
                            <article class="mc-card" data-nombre="">
                                <div class="mc-card__body">
                                    <div class="mc-card__text">
                                        <h3 class="mc-card__title"><?= $producto['nombre']?></h3>
                                        <p class="mc-card__desc"><?= $producto['descripcion']?></p>
                                    </div>
                                    <div class="mc-card__footer">
                                        <span class="mc-price">₡ <span class="mc-price__num"><?= $producto['precio']?></span></span>

                                        <!-- FORM POST -->
                                        <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=carrito&action=agregar" style="margin:0;">
                                            <input type="hidden" name="id_producto" value="<?= $producto['id']?>">
                                            <input type="hidden" name="cantidad" value="1">
                                            <button class="mc-btn mc-btn--ghost" type="submit">
                                                <i class="bi bi-plus-lg"></i> Agregar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>     
                        <?php endforeach; ?>
                    </div>
                </section>

            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>
</body>

</html>