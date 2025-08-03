<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class Usuario {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearUsuario ($idUsuario, $idRol, $idEstado, $nombre, $telefono, $correo, $contrasena) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_usuario_sp(:idUsuario, :idRol, :idEstado, :nombre, :telefono, :correo, :contrasena);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":idRol", $idRol);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":telefono", $telefono);
            oci_bind_by_name($stmt, ":correo", $correo);
            oci_bind_by_name($stmt, ":contrasena", $contrasena);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar usuario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function actualizarUsuario ($idUsuario, $idRol, $idEstado, $nombre, $telefono, $correo, $contrasena) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_usuario_sp(:idUsuario, :idRol, :idEstado, :nombre, :telefono, :correo, :contrasena);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":idRol", $idRol);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":telefono", $telefono);
            oci_bind_by_name($stmt, ":correo", $correo);
            oci_bind_by_name($stmt, ":contrasena", $contrasena);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar usuario: " . $e['message']);
            }
            oci_free_statement($stmt);

        }

        public function cambiarEstadoUsuario($idUsuario, $idEstado){
            $sql = "BEGIN 
                        FIDE_PK_KERAT_PKG.fide_cambiar_estado_usuario_SP(:idUsuario, :idEstado); 
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ':idUsuario', $idUsuario);
            oci_bind_by_name($stmt, ':idEstado', $idEstado);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al cambiar estado del usuario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerUsuario ($idUsuario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_OBTENER_USUARIO_SP(:idUsuario, :rol, :estado, :nombre, :telefono, :correo);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            $rol = null;
            $estado = null;
            $nombre = null;
            $telefono = null;
            $correo = null;

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);  // In
            oci_bind_by_name($stmt, ":idRol", $rol);            // Out
            oci_bind_by_name($stmt, ":idEstado", $estado);      // Out
            oci_bind_by_name($stmt, ":nombre", $nombre);        // Out
            oci_bind_by_name($stmt, ":telefono", $telefono);    // Out
            oci_bind_by_name($stmt, ":correo", $correo);        // Out

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al encontrar usuario: " . $e['message']);
            } else {
                $usuario = [
                    "rol" => $rol,
                    "estado" => $estado,
                    "nombre" => $nombre,
                    "telefono" => $telefono,
                    "correo" => $correo
                ];
                return $usuario;
            }
            oci_free_statement($stmt);

        }
    }
?>