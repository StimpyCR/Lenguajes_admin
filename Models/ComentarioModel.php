<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class ComentarioModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearComentario ($idPedido, $idUsuario, $comentario, $calificacion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_comentario_SP(:idPedido, :idUsuario, :comentario, :calificacion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idPedido", $idPedido);
            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            oci_bind_by_name($stmt, ":comentario", $comentario);
            oci_bind_by_name($stmt, ":calificacion", $calificacion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar comentario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarComentario ($idComentario, $comentario, $calificacion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_comentario_SP(:idComentario, :comentario, :calificacion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idComentario", $idComentario);
            oci_bind_by_name($stmt, ":comentario", $comentario);
            oci_bind_by_name($stmt, ":calificacion", $calificacion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar comentario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoComentario ($idComentario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_eliminar_comentario_SP(:idComentario);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idComentario", $idComentario);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar comentario: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerComentarios () {
            $comentarios = [];
            $idComentario = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_COMENTARIOS_SP(:idComentario, :comentario, :calificacion, :fechaHora, :usuario);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $comentario = '';
                $calificacion = 0;
                $fechaHora = '';
                $usuario = '';
                                
                oci_bind_by_name($stmt, ":idComentario", $idComentario, 4000);            // In
                oci_bind_by_name($stmt, ":comentario", $comentario, 4000);
                oci_bind_by_name($stmt, ":calificacion", $calificacion, 4000);
                oci_bind_by_name($stmt, ":fechaHora", $fechaHora, 4000);
                oci_bind_by_name($stmt, ":usuario", $usuario, 4000);
                                
                oci_execute($stmt);
                
                if ($comentario === null && $calificacion === null && $fechaHora === null){
                    break;
                } 

                $comentarios[] = [
                    "id" => $idComentario,
                    "comentario" => $comentario,
                    "calificacion" => $calificacion,
                    "fechaHora" => $fechaHora,
                    "usuario" => $usuario
                ];
                
                $idComentario++;
            }
                
            oci_free_statement($stmt);
            return $comentarios;
        }
    }
?>