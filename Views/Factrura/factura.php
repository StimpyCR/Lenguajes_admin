<?php
// Views/Factura/facturacion.php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<head>
    <meta charset="utf-8">
    <title>Generar factura</title>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/perfil.css">
</head>

<body>
    <div id="main-wrapper">
        <?php ShowHeader();
        ShowSideBar(); ?>
        <div class="page-wrapper">
            <div class="container-fluid py-5">
                <div class="alert alert-warning">
                    Para generar la factura, vuelve al carrito y confirma tu compra.
                </div>
                <a href="/LENGUAJES_ADMIN/Views/Carrito/carrito.php" class="btn btn-primary">Volver al carrito</a>

                <!-- (Opcional) Demo mínima: enviar estructura esperada al controlador -->
                <!-- <form action="/LENGUAJES_ADMIN/Controllers/FacturaController.php" method="post">
          <input type="hidden" name="items[0][id]" value="101">
          <input type="hidden" name="items[0][nombre]" value="Hamburguesa Clásica">
          <input type="hidden" name="items[0][precio]" value="3500">
          <input type="hidden" name="items[0][cantidad]" value="2">
          <input type="hidden" name="metodo_pago" value="efectivo">
          <button class="btn btn-success mt-3">Probar generación</button>
        </form> -->
            </div>
            <?php ShowFooter(); ?>
        </div>
    </div>
    <div class="chat-windows"></div>
    <?php AddJs(); ?>
</body>

</html>