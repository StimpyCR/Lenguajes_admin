<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';

    // Funciones para obtener nombres
    function nombreIngrediente($ingredientes, $idIngrediente) {
        foreach ($ingredientes as $ingrediente) {
            if ($ingrediente['id'] === $idIngrediente){
                $nombre = $ingrediente['nombre'];
                return $nombre;
            }
        }
    }
    function nombreProducto($productos, $idProducto) {
        foreach ($productos as $producto) {
            if ($producto['id'] === $idProducto){
                $nombre = $producto['nombre'];
                return $nombre;
            }
        }
    }
?>

<!DOCTYPE html>
<html>

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

                <div class="card shadow p-4">
                    <h2 class="mb-4 text-center">Gestión de Ingredientes por Productos</h2>

                    <!-- FORMULARIO CRUD -->
                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=ingredienteProducto&action=agregar" enctype="multipart/form-data">
                        <div class="col-6 mb-3">
                            <label for="ingrediente" class="form-label">Ingrediente</label>
                            <select class="form-select form-control" id="ingrediente" name="ingrediente" required>
                            <option value="" disabled selected>Seleccione un ingrediente</option>
                            <?php foreach ($ingredientes as $ingrediente): ?>
                                <!-- Para mostrar solo los realmente disponibles -->
                                <?php if ($ingrediente['estado'] === 'Activo' && $ingrediente['cantidad'] > 0): ?>
                                    <option value="<?= $ingrediente['id'] ?>"><?= $ingrediente['nombre'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <label for="txtCantidad" class="form-label">Cantidad del Ingrediente en el Producto</label>
                            <input type="number" class="form-control" id="txtCantidad" name="txtCantidad" placeholder="Ej: 5" min="0" required>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <label for="producto" class="form-label">Producto</label>
                            <select class="form-select form-control" id="producto" name="producto" required>
                            <option value="" disabled selected>Seleccione un producto</option>
                            <?php foreach ($productos as $producto): ?>
                                <!-- Para mostrar solo los realmente disponibles -->
                                <?php if ($producto['estado'] === 'Activo'): ?>
                                    <option value="<?= $producto['id'] ?>"><?= $producto['nombre'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-6 d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>

                    </form>
                </div>

                <!-- TABLA DE PRODUCTOS -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Lista de Ingredientes por Productos</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Ingrediente</th>
                                <th>Cantidad en producto</th>
                                <th>Producto</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ingredientesPorProductos as $inPr): ?>
                                <tr>
                                    <td><?= nombreIngrediente($ingredientes, $inPr['IDINGREDIENTE']) ?></td>
                                    <td><?= $inPr['CANTIDAD'] ?></td>
                                    <td><?= nombreProducto($productos, $inPr['IDPRODUCTO']) ?></td=>

                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-idIngrediente="<?= $inPr['IDINGREDIENTE'] ?>" data-idProducto="<?= $inPr['IDPRODUCTO'] ?>" data-cantidad="<?= $inPr['CANTIDAD'] ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=ingredienteProducto&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Cantidad</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editIdIngrediente" id="editIdIngrediente">
                                                            <input type="hidden" name="editIdProducto" id="editIdProducto">
                                                            <div class="mb-3">
                                                                <label for="editCantidad" class="form-label">Cantidad del Ingrediente en el Producto</label>
                                                                <input type="number" class="form-control" id="editCantidad" name="editCantidad" min="0" required>
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
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <?php
            ShowFooter();
            ?>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php
    AddJs();
    ?>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/ingredientesProductosEditarModal.js"></script>
</body>

</html>