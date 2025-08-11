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
                <h2 class="mb-4 text-center">Mis Reservas</h2>
                <div class="card mt-4 shadow p-3">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Cliente</th>
                                <th>Número de Mesa</th>
                                <th>Restaurante</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $reserva): ?>
                                <tr>
                                    <td><?= $reserva['usuario'] ?></td>
                                    <td><?= $reserva['numeroMesa'] ?></td>
                                    <td><?= $reserva['restaurante'] ?></td>
                                    <td><?= $reserva['fechaDesde'] ?></td>
                                    <td><?= $reserva['fechaHasta'] ?></td>
                                    <td><?= $reserva['estado'] ?></td>
                                    
                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $reserva['id'] ?>" data-idMesa="<?= $reserva['idMesa'] ?>" data-idSucursal="<?= $reserva['idSucursal'] ?>" data-idEstado="<?= $reserva['idEstado'] ?>" data-fechaDesde="<?= htmlspecialchars($reserva['fechaDesde'], ENT_QUOTES) ?>" data-fechaHasta="<?= htmlspecialchars($reserva['fechaHasta'], ENT_QUOTES) ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=reserva&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Reserva</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <input type="hidden" name="editIdEstado" id="editIdEstado">

                                                            <div class="mb-3">
                                                                <label for="editMesa" class="form-label">Mesas Disponibles</label>
                                                                <select class="form-select form-control" id="editMesa" name="editMesa" required>
                                                                <option value="" disabled selected>Seleccione una mesa</option>
                                                                <?php foreach ($mesas as $mesa): ?>
                                                                    <option value="<?= $mesa['id'] ?>"><?= $mesa['numeroMesa'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="editSucursal" class="form-label">Sucursales</label>
                                                                <select class="form-select form-control" name="editSucursal" id="editSucursal" required>
                                                                <option value="">Seleccione una sucursal</option>
                                                                <?php foreach ($sucursales as $sucursal): ?>
                                                                    <option value="<?= $sucursal['id'] ?>"><?= $sucursal['nombre'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="editFechaDesde" class="form-label">Fecha Desde</label>
                                                                <input type="datetime-local" class="form-control" name="editFechaDesde" id="editFechaDesde" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="editFechaHasta" class="form-label">Fecha Hasta</label>
                                                                <input type="datetime-local" class="form-control" name="editFechaHasta" id="editFechaHasta" required>
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
                                        <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=reserva&action=eliminar" onsubmit="return confirm('¿Estás seguro de que deseas cancelar tu reserva?');">
                                            <input type="hidden" name="idReserva" value="<?= $reserva["id"] ?>">
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
    <script src="/LENGUAJES_ADMIN/Views/Funciones/reservas.js"></script>
</body>

</html>