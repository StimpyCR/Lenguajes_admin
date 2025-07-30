<?php
    // Importamos Modelos
    require_once __DIR__.'/../Models/LoginModel.php';
    
    $correo = $_POST["txtCorreo"];
    $contrasena = $_POST["txtContrasenna"];
    
    $login = new Login();
    
    if ($login->validarCredenciales($correo, $contrasena)) {
        header("Location: ../Views/Home/principal.php");
    } else {
        // Redireccionamos y mandamos el error por GET
        header("Location: ../Views/Home/login.php?error=1");
    }
?>