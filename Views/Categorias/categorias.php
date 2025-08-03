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
                    <h2 class="mb-4 text-center">Categorias de Platillos</h2>

                    <!-- FORMULARIO CRUD -->
                    <form method="POST" action="procesar_producto.php" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="3" placeholder="Describe el platillo..."></textarea>
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