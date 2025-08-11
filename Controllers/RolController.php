<?php
    require_once __DIR__.'/../Models/RolModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class RolController {
        public function index() {
            $rolModel = new RolModel();
            $roles = $rolModel -> obtenerRoles();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Roles/roles.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['txtNombre'];
                $descripcion = $_POST['txtDescripcion'];

                $rolModel = new RolModel();
                $rolModel -> crearRol($nombre, $descripcion);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=rol&action=index");
                exit;
            }
        }

        public function eliminar() {    // Solo cambia el estado
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idRol = $_POST['idRol'];

                $rolModel = new RolModel();
                $rolModel -> cambiarEstadoRol($idRol);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=rol&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idRol = $_POST['editId'];
                $nombre = $_POST['editNombre'];
                $idEstado = $_POST['editEstado'];
                $descripcion = $_POST['editDescripcion'];

                $rolModel = new RolModel();
                $rolModel -> actualizarRol($idRol, $idEstado, $nombre, $descripcion);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=rol&action=index");
                exit;
            }
        }
    }
?>