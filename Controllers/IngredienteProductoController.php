<?php
    // Importamos Model
    require_once __DIR__.'/../Models/IngredienteProductoModel.php';
    require_once __DIR__.'/../Models/IngredienteModel.php';
    require_once __DIR__.'/../Models/ProductoModel.php';

    // Clase
    class IngredienteProductoController {
        public function index(){
            $ingredienteProductoModel = new IngredienteProductoModel();
            $ingredientesPorProductos = $ingredienteProductoModel -> obtenerIngredientesProductos();

            $ingredienteModel = new IngredienteModel();
            $ingredientes = $ingredienteModel -> obtenerIngredientes();

            $productoModel = new ProductoModel();
            $productos = $productoModel -> obtenerProductos();

            require __DIR__.'/../Views/IngredienteProducto/ingredientesProductos.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idIngrediente = $_POST['ingrediente'];
                $idProducto = $_POST['producto'];
                $cantidad = $_POST['txtCantidad'];

                $model = new IngredienteProductoModel();
                $model -> crearIngredienteProducto($idIngrediente, $idProducto, $cantidad);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=ingredienteProducto&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idIngrediente = $_POST['editIdIngrediente'];
                $idProducto = $_POST['editIdProducto'];
                $cantidad = $_POST['editCantidad'];

                $model = new IngredienteProductoModel();
                $model -> actualizarIngredienteProducto($idIngrediente, $idProducto, $cantidad);
                
                header("Location: /LENGUAJES_ADMIN/index.php?controller=ingredienteProducto&action=index");
                exit;
            }
        }
    }
?>