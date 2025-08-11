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
                    <h2 class="mb-4 text-center">Gestión de Mesas</h2>

                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=mesa&action=agregar" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="txtNumeroMesa" class="form-label">Número de Mesa</label>
                            <input type="number" class="form-control" id="txtNumeroMesa" name="txtNumeroMesa" placeholder="Ej: 1" required>
                        </div>
                        <div class="mb-3">
                            <label for="txtUbicacion" class="form-label">Ubicación</label>
                            <textarea class="form-control" id="txtUbicacion" name="txtUbicacion" rows="3" placeholder="Ubicación de la mesa..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="txtCapacidad" class="form-label">Capacidad</label>
                            <input type="number" class="form-control" id="txtCapacidad" name="txtCapacidad" placeholder="Ej: 15" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABLA DE MESAS -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Mesas Registradas</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Número de Mesa</th>
                                <th>Ubicación</th>
                                <th>Capacidad</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($mesas as $mesa): ?>
                                <tr>
                                    <td><?= $mesa["numeroMesa"] ?></td>
                                    <td><?= $mesa["ubicacion"] ?></td>
                                    <td><?= $mesa["capacidad"] ?></td>
                                    <td><?= $mesa["estado"] ?></td>
                                    
                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $mesa['id'] ?>" data-numeroMesa="<?= $mesa['numeroMesa'] ?>" data-ubicacion="<?= htmlspecialchars($mesa['ubicacion'], ENT_QUOTES) ?>" data-capacidad="<?= $mesa['capacidad'] ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=mesa&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Mesa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <div class="mb-3">
                                                                <label for="editNumeroMesa" class="form-label">Número de Mesa</label>
                                                                <input type="number" class="form-control" id="editNumeroMesa" name="editNumeroMesa" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editUbicacion" class="form-label">Ubicación</label>
                                                                <textarea class="form-control" id="editUbicacion" name="editUbicacion" rows="3" required></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editCapacidad" class="form-label">Capacidad</label>
                                                                <input type="number" class="form-control" id="editCapacidad" name="editCapacidad" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <select class="form-select" id="editEstado" name="editEstado" required>
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
                                        <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=mesa&action=eliminar" onsubmit="return confirm('¿Estás seguro de que deseas inactivar esta mesa?');">
                                            <input type="hidden" name="idMesa" value="<?= $mesa["id"] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
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
    <script src="/LENGUAJES_ADMIN/Views/Funciones/mesasEditarModal.js"></script>
</body>

</html>