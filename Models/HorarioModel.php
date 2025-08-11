<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class HorarioModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearHorario ($idUsuario, $horaEntrada, $horaSalida) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_horario_empleado_SP(:idUsuario, :horaEntrada, :horaSalida);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":horaEntrada", $horaEntrada);
            oci_bind_by_name($stmt, ":horaSalida", $horaSalida);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar horario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarHorario ($idHorario, $idUsuario, $horaEntrada, $horaSalida) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_horario_empleado_SP(:idHorario, :idUsuario, :horaEntrada, :horaSalida);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idHorario", $idHorario);
            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":horaEntrada", $horaEntrada);
            oci_bind_by_name($stmt, ":horaSalida", $horaSalida);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar horario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerHorarios () {
            $horarios = [];
            $idHorario = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_HORARIOS_EMPLEADOS_SP(:idHorario, :idUsuario, :horaEntrada, :horaSalida);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $idUsuario = 0;
                $horaEntrada = '';
                $horaSalida = '';
                                
                oci_bind_by_name($stmt, ":idHorario", $idHorario, 4000);        // In
                oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000);        // Out
                oci_bind_by_name($stmt, ":horaEntrada", $horaEntrada, 4000);    // Out
                oci_bind_by_name($stmt, ":horaSalida", $horaSalida, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($idUsuario === null && $horaEntrada === null && $horaSalida === null){
                    break;
                } 

                $horarios[] = [
                    "id" => $idHorario,
                    "idUsuario" => $idUsuario,
                    "horaEntrada" => $horaEntrada,
                    "horaSalida" => $horaSalida
                ];
                
                $idHorario++;
            }
                
            oci_free_statement($stmt);
            return $horarios;
        }
    }
?>