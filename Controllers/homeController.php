<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Curso/Models/homeModel.php';


if (isset($_POST["btnIniciarSesion"])) {
    $correo = $_POST["txtCorreo"];
    $contrasenna = $_POST["txtContrasenna"];



    //Enviamos el nomnbre de usuario y la contrasenna al modelo

    $respuesta = ValidarInicioSesionModel($correo, $contrasenna);

    if ($respuesta != null && $respuesta->num_rows > 0) {


        header("location: ../../Views/Home/principal.php");
    } else {
        $_POST["txtMensaje"]  = "Su informacion no fue validada correctamente. ";
    }
}



//Registar
if (isset($_POST["btnRegistrarUsuario"])) {


    $nombre = $_POST["txtNombre"];
    $email = $_POST["txtCorreo"];
    $identificacion = $_POST["txtIdentificacion"];
    $contrasenna = $_POST["txtContrasenna"];

    if (strlen($contrasenna) <= 4) {
        $_POST["txtMensaje"]  = "Su informacion no fue registrada correctamente.!!!!! ";
        return;
    }


    //Enviamos el nomnbre de usuario y la contrasenna al modelo

    $respuesta = RegistrarUsuarioModel($nombre, $email, $nombreUsuario, $contrasenna);

    if ($respuesta) {


        header("location: ../../Views/Home/login.php");
    } else {
        $_POST["txtMensaje"]  = "Su informacion no fue registrada correctamente. ";
    }
}


//RecuperarAcceso
if (isset($_POST["btnRecuperarAcceso"])) {
    $correo = $_POST["txtCorreo"];

    $respuesta = ValidarCorreoModel($correo);


    if ($respuesta != null && $respuesta->num_rows > 0) {

        $datos = mysqli_fetch_array($respuesta);


        $contra = generarContrasenna();

        ActualizarContrasennaModel($datos["IdUsuario"] , $contra);





        $mensaje = "<html><body>  
        Estimado(a)" . $datos["Nombre"] . "<br><br>
        Se ha genarado el siguiente codigo de seguridad:" . $datos["Contrasenna"] . "<br>
        Recuerde realizar el cambio de contrasenna una vez que ingrese al siguiente sistema.  </body> </html>";

        //tomar los datos y enviar el correo electronico al usuario


        header("location: ../../Views/Home/login.php");
    } else {
        $_POST["txtMensaje"]  = "Su informacion no fue validada correctamente. ";
    }
}


function generarContrasenna($longitud = 8)
{
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    $contrasenna = '';

    for ($i = 0; $i < $longitud; $i++) {
        $indiceAleatorio = rand(0, strlen($caracteres) - 1);
        $contrasenna .= $caracteres[$indiceAleatorio];
    }

    return $contrasenna;
}
