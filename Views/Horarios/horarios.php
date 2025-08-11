<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';

    // Para obtener el nombre completo del empleado
    function obtenerEmpleado($idUsuario) {
        $usuarioModel = new UsuarioModel();
        $empleado = $usuarioModel -> obtenerUsuario($idUsuario);
        return $empleado['nombre'];
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

                <!-- FORMULARIO CRUD -->
                <div class="card shadow p-4">
                    <h2 class="mb-4 text-center">Gestión de Horarios</h2>

                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=horario&action=agregar" enctype="multipart/form-data">
                        <div class="col-6 mb-3">
                            <label for="txtIdUsuario" class="form-label">Identificación del Usuario</label>
                            <input type="number" class="form-control" id="txtIdUsuario" name="txtIdUsuario" placeholder="Ej: 118760090" required>
                        </div>
                        
                        <div class="col-3 mb-3">
                            <label for="horaEntrada" class="form-label">Hora de Entrada</label>
                            <input type="time" class="form-control" id="horaEntrada" name="horaEntrada" required>
                        </div>
                        
                        <div class="col-3 mb-3">
                            <label for="horaSalida" class="form-label">Hora de Salida</label>
                            <input type="time" class="form-control" id="horaSalida" name="horaSalida" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABLA DE HORARIOS -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Horarios Registrados</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Empleado</th>
                                <th>Hora de Entrada</th>
                                <th>Hora de Salida</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($horarios as $horario): ?>
                                <tr>
                                    <td><?= obtenerEmpleado($horario['idUsuario']) ?></td>
                                    <td><?= $horario["horaEntrada"] ?></td>
                                    <td><?= $horario["horaSalida"] ?></td>
                                    
                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $horario['id'] ?>" data-idUsuario="<?= $horario['idUsuario'] ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=horario&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Horario</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <div class="mb-3">
                                                                <label for="editIdUsuario" class="form-label">Identificación del Usuario</label>
                                                                <input type="text" class="form-control" name="editIdUsuario" id="editIdUsuario" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editHoraEntrada" class="form-label">Hora de Entrada</label>
                                                                <input type="time" class="form-control" id="editHoraEntrada" name="editHoraEntrada" required>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="editHoraSalida" class="form-label">Hora de Salida</label>
                                                                <input type="time" class="form-control" id="editHoraSalida" name="editHoraSalida" required>
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
    <script src="/LENGUAJES_ADMIN/Views/Funciones/horariosEditarModal.js"></script>
</body>

</html>