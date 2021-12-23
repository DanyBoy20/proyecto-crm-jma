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
$registroareahospital = new Controladores\AreasControlador;
$registroareahospital->guardarAreaHospital();
?>
<main class="contenido">
    <!-- TITULO VENTANA -->
    <div class="contenedor__secciones_titulos">
        <div class="seccion__titulo color_titulo_seccion">
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    Registro Areas Hospital
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
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <!-- INICIO IZQUIERDA -->

                <!-- <div class="caja__izq">
                    <p class="titulo__fieldset">Seleccione:</p>
                </div> -->

                <!-- FIN IZQUIERDA -->

                <!-- INICIO DERECHA -->
                <form id="formRegistroDemo" method="POST" enctype='multipart/form-data' class="caja__der">

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
                                <label for="area"><div class="dato_obligatorio"></div>Area:</label>
                                <input type="text"  name="area" id="area" list="lista" class="contactoForm_elemento-dimension" placeholder="Nombre del area" required />
                                <datalist id="lista">
                                </datalist>
                                <span id="avisoError" class="avisoError"></span>
                            </div>

                            <div class="elemento_individual_form_self">
                            <input type="hidden" id="idarea" name="idarea">
                            <input type="hidden" id="idhospital" name="idhospital">
                                <button class="btnGris1" id="validarIngreso">GUARDAR<i class="icono_contenidos iconoGuardar"></i></button>
                            </input>
                        </div>
                    </fieldset>

                </form>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/registrarAreaHospital.js" type="module"></script>
<script src="Vistas/js/apiFetchAreaHospital.js" type="module"></script>