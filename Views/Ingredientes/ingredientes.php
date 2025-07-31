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

                <div class="card shadow p-4">
                    <h2 class="mb-4 text-center">Gestión de Ingredientes</h2>

                    <!-- FORMULARIO CRUD -->
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre del ingrediente</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ej: Culantro" required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad del Producto</label>
                            <input type="number" class="form-control" id="txtCantidadProducto" name="txtCantidadProducto" placeholder="Cantidad en Stock" min="0" required>
                        </div>




                        <div class="d-flex justify-content-between">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                            <button type="submit" name="accion" value="modificar" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Modificar
                            </button>
                            <button type="submit" name="accion" value="eliminar" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>

                    </form>
                </div>

                <!-- TABLA DE PRODUCTOS -->
                <div class="card mt-4 shadow p-3">
                    <h4 class="mb-3">Lista de Ingredientes</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID del Ingrediente</th>
                                <th>Nombre</th>
                                <th>Cantidad del Producto</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se llenarán los productos dinámicamente -->
                            <tr>
                                <td>1</td>
                                <td>Pizza Margarita</td>
                                <td>$9.99</td>

                            </tr>
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
</body>

</html>