<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class Usuario {
        // Atributos
        private $conexion;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conexion = $db -> conectar();
        }

        // Actualizar usuario incluyendo la contraseña (contrasena en RAW)
    public function actualizarUsuario($idUsuario, $idRol, $nombre, $telefono, $correo, $contrasenaBinaria)
    {
        $sql = "BEGIN FIDE_PK_KERAT_PKG.fide_actualizar_usuario_sp(:idUsuario, :idRol, :nombre, :telefono, :correo, :contrasena); END;";
        $stmt = oci_parse($this->conexion, $sql);

        oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
        oci_bind_by_name($stmt, ":idRol", $idRol);
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":telefono", $telefono);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":contrasena", $contrasenaBinaria, 32, SQLT_RAW);

        $resultado = oci_execute($stmt);

        if (!$resultado) {
            $e = oci_error($stmt);
            throw new Exception("Error al actualizar usuario: " . $e['message']);
        }
    }

    // Cambiar estado usuario
    public function cambiarEstadoUsuario($idUsuario, $idEstado)
    {
        $sql = "BEGIN FIDE_PK_KERAT_PKG.fide_cambiar_estado_usuario_SP(:idUsuario, :idEstado); END;";
        $stmt = oci_parse($this->conexion, $sql);

        oci_bind_by_name($stmt, ':idUsuario', $idUsuario);
        oci_bind_by_name($stmt, ':idEstado', $idEstado);

        $resultado = oci_execute($stmt);
        if (!$resultado) {
            $e = oci_error($stmt);
            throw new Exception("Error al cambiar estado del usuario: " . $e['message']);
        }
        oci_free_statement($stmt);
    }

    public function __destruct()
    {
        if ($this->conexion) {
            oci_close($this->conexion);
        }
    }
    }
    
?>