<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#57d6a1" />
    <meta name="msapplication-navbutton-color" content="#57d6a1" />
    <meta name="apple-mobie-web-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#57d6a1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="57x57" href="Vistas/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="Vistas/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="Vistas/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="Vistas/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="Vistas/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="Vistas/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="Vistas/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="Vistas/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="Vistas/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="Vistas/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Vistas/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="Vistas/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Vistas/img/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>JUAMA - ADMINISTRACIÓN </title>
    <link rel="stylesheet" href="Vistas/css/style.css" />
    <script src="Vistas/js/script.js"></script>
    <!-- <script src='https://www.google.com/recaptcha/api.js' async defer></script> -->
</head>
<body>
<!-- |||| CONTENEDOR GRID PARA LA PAGINA COMPLETA |||| -->
<div id="cuadrilla" class="grid">
    <?php
        $modulo = new Controladores\EnlacesControlador();
        $modulo->enlacesControlador();
    ?>
    <!-- ======== 05 PIE DE PAGINA ======== -->
    <?php include 'modulos/piepagina.php'; ?>
</div>
<!-- ======== 06 ESTRUCTURA FINAL ======== -->
<?php include 'modulos/piefin.php'; ?> 