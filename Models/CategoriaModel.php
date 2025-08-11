<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Clase
    class CategoriaModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearCategoria ($descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_categoria_SP(:descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar categoría: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarCategoria ($idCategoria, $idEstado, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_categoria_SP(:idCategoria, :idEstado, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idCategoria", $idCategoria);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar categoría: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoCategoria ($idCategoria) {
            $sql = "BEGIN 
                        FIDE_PK_KERAT_PKG.fide_cambiar_estado_categoria_SP(:idCategoria); 
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ':idCategoria', $idCategoria);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al cambiar estado de la categoría: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerCategorias(){
            $categorias = [];
            $idCategoria = 1;

            while (true){
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_CATEGORIAS_SP(:idCategoria, :descripcion, :estado, :rutaImagen);
                        END;";
                
                $stmt = oci_parse($this->conn, $sql);

                $descripcion = "";
                $estado = "";
                $rutaImagen = "";

                oci_bind_by_name($stmt, ":idCategoria", $idCategoria, 4000);
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);
                oci_bind_by_name($stmt, ":estado", $estado, 4000);
                oci_bind_by_name($stmt, ":rutaImagen", $rutaImagen, 4000);

                oci_execute($stmt);

                if ($descripcion === null && $estado === null) {
                    break;
                }

                $categorias[] = [
                    "id" => $idCategoria,
                    "descripcion" => $descripcion,
                    "estado" => $estado,
                    "rutaImagen" => $rutaImagen
                ];

                $idCategoria++;
            }

            oci_free_statement($stmt);
            return $categorias;
        }
    }
?>