<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
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

                <!-- FORMULARIO CRUD -->
                <div class="card shadow p-4">
                    <h2 class="mb-4 text-center">Gestión de Direcciones</h2>

                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=direccion&action=agregar" enctype="multipart/form-data">
                        <div class="mb-3">
                            <select class="form-select" id="provincia" name="provincia" required>
                            <option value="" disabled selected>Seleccione una provincia</option>
                            <?php foreach ($provincias as $provincia): ?>
                                <option value="<?= $provincia['id'] ?>"><?= $provincia['descripcion'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" id="canton" name="canton" required>
                            <option value="" disabled selected>Seleccione un cantón</option>
                            <?php foreach ($cantones as $canton): ?>
                                <option value="<?= $canton['id'] ?>"><?= $canton['descripcion'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" id="distrito" name="distrito" required>
                            <option value="" disabled selected>Seleccione un distrito</option>
                            <?php foreach ($distritos as $distrito): ?>
                                <option value="<?= $distrito['id'] ?>"><?= $distrito['descripcion'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="txtDetalle" class="form-label">Detalle</label>
                            <textarea class="form-control" id="txtDetalle" name="txtDetalle" rows="3" placeholder="Describe la direccion..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABLA DE DIRECCIONES -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Direcciones Registradas</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Provincia</th>
                                <th>Cantón</th>
                                <th>Distrito</th>
                                <th>Detalle</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($direcciones as $direccion): ?>
                                <tr>
                                    <td><?= $direccion["provincia"] ?></td>
                                    <td><?= $direccion["canton"] ?></td>
                                    <td><?= $direccion["distrito"] ?></td>
                                    <td><?= $direccion["detalle"] ?></td>
                                    
                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $direccion['id'] ?>" data-detalle="<?= htmlspecialchars($direccion['detalle'], ENT_QUOTES) ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=direccion&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Dirección</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <div class="mb-3">
                                                                <select class="form-select" id="editProvincia" name="editProvincia" required>
                                                                <option value="" disabled selected>Seleccione una provincia</option>
                                                                <?php foreach ($provincias as $provincia): ?>
                                                                    <option value="<?= $provincia['id'] ?>"><?= $provincia['descripcion'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <select class="form-select" id="editCanton" name="editCanton" required>
                                                                <option value="" disabled selected>Seleccione un cantón</option>
                                                                <?php foreach ($cantones as $canton): ?>
                                                                    <option value="<?= $canton['id'] ?>"><?= $canton['descripcion'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <select class="form-select" id="editDistrito" name="editDistrito" required>
                                                                <option value="" disabled selected>Seleccione un distrito</option>
                                                                <?php foreach ($distritos as $distrito): ?>
                                                                    <option value="<?= $distrito['id'] ?>"><?= $distrito['descripcion'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editDetalle" class="form-label">Detalle</label>
                                                                <textarea class="form-control" id="editDetalle" name="editDetalle" rows="3" required></textarea>
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

    <?php
    AddJs();
    ?>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/direccionesEditarModal.js"></script>
</body>

</html>