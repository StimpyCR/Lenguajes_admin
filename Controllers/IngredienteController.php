<?php
    // Importamos Model
    require_once __DIR__.'/../Models/IngredienteModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    // Clase
    class IngredienteController {
        public function index(){
            $ingredienteModel = new IngredienteModel();
            $ingredientes = $ingredienteModel -> obtenerIngredientes();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Ingredientes/ingredientes.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['txtNombre'];
                $cantidadProducto = $_POST['txtCantidadProducto'];

                $model = new IngredienteModel();
                $model -> crearIngrediente($nombre, $cantidadProducto);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=ingrediente&action=index");
                exit;
            }
        }

        public function eliminar () {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idIngrediente = $_POST['idIngrediente'];

                $model = new IngredienteModel();
                $model -> cambiarEstadoIngrediente($idIngrediente);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=ingrediente&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idIngrediente = $_POST['editId'];
                $nombre = $_POST['editNombre'];
                $cantidad = $_POST['editCantidad'];
                $idEstado = $_POST['editEstado'];

                $model = new IngredienteModel();
                $model -> actualizarIngrediente($idIngrediente, $nombre, $cantidad, $idEstado);
                
                header("Location: /LENGUAJES_ADMIN/index.php?controller=ingrediente&action=index");
                exit;
            }
        }
    }
?>