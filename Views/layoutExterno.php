<?php

function AddCss()
{
    echo '
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | Kerat</title>

    <link href="/LENGUAJES_ADMIN/Views/Estilos/style.min.css" rel="stylesheet">

</head>';


    function AddJs()
    {
        echo '
    <script src="/LENGUAJES_ADMIN/Views/Funciones/jquery.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/popper.min.js"></script>
    <script src="/LENGUAJES_ADMIN/Views/Funciones/bootstrap.min.js"></script>';
    }
}
