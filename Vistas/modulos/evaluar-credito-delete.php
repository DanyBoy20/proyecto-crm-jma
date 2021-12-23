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
                    Evaluación inicial
                </h3>
            </div>
        </div>
    </div>
    <!-- CONTENEDOR PRINCIPAL VENTANA -->
    <div class="principal1">
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <!-- INICIO IZQUIERDA -->

                <div class="caja__izq">
                    <!-- <h2>Evaluación para saber si cuenta con capacidad de credito.</h2> -->
                    <p class="titulo__fieldset">Capacidad de crédito</p>
                </div>

                <!-- FIN IZQUIERDA -->

                <!-- INICIO DERECHA -->
                <form class="caja__der">

                    <fieldset id="seccion__izquierda" class="seccion__izquierda">
                        <div class="contenedor_elementos_fieldset">

                            <div class="elemento_individual_form">
                                <label for="tipocliente">¿Eres jubilado o pensionado?</label>
                                <select class="contactoForm_elemento-dimension" name="tipocliente" id="tipocliente" required>
                                    <option value="" disabled selected hidden>Elija una opción</option>
                                    <option value="Pensionado">Pensionado</option>
                                    <option value="Jubilado">Jubilado</option>
                                </select>
                            </div>

                            <div id="contenedorpercepcion" class="elemento_individual_form ocultar">
                                <label for="percepcion">¿De cuánto es tu percepción?</label>
                                <input type="number" id="percepcion" name="percepcion" placeholder="4500" class="contactoForm_elemento-dimension" minlength="4500" required />
                            </div>

                            <div id="contenedorDescuentoJubilado" class="elemento_individual_form  ocultar">
                                <label for="descuentoJubilado">¿Tienes algún descuento por concepto 322 o 355?</label>
                                <select class="contactoForm_elemento-dimension" name="descuentoJubilado" id="descuentoJubilado" required>
                                    <option value="" disabled selected hidden>Elija una opción</option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div id="contenedorDescuentoPensionado" class="elemento_individual_form ocultar">
                                <label for="descuentoPensionado">¿Tienes algún descuento directo en nómina?</label>
                                <select class="contactoForm_elemento-dimension" name="descuentoPensionado" id="descuentoPensionado" required>
                                    <option value="" disabled selected hidden>Elija una opción</option>
                                    <option value="si">Si</option>
                                    <option value="No">no</option>
                                </select>
                            </div>

                            <div id="contenedorCantidadDescuentoPensionado" class="elemento_individual_form ocultar">
                                <label for="descuento">¿De cuánto es su descuento?</label>
                                <input type="number" id="descuento" name="descuento" placeholder="Solo numeros" class="contactoForm_elemento-dimension" minlength="4" maxlength="35" required />
                            </div>
                            
                        </div>
                    </fieldset>

                </form>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/evaluar.js" type="module"></script>