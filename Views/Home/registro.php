<?php
session_start();

require_once __DIR__ . '/../../Models/LoginModel.php';

$error = "";
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnRegistrarUsuario'])) {
    $idUsuario = $_POST['txtIdentificacion'] ?? '';
    $nombre = $_POST['txtNombre'] ?? '';
    $correo = $_POST['txtCorreo'] ?? '';
    $contrasena = $_POST['txtContrasenna'] ?? '';

    // Validar campos mínimos
    if (!$idUsuario || !$nombre || !$correo || !$contrasena) {
        $error = "Todos los campos son obligatorios";
    } else {
        try {

            $crud = new CrudUsuarios();

            // Registrar con rol=2 (usuario normal), estado=1 (activo)
            $crud->insertarUsuario(
                intval($idUsuario),
                2,
                1,
                $nombre,
                '',          // teléfono vacío por ahora
                $correo,
                $contrasena
            );

            $mensaje = "Usuario registrado correctamente. Ahora podés iniciar sesión.";
        } catch (Exception $e) {
            $error = "Error al registrar usuario: " . $e->getMessage();
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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../Imagenes/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="../Imagenes/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Registro</h5>
                    </div>
                    <div class="row">
                        <div class="col-12">

                            <?php if ($error): ?>
                                <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
                            <?php endif; ?>

                            <?php if ($mensaje): ?>
                                <div class="alert alert-success text-center"><?php echo htmlspecialchars($mensaje); ?></div>
                            <?php endif; ?>

                            <form class="form-horizontal m-t-20" action="" method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtIdentificacion" name="txtIdentificacion" type="text" class="form-control form-control-lg" placeholder="Identificación" required value="<?php echo htmlspecialchars($_POST['txtIdentificacion'] ?? ''); ?>">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtNombre" name="txtNombre" type="text" class="form-control form-control-lg" placeholder="Nombre" required value="<?php echo htmlspecialchars($_POST['txtNombre'] ?? ''); ?>">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-email"></i></span>
                                    </div>
                                    <input id="txtCorreo" name="txtCorreo" type="email" class="form-control form-control-lg" placeholder="Correo" required value="<?php echo htmlspecialchars($_POST['txtCorreo'] ?? ''); ?>">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input id="txtContrasenna" name="txtContrasenna" type="password" class="form-control form-control-lg" placeholder="Contraseña" required>
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="btnRegistrarUsuario" name="btnRegistrarUsuario" class="btn btn-block btn-lg btn-info" type="submit">Procesar</button>
                                    </div>
                                </div>

                                <div class="form-group m-b-0 m-t-10 text-center">
                                    Si ya tienes una cuenta <a href="login.php" class="text-info m-l-5"><b>Iniciar Sesión</b></a>
                                </div>
                                <div class="form-group m-b-0 m-t-10 text-center">
                                    Olvidaste la contraseña? <a href="recuperarAcceso.php" class="text-info m-l-5"><b>Recuperar el acceso</b></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Aquí puedes mantener o eliminar la sección de recuperación si no la usas -->
            </div>
        </div>
    </div>

    <script src="../Funciones/jquery.min.js"></script>
    <script src="../Funciones/popper.min.js"></script>
    <script src="../Funciones/bootstrap.min.js"></script>
</body>

</html>
