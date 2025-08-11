<?php
    // Importamos Modelos
    require_once __DIR__.'/../Models/LoginModel.php';
    require_once __DIR__.'/../Models/ProductoModel.php';
    require_once __DIR__.'/../Models/CategoriaModel.php';

    class HomeController {
        public function index () {
            header("Location: /LENGUAJES_ADMIN/Views/Home/principal.php");
        }

        public function menu(){
            $categoriaModel = new CategoriaModel();
            $categorias = $categoriaModel -> obtenerCategorias();
            $categoriasActivas = [];
            foreach ($categorias as $categoria){
                if ($categoria['estado'] === 'Activo'){
                    $categoriasActivas[] = $categoria;
                }
            }

            require __DIR__.'/../Views/Home/menu.php';
        }

        public function listado() {
            $categoriaSeleccionada = $_POST['categoria'];
            
            $productoModel = new ProductoModel();
            $productos = $productoModel -> obtenerProductos();
            $productosActivos = [];
            foreach ($productos as $producto){
                if ($producto['estado'] === 'Activo' && $producto['categoria'] === $categoriaSeleccionada) {
                    $productosActivos[] = $producto;
                }
                
            }

            require __DIR__.'/../Views/Home/listado.php';
        }

        public function login () {
            $correo = $_POST["txtCorreo"];
            $contrasena = $_POST["txtContrasenna"];
            
            $login = new LoginModel();
            
            if ($login->validarCredenciales($correo, $contrasena)) {
                header("Location: /LENGUAJES_ADMIN/Views/Home/principal.php");
            } else {
                // Redireccionamos y mandamos el error por GET
                header("Location: /LENGUAJES_ADMIN/Views/Home/login.php?error=1");
            }
        }
    }
?>