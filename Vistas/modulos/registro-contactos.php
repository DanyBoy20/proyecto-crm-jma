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
                    Registro contactos hospital
                </h3>
            </div>
        </div>
    </div>
    <!-- CONTENEDOR PRINCIPAL VENTANA -->
    <div class="principal1">
        <form id="formRegistroContacto" method="POST" enctype='multipart/form-data'>
            <section class="division_secciones">
                <div class="contenedor_izq_der">
                    <!-- INICIO IZQUIERDA -->
                    
                <div class="caja__izq">

                    <div class="elemento_individual_form">
                        <label for="hospital"><div class="dato_obligatorio"></div>Hospital:</label>
                        <input type="text" name="hospital" id="hospital" list="listahospital" class="contactoForm_elemento-dimension" placeholder="Nombre" required />
                        <datalist id="listahospital">
                        </datalist>
                        <span id="avisoError" class="avisoError"></span>
                    </div>
                
                </div> 

                <!-- FIN IZQUIERDA -->

                <!-- INICIO DERECHA-->

                <div class="caja__der">
                <fieldset id="seccion__izquierda" class="seccion__izquierda">
                        
                        <div class="contenedor_elementos_fieldset">
                            <div class="elemento_individual_form">
                                <label for="titulo"><div class="dato_obligatorio"></div>Titulo</label>
                                <select class="contactoForm_elemento-dimension" name="titulo" id="titulo" required>
                                    <option value="undefined" disabled selected hidden>Seleccione rol</option>
                                    <option value="Lic.">Licenciado</option>
                                    <option value="Dr.">Doctor</option>
                                    <option value="Q.M.">Químico</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="nombre"><div class="dato_obligatorio"></div>Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escriba el/los nombres" class="contactoForm_elemento-dimension" minlength="4" maxlength="35" required /><span class="avisoError"></span>                            
                            </div>
                            <div class="elemento_individual_form">
                                <label for="apellidop"><div class="dato_obligatorio"></div>Apellido Paterno</label></span>
                                <input type="text" id="apellidop" name="apellidop" placeholder="Ingrese solo letras" class="contactoForm_elemento-dimension" minlength="4" maxlength="35" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="apellidom"><div class="dato_obligatorio"></div>Apellido Materno</label>
                                <input type="text" id="apellidom" name="apellidom" placeholder="Ingrese solo letras" class="contactoForm_elemento-dimension" minlength="3" maxlength="35" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="cargo"><div class="dato_obligatorio"></div>Cargo</label>
                                <select class="contactoForm_elemento-dimension" name="cargo" id="cargo" required>
                                    <option value="undefined" disabled selected hidden>Seleccionar cargo</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="telefono"><div class="dato_obligatorio"></div>Número de teléfono</label>
                                <input type="tel" id="telefono" name="telefono" placeholder="Teléfono con clave de larga distancia" class="contactoForm_elemento-dimension" minlength="10" maxlength="12" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="celular"><div class="dato_obligatorio"></div>Número de celular</label>
                                <input type="tel" id="celular" name="celular" placeholder="10 dígitos" class="contactoForm_elemento-dimension" minlength="10" maxlength="10" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="email"><div class="dato_obligatorio"></div>Correo electrónico</label>
                                <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" class="contactoForm_elemento-dimension" minlength="10" maxlength="50" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form_self3">
                                <label for="area"><div class="dato_obligatorio"></div>Area asignada</label>
                                <select class="contactoForm_elemento-dimension" name="area" id="area" required>
                                    <option value="undefined" disabled selected hidden>Seleccionar</option>
                                </select><span id="avisoError" class="avisoError"></span>
                            </div>

                            <div class="elemento_individual_form_self">
                                <input type="hidden" id="idhospital" name="idhospital">
                                <button class="btnGris1" id="validarIngreso">GUARDAR<i class="icono_contenidos iconoGuardar"></i></button>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <!-- FIN DERECHA -->

                </div>
            </section>
        </form>
    </div>
</main>
<script src="Vistas/js/registrarContacto.js" type="module"></script>
<script src="Vistas/js/apiFetchContacto.js" type="module"></script>