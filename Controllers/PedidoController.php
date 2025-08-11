<?php
    session_start();
    require_once __DIR__.'/../Models/PedidoModel.php';
    require_once __DIR__.'/../Models/PedidoDetalleModel.php';
    require_once __DIR__.'/../Models/EstadoModel.php';

    class PedidoController {
        public function index() {
            $pedidoModel = new PedidoModel();
            $pedidos = $pedidoModel -> obtenerPedidoCompleto($_SESSION['idCarrito']);

            $estadoModel = new EstadoModel();
            $estados = $estadoModel -> obtenerEstados();

            require __DIR__.'/../Views/Pedido/pedidos.php';
        }

        public function agregar() {
            if (!isset($_SESSION['idPedido'])){
                $pedidoModel = new PedidoModel();
                $pedidoModel -> crearPedido($_SESSION['usuario']['id']);

                $_SESSION['idPedido'] = $pedidoModel -> obtenerIdPedido($_SESSION['usuario']['id']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idPedido = $_SESSION['idPedido'];
                $idCarrito = $_POST['idCarrito'];

                $pedidoDetalleModel = new PedidoDetalleModel();
                $pedidoDetalleModel -> crearPedidoDetalle($idPedido, $idCarrito);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=pedido&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idPedido = $_POST['editId'];
                $idCarrito = $_SESSION['idCarrito'];
                $idEstado = $_POST['editEstado'];

                $pedidoDetalleModel = new PedidoDetalleModel();
                $pedidoDetalleModel -> actualizarPedidoDetalle($idPedido, $idCarrito, $idEstado);

                header('Location: /LENGUAJES_ADMIN/index.php?controller=pedido&action=index');
                exit;
            }
        }

        public function eliminar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idPedido = $_POST['idPedido'];
                $idCarrito = $_SESSION['idCarrito'];

                $pedidoDetalleModel = new PedidoDetalleModel();
                $pedidoDetalleModel->cambiarEstadoPedidoDetalle($idPedido, $idCarrito);
            
                header('Location: /LENGUAJES_ADMIN/index.php?controller=pedido&action=index');
                exit;
            }
        }
    }
?>