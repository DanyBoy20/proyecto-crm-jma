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
                ACCESO RESTRINGIDO
              </h3>
            </div>
          </div> 
        </div>
        <!-- CONTENEDOR PRINCIPAL VENTANA -->
        <div class="principal1">
          <section class="division_secciones">
            <div class="contenedor_izq_der">
              <!-- INICIO IZQUIERDA -->
              
              <div class="caja__izq_perfil">
                <div class="imagen_error">
                    <img class="imagen_perfil" src="Vistas/img/acceso-restringido.svg" alt="">
                </div>              
              </div>
             
              <!-- FIN IZQUIERDA -->
              <!-- INICIO DERECHA -->                
              <div class="caja__der">

                <div class="contenido-atajo">
          
                    <!-- Tarjeta Atajo -->
                    <div class="atajo">
                        <h2 class="mensaje_error_pagina">No tiene los permisos necesarios para acceder a este recurso.</h2>
                    </div>
          
                  </div>

              </div>
              <!-- FIN DERECHA -->              
            </div>
          </section>
        </div>

      </main>