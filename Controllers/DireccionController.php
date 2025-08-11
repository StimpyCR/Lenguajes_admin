<?php
    require_once __DIR__.'/../Models/DireccionModel.php';
    require_once __DIR__.'/../Models/ProvinciaModel.php';
    require_once __DIR__.'/../Models/CantonModel.php';
    require_once __DIR__.'/../Models/DistritoModel.php';

    class DireccionController {
        public function index() {
            $direccionModel = new DireccionModel();
            $direcciones = $direccionModel -> obtenerDirecciones();

            $provinciaModel = new ProvinciaModel();
            $provincias = $provinciaModel -> obtenerProvincias();

            $cantonModel = new CantonModel();
            $cantones = $cantonModel -> obtenerCantones();

            $distritoModel = new DistritoModel();
            $distritos = $distritoModel -> obtenerDistritos();

            require __DIR__.'/../Views/Direcciones/direcciones.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idProvincia = $_POST['provincia'];
                $idCanton = $_POST['canton'];
                $idDistrito = $_POST['distrito'];
                $detalle = $_POST['txtDetalle'];

                $direccionModel = new DireccionModel();
                $direccionModel -> crearDireccion($idProvincia, $idCanton, $idDistrito, $detalle);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=direccion&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idDireccion = $_POST['editId'];
                $idProvincia = $_POST['editProvincia'];
                $idCanton = $_POST['editCanton'];
                $idDistrito = $_POST['editDistrito'];
                $detalle = $_POST['editDetalle'];

                $direccionModel = new DireccionModel();
                $direccionModel -> actualizarDireccion($idDireccion, $idProvincia, $idCanton, $idDistrito, $detalle);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=direccion&action=index");
                exit;
            }
        }
    }
?>