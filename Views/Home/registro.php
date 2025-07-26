<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registro</title>

    <link href="../Estilos/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">


        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../Imagenes/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="../Imagenes/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Registro</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">

                            <form class="form-horizontal m-t-20" action="" method="POST">

                                <!-- PHP POR SI NO TIENE UN USUARIO -->
                                <?php


                                if (isset($_POST["txtMensaje"])) {
                                    echo "<div class='alert alert-warning text-center'>" .  $_POST["txtMensaje"] . "</div>";
                                }


                                ?>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtIdentificaicon" name="txtIdentificacion" type="text" class="form-control form-control-lg" placeholder="Identificacion">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtNombre" name="txtNombre" type="text" class="form-control form-control-lg" placeholder="Nombre">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtCorreo" name="txtCorreo" type="email" class="form-control form-control-lg" placeholder="Correo">
                                </div>





                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input id="txtContrasenna" name="txtContrasenna" type="password" class="form-control form-control-lg" placeholder="Contraseña" required>
                                </div>



                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="btnRegistrarUsuario" name="btnRegistrarUsuario" class="btn btn-block btn-lg btn-info" type="submit">Procesar</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Si ya tienes una cuenta <a href="login.php" class="text-info m-l-5"><b>Iniciar Sesion</b></a>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Olvidaste la contraseña? <a href="recuperarAcceso.php" class="text-info m-l-5"><b>Recuperar el acceso</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <span class="db"><img src="../Imagenes/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Recover Password</h5>
                        <span>Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="email" required="" placeholder="Username">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-danger" type="submit" name="action">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../Funciones/jquery.min.js"></script>
    <script src="../Funciones/popper.min.js"></script>
    <script src="../Funciones/bootstrap.min.js"></script>


</body>

</html>