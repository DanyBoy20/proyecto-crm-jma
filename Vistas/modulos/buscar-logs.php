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
                    Buscar Log
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
                <h1>BARRA LATERAL PARA FUTUROS MODULOS/OPCIONES</h1>
              </div> 
              -->
                <!-- FIN IZQUIERDA -->
                <!-- INICIO DERECHA -->
                <form class="caja__der">

                    <fieldset id="seccion__izquierda" class="seccion__izquierda">
                        <div class="contenedor_elementos_fieldset">
                            <div class="elemento_individual_form">
                                <label for="direccion">Buscar por clave:</label>
                                <input type="text" id="direccion" name="direccion" placeholder="Números enteros" class="contactoForm_elemento-dimension" minlength="10" maxlength="26" required />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="seccion__derecha" class="seccion__derecha">
                        <div class="elemento_individual_form_self2">
                            <button class="btnVerde4" id="validarIngreso">BUSCAR<i class="icono_contenidos iconoBuscar"></i></button>
                        </div>
                    </fieldset>

                </form>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>
</main>