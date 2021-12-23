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
/* $guardarUsuario = new Controladores\EmpleadosControlador;
$guardarUsuario->guardar(); */
?>
<main class="contenido">
    <!-- TITULO VENTANA -->
    <div class="contenedor__secciones_titulos">
        <div class="seccion__titulo color_titulo_seccion">
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    Registro de empleados
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
                <form id="formRegistroEmpleado" method="POST" enctype='multipart/form-data' class="caja__der">

                    <fieldset id="seccion__izquierda" class="seccion__izquierda">
                        <p class="titulo__fieldset">Datos personales</p>
                        <div class="contenedor_elementos_fieldset">
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
                                <label for="celular"><div class="dato_obligatorio"></div>Número de teléfono celular</label>
                                <input type="tel" id="celular" name="celular" placeholder="10 dígitos" class="contactoForm_elemento-dimension" minlength="10" maxlength="10" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="telefono"><div class="dato_obligatorio"></div>Número de teléfono residencial</label>
                                <input type="tel" id="telefono" name="telefono" placeholder="Teléfono con clave de larga distancia" class="contactoForm_elemento-dimension" minlength="10" maxlength="12" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="email"><div class="dato_obligatorio"></div>Correo electrónico</label>
                                <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" class="contactoForm_elemento-dimension" minlength="10" maxlength="50" required /><span class="avisoError"></span>
                            </div>

                            <div class="elemento_individual_form_self">
                                <a id="siguiente" href="#" class="boton__cambio btnGris1">SIGUIENTE<i class="icono_contenidos iconoSiguiente"></i></a>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset id="seccion__derecha" class="seccion__derecha ocultar">
                        <p class="titulo__fieldset">Dirección</p>
                        <div class="contenedor_elementos_fieldset">
                            <div class="elemento_individual_form">
                                <label for="direccion"><div class="dato_obligatorio"></div>Calle y número</label>
                                <input type="text" id="direccion" name="direccion" placeholder="Escriba la calle y número" class="contactoForm_elemento-dimension" minlength="10" maxlength="70" required /><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="estado"><div class="dato_obligatorio"></div>Estado</label>
                                <select class="contactoForm_elemento-dimension" name="estado" id="estado" required>
                                    <option value="undefined" disabled selected hidden>Seleccione una estado</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="ciudad"><div class="dato_obligatorio"></div>Ciudad</label>
                                <select class="contactoForm_elemento-dimension" name="ciudad" id="ciudad" required>
                                    <option value="undefined" disabled selected hidden>Seleccione una ciudad</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="cp"><div class="dato_obligatorio"></div>Código postal</label>
                                <select class="contactoForm_elemento-dimension" name="cp" id="cp" required>
                                    <option value="undefined" disabled selected hidden>Seleccione un código postal</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="colonia"><div class="dato_obligatorio"></div>Colonia</label>
                                <select class="contactoForm_elemento-dimension" name="colonia" id="colonia" required>
                                    <option value="undefined" disabled selected hidden>Seleccione una colonia</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <label for="rol"><div class="dato_obligatorio"></div>Asignar rol</label>
                                <select class="contactoForm_elemento-dimension" name="rol" id="rol" required>
                                    <option value="undefined" disabled selected hidden>Seleccione rol</option>
                                    <option value="2">Administrador</option>
                                    <option value="3">Ventas</option>
                                    <option value="4">Atención al cliente</option>
                                </select><span class="avisoError"></span>
                            </div>
                            <div class="elemento_individual_form">
                                <a id="anterior" href="#" class="boton__cambio btnGris1"><i class="icono_contenidos2 iconoAnterior"></i>ANTERIOR</a>
                            </div>
                            <div class="elemento_individual_form">
                                <button class="btnGris1" id="validarIngreso">GUARDAR<i class="icono_contenidos iconoGuardar"></i></button>
                            </div>
                        </div>
                    </fieldset>

                </form>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/apiUbicaciones.js" type="module"></script>
<script src="Vistas/js/registrarContacto.js" type="module"></script>
<script src="Vistas/js/forms.js"></script>