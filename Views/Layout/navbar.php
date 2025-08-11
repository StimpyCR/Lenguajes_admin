<!-- Estructura para las rutas de los HREF: href="/LENGUAJES_ADMIN/index.php?controller=NombreDelController&action=metodoDelController" -->
<?php
    // Para los ROLES
    function opcionesAdmin () {
        if ($_SESSION["usuario"]["idRol"] == 1) {
            echo '<!-- Dropdown "A" -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle admin-link" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        A
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-animate" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=producto&action=index">Gestión de Productos</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=categoria&action=index">Gestión de Categorías</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=ingrediente&action=index">Gestión de Ingredientes</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=sucursal&action=index">Gestión de Sucursales</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=direccion&action=index">Gestión de Direcciones</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=provincia&action=index">Gestión de Provincias</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=canton&action=index">Gestión de Cantones</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=distrito&action=index">Gestión de Distritos</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=estado&action=index">Gestión de Estados</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=rol&action=index">Gestión de Roles</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=prioridad&action=index">Gestión de Prioridades</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=horario&action=index">Gestión de Horarios de Empleados</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=mesa&action=index">Gestión de Mesas</a></li>
                        <li><a class="dropdown-item" href="/LENGUAJES_ADMIN/index.php?controller=ingredienteProducto&action=index">Gestión de Ingredientes por Productos</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                    </ul>
                </div>';
        }
    }
?>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-5 d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a class="navbar-brand" href="/LENGUAJES_ADMIN/index.php?controller=home&action=index">K</a>

        <!-- Menú centrado -->
        <div class="d-flex justify-content-center flex-grow-1">
            <ul class="navbar-nav d-flex flex-row justify-content-center align-items-center gap-4">
                <li class="nav-item"><a class="nav-link" href="/LENGUAJES_ADMIN/index.php?controller=home&action=menu">Menú</a></li>
                <li class="nav-item"><a class="nav-link" href="/LENGUAJES_ADMIN/index.php?controller=reserva&action=index">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="/LENGUAJES_ADMIN/index.php?controller=comentario&action=index">Reseñas</a></li>
                <li class="nav-item"><a class="nav-link" href="/LENGUAJES_ADMIN/Views/SobreNosotros/aboutUs.php">Nosotros</a></li>

            </ul>
        </div>

        <!-- Dropdowns a la derecha -->
        <div class="d-flex align-items-center gap-4">
            <!-- Dropdown Admin -->
            <?php opcionesAdmin() ?>

            <!-- Dropdown Usuario -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle user-icon" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-animate" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="../Home/consultarPerfil.php">Perfil</a></li>
                    <li>
                        <form method="POST" action="logout.php" style="margin: 0;">
                            <button type="submit" class="dropdown-item">Cerrar sesión</button>
                        </form>
                    </li>

                </ul>
            </div>

            <!-- Carrito -->
            <div class="dropdown">
                <a class="nav-link" href="/LENGUAJES_ADMIN/index.php?controller=carrito&action=index">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>
</nav>