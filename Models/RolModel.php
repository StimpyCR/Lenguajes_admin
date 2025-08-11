<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class RolModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearRol ($nombre, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_rol_SP(:nombre, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar rol: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarRol ($idRol, $idEstado, $nombre, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_rol_SP(:idRol, :idEstado, :nombre, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idRol", $idRol);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar rol: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoRol ($idRol) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_cambiar_estado_rol_SP(:idRol);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idRol", $idRol);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar rol: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerRoles () {
            $roles = [];
            $idRol = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_ROLES_SP(:idRol, :estado, :nombre, :descripcion);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $estado = "";
                $nombre = "";
                $descripcion = "";
                
                oci_bind_by_name($stmt, ":idRol", $idRol, 4000);                    // In
                oci_bind_by_name($stmt, ":estado", $estado, 4000);                  // Out
                oci_bind_by_name($stmt, ":nombre", $nombre, 4000);                  // Out
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);        // Out
                                
                oci_execute($stmt);
                
                if ($descripcion === null && $estado === null && $nombre === null){
                    break;
                }

                $roles[] = [
                    "id" => $idRol,
                    "estado" => $estado,
                    "nombre" => $nombre,
                    "descripcion" => $descripcion
                ];
                
                $idRol++;
            }
                
            oci_free_statement($stmt);
            return $roles;
        }
    }
?>