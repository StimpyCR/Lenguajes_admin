<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-5 d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a class="navbar-brand" href="#">K</a>

        <!-- Menú centrado -->
        <div class="d-flex justify-content-center flex-grow-1">
            <ul class="navbar-nav d-flex flex-row justify-content-center align-items-center gap-4">
                <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sobre Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Food Safety</a></li>
            </ul>
        </div>

        <!-- Dropdowns a la derecha -->
        <div class="d-flex align-items-center gap-4">
            <!-- Dropdown "A" -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle admin-link" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    A
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-animate" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="#">Gestión de Productos</a></li>
                    <li><a class="dropdown-item" href="#">Reportes</a></li>
                    <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                </ul>
            </div>

            <!-- Dropdown Usuario -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle user-icon" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-animate" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Ajustes</a></li>
                    <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
