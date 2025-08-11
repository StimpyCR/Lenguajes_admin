<?php
    session_start();

    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Importamos Model de Usuarios
    require_once __DIR__.'/../Models/UsuarioModel.php';

    // Clase
    class LoginModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // Métodos
        public function validarCredenciales($correo, $contrasenaIngresada){ 
            $sql = 'BEGIN 
                        FIDE_PK_KERAT_PKG.FIDE_OBTENER_USUARIO_POR_CORREO_SP(:correo, :idUsuario, :nombre, :idRol, :idEstado); 
                    END;';
            $stmt = oci_parse($this -> conn, $sql);

            $idUsuario = 0;
            $nombre = '';
            $idRol = 0;
            $idEstado = 0;

            oci_bind_by_name($stmt, ':correo', $correo, 4000);                // IN
            oci_bind_by_name($stmt, ':idUsuario', $idUsuario, 4000);          // OUT
            oci_bind_by_name($stmt, ':nombre', $nombre, 4000);                // OUT
            oci_bind_by_name($stmt, ':idRol', $idRol, 4000);                  // OUT
            oci_bind_by_name($stmt, ':idEstado', $idEstado, 4000);            // OUT

            oci_execute($stmt);

            if ($idUsuario !== null) {
                $sqlClave = "BEGIN
                                :contrasena := FIDE_PK_KERAT_PKG.FIDE_DESENCRIPTAR_CLAVE_FN(:idusuario);
                            END;";
                $stmtClave = oci_parse($this->conn, $sqlClave);

                $contrasenaDesencriptada = '';
                oci_bind_by_name($stmtClave, ':contrasena', $contrasenaDesencriptada); // salida
                oci_bind_by_name($stmtClave, ':idusuario', $idUsuario); // entrada

                if (oci_execute($stmtClave)) {
                    // Validar estado y contraseña
                    if ($idEstado == 1 && $contrasenaDesencriptada === $contrasenaIngresada) {
                        $model = new UsuarioModel();

                        $_SESSION["usuario"] = $model -> obtenerUsuario($idUsuario);
                        return true;
                    }
                }
            }

            return false; 
        }
    }
?>