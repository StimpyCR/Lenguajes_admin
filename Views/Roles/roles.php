<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';

    // Validación de si el usuario inició sesión (NO ELIMINAR, SOLO COMENTAR DE SER NECESARIO)
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: /LENGUAJES_ADMIN/Views/Home/login.php");
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
                    <h2 class="mb-4 text-center">Gestión de Roles</h2>

                    <!-- FORMULARIO CRUD -->
                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=rol&action=agregar" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="txtNombre" class="form-label">Nombre del Rol</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingresa el nombre..." required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="txtDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="3" placeholder="Describe el rol..."></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABLA DE ROLES -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Lista de Roles</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($roles as $rol): ?>
                                <tr>
                                    <td><?= $rol['nombre'] ?></td>
                                    <td><?= $rol['descripcion'] ?></td>
                                    <td><?= $rol['estado'] ?></td>

                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $rol['id'] ?>" data-nombre="<?= htmlspecialchars($rol['nombre'], ENT_QUOTES) ?>" data-descripcion="<?= htmlspecialchars($rol['descripcion'], ENT_QUOTES) ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=rol&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Rol</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <div class="mb-3">
                                                                <label for="editNombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" id="editNombre" name="editNombre" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editDescripcion" class="form-label">Descripción</label>
                                                                <textarea class="form-control" id="editDescripcion" name="editDescripcion" rows="3" required></textarea>
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
                                        <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=rol&action=eliminar" onsubmit="return confirm('¿Estás seguro de que deseas inactivar este rol?');">
                                            <input type="hidden" name="idRol" value="<?= $rol["id"] ?>">
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

    <div class="chat-windows"></div>

    <?php
    AddJs();
    ?>
    <!-- Se añade acá porque solo Roles lo necesita -->
    <script src="/LENGUAJES_ADMIN/Views/Funciones/rolesEditarModal.js"></script>
</body>

</html>