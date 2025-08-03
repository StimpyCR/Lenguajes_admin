<?php
require_once __DIR__ . '/../Config/database.php';

if (!defined('SQLT_RAW')) {
    define('SQLT_RAW', 23);
}

class CrudUsuarios
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }


    public function validarCredenciales($correo, $contrasenaIngresada)
    {

        $sqlUsuario = "SELECT idUsuario, nombre, idRol, idEstado FROM fide_usuario_tb WHERE correo = :correo";
        $stmtUsuario = oci_parse($this->conexion, $sqlUsuario);
        oci_bind_by_name($stmtUsuario, ':correo', $correo);
        oci_execute($stmtUsuario);

        $usuario = oci_fetch_assoc($stmtUsuario);

        if ($usuario) {

            $sqlClave = "BEGIN :contrasena := FIDE_DESENCRIPTAR_CLAVE_FN(:idusuario); END;";
            $stmtClave = oci_parse($this->conexion, $sqlClave);

            $contrasenaDesencriptada = '';
            oci_bind_by_name($stmtClave, ':contrasena', $contrasenaDesencriptada, 100); // salida
            oci_bind_by_name($stmtClave, ':idusuario', $usuario['IDUSUARIO']); // entrada

            if (oci_execute($stmtClave)) {
                // Validar estado y contraseña
                if ($usuario['IDESTADO'] == 1 && $contrasenaDesencriptada === $contrasenaIngresada) {

                    $usuario['CONTRASENA_DESENCRIPTADA'] = $contrasenaDesencriptada;
                    return $usuario;
                }
            }
        }

        return false;
    }

    public function insertarUsuario($idUsuario, $idRol, $idEstado, $nombre, $telefono, $correo, $contrasena)
    {

        $sql = "BEGIN FIDE_PK_KERAT_PKG.fide_insertar_usuario_sp(:idUsuario, :idRol, :idEstado, :nombre, :telefono, :correo, :contrasena); END;";
        $stmt = oci_parse($this->conexion, $sql);

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
