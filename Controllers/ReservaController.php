<?php
    session_start();

    require_once __DIR__.'/../Models/ReservaModel.php';
    require_once __DIR__.'/../Models/MesaModel.php';
    require_once __DIR__.'/../Models/SucursalModel.php';

    class ReservaController {
        public function index() {
            $mesaModel = new MesaModel();
            $mesas = $mesaModel -> obtenerMesas();

            $sucursalModel = new SucursalModel();
            $sucursales = $sucursalModel -> obtenerSucursales();

            require __DIR__.'/../Views/Reservas/reservas.php';
        }
        
        public function listado() {
            $reservaModel = new ReservaModel();
            $reservasSinFiltro = $reservaModel -> obtenerReservas();
            $reservas = [];
            foreach($reservasSinFiltro as $r){
                if ($r['idEstado'] == 8 && $r['idUsuario'] == $_SESSION['usuario']['id']){
                    $reservas[] = $r;
                }
            }
            
            $mesaModel = new MesaModel();
            $mesasSinFiltro = $mesaModel -> obtenerMesas();
            $mesas = [];
            foreach($mesasSinFiltro as $m){
                if ($m['estado'] === 'Disponible'){
                    $mesas[] = $m;
                }
            }

            $sucursalModel = new SucursalModel();
            $sucursales = $sucursalModel -> obtenerSucursales();

            require __DIR__.'/../Views/Reservas/verReserva.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idUsuario = $_SESSION['usuario']['id'];
                $idMesa = $_POST['idMesa'];
                $idSucursal = $_POST['idSucursal'];
                $fechaDesde = $_POST['fechaDesde'];
                $fechaHasta = $_POST['fechaHasta'];

                $reservaModel = new ReservaModel();
                $reservaModel -> crearReserva($idUsuario, $idMesa, $idSucursal,$fechaDesde, $fechaHasta);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=reserva&action=listado");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idReserva = $_POST['editId'];
                $idUsuario = $_SESSION['usuario']['id'];
                $idMesa = $_POST['editMesa'];
                $idSucursal = $_POST['editSucursal'];
                $idEstado = $_POST['editIdEstado'];
                $fechaDesde = $_POST['editFechaDesde'];
                $fechaHasta = $_POST['editFechaHasta'];
                
                $reservaModel = new ReservaModel();
                $reservaModel -> actualizarReserva($idReserva, $idUsuario, $idMesa, $idSucursal, $idEstado, $fechaDesde, $fechaHasta);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=reserva&action=listado");
                exit;
            }
        }

        public function eliminar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idReserva = $_POST['idReserva'];

                $reservaModel = new ReservaModel();
                $reservaModel -> cambiarEstadoReserva($idReserva);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=reserva&action=listado");
                exit;
            }
        }
    }
?>