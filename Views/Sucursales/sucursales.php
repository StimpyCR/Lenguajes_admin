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
                    <h2 class="mb-4 text-center">Gestión de Sucursales</h2>

                    <!-- FORMULARIO CRUD -->
                    <form method="POST" action="procesar_producto.php" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control input-grande" id="txtNombre" name="txtNombre" placeholder="Ej: Sucursal Escazu" required>
                            </div>


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
                    <h4 class="mb-3">Lista de Productos</h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se llenarán los productos dinámicamente -->
                            <tr>
                                <td>1</td>
                                <td>Pizza Margarita</td>
                                <td>$9.99</td>
                                <td>Pizza clásica italiana con tomate, mozzarella y albahaca.</td>
                                <td><img src="https://images.unsplash.com/photo-1601924638867-3ecb1a30b99b" alt="Pizza Margarita" width="80"></td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Editar</button>
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </td>
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