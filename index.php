<?php
    session_start();

    if (isset($_SESSION["usuario"])) {
        header("Location: Views/Home/principal.php");
        exit();
    } else {
        header("location: Views/Home/login.php");
        exit();
    }
?>