<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
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
            <div class="container-fluid perfil-container">
                <h2 class="perfil-title text-center mb-4">⚙️ Actualizar Perfil</h2>

                <div class="perfil-card">
                    <div class="perfil-card-body">
                        <form action="" method="POST" class="perfil-form animate-form">

                            <?php
                            if (isset($_POST['txtMensaje']))
                                echo '<div class="alert alert-warning text-center animate-fade">' . $_POST['txtMensaje'] . '</div>';
                            ?>

                            <div class="mb-3">
                                <label for="txtIdentificacion" class="form-label">Identificación</label>
                                <input type="text" class="form-control perfil-input" id="txtIdentificacion" name="txtIdentificacion" required
                                    value="<?php echo $resultado['Identificacion'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="txtNombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control perfil-input" id="txtNombre" name="txtNombre" required
                                    value="<?php echo $resultado['Nombre'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="txtCorreo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control perfil-input" id="txtCorreo" name="txtCorreo" required
                                    value="<?php echo $resultado['Correo'] ?>">
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" id="btnActualizarPerfilUsuario" name="btnActualizarPerfilUsuario" class="btn perfil-btn">
                                    💾 Guardar cambios
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