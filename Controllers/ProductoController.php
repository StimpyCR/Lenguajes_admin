<?php
    require_once __DIR__.'/../Models/ProductoModel.php';
    require_once __DIR__.'/../Models/CategoriaModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class ProductoController {
        public function index() {
            $productoModel = new ProductoModel();
            $productos = $productoModel -> obtenerProductos();

            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel -> obtenerCategorias();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Productos/productos.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['txtNombre'];
                $descripcion = $_POST['txtDescripcion'];
                $precio = $_POST['txtPrecio'];
                $idCategoria = $_POST['categoria'];

                $productoModel = new ProductoModel();
                $productoModel -> crearProducto($idCategoria, $nombre, $descripcion, $precio);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=producto&action=index");
                exit;
            }
        }

        public function eliminar() {    // Solo cambia el estado
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idProducto = $_POST['idProducto'];

                $productoModel = new ProductoModel();
                $productoModel -> cambiarEstadoProducto($idProducto);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=producto&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idProducto = $_POST['editId'];
                $idCategoria = $_POST['editCategoria'];
                $idEstado = $_POST['editEstado'];
                $nombre = $_POST['editNombre'];
                $descripcion = $_POST['editDescripcion'];
                $precio = $_POST['editPrecio'];

                $productoModel = new ProductoModel();
                $productoModel -> actualizarProducto($idProducto, $idCategoria, $idEstado, $nombre, $descripcion, $precio);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=producto&action=index");
                exit;
            }
        }
    }
?>