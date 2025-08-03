<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php AddCss(); ?>
    <link rel="stylesheet" href="../Estilos/reservaMesa.css"> <!-- CSS externo -->
</head>

<body>
    <div id="main-wrapper">
        <?php ShowHeader(); ?>
        <?php ShowSideBar(); ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <h2 class="text-center">Reservar Mesa</h2>
                <form method="POST" action="" class="form-reserva">
                    <div class="mesa-container">
                        <?php
                        // Ejemplo: generar 10 mesas con estados simulados
                        $mesas = [
                            ['id' => 1, 'estado' => 'disponible'],
                            ['id' => 2, 'estado' => 'ocupada'],
                            ['id' => 3, 'estado' => 'disponible'],
                            ['id' => 4, 'estado' => 'reservada'],
                            ['id' => 5, 'estado' => 'disponible'],
                            ['id' => 6, 'estado' => 'disponible'],
                            ['id' => 7, 'estado' => 'ocupada'],
                            ['id' => 8, 'estado' => 'disponible'],
                            ['id' => 9, 'estado' => 'reservada'],
                            ['id' => 10, 'estado' => 'disponible'],
                        ];

                        foreach ($mesas as $mesa) {
                            echo "<div class='mesa {$mesa['estado']}' data-id='{$mesa['id']}'>{$mesa['id']}</div>";
                        }
                        ?>
                    </div>
                    <input type="hidden" name="mesa_id" id="mesa_id">
                    <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                </form>

                <!-- Botón de Ver Reservas -->
                <div style="margin-top: 30px; text-align: left;">
                    <a href="VerReserva.php" class="btn btn-secondary">
                        <i class="fa fa-list"></i> Ver Reservas
                    </a>
                </div>
            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <script>
        const mesas = document.querySelectorAll('.mesa');
        const inputMesa = document.getElementById('mesa_id');

        mesas.forEach(mesa => {
            mesa.addEventListener('click', () => {
                if (!mesa.classList.contains('ocupada') && !mesa.classList.contains('reservada')) {
                    mesas.forEach(m => m.classList.remove('seleccionada'));
                    mesa.classList.add('seleccionada');
                    inputMesa.value = mesa.dataset.id;
                }
            });
        });
    </script>

    <?php AddJs(); ?>
</body>

</html>