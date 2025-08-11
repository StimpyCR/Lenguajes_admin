<?php
    session_start();
    require_once __DIR__.'/../Models/CarritoModel.php';
    require_once __DIR__.'/../Models/CarritoDetalleModel.php';

    class CarritoController {
        public function index() {
            $carritoModel = new CarritoModel();
            $carritoSinFiltar = $carritoModel -> obtenerCarritoCompleto($_SESSION['usuario']['id']);
            $carrito = [];
            foreach($carritoSinFiltar as $c){
                if((int) $c['IDESTADO'] === 1){
                    $carrito[] = $c;
                }
            }

            require __DIR__.'/../Views/Carrito/carrito.php';
        }

        // Método enrutador
        public function enrutadorAccion(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST['accion'])) {
                    switch ($_POST['accion']) {
                        // Si se presiona el botón de Confirmar, ejecuta editar()
                        case 'confirmarEdicion':
                            $this->editarCantidad();
                            break;
                        // Si se presiona el botón de Remover, ejecuta eliminar()
                        case 'eliminar':
                            $this->eliminarProducto();
                            break;
                    }
                }
            }
        }

        public function agregar() {
            if (!isset($_SESSION['idCarrito'])){
                $carritoModel = new CarritoModel();
                $carritoModel -> crearCarrito($_SESSION['usuario']['id']);

                $_SESSION['idCarrito'] = $carritoModel -> obtenerIdCarrito($_SESSION['usuario']['id']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idCarrito = $_SESSION['idCarrito'];
                $idProducto = $_POST['id_producto'];
                $cantidad = $_POST['cantidad'];

                $carritoDetalleModel = new CarritoDetalleModel();
                $carritoDetalleModel -> crearCarritoDetalle($idCarrito, $idProducto, $cantidad);

                header("Location: /LENGUAJES_ADMIN/index.php?controller=carrito&action=index");
                exit;
            }
        }

        public function editarCantidad() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idCarritoArr = $_POST['idCarrito'] ?? [];
                $idProductoArr = $_POST['idProducto'] ?? [];
                $cantidadArr = $_POST['cantidad'] ?? [];

                if (count($idCarritoArr) === count($idProductoArr) && count($idProductoArr) === count($cantidadArr)) {
                    $carritoDetalleModel = new CarritoDetalleModel();

                    for ($i = 0; $i < count($cantidadArr); $i++) {
                        $idCarrito = $idCarritoArr[$i];
                        $idProducto = $idProductoArr[$i];
                        $cantidad = $cantidadArr[$i];

                        $carritoDetalleModel -> actualizarCarritoDetalle($idCarrito, $idProducto, $cantidad);
                    }
                }

                header('Location: /LENGUAJES_ADMIN/index.php?controller=carrito&action=index');
                exit;
            }
        }

        public function eliminarProducto() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idCarritoArr = $_POST['idCarrito'] ?? [];
                $idProductoArr = $_POST['idProducto'] ?? [];

                if (count($idCarritoArr) === 1 && count($idProductoArr) === 1) {
                    $idCarrito = $idCarritoArr[0];
                    $idProducto = $idProductoArr[0];

                    $carritoDetalleModel = new CarritoDetalleModel();
                    $carritoDetalleModel->cambiarEstadoCarritoDetalle($idCarrito, $idProducto);
                }

                header('Location: /LENGUAJES_ADMIN/index.php?controller=carrito&action=index');
                exit;
            }
        }
    }
?>