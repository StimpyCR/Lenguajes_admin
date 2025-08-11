<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html lang="es">

<?php
AddCss();
?>

<head>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/perfil.css">
</head>

<body>
    <div id="main-wrapper">

        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="container-fluid py-4">
                    <!-- Formulario de carrito -->
                    <form id="cartForm" class="row g-4" action="/LENGUAJES_ADMIN/index.php?controller=carrito&action=enrutadorAccion" method="POST">

                        <!-- ================== LISTA DE PRODUCTOS ================== -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm rounded-4">
                                <div class="card-header bg-dark text-white rounded-top-4">
                                    <strong>Mi carrito</strong>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Producto</th>
                                                    <th class="text-center" style="width: 120px;">Cantidad</th>
                                                    <th class="text-end" style="width: 140px;">Precio Unitario</th>
                                                    <th class="text-end" style="width: 160px;">Subtotal (sin IVA)</th>
                                                    <th class="text-center" style="width: 60px;"></th>
                                                </tr>
                                            </thead>

                                            <tbody id="cartItems">
                                                <?php if(empty($carrito) || count($carrito) == 0): ?>
                                                    <?php $total = 0; ?>
                                                    <?php $subtotalTotal = 0; ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted py-5">
                                                            Tu carrito está vacío.
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php $total = 0; ?>
                                                    <?php $subtotalTotal = 0; ?>
                                                    <?php foreach($carrito as $c): ?>
                                                        <?php $subtotalInd = 0; ?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <div>
                                                                        <div class="fw-semibold"><?= $c['NOMBRE_PRODUCTO'] ?></div>
                                                                        <div class="text-muted small">ID: 0<?= $c['IDPRODUCTO'] ?></div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="text-center">
                                                                <input type="hidden" name="idCarrito[]" value="<?= $c['IDCARRITO'] ?>">
                                                                <input type="hidden" name="idProducto[]" value="<?= $c['IDPRODUCTO'] ?>">
                                                                <input type="number" name="cantidad[]" class="form-control form-control-sm text-center cantidad-input d-none" min="1" value="<?= $c['CANTIDAD'] ?>">
                                                                <span class="cantidad-text"><?= $c['CANTIDAD'] ?></span>
                                                            </td>

                                                            <td class="text-end">
                                                                ₡<span class="price"><?= $c['PRECIO'] ?></span>
                                                            </td>

                                                            <td class="text-end">
                                                                <?php $subtotalInd = round((((int) $c['TOTAL']) / (1.13)), 2); ?>
                                                                ₡<span class="line-subtotal"><?= $subtotalInd ?></span>
                                                                <?php $total += (int) $c['TOTAL']; ?>
                                                                <?php $subtotalTotal += $subtotalInd; ?>
                                                            </td>

                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-link text-danger p-0 remove-item" title="Eliminar">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer bg-light d-flex justify-content-between">
                                    <a href="/LENGUAJES_ADMIN/index.php?controller=home&action=menu" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i> Seguir comprando
                                    </a>
                                    <button type="button" id="btnEditarCarrito" class="btn btn-outline-primary">
                                        Editar carrito
                                    </button>

                                </div>
                            </div>
                        </div>

                        <!-- ================== RESUMEN ================== -->
                        <div class="col-lg-4">
                            <div class="card shadow-sm rounded-4 mb-4">
                                <div class="card-header bg-dark text-white rounded-top-4">
                                    <strong>Resumen</strong>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <strong>₡<span id="sum-subtotal"><?= $subtotalTotal ?></span></strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Impuestos (13%)</span>
                                        <strong>₡<span id="sum-tax"><?= round(($subtotalTotal * 0.13), 2) ?></span></strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between fs-5">
                                        <span>Total</span>
                                        <strong>₡<span id="sum-total"><?= round($total, 2) ?></span></strong>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </form>
                    <div class="card shadow-sm rounded-4">
                        <div class="card-footer bg-light d-flex justify-content-between">
                            <form action="/LENGUAJES_ADMIN/index.php?controller=pedido&action=agregar" method="POST" id="formPago">
                                <input type="hidden" name="idCarrito" id="idCarrito" value="<?= (int) $carrito[0]['IDCARRITO'] ?>">
                                <button type="submit" class="btn btn-primary w-100 mt-3">
                                    Confirmar y pagar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ShowFooter(); ?>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/carrito.js"></script>
</body>

</html>