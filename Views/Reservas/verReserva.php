<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php AddCss(); ?>
</head>

<body>
    <div id="main-wrapper">
        <?php ShowHeader(); ?>
        <?php ShowSideBar(); ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <h2>Mis Reservas</h2>
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Mesa</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Llamar al procedimiento almacenado para obtener reservas del usuario
                        // Ejemplo de datos simulados:
                        $reservas = [
                            ['id' => 1, 'mesa' => 3, 'fecha' => '2025-08-05', 'hora' => '19:00', 'estado' => 'Confirmada'],
                            ['id' => 2, 'mesa' => 5, 'fecha' => '2025-08-07', 'hora' => '20:30', 'estado' => 'Pendiente']
                        ];

                        foreach ($reservas as $reserva) {
                            echo "
                        <tr>
                            <td>{$reserva['id']}</td>
                            <td>Mesa {$reserva['mesa']}</td>
                            <td>{$reserva['fecha']}</td>
                            <td>{$reserva['hora']}</td>
                            <td>{$reserva['estado']}</td>
                            <td>
                                <a href='editarReserva.php?id={$reserva['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                <form method='POST' action='procesar_eliminar_reserva.php' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$reserva['id']}'>
                                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar esta reserva?\");'>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php ShowFooter(); ?>
        </div>
    </div>
    <?php AddJs(); ?>
</body>

</html>