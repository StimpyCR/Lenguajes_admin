<?php
    require_once __DIR__.'/../Models/PrioridadModel.php';

    class PrioridadController {
        public function index() {
            $prioridadModel = new PrioridadModel();
            $prioridades = $prioridadModel -> obtenerPrioridades();

            require __DIR__.'/../Views/Prioridades/prioridades.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $descripcion = $_POST['txtDescripcion'];

                $prioridadModel = new PrioridadModel();
                $prioridadModel -> crearPrioridad($descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=prioridad&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idPrioridad = $_POST['editId'];
                $descripcion = $_POST['editDescripcion'];

                $prioridadModel = new PrioridadModel();
                $prioridadModel -> actualizarPrioridad($idPrioridad, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=prioridad&action=index");
                exit;
            }
        }
    }
?>