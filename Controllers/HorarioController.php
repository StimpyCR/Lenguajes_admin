<?php
    require_once __DIR__.'/../Models/HorarioModel.php';
    require_once __DIR__.'/../Models/UsuarioModel.php';

    class HorarioController {
        public function index() {
            $horarioModel = new HorarioModel();
            $horarios = $horarioModel -> obtenerHorarios();

            require __DIR__.'/../Views/Horarios/horarios.php';
        }

        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idUsuario = (int) $_POST['txtIdUsuario'];
                $horaEntrada = (string) $_POST['horaEntrada'];
                $horaSalida = (string) $_POST['horaSalida'];
                
                $horarioModel = new HorarioModel();
                $horarioModel -> crearHorario($idUsuario, $horaEntrada, $horaSalida);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=horario&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idHorario = $_POST['editId'];
                $idUsuario = $_POST['editIdUsuario'];
                $horaEntrada = $_POST['editHoraEntrada'];
                $horaSalida = $_POST['editHoraSalida'];
                
                $horarioModel = new HorarioModel();
                $horarioModel -> actualizarHorario($idHorario, $idUsuario, $horaEntrada, $horaSalida);
    
                header("Location: /LENGUAJES_ADMIN/index.php?controller=horario&action=index");
                exit;
            }
        }
    }
?>