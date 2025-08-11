<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php AddCss(); ?>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/reservaMesa.css"> <!-- CSS externo -->
</head>

<body>
    <div id="main-wrapper">
        <?php ShowHeader(); ?>
        <?php ShowSideBar(); ?>


        <div class="page-wrapper">
            <div class="container-fluid">
                <h2 class="text-center mb-3">Reservar Mesa</h2>

                <!-- Contenedor de Mesas -->
                <div class="mesa-container">
                    <?php foreach ($mesas as $mesa): ?>
                        <div class="mesa <?= strtolower(trim($mesa['estado'])) ?>" data-id="<?= $mesa['id'] ?>">
                            <?= $mesa['numeroMesa'] ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Botón que abre el modal -->
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary" id="btnConfirmar" disabled>
                        Confirmar Reserva
                    </button>
                </div>


                <!-- Botón de Ver Reservas -->
                <div style="margin-top: 30px; text-align: left;">
                    <a href="/LENGUAJES_ADMIN/index.php?controller=reserva&action=listado" class="btn btn-secondary">
                        <i class="fa fa-list"></i> Ver Reservas
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalReserva" tabindex="-1" aria-labelledby="modalReservaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="/LENGUAJES_ADMIN/index.php?controller=reserva&action=agregar">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalReservaLabel">Confirmar Reserva</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="idMesa" id="idMesa">

                            <div class="mb-3">
                                <label for="idSucursal" class="form-label">Sucursal</label>
                                <select class="form-select form-control" name="idSucursal" id="idSucursal" required>
                                    <option value="">Seleccione una sucursal</option>
                                    <?php foreach ($sucursales as $sucursal): ?>
                                        <option value="<?= $sucursal['id'] ?>"><?= $sucursal['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="fechaDesde" class="form-label">Fecha Desde</label>
                                <input type="datetime-local" class="form-control" name="fechaDesde" id="fechaDesde" required>
                            </div>

                            <div class="mb-3">
                                <label for="fechaHasta" class="form-label">Fecha Hasta</label>
                                <input type="datetime-local" class="form-control" name="fechaHasta" id="fechaHasta" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Reservar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php ShowFooter(); ?>
    </div>

    <?php AddJs(); ?>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/reservas.js"></script>
</body>

</html>