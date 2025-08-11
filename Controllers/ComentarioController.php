<?php
    require_once __DIR__.'/../Models/ComentarioModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class ComentarioController {
        public function index() {
            $comentarioModel = new ComentarioModel();
            $comentarios = $comentarioModel -> obtenerComentarios();

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Reseñas/reseña.php';
        }

        // public function agregar() {
        //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //         $numeroComentario = $_POST['txtNumeroComentario'];
        //         $ubicacion = $_POST['txtUbicacion'];
        //         $capacidad = $_POST['txtCapacidad'];

        //         $comentarioModel = new ComentarioModel();
        //         $comentarioModel -> crearComentario($numeroComentario, $ubicacion, $capacidad);

        //         header("Location: /LENGUAJES_ADMIN/index.php?controller=comentario&action=index");
        //         exit;
        //     }
        // }

        // public function editar() {
        //     if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //         $idComentario = $_POST['editId'];
        //         $idEstado = $_POST['editEstado'];
        //         $numeroComentario = $_POST['editNumeroComentario'];
        //         $ubicacion = $_POST['editUbicacion'];
        //         $capacidad = $_POST['editCapacidad'];

        //         $comentarioModel = new ComentarioModel();
        //         $comentarioModel -> actualizarComentario($idComentario, $idEstado, $numeroComentario, $ubicacion, $capacidad);
    
        //         header("Location: /LENGUAJES_ADMIN/index.php?controller=comentario&action=index");
        //         exit;
        //     }
        // }

        // public function eliminar() {
        //     if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //         $idComentario = $_POST['idComentario'];

        //         $comentarioModel = new ComentarioModel();
        //         $comentarioModel -> cambiarEstadoComentario($idComentario);
    
        //         header("Location: /LENGUAJES_ADMIN/index.php?controller=comentario&action=index");
        //         exit;
        //     }
        // }
    }
?>