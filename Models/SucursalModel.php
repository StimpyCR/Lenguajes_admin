<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class SucursalModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearSucursal ($idDireccion, $nombre) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_RESTAURANTE_SP(:idDireccion, :nombre);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idDireccion", $idDireccion);
            oci_bind_by_name($stmt, ":nombre", $nombre);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar sucursal: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarSucursal ($idSucursal, $idDireccion, $idEstado, $nombre) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_RESTAURANTE_SP(:idSucursal, :idDireccion, :idEstado, :nombre);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idSucursal", $idSucursal);
            oci_bind_by_name($stmt, ":idDireccion", $idDireccion);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":nombre", $nombre);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar sucursal: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoSucursal ($idSucursal) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_RESTAURANTE_SP(:idSucursal);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idSucursal", $idSucursal);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar sucursal: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerSucursales () {
            $sucursales = [];
            $idSucursal = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_SUCURSALES_SP(:idSucursal, :idDireccion, :estado, :nombre);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $idDireccion = 0;
                $estado = "";
                $nombre = "";
                                
                oci_bind_by_name($stmt, ":idSucursal", $idSucursal, 4000);          // In
                oci_bind_by_name($stmt, ":idDireccion", $idDireccion, 4000);        // Out
                oci_bind_by_name($stmt, ":estado", $estado, 4000);                  // Out
                oci_bind_by_name($stmt, ":nombre", $nombre, 4000);                  // Out
                                
                oci_execute($stmt);
                
                if ($idDireccion === null && $estado === null && $nombre === null){
                    break;
                }

                $sucursales[] = [
                    "id" => $idSucursal,
                    "idDireccion" => $idDireccion,
                    "estado" => $estado,
                    "nombre" => $nombre,
                ];
                
                $idSucursal++;
            }
                
            oci_free_statement($stmt);
            return $sucursales;
        }
    }
?>