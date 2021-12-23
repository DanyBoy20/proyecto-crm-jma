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
    <!-- TITULO VENTANA -->
    <div class="contenedor__secciones_titulos">
        <div class="seccion__titulo color_titulo_seccion">
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    SOLICITUD DE DEMOSTRACIÓN
                </h3>
            </div>
        </div>
    </div>
    <!-- CONTENEDOR PRINCIPAL VENTANA -->
    <div class="principal1">
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <!-- INICIO IZQUIERDA -->
                <!-- 
              <div class="caja__izq">
                <h1>BARRA LATERAL PARA FUTUROS MODULOS / OPCIONES</h1>
              </div> 
              -->
                <!-- FIN IZQUIERDA -->
                <!-- INICIO DERECHA -->
                <?php
                $guardarUsuario = new Controladores\DemosControlador;
                $guardarUsuario->editar();
                ?>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/actualizarDemos.js" type="module"></script>
<script src="Vistas/js/apiFetchActualizarDemo.js" type="module"></script>