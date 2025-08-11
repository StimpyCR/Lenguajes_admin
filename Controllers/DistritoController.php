<?php
    require_once __DIR__.'/../Models/DistritoModel.php';

    class DistritoController {
        public function index() {
            $distritoModel = new DistritoModel();
            $distritos = $distritoModel -> obtenerDistritos();

            require __DIR__.'/../Views/Direcciones/distritos.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['txtDescripcion'];

                $distritoModel = new DistritoModel();
                $distritoModel -> crearDistrito($descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=distrito&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idDistrito = $_POST['editId'];
                $descripcion = $_POST['editDescripcion'];

                $distritoModel = new DistritoModel();
                $distritoModel -> actualizarDistrito($idDistrito, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=distrito&action=index");
                exit;
            }
        }
    }
?>