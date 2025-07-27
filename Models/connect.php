<?php
// Datos de conexión
$usuario = "kerat_restaurante";        // Cambia por tu usuario Oracle
$contrasena = "123";  // Cambia por tu contraseña
$cadenaConexion = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    (CONNECT_DATA =
        (SERVER = DEDICATED)
        (SERVICE_NAME = XE)         
    )
)";

// Conectar a Oracle
putenv("NLS_LANG=AMERICAN_AMERICA.AL32UTF8");
$conn = oci_connect($usuario, $contrasena, $cadenaConexion,'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    echo "Error de conexión: " . htmlentities($e['message'], ENT_QUOTES);
    exit;
} else {
    echo "Conexión exitosa a Oracle!";
}

// No olvides cerrar la conexión cuando termines
oci_close($conn);
