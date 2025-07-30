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

                <div class="menu-header text-center">
                    <h1>Menú de Platillos</h1>
                    <p>Descubre nuestras opciones deliciosas</p>
                    <div class="menu-search">
                        <input type="text" placeholder="Buscar platillo...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="menu-container">
                    <!-- Fila 1 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1601924638867-3ecb1a30b99b" alt="Pizza Margarita">
                        <h3>Pizza Margarita</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1550547660-d9450f859349" alt="Hamburguesa Clásica">
                        <h3>Hamburguesa Clásica</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141" alt="Ensalada César">
                        <h3>Ensalada César</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1512058564366-c9e3c6a4f04b" alt="Sushi Roll">
                        <h3>Sushi Roll</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1626085483650-7f7d24f1525c" alt="Tacos al Pastor">
                        <h3>Tacos al Pastor</h3>
                    </div>

                    <!-- Fila 2 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1601924928376-06c6c7cc7f88" alt="Pasta Alfredo">
                        <h3>Pasta Alfredo</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1523983302122-94f42e4e5e6b" alt="Ramen Japonés">
                        <h3>Ramen Japonés</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1602333865978-35f84b7ba4aa" alt="Pollo a la Parrilla">
                        <h3>Pollo a la Parrilla</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Paella Española">
                        <h3>Paella Española</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1589307003857-45d58e0d4e3b" alt="Ceviche Peruano">
                        <h3>Ceviche Peruano</h3>
                    </div>

                    <!-- Fila 3 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1551024601-bec78aea704b" alt="Hot Dog Especial">
                        <h3>Hot Dog Especial</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe" alt="Panqueques">
                        <h3>Panqueques</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7" alt="Bagel con Salmón">
                        <h3>Bagel con Salmón</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" alt="Bruschetta Italiana">
                        <h3>Bruschetta Italiana</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1627308595229-7830a5c91f9f" alt="Falafel con Hummus">
                        <h3>Falafel con Hummus</h3>
                    </div> 



                    

                    <!-- Fila 4 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1604909053065-86aef0f4b99e" alt="Empanadas Argentinas">
                        <h3>Empanadas Argentinas</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1551218808-94e220e084d2" alt="Helado Artesanal">
                        <h3>Helado Artesanal</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1615719413546-198b1d69a62f" alt="Brownie con Helado">
                        <h3>Brownie con Helado</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Smoothie Tropical">
                        <h3>Smoothie Tropical</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1523983302122-94f42e4e5e6b" alt="Wrap Vegetariano">
                        <h3>Wrap Vegetariano</h3>
                    </div>

                    <!-- Fila 5 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Lasaña Boloñesa">
                        <h3>Lasaña Boloñesa</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1600891965050-c4c7b1c2f7b5" alt="Pollo Teriyaki">
                        <h3>Pollo Teriyaki</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Gyozas Japonesas">
                        <h3>Gyozas Japonesas</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1598514982476-9e49c2af6eb8" alt="Arepas Venezolanas">
                        <h3>Arepas Venezolanas</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Crema de Calabaza">
                        <h3>Crema de Calabaza</h3>
                    </div>

                    <!-- Fila 6 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Sopa de Cebolla">
                        <h3>Sopa de Cebolla</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Gazpacho Andaluz">
                        <h3>Gazpacho Andaluz</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187" alt="Burritos Tex-Mex">
                        <h3>Burritos Tex-Mex</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Croissants">
                        <h3>Croissants</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" alt="Café Espresso">
                        <h3>Café Espresso</h3>
                    </div>

                    <!-- Fila 7 -->
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Capuchino">
                        <h3>Capuchino</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1562059390-a761a084768e" alt="Té Matcha">
                        <h3>Té Matcha</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Milkshake Vainilla">
                        <h3>Milkshake Vainilla</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" alt="Jugo de Naranja">
                        <h3>Jugo de Naranja</h3>
                    </div>
                    <div class="menu-card"><img src="https://images.unsplash.com/photo-1617196038957-3215e24e8169" alt="Agua Mineral">
                        <h3>Agua Mineral</h3>
                    </div>



                </div>


            </div>




            <?php

            ShowFooter();
            ?>





        </div>

    </div>


    <div class="chat-windows"></div>



    <?php

    AddJs();
    ?>










</body>

</html>