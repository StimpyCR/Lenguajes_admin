<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class ReservaModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearReserva ($idUsuario, $idMesa, $idSucursal, $fechaDesde, $fechaHasta) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_RESERVA_SP(:idUsuario, :idMesa, :idSucursal, :fechaDesde, :fechaHasta);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":idMesa", $idMesa);
            oci_bind_by_name($stmt, ":idSucursal", $idSucursal);
            oci_bind_by_name($stmt, ":fechaDesde", $fechaDesde);
            oci_bind_by_name($stmt, ":fechaHasta", $fechaHasta);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar reserva: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarReserva ($idReserva, $idUsuario, $idMesa, $idSucursal, $idEstado, $fechaDesde, $fechaHasta) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_RESERVA_SP(:idReserva, :idUsuario, :idMesa, :idSucursal, :idEstado, :fechaDesde, :fechaHasta);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idReserva", $idReserva);
            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":idMesa", $idMesa);
            oci_bind_by_name($stmt, ":idSucursal", $idSucursal);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":fechaDesde", $fechaDesde);
            oci_bind_by_name($stmt, ":fechaHasta", $fechaHasta);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar reserva: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoReserva ($idReserva) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_RESERVA_SP(:idReserva);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idReserva", $idReserva);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar reserva: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerReservas () {
            $reservas = [];
            $idReserva = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_RESERVAS_SP(:idReserva, :idUsuario, :usuario, :idMesa, :numeroMesa, :idSucursal, :restaurante, :idEstado, :estado, :fechaDesde, :fechaHasta);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $idUsuario = 0;
                $usuario = '';
                $idMesa = 0;
                $numeroMesa = 0;
                $idSucursal = 0;
                $restaurante = '';
                $idEstado = 0;
                $estado = '';
                $fechaDesde = '';
                $fechaHasta = '';
                                
                oci_bind_by_name($stmt, ":idReserva", $idReserva, 4000);
                oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000);
                oci_bind_by_name($stmt, ":usuario", $usuario, 4000);
                oci_bind_by_name($stmt, ":idMesa", $idMesa, 4000);
                oci_bind_by_name($stmt, ":numeroMesa", $numeroMesa, 4000);
                oci_bind_by_name($stmt, ":idSucursal", $idSucursal, 4000);
                oci_bind_by_name($stmt, ":restaurante", $restaurante, 4000);
                oci_bind_by_name($stmt, ":idEstado", $idEstado, 4000);
                oci_bind_by_name($stmt, ":estado", $estado, 4000);
                oci_bind_by_name($stmt, ":fechaDesde", $fechaDesde, 4000);
                oci_bind_by_name($stmt, ":fechaHasta", $fechaHasta, 4000);
                                
                oci_execute($stmt);
                
                if ($idUsuario === null && $idMesa === null && $idSucursal === null && $idEstado === null){
                    break;
                } 

                $reservas[] = [
                    "id" => $idReserva,
                    "idUsuario" => $idUsuario,
                    "usuario" => $usuario,
                    "idMesa" => $idMesa,
                    "numeroMesa" => $numeroMesa,
                    "idSucursal" => $idSucursal,
                    "restaurante" => $restaurante,
                    "idEstado" => $idEstado,
                    "estado" => $estado,
                    "fechaDesde" => $fechaDesde,
                    "fechaHasta" => $fechaHasta
                ];
                
                $idReserva++;
            }
                
            oci_free_statement($stmt);
            return $reservas;
        }
    }
?>