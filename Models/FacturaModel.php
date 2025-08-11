<?php
// Importamos Config
require_once __DIR__ . '/../Config/database.php';

// Creamos clase
class UsuarioModel
{
    // Atributos
    private $conn;

    // Constructor
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    /** Obtiene el siguiente ID de factura desde tu SEQUENCE */
    function ObtenerIdFactura(\OCI_Connection $conn): int
    {
        // Cambia SEQ_FACTURA por tu secuencia real
        $stid = oci_parse($conn, 'SELECT SEQ_FACTURA.NEXTVAL AS ID FROM DUAL');
        if (!oci_execute($stid)) {
            $e = oci_error($stid);
            throw new Exception('Error al ejecutar SEQUENCE: ' . $e['message']);
        }
        $row = oci_fetch_assoc($stid);
        oci_free_statement($stid);
        if (!$row || empty($row['ID'])) {
            throw new Exception('No se pudo obtener ID de factura.');
        }
        return (int)$row['ID'];
    }

    /** Llama al SP de cabecera: fide_insertar_factura_SP */
    function SP_InsertarFactura(
        \OCI_Connection $conn,
        int $idFactura,
        ?int $idUsuario,
        ?int $idPedido,
        ?int $idSucursal,
        int $idEstado,
        float $totalFactura,
        float $iva
    ): void {
        $pl = 'BEGIN
        fide_insertar_factura_SP(
            :p_idfactura, :p_idusuario, :p_idpedido, :p_idsucursal,
            :p_idestado, :p_total, :p_iva
        );
    END;';
        $st = oci_parse($conn, $pl);

        oci_bind_by_name($st, ':p_idfactura', $idFactura, -1, SQLT_INT);
        oci_bind_by_name($st, ':p_idusuario', $idUsuario, -1, SQLT_INT);     // permite NULL
        oci_bind_by_name($st, ':p_idpedido',  $idPedido,  -1, SQLT_INT);     // permite NULL
        oci_bind_by_name($st, ':p_idsucursal', $idSucursal, -1, SQLT_INT);     // permite NULL
        oci_bind_by_name($st, ':p_idestado',  $idEstado,  -1, SQLT_INT);
        oci_bind_by_name($st, ':p_total',     $totalFactura);
        oci_bind_by_name($st, ':p_iva',       $iva);

        if (!oci_execute($st)) {
            $e = oci_error($st);
            throw new Exception('SP fide_insertar_factura_SP: ' . $e['message']);
        }
        oci_free_statement($st);
        // No commit aquí: tus SP ya hacen COMMIT.
    }

    /** Llama al SP de detalle: fide_insertar_detalle_factura_SP por cada ítem */
    function SP_InsertarDetalleFactura(
        \OCI_Connection $conn,
        int $idFactura,
        int $idProducto,
        int $idEstado,
        float $subtotal,
        ?float $capacidad
    ): void {
        $pl = 'BEGIN
        fide_insertar_detalle_factura_SP(
            :p_idfactura, :p_idproducto, :p_idestado, :p_subtotal, :p_capacidad
        );
    END;';
        $st = oci_parse($conn, $pl);

        oci_bind_by_name($st, ':p_idfactura',  $idFactura, -1, SQLT_INT);
        oci_bind_by_name($st, ':p_idproducto', $idProducto, -1, SQLT_INT);
        oci_bind_by_name($st, ':p_idestado',   $idEstado, -1, SQLT_INT);
        oci_bind_by_name($st, ':p_subtotal',   $subtotal);
        oci_bind_by_name($st, ':p_capacidad',  $capacidad); // permite NULL

        if (!oci_execute($st)) {
            $e = oci_error($st);
            throw new Exception('SP fide_insertar_detalle_factura_SP: ' . $e['message']);
        }
        oci_free_statement($st);
    }
}
