<?php

function ShowHeader()
{
    echo '
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>

                    <div class="navbar-brand">
                        <a href="/LENGUAJES_ADMIN/index.php?controller=home&action=index" class="logo">
                            <b class="logo-icon">
                                <img src="/LENGUAJES_ADMIN/Views/Imagenes/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="/LENGUAJES_ADMIN/Views/Imagenes/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            
                        </a>
                        <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                        </a>
                    </div>

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav float-left mr-auto">


                    </ul>

                    <ul class="navbar-nav float-right">

                        <li class="nav-item dropdown">


                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="m-l-5 font-medium d-none d-sm-inline-block">
                            <i class="mdi mdi-account"></i>
                            <i class="mdi mdi-chevron-down"></i>
                            </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>

                                <div class="profile-dis scrollable">
                                    <a class="dropdown-item" href="/LENGUAJES_ADMIN/Views/Home/consultarPerfil.php">
                                        <i class="ti-user m-r-5 m-l-5"></i>Mi perfil</a>
                                    <a class="dropdown-item" href="/LENGUAJES_ADMIN/Views/Home/logout.php">

                                        <i class="ti-wallet m-r-5 m-l-5"></i> Cerrar Sesion</a>

                                </div>

                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>';



    function ShowFooter()
    {
        echo '<footer class="footer text-center">
                Bienvenido a Kerat donde cada plato cuenta una historia
            </footer>';
    }

    function ShowSideBar()
    {
        echo '
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item" style="margin-bottom: 10px;"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/LENGUAJES_ADMIN/index.php?controller=home&action=index" aria-expanded="false">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <span class="hide-menu">Volver al Inicio</span>
                    </a>
                </li>
                <li class="sidebar-item" style="margin-bottom: 10px;"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/LENGUAJES_ADMIN/index.php?controller=home&action=menu" aria-expanded="false">
                        <i class="fa fa-coffee" aria-hidden="true"></i>
                        <span class="hide-menu">Menu</span>
                    </a>
                </li>
                <li class="sidebar-item" style="margin-bottom: 10px;">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/LENGUAJES_ADMIN/index.php?controller=reserva&action=index" aria-expanded="false">
                        <i class="fa fa-cutlery"></i>
                        <span class="hide-menu">Reservar Mesa</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>';
    }



    function AddJs()
    {
        echo '
    <script src="/LENGUAJES_ADMIN/Views/Funciones/jquery.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/popper.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/bootstrap.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/app.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/app.init.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/app-style-switcher.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/perfect-scrollbar.jquery.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/sparkline.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/waves.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones//sidebarmenu.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/perfil.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones//custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>';
    }
}


function AddCss()
{
    echo '<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kerat Restaurante</title>
    

    <link href="/LENGUAJES_ADMIN/Views/Estilos/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>';
}
