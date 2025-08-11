<?php
    session_start();

    // Importamos Model
    require_once __DIR__.'/../Models/UsuarioModel.php';

    class UsuarioController {
        public function agregar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idUsuario = $_POST['txtIdentificacion'];
                $nombre = $_POST['txtNombre'];
                $telefono = $_POST['txtTelefono'];
                $correo = $_POST['txtCorreo'];
                $contrasena = $_POST['txtContrasenna'];

                $usuarioModel = new UsuarioModel();
                $result = $usuarioModel -> crearUsuario($idUsuario, $nombre, $telefono, $correo, $contrasena);

                if ($result){
                    header("Location: /LENGUAJES_ADMIN/Views/Home/login.php?registro=ok");
                    exit;
                } else {
                    // Redireccionamos y mandamos el error por GET
                    header("Location: /LENGUAJES_ADMIN/Views/Home/registro.php?error=1");
                    exit;
                }

            }
        }

        // Método enrutador para el Form del Perfil
        public function enrutadorAccion(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST["accion"])) {
                    switch ($_POST["accion"]) {
                        // Si se presiona el botón de Guardar, ejecuta editar()
                        case "editar":
                            $this->editar();
                            break;
                        // Si se presiona el botón de Inactivar, ejecuta eliminar()
                        case "eliminar":
                            $this->eliminar();
                            break;
                    }
                }
            }
        }

        public function eliminar() {    // Solo cambia el estado
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idUsuario = $_SESSION["usuario"]["id"];
                $contrasenaActual = $_POST['txtContrasena'];
                
                $usuarioModel = new UsuarioModel();

                // Si la contraseña actual ingresada es igual a la almacenada en la BD
                if ($contrasenaActual === $usuarioModel -> obtenerContraseña($idUsuario)){
                    // Inactiva el perfil y cierra la sesión
                    $usuarioModel -> cambiarEstadoUsuario($idUsuario);
                    header("Location: /LENGUAJES_ADMIN/Views/Home/logout.php");
                    exit;
                }
                // Si la contraseña actual es incorrecta
                else {
                    // No guarda nada, solo da un error
                    header("Location: /LENGUAJES_ADMIN/Views/Home/consultarPerfil.php?eliminar=errorPwd");
                    exit;
                }
                

                header("Location: /LENGUAJES_ADMIN/index.php?controller=producto&action=index");
                exit;
            }
        }

        public function editar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idUsuario = $_SESSION["usuario"]["id"];
                $nombre = $_POST['txtNombre'];
                $telefono = $_POST['txtTelefono'];
                $correo = $_POST['txtCorreo'];
                $contrasenaActual = $_POST['txtContrasena'];
                $contrasenaNueva = $_POST['txtNuevaContrasena'];
                $contrasenaNueva2 = $_POST['txtNuevaContrasena2'];

                $usuarioModel = new UsuarioModel();

                // Si la contraseña actual ingresada es igual a la almacenada en la BD
                if ($contrasenaActual === $usuarioModel -> obtenerContraseña($idUsuario)) {
                    // Si no se quiso cambiar la contraseña
                    if ($contrasenaNueva === "" || $contrasenaNueva2 === "") {
                        // Actualiza los datos, manteniendo la misma contra
                        $usuarioModel -> actualizarUsuario($idUsuario, $nombre, $telefono, $correo, $contrasenaActual);
                        
                        $_SESSION["usuario"]["nombre"] = $nombre;
                        $_SESSION["usuario"]["telefono"] = $telefono;
                        $_SESSION["usuario"]["correo"] = $correo;
                        
                        header("Location: /LENGUAJES_ADMIN/Views/Home/consultarPerfil.php?actualizar=ok");
                        exit;
                    } 
                    // Si se ingresó algo en la Nueva Contraseña
                    elseif ($contrasenaNueva !== "" && $contrasenaNueva2 !== "") {
                        // Si coinciden
                        if ($contrasenaNueva === $contrasenaNueva2) {
                            // Cambia la contraseña y guarda los datos
                            $usuarioModel -> actualizarUsuario($idUsuario, $nombre, $telefono, $correo, $contrasenaNueva);

                            $_SESSION["usuario"]["nombre"] = $nombre;
                            $_SESSION["usuario"]["telefono"] = $telefono;
                            $_SESSION["usuario"]["correo"] = $correo;

                            header("Location: /LENGUAJES_ADMIN/Views/Home/consultarPerfil.php?actualizar=ok");
                            exit;
                        }
                        // Si no coinciden
                        else {
                            // No guarda nada, solo da un error
                            header("Location: /LENGUAJES_ADMIN/Views/Home/consultarPerfil.php?actualizar=errorNewPwd");
                            exit;
                        }
                    }
                }
                // Si la contraseña actual es incorrecta
                else {
                    // No guarda nada, solo da un error
                    header("Location: /LENGUAJES_ADMIN/Views/Home/consultarPerfil.php?actualizar=errorPwd");
                    exit;
                }
            }
        }
    }
?>