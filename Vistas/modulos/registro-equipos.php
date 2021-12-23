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
$guardarSolicitudDemo = new Controladores\TablasControlador;
$guardarSolicitudDemo->guardarEquipo();
?>
<main class="contenido">
    <!-- TITULO VENTANA -->
    <div class="contenedor__secciones_titulos">
        <div class="seccion__titulo color_titulo_seccion">
            <div class="contenedor__seccion__descripcion">
                <h3 class="contenedor__seccion__titulo texto-normal">
                    Registro de productos
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
                    <p class="titulo__fieldset"></p>
                </div> -->

                <!-- FIN IZQUIERDA -->

                <!-- INICIO DERECHA -->
                <form id="formRegistroProductos" method="POST" class="caja__der">

                <fieldset id="seccion__derecha" class="seccion__derecha">
                        <!-- <p class="titulo__fieldset">Area</p> -->
                        <div class="contenedor_elementos_fieldset">

                            <div class="elemento_individual_form">
                                <label for="categoria"><div class="dato_obligatorio"></div>Categoria:</label>
                                <select class="contactoForm_elemento-dimension" name="categoria" id="categoria" required>
                                    <option value="undefined" disabled selected hidden>Seleccionar categoria</option>
                                </select><span class="avisoError"></span>
                            </div>

                            <div class="elemento_individual_form">
                                <label for="marca"><div class="dato_obligatorio"></div>Marca:</label>
                                <select class="contactoForm_elemento-dimension" name="marca" id="marca" required>
                                    <option value="undefined" disabled selected hidden>Seleccionar marca</option>
                                </select><span class="avisoError"></span>
                            </div>

                            <div class="elemento_individual_form">
                                <label for="producto"><div class="dato_obligatorio"></div>Descripción:</label>
                                <input type="text" id="producto" name="producto" placeholder="Escriba el nombre del producto" class="contactoForm_elemento-dimension" minlength="10" maxlength="70" required /><span class="avisoError"></span>
                            </div>

                            <div class="elemento_individual_form">
                                <label for="modelo"><div class="dato_obligatorio"></div>Modelo:</label>
                                <input type="text" id="modelo" name="modelo" placeholder="Escriba el nombre del modelo" class="contactoForm_elemento-dimension" minlength="10" maxlength="70" required /><span class="avisoError"></span>
                            </div>


                            <div class="elemento_individual_form_self">
                                <button class="btnGris1" id="validarRegistro">GUARDAR<i class="icono_contenidos iconoGuardar"></i></button>
                            </div>
                        </div>
                    </fieldset>

                </form>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>

    <div class="principal1">        
        <section class="division_secciones">
            <div class="contenedor_izq_der">
                <!-- INICIO IZQUIERDA -->
                <!-- <div class="caja__izq">
                    <div class="elemento_individual_form">                          
                    </div> 
                </div> -->
                <!-- FIN IZQUIERDA -->
                <!-- INICIO DERECHA -->
                <div class="caja__der">
                    <div id="contenedor_lista_empleados" class="contenedor__tablas">
                        <div class="tabla__contenidos" tabindex="0">
                            <table class="tabla__general">
                                <thead>
                                    <tr>
                                        <th>CATEGORIA</th>
                                        <th>EQUIPO</th>
                                        <th>MODELO</th>
                                        <th>MARCA</th>
                                    </tr>
                                </thead>
                                <tbody id="fila_empleado">                    
                                    <!-- <tr>
                                        <td class="celda__contenido"></td>
                                        <td class="celda__contenido"></td>              
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- FIN DERECHA -->
            </div>
        </section>
    </div>
</main>
<script src="Vistas/js/registrarEquipos.js" type="module"></script>
<script src="Vistas/js/apiFetchRegistroEquipos.js" type="module"></script>