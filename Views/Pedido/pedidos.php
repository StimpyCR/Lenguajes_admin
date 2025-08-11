<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>


<?php AddCss(); ?>

<body>
    <div id="main-wrapper">
        <?php ShowHeader(); ?>
        <?php ShowSideBar(); ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <h2 class="mb-4 text-center">Mis Pedidos</h2>
                <div class="card mt-4 shadow p-3">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Número de Pedido</th>
                                <th>Fecha y Hora</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?= $pedido['IDPEDIDO'] ?></td>
                                    <td><?= $pedido['FECHA_HORA'] ?></td>
                                    <td><?= $pedido['NOMBRE_PRODUCTO'] ?></td>
                                    <td><?= $pedido['CANTIDAD'] ?></td>
                                    <td><?= $pedido['TOTAL'] ?></td>
                                    <td><?= $pedido['NOMBRE_ESTADO'] ?></td>
                                    
                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $pedido['IDPEDIDO'] ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=pedido&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Pedido</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <div class="mb-3">
                                                                <label for="editEstado" class="form-label">Estado del Pedido</label>
                                                                <select class="form-select form-control" id="editEstado" name="editEstado" required>
                                                                <option value="" disabled selected>Seleccione un estado</option>
                                                                <?php foreach ($estados as $estado): ?>
                                                                    <option value="<?= $estado['id'] ?>"><?= $estado['descripcion'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" name="accion" value="modificar" class="btn btn-warning">Guardar Cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Eliminar -->
                                        <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=pedido&action=eliminar" onsubmit="return confirm('¿Estás seguro de que deseas cancelar tu pedido?');">
                                            <input type="hidden" name="idPedido" value="<?= $pedido["IDPEDIDO"] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php ShowFooter(); ?>
        </div>
    </div>
    <?php AddJs(); ?>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/pedidos.js"></script>
</body>

</html>