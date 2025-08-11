<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';

    // Validación de si el usuario inició sesión (NO ELIMINAR, SOLO COMENTAR DE SER NECESARIO)
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: /LENGUAJES_ADMIN/Views/Home/login.php");
    }

    // Para obtener la direccion de la sucursal de forma dinamica
    function direccionSucursal($direcciones, $idDireccion) {
        foreach($direcciones as $direccion){
            if ($direccion['id'] === $idDireccion){
                return $direccion['provincia'] . ', ' . $direccion['canton'] . ', ' . $direccion['distrito'] . ', ' . $direccion['detalle'];
                break;
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<?php
AddCss();
?>
<style>
    /* Estilos para los dropdowns de Direccion */
    #direccion {
        max-width: 500px;
    }
    #editDireccion {
        max-width: 400px;
    }
</style>

<body>
    <div id="main-wrapper">
        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid">

                <div class="card shadow p-4">
                    <h2 class="mb-4 text-center">Gestión de Sucursales</h2>

                    <!-- FORMULARIO CRUD -->
                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=sucursal&action=agregar" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="txtNombre" class="form-label">Nombre de la Sucursal</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingresa el nombre..." required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" id="direccion" name="direccion" required>
                            <option value="" disabled selected>Seleccione una dirección</option>
                            <?php foreach ($direcciones as $direccion): ?>
                                <option value="<?= $direccion['id'] ?>"><?= $direccion['provincia'] . ', ' . $direccion['canton'] . ', ' . $direccion['distrito'] . ', ' . $direccion['detalle'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TABLA DE SUCURSALES -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Lista de Sucursales</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sucursales as $sucursal): ?>
                                <tr>
                                    <td><?= $sucursal['nombre'] ?></td>
                                    <td><?= direccionSucursal($direcciones, $sucursal['idDireccion']) ?></td>
                                    <td><?= $sucursal['estado'] ?></td>

                                    <td class="d-flex justify-content-around">
                                        <!-- Editar -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $sucursal['id'] ?>" data-nombre="<?= htmlspecialchars($sucursal['nombre'], ENT_QUOTES) ?>">Editar</button>

                                        <!-- MODAL DE EDICIÓN -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=sucursal&action=editar">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Editar Sucursal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="editId" id="editId">
                                                            <div class="mb-3">
                                                                <label for="editNombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" id="editNombre" name="editNombre" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <select class="form-select" id="editDireccion" name="editDireccion" required>
                                                                <option value="" disabled selected>Seleccione una dirección</option>
                                                                <?php foreach ($direcciones as $direccion): ?>
                                                                    <option value="<?= $direccion['id'] ?>"><?= $direccion['provincia'] . ', ' . $direccion['canton'] . ', ' . $direccion['distrito'] . ', ' . $direccion['detalle'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
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
                                        <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=sucursal&action=eliminar" onsubmit="return confirm('¿Estás seguro de que deseas inactivar esta sucursal?');">
                                            <input type="hidden" name="idSucursal" value="<?= $sucursal["id"] ?>">
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
    <!-- Se añade acá porque solo Sucursales lo necesita -->
    <script src="/LENGUAJES_ADMIN/Views/Funciones/sucursalesEditarModal.js"></script>
</body>

</html>