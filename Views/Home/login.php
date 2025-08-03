<?php
    session_start();
    
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutExterno.php';
    require_once __DIR__ . '/../../Models/LoginModel.php';

    
$error = null;

    if(isset($_SESSION["idusuario"])){
        header("Location: principal.php");
        exit();
    }



$error = null;

if (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnIniciarSesion'])) {
    $correo = $_POST['txtCorreo'] ?? '';
    $contrasena = $_POST['txtContrasenna'] ?? '';

    if (!$correo || !$contrasena) {
        $error = "Debe ingresar correo y contraseña";
    } else {
        try {
            $crud = new CrudUsuarios();
            $usuario = $crud->validarCredenciales($correo, $contrasena);

            if ($usuario) {
                $_SESSION['idusuario'] = $usuario['IDUSUARIO'];
                $_SESSION['nombre'] = $usuario['NOMBRE'];
                $_SESSION['idrol'] = $usuario['IDROL'];

                header("Location: principal.php");
                exit;
            } else {
                $error = "Correo o contraseña inválidos, o usuario inactivo";
            }
        } catch (Exception $e) {
            $error = "Error al iniciar sesión: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>

    <link href="../Estilos/style.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url(../Imagenes/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="../Imagenes/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Iniciar Sesión</h5>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" action="" method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input id="txtCorreo" name="txtCorreo" type="email"
                                        class="form-control form-control-lg" placeholder="Correo" required />
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span>
                                    </div>
                                    <input id="txtContrasenna" name="txtContrasenna" type="password"
                                        class="form-control form-control-lg" placeholder="Contraseña" required />
                                </div>

                                <!-- Mostrar error si existe -->
                                <?php if ($error): ?>
                                    <div class="alert alert-danger text-center">
                                        <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="btnIniciarSesion" name="btnIniciarSesion"
                                            class="btn btn-block btn-lg btn-info" type="submit">Procesar</button>
                                    </div>
                                </div>

                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Si no tienes una cuenta <a href="registro.php"
                                            class="text-info m-l-5"><b>Registráte</b></a>
                                    </div>
                                </div>

                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        ¿Olvidaste la contraseña? <a href="recuperarAcceso.php"
                                            class="text-info m-l-5"><b>Recuperar el acceso</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Puedes mantener o eliminar esta sección de recuperación -->
                <div id="recoverform" style="display:none;">
                    <div class="logo">
                        <span class="db"><img src="../Imagenes/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Recover Password</h5>
                        <span>Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row m-t-20">
                        <form class="col-12" action="index.html">
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="email" required
                                        placeholder="Username" />
                                </div>
                            </div>
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