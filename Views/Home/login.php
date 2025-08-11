<?php
    session_start();
    
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutExterno.php';

    if(isset($_SESSION["usuario"])){
        header("Location: principal.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>

<?php


AddCss();


?>


<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../Imagenes/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="../Imagenes/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Iniciar Sesion</h5>
                    </div>

                    <!-- Si el registro se completó correctamente -->
                    <?php
                        if (isset($_GET['registro']) && $_GET['registro'] === 'ok') {
                            echo '<div class="alert alert-success" role="alert">
                                    Usuario creado correctamente. Ahora puedes iniciar sesión.
                                </div>';
                        }
                    ?>

                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" action="/LENGUAJES_ADMIN/index.php?controller=home&action=login" method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input id="txtCorreo" name="txtCorreo" type="email" class="form-control form-control-lg" placeholder="Correo" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span>
                                    </div>
                                    <input id="txtContrasenna" name="txtContrasenna" type="password" class="form-control form-control-lg" placeholder="Contraseña" required>
                                </div>

                                <!-- Validar si hay algun error -->
                                <?php if (isset($_GET["error"])): ?>
                                    <p style="color: red;">Usuario o contraseña incorrectos</p>
                                <?php endif; ?>

                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="btnIniciarSesion" name="btnIniciarSesion" class="btn btn-block btn-lg btn-info" type="submit">Procesar</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Si no tienes una cuenta <a href="registro.php" class="text-info m-l-5"><b>Regístrate</b></a>
                                    </div>
                                </div>
                                <!-- <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Olvidaste la contraseña? <a href="recuperarAcceso.php" class="text-info m-l-5"><b>Recuperar el acceso</b></a>
                                    </div>
                                </div> -->
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


    <?php


    AddJs();


    ?>






</body>

</html>