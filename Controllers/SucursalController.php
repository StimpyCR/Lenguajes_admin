<?php
    require_once __DIR__.'/../Models/SucursalModel.php';
    require_once __DIR__.'/../Models/DireccionModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class SucursalController {
        public function index() {
            $sucursalModel = new SucursalModel();
            $sucursales = $sucursalModel -> obtenerSucursales();

            $direccionModel = new DireccionModel();
            $direcciones = $direccionModel -> obtenerDirecciones();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Sucursales/sucursales.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['txtNombre'];
                $idDireccion = $_POST['direccion'];

                $sucursalModel = new SucursalModel();
                $sucursalModel -> crearSucursal($idDireccion, $nombre);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=sucursal&action=index");
                exit;
            }
        }

        public function eliminar() {    // Solo cambia el estado
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idSucursal = $_POST['idSucursal'];

                $sucursalModel = new SucursalModel();
                $sucursalModel -> cambiarEstadoSucursal($idSucursal);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=sucursal&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idSucursal = $_POST['editId'];
                $nombre = $_POST['editNombre'];
                $idDireccion = $_POST['editDireccion'];
                $idEstado = $_POST['editEstado'];

                $sucursalModel = new SucursalModel();
                $sucursalModel -> actualizarSucursal($idSucursal, $idDireccion, $idEstado, $nombre);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=sucursal&action=index");
                exit;
            }
        }
    }
?>