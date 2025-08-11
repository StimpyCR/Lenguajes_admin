<?php
    require_once __DIR__.'/../Models/EstadoModel.php';

    class EstadoController {
        public function index() {
            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Estados/estados.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['txtDescripcion'];

                $estadoModel = new EstadoModel();
                $estadoModel -> crearEstado($descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=estado&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idEstado = $_POST['editId'];
                $descripcion = $_POST['editDescripcion'];

                $estadoModel = new EstadoModel();
                $estadoModel -> actualizarEstado($idEstado, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=estado&action=index");
                exit;
            }
        }
    }
?>