<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menu.css">

<?php
AddCss();
?>

<body>
    <div id="main-wrapper">
        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- Encabezado del Menú -->
                <div class="menu-header text-center">
                    <h1>Menú de Platillos</h1>
                    <p>Descubre nuestras opciones deliciosas</p>
                    <div class="menu-search">
                        <input type="text" placeholder="Buscar platillo...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <!-- Botón de Ver Pedido (oculto inicialmente) -->
                <a href="../Menu/verPedido.php" class="pedido-button" id="pedidoButton">
                    <i class="fas fa-receipt"></i> Ver mi pedido
                </a>
                <!-- Contenedor de Platillos -->
                <div class="menu-container">

                    <!-- Cada platillo tiene botón de "Agregar al pedido" -->
                    <div class="menu-card" onclick="agregarAlPedido('Pizza Margarita')">
                        <img src="https://images.unsplash.com/photo-1601924638867-3ecb1a30b99b" alt="Pizza Margarita">
                        <h3>Pizza Margarita</h3>
                    </div>

                    <div class="menu-card" onclick="agregarAlPedido('Hamburguesa Clásica')">
                        <img src="https://images.unsplash.com/photo-1550547660-d9450f859349" alt="Hamburguesa Clásica">
                        <h3>Hamburguesa Clásica</h3>
                    </div>

                    <div class="menu-card" onclick="agregarAlPedido('Ensalada César')">
                        <img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141" alt="Ensalada César">
                        <h3>Ensalada César</h3>
                    </div>

                    <div class="menu-card" onclick="agregarAlPedido('Sushi Roll')">
                        <img src="https://images.unsplash.com/photo-1512058564366-c9e3c6a4f04b" alt="Sushi Roll">
                        <h3>Sushi Roll</h3>
                    </div>

                    <div class="menu-card" onclick="agregarAlPedido('Tacos al Pastor')">
                        <img src="https://images.unsplash.com/photo-1626085483650-7f7d24f1525c" alt="Tacos al Pastor">
                        <h3>Tacos al Pastor</h3>
                    </div>
                </div>
            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- Script para manejar el pedido -->
    <script>
        // Mostrar/ocultar el botón de "Ver mi pedido"
        document.addEventListener('DOMContentLoaded', () => {
            const pedidoButton = document.getElementById('pedidoButton');
            const pedido = JSON.parse(localStorage.getItem('pedido')) || [];
            if (pedido.length > 0) {
                pedidoButton.style.display = 'flex';
            } else {
                pedidoButton.style.display = 'none';
            }
        });

        // Agregar producto al pedido
        function agregarAlPedido(producto) {
            let pedido = JSON.parse(localStorage.getItem('pedido')) || [];
            pedido.push(producto);
            localStorage.setItem('pedido', JSON.stringify(pedido));

            // Mostrar el botón cuando se agrega algo
            document.getElementById('pedidoButton').style.display = 'flex';
        }
    </script>
</body>

</html>