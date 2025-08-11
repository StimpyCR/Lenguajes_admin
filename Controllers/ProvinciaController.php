<?php
    require_once __DIR__.'/../Models/ProvinciaModel.php';

    class ProvinciaController {
        public function index() {
            $provinciaModel = new ProvinciaModel();
            $provincias = $provinciaModel -> obtenerProvincias();

            require __DIR__.'/../Views/Direcciones/provincias.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['txtDescripcion'];

                $provinciaModel = new ProvinciaModel();
                $provinciaModel -> crearProvincia($descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=provincia&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idProvincia = $_POST['editId'];
                $descripcion = $_POST['editDescripcion'];

                $provinciaModel = new ProvinciaModel();
                $provinciaModel -> actualizarProvincia($idProvincia, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=provincia&action=index");
                exit;
            }
        }
    }
?>