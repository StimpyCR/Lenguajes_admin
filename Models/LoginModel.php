<?php
    session_start();

    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Clase
    class Login {
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

            $idUsuario = null;
            $nombre = null;
            $idRol = null;
            $idEstado = null;

            oci_bind_by_name($stmt, ':correo', $correo);                // IN
            oci_bind_by_name($stmt, ':idUsuario', $idUsuario);          // OUT
            oci_bind_by_name($stmt, ':nombre', $nombre);                // OUT
            oci_bind_by_name($stmt, ':idRol', $idRol);                  // OUT
            oci_bind_by_name($stmt, ':idEstado', $idEstado);            // OUT

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
                        $_SESSION["usuario"] = ["nombre" => $nombre, "rol" => $idRol, "id" => $idUsuario];
                        return true;
                    }
                }
            }

            return false; 
        }
    }
?>