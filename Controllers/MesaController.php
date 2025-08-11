<?php
    require_once __DIR__.'/../Models/MesaModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class MesaController {
        public function index() {
            $mesaModel = new MesaModel();
            $mesas = $mesaModel -> obtenerMesas();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Mesas/mesas.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $numeroMesa = $_POST['txtNumeroMesa'];
                $ubicacion = $_POST['txtUbicacion'];
                $capacidad = $_POST['txtCapacidad'];

                $mesaModel = new MesaModel();
                $mesaModel -> crearMesa($numeroMesa, $ubicacion, $capacidad);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=mesa&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idMesa = $_POST['editId'];
                $idEstado = $_POST['editEstado'];
                $numeroMesa = $_POST['editNumeroMesa'];
                $ubicacion = $_POST['editUbicacion'];
                $capacidad = $_POST['editCapacidad'];

                $mesaModel = new MesaModel();
                $mesaModel -> actualizarMesa($idMesa, $idEstado, $numeroMesa, $ubicacion, $capacidad);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=mesa&action=index");
                exit;
            }
        }

        public function eliminar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idMesa = $_POST['idMesa'];

                $mesaModel = new MesaModel();
                $mesaModel -> cambiarEstadoMesa($idMesa);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=mesa&action=index");
                exit;
            }
        }
    }
?>