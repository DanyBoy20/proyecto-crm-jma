<?php
/* session_start(); */
if(!isset($_SESSION['validar'])){
    echo '<script>window.location.href="index"</script>';
    exit();
}
if(!$_SESSION['validar']){
    echo '<script>window.location.href="index"</script>';
    exit();
}
include 'Vistas/modulos/cabecera.php';
include 'Vistas/modulos/navegacion.php';
?> 
<main class="contenido">
<!-- Cabezera bienvenida -->
<div class="contenido-cabecera">
    <div class="contenido-cabecera__contenedor">
        <div class="contenido-cabecera__bienvenida">
            <div class="contenido-cabecera__bienvenida-subtitulo texto-normal">
            Hola <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidop'] ?>
            </div>
            <div class="contenido-cabecera__bienvenida-titulo texo-normal">
                <span>¿Qué deseas hacer hoy?</span>
            </div>            
        </div>
        <!-- <div class="vistarapida">
            <div class="vistarapida__item">
                <div class="vistarapida__item-total">100</div>
                <div class="vistarapida__item-descripcion">
                    <i class="icono iconoHospitales"></i>
                    <span class="texto-normal">Hospitales</span>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- ATAJOS TARJETAS (a secciones principales) -->
<?php 
$modulo = new Controladores\InicioControlador();
$modulo->ver($_SESSION['idrol']);                          
?>
</main>
