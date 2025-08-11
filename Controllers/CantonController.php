<?php
    require_once __DIR__.'/../Models/CantonModel.php';

    class CantonController {
        public function index() {
            $cantonModel = new CantonModel();
            $cantones = $cantonModel -> obtenerCantones();

            require __DIR__.'/../Views/Direcciones/cantones.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['txtDescripcion'];

                $cantonModel = new CantonModel();
                $cantonModel -> crearCanton($descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=canton&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idCanton = $_POST['editId'];
                $descripcion = $_POST['editDescripcion'];

                $cantonModel = new CantonModel();
                $cantonModel -> actualizarCanton($idCanton, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=canton&action=index");
                exit;
            }
        }
    }
?>