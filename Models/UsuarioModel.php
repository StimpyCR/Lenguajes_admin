<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class UsuarioModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearUsuario ($idUsuario, $nombre, $telefono, $correo, $contrasena) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_usuario_sp(:idUsuario, :nombre, :telefono, :correo, :contrasena);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":telefono", $telefono);
            oci_bind_by_name($stmt, ":correo", $correo);
            oci_bind_by_name($stmt, ":contrasena", $contrasena);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar usuario: " . $e['message']);
                return false;
            } else {
                return true;
            }
            oci_free_statement($stmt);
        }

        public function actualizarUsuario ($idUsuario, $nombre, $telefono, $correo, $contrasena) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_usuario_sp(:idUsuario, :idRol, :nombre, :telefono, :correo, :contrasena);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            $idRol = 5;

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000);
            oci_bind_by_name($stmt, ":idRol", $idRol, 4000);
            oci_bind_by_name($stmt, ":nombre", $nombre, 4000);
            oci_bind_by_name($stmt, ":telefono", $telefono, 4000);
            oci_bind_by_name($stmt, ":correo", $correo, 4000);
            oci_bind_by_name($stmt, ":contrasena", $contrasena, 4000);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar usuario: " . $e['message']);
            }
            oci_free_statement($stmt);

        }

        public function cambiarEstadoUsuario($idUsuario){
            $sql = "BEGIN 
                        FIDE_PK_KERAT_PKG.fide_cambiar_estado_usuario_SP(:idUsuario); 
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ':idUsuario', $idUsuario);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al cambiar estado del usuario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerUsuario ($idUsuario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_OBTENER_USUARIO_SP(:idUsuario, :idRol, :estado, :nombre, :telefono, :correo);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            $idRol = 0;
            $estado = '';
            $nombre = '';
            $telefono = '';
            $correo = '';

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000);  // In
            oci_bind_by_name($stmt, ":idRol", $idRol, 4000);          // Out
            oci_bind_by_name($stmt, ":estado", $estado, 4000);        // Out
            oci_bind_by_name($stmt, ":nombre", $nombre, 4000);        // Out
            oci_bind_by_name($stmt, ":telefono", $telefono, 4000);    // Out
            oci_bind_by_name($stmt, ":correo", $correo, 4000);        // Out

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al encontrar usuario: " . $e['message']);
            } else {
                $usuario = [
                    "id" => $idUsuario,
                    "idRol" => $idRol,
                    "estado" => $estado,
                    "nombre" => $nombre,
                    "telefono" => $telefono,
                    "correo" => $correo
                ];
                return $usuario;
            }
            oci_free_statement($stmt);
        }

        public function obtenerContraseña($idUsuario) {
            $sql = "BEGIN
                        :contrasena := FIDE_PK_KERAT_PKG.FIDE_DESENCRIPTAR_CLAVE_FN(:idUsuario);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            $contrasenaDesencriptada = '';

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000); // In
            oci_bind_by_name($stmt, ":contrasena", $contrasenaDesencriptada, 4000); // Out

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al obtener contraseña: " . $e['message']);
            } else {
                return $contrasenaDesencriptada;
            }
            oci_free_statement($stmt);
        }
    }
?>