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
$guardarSolicitudDemo = new Controladores\PolizasControlador;
$guardarSolicitudDemo->guardar();
?>
<main class="contenido">
    <!-- TITULO VENTANA -->
    <div class="contenedor__secciones_titulos">
        <div class="seccion__titulo color_titulo_seccion">
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    Registro de pólizas
                </h3>
            </div>
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    <?php
                        date_default_timezone_set('America/Mexico_City');
                        echo date("d/m/Y");
                    ?>
                </h3>
            </div>
        </div>
    </div>
    <!-- CONTENEDOR PRINCIPAL VENTANA -->
    <div class="principal1">
        <form id="formRegistroDemo" method="POST" class="caja__der">
            <section class="division_secciones">
                <div class="contenedor_izq_der">
                    <!-- INICIO IZQUIERDA -->

                    <div class="caja__izq">

                        <div class="elemento_individual_form">
                            <label for="tipopoliza"><div class="dato_obligatorio"></div>Tipo:</label>
                            <select class="contactoForm_elemento-dimension" name="tipopoliza" id="tipopoliza" required>
                                <option value="undefined" disabled selected hidden>Seleccione</option>
                            </select><span id="avisoError" class="avisoError"></span>
                        </div>

                        <br>&nbsp;<br>
                        <p>Todos los campos son obligatorios.</p>
                    </div>
                    
                    <!-- FIN IZQUIERDA -->

                    <!-- INICIO DERECHA -->
                    <div class="caja__der">

                        <fieldset id="seccion__derecha" class="seccion__derecha">
                            <!-- <p class="titulo__fieldset">Dirección</p> -->
                            <div class="contenedor_elementos_fieldset">
                                <div class="elemento_individual_form">
                                    <label for="hospital"><div class="dato_obligatorio"></div>Hospital:</label>
                                    <input type="text" name="hospital" id="hospital" list="listahospital" class="contactoForm_elemento-dimension" placeholder="Nombre del hospital" required />
                                    <datalist id="listahospital">
                                    </datalist>
                                    <span id="avisoError" class="avisoError"></span>
                                </div>
                                <div class="elemento_individual_form">
                                    <label for="solicitante"><div class="dato_obligatorio"></div>Solicitante:</label>
                                    <select class="contactoForm_elemento-dimension" name="solicitante" id="solicitante" required>
                                        <option value="undefined" disabled selected hidden>¿Quien solicita la demostración?</option>
                                    </select><span id="avisoError" class="avisoError"></span>
                                </div>                          
                                <div class="elemento_individual_form_self4">
                                    <label for="area"><div class="dato_obligatorio"></div>Area:</label>
                                    <select class="contactoForm_elemento-dimension" name="area" id="area" required>
                                        <option value="undefined" disabled selected hidden>Seleccionar</option>
                                    </select><span id="avisoError" class="avisoError"></span>
                                </div>
                                <div class="elemento_individual_form">
                                    <label for="mensaje"><div class="dato_obligatorio"></div>Observaciones:</label>
                                    <textarea class="contactoForm_elemento-dimension" name="mensaje" id="mensaje" cols="30" rows="50" minlength="10" maxlength="150" placeholder="Comentarios" required></textarea>
                                    <span id="avisoError" class="avisoError"></span>
                                </div>
                                <div class="elemento_individual_form_self4">
                                    <label for="producto"><div class="dato_obligatorio"></div>Producto:</label>
                                    <input type="text"  name="producto" id="producto" list="lista" class="contactoForm_elemento-dimension" placeholder="Nombre del producto" required />
                                    <datalist id="lista">
                                    </datalist>
                                    <span id="avisoError" class="avisoError"></span>
                                </div>
                                <div class="elemento_individual_form_self4">
                                    <label for="sn"><div class="dato_obligatorio"></div>Serie:</label>
                                    <input type="tel" id="sn" name="sn" placeholder="Escriba el numero de serie" class="contactoForm_elemento-dimension" minlength="10" maxlength="12" required /><span class="avisoError"></span>
                                </div>    
                                
                                <div class="elemento_individual_form_self">
                                <input type="hidden" id="idproducto" name="idproducto">
                                <input type="hidden" id="idhospital" name="idhospital">
                                    <button class="btnGris1" id="validarIngreso">GUARDAR<i class="icono_contenidos iconoGuardar"></i></button>
                                </input>
                            </div>
                        </fieldset>

                    </div>
                    <!-- FIN DERECHA -->
                    
                </div>
            </section>
        </form>
    </div>
</main>
<script src="Vistas/js/registrarPoliza.js" type="module"></script>
<script src="Vistas/js/apiFetchPolizas.js" type="module"></script>