<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menu.css">
<link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/menuModal.css"> <!-- CSS del modal -->

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

                <!-- Botón de Ver Pedido -->
                <a href="../Menu/verPedido.php" class="pedido-button" id="pedidoButton">
                    <i class="fas fa-receipt"></i> Ver mi pedido
                </a>

                <!-- Contenedor de Platillos -->
                <div class="menu-container">
                    <div class="menu-card" onclick="mostrarDescripcion('Pizza Margarita', 'Clásica pizza italiana con salsa de tomate, mozzarella fresca y albahaca.', [
                        'https://images.unsplash.com/photo-1601924638867-3ecb1a30b99b',
                        'https://images.unsplash.com/photo-1603079842089-0284580f49f1',
                        'https://images.unsplash.com/photo-1506354666786-959d6d497f1a'
                    ])">
                        <img src="https://images.unsplash.com/photo-1601924638867-3ecb1a30b99b" alt="Pizza Margarita">
                        <h3>Pizza Margarita</h3>
                    </div>

                    <div class="menu-card" onclick="mostrarDescripcion('Hamburguesa Clásica', 'Jugosa carne de res, queso cheddar, lechuga, tomate y nuestra salsa especial.', [
                        'https://images.unsplash.com/photo-1550547660-d9450f859349',
                        'https://images.unsplash.com/photo-1609408140325-462f9d8e6042'
                    ])">
                        <img src="https://images.unsplash.com/photo-1550547660-d9450f859349" alt="Hamburguesa Clásica">
                        <h3>Hamburguesa Clásica</h3>
                    </div>
                </div>
            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <!-- Modal con carrusel y formulario -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <span class="modal-close" onclick="cerrarModal()">&times;</span>
            <h3 id="modalTitulo"></h3>

            <!-- Carrusel -->
            <div id="carouselModal" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="carouselInner"></div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselModal" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselModal" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <!-- Descripción del platillo -->
            <p id="modalDescripcion"></p>

            <!-- Formulario tipo POST -->
            <form action="" method="POST">
                <input type="hidden" id="productoInput" name="producto">
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-info" type="submit">
                            Agregar al pedido
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mostrar modal con descripción y carrusel dinámico
        function mostrarDescripcion(titulo, descripcion, imagenes) {
            document.getElementById('modalTitulo').innerText = titulo;
            document.getElementById('modalDescripcion').innerText = descripcion;
            document.getElementById('productoInput').value = titulo; // ✅ Asignar producto al input hidden

            // Generar imágenes del carrusel
            const carouselInner = document.getElementById('carouselInner');
            carouselInner.innerHTML = '';
            imagenes.forEach((img, index) => {
                const activeClass = index === 0 ? 'active' : '';
                carouselInner.innerHTML += `
                    <div class="carousel-item ${activeClass}">
                        <img src="${img}" class="d-block w-100" alt="${titulo}">
                    </div>
                `;
            });

            document.getElementById('modalOverlay').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('modalOverlay').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const pedidoButton = document.getElementById('pedidoButton');
            const pedido = JSON.parse(localStorage.getItem('pedido')) || [];
            pedidoButton.style.display = pedido.length > 0 ? 'flex' : 'none';
        });
    </script>
</body>

</html>