<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';

    // Validación de si el usuario inició sesión (NO ELIMINAR, SOLO COMENTAR DE SER NECESARIO)
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="es">

<?php
AddCss();
?>

<head>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/perfil.css">
</head>

<body>
    <div id="main-wrapper">

        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <!-- Mensajes de confirmación (satisfactorios y errores) -->
            <?php
                // Todo bien
                if (isset($_GET['actualizar']) && $_GET['actualizar'] === 'ok') {
                    echo '<div class="alert alert-success text-center" role="alert">
                            Datos actualizados correctamente.
                        </div>';
                }
                // Nuevo PWD incorrecto
                elseif (isset($_GET['actualizar']) && $_GET['actualizar'] === 'errorNewPwd'){
                    echo '<div class="alert alert-danger text-center" role="alert">
                            La Nueva Contraseña no coincide. Intente nuevamente.
                        </div>';
                }
                // PWD actual incorrecto (para actualizar)
                elseif(isset($_GET['actualizar']) && $_GET['actualizar'] === 'errorPwd'){
                    echo '<div class="alert alert-danger text-center" role="alert">
                            La contraseña actual es incorrecta. Intente nuevamente para guardar los cambios.
                        </div>';
                }
                // PWD actual incorrecto (para inactivar)
                elseif(isset($_GET['eliminar']) && $_GET['eliminar'] === 'errorPwd'){
                    echo '<div class="alert alert-danger text-center" role="alert">
                            La contraseña actual es incorrecta. No se logró inactivar la cuenta.
                        </div>';
                }
            ?>    
            
            <div class="container-fluid perfil-container">
                <h2 class="perfil-title text-center mb-4">⚙️ Actualizar Perfil</h2>
                <div class="perfil-card">
                    <div class="perfil-card-body">
                        <form action="/LENGUAJES_ADMIN/index.php?controller=usuario&action=enrutadorAccion" method="POST" class="perfil-form animate-form">
                            <h3 class="text-center my-3">Cambie únicamente los datos que desea actualizar</h3>
                            
                            <!-- Comenté esto porque no sé que hace jeje -->
                            <?php
                            // if (isset($_POST['txtMensaje']))
                            //     echo '<div class="alert alert-warning text-center animate-fade">' . $_POST['txtMensaje'] . '</div>';
                            ?>

                            <div class="mb-3">
                                <label for="txtNombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control perfil-input" id="txtNombre" name="txtNombre" required
                                    value="<?= $_SESSION["usuario"]["nombre"] ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="txtTelefono" class="form-label">Número de Teléfono</label>
                                <input type="tel" class="form-control perfil-input" id="txtTelefono" name="txtTelefono" required
                                    value="<?= $_SESSION["usuario"]["telefono"] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="txtCorreo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control perfil-input" id="txtCorreo" name="txtCorreo" required
                                    value="<?= $_SESSION["usuario"]["correo"] ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="txtContrasena" class="form-label">Contraseña Actual</label>
                                <input type="password" class="form-control perfil-input" id="txtContrasena" name="txtContrasena" required>
                            </div>
                            
                            <div class="mb-3">
                                <h4>En caso de querer cambiar la contraseña, ingresarla debajo. De lo contrario, dejar vacío.</h4>
                            </div>

                            <div class="mb-3">
                                <label for="txtNuevaContrasena" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control perfil-input" id="txtNuevaContrasena" name="txtNuevaContrasena">
                            </div>
                            
                            <div class="mb-3">
                                <label for="txtNuevaContrasena2" class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control perfil-input" id="txtNuevaContrasena2" name="txtNuevaContrasena2">
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" id="btnActualizarPerfilUsuario" name="accion" value="editar" class="btn perfil-btn">
                                    💾 Guardar cambios
                                </button>
                            </div>
                            
                            <!-- Sebas, acá pongale un estilo más bonito al botón jaja -->
                            <!-- Nada más no cambie los Name ni ID de los botones porfa -->
                            <div class="text-center mt-5">
                                <button type="submit" id="btnEliminarPerfilUsuario" name="accion" value="eliminar" class="btn btn-danger">
                                    Inactivar Cuenta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>
</body>

</html>