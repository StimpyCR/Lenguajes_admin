<?php
    require_once __DIR__.'/../Models/CategoriaModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class CategoriaController {
        public function index() {
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel -> obtenerCategorias();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Categorias/categorias.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['txtDescripcion'];

                $categoriaModel = new CategoriaModel();
                $categoriaModel -> crearCategoria($descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=categoria&action=index");
                exit;
            }
        }

        public function eliminar() {    // Solo cambia el estado
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idCategoria = $_POST['idCategoria'];

                $categoriaModel = new CategoriaModel();
                $categoriaModel -> cambiarEstadoCategoria($idCategoria);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=categoria&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idCategoria = $_POST['editId'];
                $idEstado = $_POST['editEstado'];
                $descripcion = $_POST['editDescripcion'];

                $categoriaModel = new CategoriaModel();
                $categoriaModel -> actualizarCategoria($idCategoria, $idEstado, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=categoria&action=index");
                exit;
            }
        }
    }
?>