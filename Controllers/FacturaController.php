<?php
session_start();
require_once __DIR__ . '/../Models/CantonModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/LENGUAJES_ADMIN/Models/FacturaModel.php';

class CantonController
{

    public function index()
    {

        /**
         * Espera POST con:
         *  - items[i][id], items[i][nombre], items[i][precio], items[i][cantidad], (opcional items[i][capacidad])
         *  - metodo_pago (opcional)
         *  - idpedido (opcional), idsucursal (opcional)
         */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // ===== 1) Datos de sesión / POST
                $usuarioIdRaw = $_SESSION['usuario_id'] ?? null;
                $idUsuario    = is_numeric($usuarioIdRaw) ? (int)$usuarioIdRaw : null;

                $usuarioMail  = $_SESSION['usuario_mail'] ?? 'N/A';
                $items        = $_POST['items'] ?? [];
                $metodoPago   = $_POST['metodo_pago'] ?? 'desconocido';

                $idPedido     = isset($_POST['idpedido'])   && $_POST['idpedido']   !== '' ? (int)$_POST['idpedido']   : null;
                $idSucursal   = isset($_POST['idsucursal']) && $_POST['idsucursal'] !== '' ? (int)$_POST['idsucursal'] : null;

                if (empty($items)) {
                    throw new Exception('No llegaron ítems del carrito.');
                }

                // ===== 2) Recalcular montos
                $subtotal = 0.0;
                foreach ($items as $it) {
                    $p = isset($it['precio']) ? (float)$it['precio'] : 0.0;
                    $c = isset($it['cantidad']) ? (int)$it['cantidad'] : 1;
                    if ($c < 1) $c = 1;
                    $subtotal += $p * $c;
                }
                $iva   = round($subtotal * 0.13, 2);
                $total = round($subtotal + $iva, 2);

                // ===== 3) Conectar Oracle y llamar SPs
                $conn      = OracleConnect();
                $idFactura = ObtenerIdFactura($conn);

                $idEstadoCab = 1; // 1=activo (ajústalo según tu catálogo)
                SP_InsertarFactura($conn, $idFactura, $idUsuario, $idPedido, $idSucursal, $idEstadoCab, $total, $iva);

                $idEstadoDet = 1; // 1=activo
                foreach ($items as $it) {
                    $idProd    = isset($it['id']) ? (int)$it['id'] : 0;
                    $cant      = isset($it['cantidad']) ? (int)$it['cantidad'] : 1;
                    if ($cant < 1) $cant = 1;
                    $precio    = isset($it['precio']) ? (float)$it['precio'] : 0.0;
                    $subLinea  = $precio * $cant;

                    // Si no manejas capacidad, quedará NULL
                    $capacidad = (isset($it['capacidad']) && $it['capacidad'] !== '') ? (float)$it['capacidad'] : null;

                    // Nota: tu SP de detalle no recibe "cantidad", solo "subtotal" y "capacidad".
                    // Si alguna vez necesitas cantidad, agrega el parámetro en el SP.
                    SP_InsertarDetalleFactura($conn, $idFactura, $idProd, $idEstadoDet, $subLinea, $capacidad);
                }

                // ===== 4) Generar TXT
                $facturaNum = 'FAC-' . $idFactura;          // ahora amarrado al ID real
                $fechaHora  = date('Y-m-d H:i:s');
                $line = str_repeat('-', 58);

                $txt  = "Restaurante Kerat\r\n";
                $txt .= "Factura: {$facturaNum}\r\n";
                $txt .= "Fecha:   {$fechaHora}\r\n";
                $txt .= "Cliente ID: " . ($idUsuario ?? 'N/A') . "\r\n";
                $txt .= "Email:      {$usuarioMail}\r\n";
                $txt .= "Pago:       {$metodoPago}\r\n";
                $txt .= "{$line}\r\n";
                $txt .= str_pad('Producto', 28)
                    .  str_pad('Cant', 6, ' ', STR_PAD_LEFT)
                    .  str_pad('Precio', 12, ' ', STR_PAD_LEFT)
                    .  str_pad('Subtotal', 12, ' ', STR_PAD_LEFT) . "\r\n";
                $txt .= "{$line}\r\n";

                foreach ($items as $it) {
                    $nombre   = $it['nombre']   ?? 'Producto';
                    $precio   = (float)($it['precio'] ?? 0);
                    $cantidad = (int)($it['cantidad'] ?? 1);
                    if ($cantidad < 1) $cantidad = 1;
                    $subLinea = $precio * $cantidad;

                    $txt .= str_pad(mb_substr($nombre, 0, 26), 28);
                    $txt .= str_pad($cantidad, 6, ' ', STR_PAD_LEFT);
                    $txt .= str_pad('₡' . number_format($precio, 2),   12, ' ', STR_PAD_LEFT);
                    $txt .= str_pad('₡' . number_format($subLinea, 2), 12, ' ', STR_PAD_LEFT);
                    $txt .= "\r\n";
                }

                $txt .= "{$line}\r\n";
                $txt .= str_pad('Subtotal:',        46, ' ', STR_PAD_LEFT) . str_pad('₡' . number_format($subtotal, 2), 12, ' ', STR_PAD_LEFT) . "\r\n";
                $txt .= str_pad('Impuesto (13%):',  46, ' ', STR_PAD_LEFT) . str_pad('₡' . number_format($iva, 2),      12, ' ', STR_PAD_LEFT) . "\r\n";
                $txt .= str_pad('Total:',           46, ' ', STR_PAD_LEFT) . str_pad('₡' . number_format($total, 2),    12, ' ', STR_PAD_LEFT) . "\r\n";
                $txt .= "{$line}\r\n";
                $txt .= "¡Gracias por su compra!\r\n";

                // Guardar en servidor (opcional)
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/LENGUAJES_ADMIN/Facturas';
                if (!is_dir($dir)) {
                    @mkdir($dir, 0775, true);
                }
                $filePath = $dir . '/' . $facturaNum . '.txt';
                file_put_contents($filePath, $txt);

                // Descargar al navegador
                header('Content-Type: text/plain; charset=UTF-8');
                header('Content-Disposition: attachment; filename="' . $facturaNum . '.txt"');
                header('Content-Length: ' . strlen($txt));
                echo $txt;
                exit;
            } catch (Throwable $ex) {
                error_log('[FACTURACION][SP] ' . $ex->getMessage());
                // Muestra una vista de error simple
                http_response_code(500);
                echo 'Ocurrió un error al procesar la factura: ' . htmlspecialchars($ex->getMessage());
                exit;
            }
        }

        // Si llega GET, redirige a la vista
        header('Location: /LENGUAJES_ADMIN/Views/Factura/facturacion.php');
        exit;
    }
}
