<?php
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
                Lista de usuarios empleados
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
                <h2>Buscar</h2>
                <div class="elemento_individual_form">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre, apellidos" class="contactoForm_elemento-dimension" minlength="4" maxlength="35" required />
                </div>
            </div>

            <!-- FIN IZQUIERDA -->

            <!-- INICIO DERECHA -->
            <div class="caja__der">
                <div id="contenedor_lista_empleados" class="contenedor__tablas">
                    <div class="tabla__contenidos" tabindex="0">
                        <table class="tabla__general">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha Registro</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="fila_empleado">                    
                            <?php
                                $modulo = new Controladores\EmpleadosControlador();
                                $modulo->consultar();
                            ?>
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
<script src="Vistas/js/apiFetchEmpleados.js" type="module"></script>