<?php

namespace Servicios;

use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class HospitalesServicios {

    public $errores = [];
    public $nombre;
    public $telefono;
    public $claveacceso;
    public $claveacceso2;
    public $direccion;
    public $estado;
    public $ciudad;
    public $cp;
    public $colonia;
    public $tipohospital;

    // ********* PARA MOSTRAR EN: expedientes
    static function tablaMostrarListaHospitales(array $resultados, int $contador){
        if (!empty($resultados)) {
            /* echo ""; */
            foreach ($resultados as $hospital) {
                /* idhospital, nombreh, tipo, estadoh, municipioh */
                echo '<tr>
                    <td class="celda__contenido">' . $hospital["nombreh"] . '</td>
                    <td class="celda__contenido">' . $hospital["tipo"] . '</td>
                    <td class="celda__contenido">' . $hospital["estadoh"] . '</td>
                    <td class="celda__contenido">' . $hospital["municipioh"] . '</td>
                    <td class="celda__contenido">
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="expediente-hospital">
                        <input type="hidden" name="idhospital" value="' . $hospital["idhospital"] . '">
                        <input type="hidden" name="estado" value="' . $hospital["estado"] . '">
                        <input class="btnVerde5" type="submit" value="Ver">
                    </form>
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="">
                        <input type="hidden" name="correoeditar" value="' . $hospital["idhospital"] . '">
                        <input class="btnAzul" type="submit" value="Editar">
                    </form>
                    </td>                 
                </tr>';
            }
        } else {
            echo '<tr>
                    <td colspan="5" class="celda__contenido">Por el momento no podemos realizar su consulta, intente mas tarde</td>                 
                </tr>';
        }
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    static function mostrarHospital(array $hospital, array $contactos, array $equipos, array $demos, array $capacitaciones){
        echo "
            <div class='contenedor__secciones_titulos'>
                <div class='seccion__titulo color_titulo_seccion'>
                    <div class='contenedor__seccion__descripcion'>
                        <h3 class='contenedor__seccion__titulo texto-normal'>" . $hospital[0]['nombreh'] . " ( " . $hospital[0]['tipo'] . " )
                        </h3>
                    </div>
                </div>
            </div>
            <div class='principal1'>
                <section class='division_secciones'>
                    <div class='contenedor_izq_der'>
                        <div class='caja__izq_perfil'>
                            <div class='datos'>
                                <h2 class='elemento_individual_form_self2'>Estudios por día:</h2>
                                <p id='tel' class='usuario_valor'>100</p>
                                <h2 class='elemento_individual_form_self2'>Consumibles por día:</h2>
                                <p id='celu' class='usuario_valor'>25</p>
                            </div>
                        </div>
                        <div class='caja__der'>
                            <div id='seccion__izquierda' class='seccion__izquierda'>
                                <div class='contenedor_elementos_fieldset'>
                                    <div class='elemento_individual_form'>
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self2'>&nbsp;Dirección</h2>
                                        <p for='email'>" . $hospital[0]['direccionh'] . "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self2'>&nbsp;Ciudad</h2>
                                        <p for='email'>" . $hospital[0]['municipioh'] . "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self2'>&nbsp;Estado</h2>
                                        <p for='email'>" . $hospital[0]['estadoh'] . "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self2'>&nbsp;Colonia / C.P.</h2>
                                        <p for='email'>" . $hospital[0]['coloniah'] . ", " . $hospital[0]['cp'] .  "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self2'>&nbsp;Telefono</h2>
                                        <p for='email'>" . $hospital[0]['telefonoh'] . "</p>
                                    </div>
                                    <div class='elemento_individual_form'>                            
                                        <h2 id='email' name='email' class='fondot elemento_individual_form_self2'>&nbsp;Fecha Registro</h2>
                                        <p for='email'>" . $hospital[0]['fecharegistroh'] . "</p>
                                    </div>                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            ";

            /* TABLA CONTACTOS */
            echo "
            <div class='seccion__derecha'>
                <!-- Barra titulo | Link | Icono -->
                <div class='tarjeta__cabecera'>
                    <div class='tarjeta__cabecera-titulo texto-normal'>
                        Contactos
                    </div>
                </div>
                <!-- Contenido -->
                <div class='tarjeta'>
                    <div class='tabla__contenidos' tabindex='0'>
                        <table class='tabla__general'>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Area</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>";

                            if (empty($contactos)) {
                                echo "
                                <tr>
                                    <td colspan='6' class='celda__contenido'>Aun no a asignado registros al hospital</td>
                                </tr>";
                            }else{
                                foreach ($contactos as $contacto) {
                                    echo "
                                    <tr>
                                        <td class='celda__contenido'>" . $contacto['titulo'] . " " . $contacto['hnombre'] . " " . $contacto['hapellidop'] . " " . $contacto['hapellidom'] . "</td>
                                        <td class='celda__contenido'>" . $contacto['descripcioncargo'] . "</td>
                                        <td class='celda__contenido'>" . $contacto['descripcionarea'] . "</td>
                                        <td class='celda__contenido'>" . $contacto['hcorreoc'] . "</td>
                                        <td class='celda__contenido'>" . $contacto['telc'] . "</td>
                                        <td class='celda__contenido'><a href='tel:527773884289' class='btnAzul'><i class='icono__subtitulos iconoTelefono'></i></a><a href='mailto:receptor@correo.com?cc=copia@correo.com&subject=Buen%20día&body=Escribir Mensaje' class='btnVerde5'><i class='icono__subtitulos iconoEnviarEmail'></i></a></td>
                                    </tr>
                                ";
                                }                                
                            }

                            echo "  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ";

            /* TABLA PRODUCTOS INSTALADOS*/
            echo "
            <div class='seccion__derecha'>
                <!-- Barra titulo | Link | Icono -->
                <div class='tarjeta__cabecera'>
                    <div class='tarjeta__cabecera-titulo texto-normal'>
                        Instalaciones
                    </div>
                </div>
                <!-- Contenido -->
                <div class='tarjeta'>
                    <div class='tabla__contenidos' tabindex='0'>
                        <table class='tabla__general'>
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>No. Serie</th>
                                    <th>Area</th>
                                    <th>Solicitud</th>
                                    <th>Instalado</th>
                                    <th>Progreso</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if (empty($equipos)) {
                                echo "
                                <tr>
                                    <td colspan='7' class='celda__contenido'>Sin equipos instalados</td>
                                </tr>";
                            }else{
                                foreach ($equipos as $equipo) { 
                                /*ORIGINAL DEBAJO DE FECHAINSTALADO <td class='celda__contenido'>" . $equipo['estado'] . "</td> */                                   
                                echo "
                                    <tr>
                                        <td class='celda__contenido'>" . $equipo['pdescripcion'] . "</td>
                                        <td class='celda__contenido'>" . $equipo['numeroserie'] . "</td>
                                        <td class='celda__contenido'>" . $equipo['descripcionarea'] . "</td>
                                        <td class='celda__contenido'>" . $equipo['fechasol'] . "</td>
                                        <td class='celda__contenido'>" . $equipo['fechainstalado'] . "</td>
                                        <td class='celda__contenido'><p class='txtbarra'>&nbsp;&nbsp;" . $equipo['barra'] . "%</p><progress max='100' value='" . $equipo['barra'] . "'></progress></td>           
                                        <td class='celda__contenido'><a href='#' class='btnAzul'>Ver</a><a href='#' class='btnVerde5'>Editar</a></td>
                                    </tr>
                                ";
                                }
                            }
                            echo "  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ";

            /* TABLA DEMOSTRACIONES*/
            echo "
            <div class='seccion__derecha'>
                <!-- Barra titulo | Link | Icono -->
                <div class='tarjeta__cabecera'>
                    <div class='tarjeta__cabecera-titulo texto-normal'>
                        Soliciudes demostración
                    </div>
                </div>
                <!-- Contenido -->
                <div class='tarjeta'>
                    <div class='tabla__contenidos' tabindex='0'>
                        <table class='tabla__general'>
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Producto</th>
                                        <th>Solicitante</th>
                                        <th>Cargo</th>
                                        <th>Area</th>
                                        <th>Solicitud</th>
                                        <th>Progreso</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                if (empty($demos)) {
                                    echo "
                                    <tr>
                                        <td colspan='8' class='celda__contenido'>No hay solicitudes de demostración pendientes</td>
                                    </tr>";
                                }else{
                                    $contador = 0;
                                    foreach ($demos as $demostraciones) {
                                    /*ORIGINAL DEBAJO DE FECHAINSTALADO <td class='celda__contenido'>" . $demostraciones['estado'] . "</td> */
                                        echo "
                                            <tr>
                                                <td class='celda__contenido'>" . $demostraciones['descripcion'] . "</td>
                                                <td class='celda__contenido'>" . $demostraciones['pdescripcion'] . "</td>
                                                <td class='celda__contenido'>" . $demostraciones['titulo'] . " " . $demostraciones['hnombre'] . " " . $demostraciones['hapellidop'] . " " . $demostraciones['hapellidom'] . "</td>
                                                <td class='celda__contenido'>" . $demostraciones['descripcioncargo'] . "</td>
                                                <td class='celda__contenido'>" . $demostraciones['descripcionarea'] . "</td>
                                                <td class='celda__contenido'>" . $demostraciones['fechasolicitud'] . "</td>
                                                <td class='celda__contenido'><p class='txtbarra'>&nbsp;&nbsp;" . $demostraciones['barra'] . "%</p><progress max='100' value='" . $demostraciones['barra'] . "'></progress></td>
                                                <td class='celda__contenido'>
                                            <form class='formeliminar' name='form" . ++$contador . "' method='post' action='demostracion'>
                                                <input type='hidden' name='iddemostracion' value='" . $demostraciones["iddemostracion"] . "'>
                                                <input class='btnAzul' type='submit' value='Ver'>
                                            </form>                                        
                                        </td>
                                            </tr>
                                        ";
                                        }
                                }

                                echo "  
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ";

            /* TABLA CAPACITACIONES */
            echo "
            <div class='seccion__derecha'>
                <!-- Barra titulo | Link | Icono -->
                <div class='tarjeta__cabecera'>
                    <div class='tarjeta__cabecera-titulo texto-normal'>
                        Capacitaciones
                    </div>
                </div>
                <!-- Contenido -->
                <div class='tarjeta'>
                    <div class='tabla__contenidos' tabindex='0'>
                        <table class='tabla__general'>
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Solicitante</th>
                                    <th>Cargo</th>
                                    <th>Producto</th>
                                    <th>Solicitud</th>
                                    <th>Progreso</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>";

                            if (empty($capacitaciones)) {
                                /*ORIGINAL DEBAJO DE FECHAINSTALADO <td class='celda__contenido'>" . $capacitacion['estado'] . "</td> */
                                echo "
                                <tr>
                                    <td colspan='8' class='celda__contenido'>Aun no a asignado registros al hospital</td>
                                </tr>";
                            }else{
                                $contador = 0;
                                foreach ($capacitaciones as $capacitacion) {
                                    echo "
                                    <tr>
                                        <td class='celda__contenido'>" . $capacitacion['descripcion'] . "</td>
                                        <td class='celda__contenido'>" . $capacitacion['titulo'] . " " . $capacitacion['hnombre'] . " " . $capacitacion['hapellidop'] . "</td>
                                        <td class='celda__contenido'>" . $capacitacion['descripcioncargo'] . "</td>
                                        <td class='celda__contenido'>" . $capacitacion['pdescripcion'] . "</td>
                                        <td class='celda__contenido'>" . $capacitacion['fechasolicitudc'] . "</td>
                                        <td class='celda__contenido'><p class='txtbarra'>&nbsp;&nbsp;" . $capacitacion['barra'] . "%</p><progress max='100' value='" . $capacitacion['barra'] . "'></progress></td>
                                        <td class='celda__contenido'>
                                            <form class='formeliminar' name='form" . ++$contador . "' method='post'>
                                                <input type='hidden' name='idcapacitacion' value=''>
                                                <input class='btnAzul' type='submit' value='Ver'>
                                            </form>                                        
                                        </td>
                                    </tr>
                                ";
                                }                                
                            }

                            echo "  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ";
    }


    static function tablaEditarEmpleados(array $resultados){
        if (!empty($resultados)) {
            foreach ($resultados as $empleado) {
                echo "
                <form id='formEditarEmpleado' method='POST' enctype='multipart/form-data' class='caja__der'>
                    <fieldset id='seccion__izquierda' class='seccion__izquierda'>
                        <p class='titulo__fieldset'>Datos personales</p>
                        <div class='contenedor_elementos_fieldset'>
                            <div class='elemento_individual_form'>
                                <label for='nombre'>Nombre</label>
                                <input type='text' id='nombre' name='nombre' class='contactoForm_elemento-dimension sololectura' readonly='readonly' value=" . $empleado['nombre'] . "  tabindex='-1' />
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='apellidop'>Apellido Paterno</label>
                                <input type='text' id='apellidop' name='apellidop' class='contactoForm_elemento-dimension sololectura'  readonly='readonly' value=" . $empleado['apellidopaterno'] . "  tabindex='-1' />
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='apellidom'>Apellido Materno</label>
                                <input type='text' id='apellidom' name='apellidom' class='contactoForm_elemento-dimension sololectura'  readonly='readonly' value=" . $empleado['apellidomaterno'] . "  tabindex='-1' />
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='email'>Correo electrónico</label>
                                <input type='email' id='email' name='email' class='contactoForm_elemento-dimension sololectura' readonly='readonly' value=" . $empleado['correo'] . "  tabindex='-1' />
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='celular'>Número de teléfono celular</label>
                                <input type='tel' id='celular' name='celular' placeholder='10 dígitos' class='contactoForm_elemento-dimension' minlength='10' maxlength='10' value=" . $empleado['numeromovil'] . " /><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='telefono'>Número de teléfono residencial</label>
                                <input type='tel' id='telefono' name='telefono' placeholder='Telefono con clave de larga distancia' class='contactoForm_elemento-dimension' minlength='10' maxlength='12' value=" . $empleado['numerotelefono'] . " /><span class='avisoError'></span>
                            </div>                                        
                            <div class='elemento_individual_form'>
                                <label for='archivo'>Foto</label>
                                <input type='file' name='archivo' id='archivo' accept='.jpg, .jpeg, .png'>
                                <div id='zona_arrastre' class='zona_arrastre'>
                                    <i class='icono_contenidos2 iconoSubirArchivo'></i>
                                    <p>
                                        Arrastre aqui su archivo<br>o presione el botón 'Examinar'.
                                    </p>
                                </div>
                            </div>
                            <div class='elemento_individual_form_self'>
                                <a id='siguiente' href='#' class='boton__cambio btnVerde'>SIGUIENTE<i class='icono_contenidos iconoSiguiente'></i></a>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id='seccion__derecha' class='seccion__derecha ocultar'>
                        <p class='titulo__fieldset'>Direccion</p>
                        <div class='contenedor_elementos_fieldset'>
                            <div class='elemento_individual_form'>
                                <label for='direccion'>Calle y número</label>
                                <input type='text' id='direccion' name='direccion' class='contactoForm_elemento-dimension' maxlength='70' value=" . $empleado['direccion'] . " /><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='estado'>Estado</label>
                                <select class='contactoForm_elemento-dimension' name='estado' id='estado' required>
                                    <option value='" . $empleado['estado'] . "' selected>" . $empleado['estado'] . "</option>
                                </select><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='ciudad'>Ciudad</label>
                                <select class='contactoForm_elemento-dimension' name='ciudad' id='ciudad' required>
                                    <option value='" . $empleado['ciudad'] . "' selected>" . $empleado['ciudad'] . "</option>
                                </select><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='cp'>Código postal</label>
                                <select class='contactoForm_elemento-dimension' name='cp' id='cp' required>
                                    <option value='" . $empleado['codigopostal'] . "' selected>" . $empleado['codigopostal'] . "</option>
                                </select><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='colonia'>Colonia</label>
                                <select class='contactoForm_elemento-dimension' name='colonia' id='colonia' required>
                                    <option value='" . $empleado['colonia'] . "' selected>" . $empleado['colonia'] . "</option>
                                </select><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='rol'>Asignar rol</label>
                                <select class='contactoForm_elemento-dimension' name='rol' id='rol' required>
                                    <option value='" . $empleado['rolid'] . "' selected>" . $empleado['descripcionE'] . "</option>
                                    <option value='2'>Administrador</option>
                                    <option value='3'>Ventas</option>
                                    <option value='4'>Atencion al cliente</option>
                                </select><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form'>
                                <label for='condicion'>Estado actual:</label>
                                <select class='contactoForm_elemento-dimension' name='condicion' id='status' required>
                                    <option value='" . $empleado['condicion'] . "' selected>" . $empleado['condicion'] . "</option>
                                    <option value='activo'>activo</option>
                                    <option value='inactivo'>inactivo</option>
                                </select><span class='avisoError'></span>
                            </div>
                            <div class='elemento_individual_form_self2'>
                                <a id='anterior' href='#' class='boton__cambio btnVerde'><i class='icono_contenidos2 iconoAnterior'></i>ANTERIOR</a>
                            </div>
                            <div class='elemento_individual_form_self2'>
                                <button class='btnVerde4' id='validarIngreso'>GUARDAR<i class='icono_contenidos iconoGuardar'></i></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            ";
            }
        } else {
            echo '<tr>
                    <td colspan="5" class="celda__contenido">Por el momento no podemos realizar su consulta, intente mas tarde</td>                 
                </tr>';
        }
    }

    
    public function validarContrasenia(string $contrasenia1, string $contrasenia2): array {
        $this->claveacceso = $contrasenia1;
        $this->claveacceso2 = $contrasenia2;

        if (trim($this->claveacceso) == '') {
            $this->errores[] = '\nDebe ingresar una contraseña';
        }
        if (preg_match('/^(?=.{8,8}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/', $this->claveacceso) == 0) {
            $this->errores[] = '\nLa contraseña debe tener 8 caracteres, al menos una letra mayuscula, una minuscula, un simbolo y un numero';
        }
        if (trim($this->claveacceso2) == '') {
            $this->errores[] = '\nDebe ingresar una contraseña';
        }
        if (preg_match('/^(?=.{8,8}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/', $this->claveacceso2) == 0) {
            $this->errores[] = '\nLa contraseña debe tener 8 caracteres, al menos una letra mayuscula, una minuscula, un simbolo y un numero';
        }
        if ($this->claveacceso != $this->claveacceso2) {
            $this->errores[] = '\nLas contraseñas no coinciden';
        }
        return $this->errores;
    }

    // ********* PARA MOSTRAR EN: registro-hospital
    public function validarDatosHospital(array $datosPOST){
        /*
        ("nombre") ("tipohospital") ("telefono") ("direccion") ("estado") ("ciudad") ("cp") ("colonia");
        */  
        $this->nombre = $datosPOST['nombre'];
        $this->tipohospital = $datosPOST['tipohospital'];
        $this->telefono = $datosPOST['telefono'];
        $this->direccion = $datosPOST['direccion'];
        $this->estado = $datosPOST['estado'];
        $this->ciudad = $datosPOST['ciudad'];
        $this->cp = $datosPOST['cp'];
        $this->colonia = $datosPOST['colonia'];


        
        #NOMBRE
        if (trim($this->nombre) == '') {
            $this->errores[] = '\nEl nombre es requerido';
        }
        if (preg_match('/^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->nombre) == 0) {
            $this->errores[] = '\nSolo letras en el campo nombre';
        }
        if (strlen($this->nombre) < 3 || strlen($this->nombre) > 35) {
            $this->errores[] = '\nLongitud de nombre mas de 3 letras';
        }
        #TIPO HOSPITAL
        if (trim($this->tipohospital) == '' || $this->tipohospital == 'undefined') {
            $this->errores[] = '\nEl rol es requerido';
        }
        if (preg_match('/^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->tipohospital) == 0) {
            $this->errores[] = '\nElija un rol';
        }
        #NUMERO TELEFONO 
        if (trim($this->telefono) == '') {
            $this->errores[] = '\nEl telefono es requerido';
        }
        if (preg_match('/^[0-9\-\(\)\/\+\s]*$/im', $this->telefono) == 0) {
            $this->errores[] = '\nEl formato para el campo telefono es invalido';
        }
        if (strlen($this->telefono) < 7 || strlen($this->telefono) > 10) {
            $this->errores[] = '\nCampo telefono debe contener 10 numeros';
        }
        #DIRECCION
        if (trim($this->direccion) == '') {
            $this->errores[] = '\nLa direccion es requerida';
        }
        if (preg_match('/^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->direccion) == 0) {
            $this->errores[] = '\nSolo letras y numeros en el campo direccion';
        }
        if (strlen($this->direccion) < 7 || strlen($this->direccion) > 70) {
            $this->errores[] = '\nLongitud de direccion mas de 7 letras';
        }
        #ESTADO
        if (trim($this->estado) == '' || $this->estado == 'undefined') {
            $this->errores[] = '\nEl estado es requerido';
        }
        if (preg_match('/^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->estado) == 0) {
            $this->errores[] = '\nSolo letras en el campo estado';
        }
        if (strlen($this->estado) < 5 || strlen($this->estado) > 60) {
            $this->errores[] = '\nLongitud de estado mas de 3 letras';
        }
        #CIUDAD
        if (trim($this->ciudad) == '' || $this->ciudad == 'undefined') {
            $this->errores[] = '\nLa ciudad es requerido';
        }
        if (preg_match('/^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->ciudad) == 0) {
            $this->errores[] = '\nSolo letras en el campo ciudad';
        }
        if (strlen($this->ciudad) < 4 || strlen($this->ciudad) > 90) {
            $this->errores[] = '\nLongitud de ciudad mas de 4 letras';
        }
        #CODIGO POSTAL
        if (trim($this->cp) == '' || $this->cp == 'undefined') {
            $this->errores[] = '\nEl codigo postal es requerido';
        }
        if (preg_match('/^[0-9\-\(\)\/\+\s]*$/im', $this->cp) == 0) {
            $this->errores[] = '\nSolo numeros en el campo codigo postal';
        }
        if (strlen($this->cp) < 5) {
            $this->errores[] = '\nCampo codigo postal debe contener 5 numeros';
        }
        #COLONIA
        if (trim($this->colonia) == '' || $this->colonia == 'undefined') {
            $this->errores[] = '\nLa ciudad es requerida';
        }
        /* CAMBIAR REGEX PARA QUE ACEPTE LETRAS, NUMEROS Y SIMBOLOS */
        if (preg_match('/^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,\d\(\)\-]+$/im', $this->colonia) == 0) {
            $this->errores[] = '\nSolo letras en el campo colonia';
        }
        if (strlen($this->colonia) < 4 || strlen($this->colonia) > 90) {
            $this->errores[] = '\nLongitud de colonia mas de 4 letras';
        }
        
    }
    
    static function crearContrasenia(int $longitud) : string {
        /* Arreglos con todos los caracteres validos */
            $minusculas = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
            $mayusculas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $simbolos = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}');
            $numeros = array('0','1','2','3','4','5','6','7','8','9');
            $arregloCompleto = array($minusculas, $mayusculas, $simbolos, $numeros); 
            /* contrasenia contendra inicialmente 4 caracteres: una minuscula, una mayuscula, un simbolo y un numero */
            $contrasenia = $minusculas[array_rand($minusculas, 1)];
            $contrasenia = $contrasenia . $mayusculas[array_rand($mayusculas, 1)];
            $contrasenia = $contrasenia . $simbolos[array_rand($simbolos, 1)];
            $contrasenia = $contrasenia . $numeros[array_rand($numeros, 1)];   
            /* strlen nos dara la longitud de i (contraseña = 4), max nos da el numero de dos valores (sera la condicion), incrementamos i  */
            for($i = strlen($contrasenia); $i < max(8, $longitud); $i++){
                // obtenemos una clave aleatoria del arreglo completo con array_rand($arregloCompleto, 1)
                $temporal = $arregloCompleto[array_rand($arregloCompleto, 1)];
                // la unimos a nuestra contraseña actual de 4 caracteres
                $contrasenia = $contrasenia . $temporal[array_rand($temporal, 1)];
            }
            /* regresamos la cadena desordenada */
            return str_shuffle($contrasenia);
    }

    
    public function validarCorreoPost($correo){
        $this->email = $correo;
        #EMAIL
        if (trim($this->email) == '') {
            $this->errores[] = '\nEl campo email es requerido';
        }  
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errores[] = '\nEmail invalido';
        }
        if (strlen($this->email) < 10 || strlen($this->email) > 50) {
            $this->errores[] = '\nLa longitud de caracteres de su correo debe ser mayor de 10 caracteres';
        }    
    }

    
    public function enviarCorreo(string $correoelectronico){
        $para = $correoelectronico;
        $as = 'Cuenta de empleado creada';
        $saltolinea = "\r\n";
        $mensaje = 'DATOS DE LA CUENTA CREADA: '. $saltolinea . '' . $this->nombre . $saltolinea . '' . $this->email . $saltolinea . '' . $this->claveacceso;
        $encabezados = 'From: ' . $correoelectronico;
        try {
            mail($para,$as,$mensaje,$encabezados);
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            echo '<script type="text/javascript">alert("OCURRIÓ UN PROBLEMA AL ENVIAR LOS DATOS POR CORREO ELECTRÓNICO");</script>';
        }

    }

    /* public function validarEmpleadoGet(){
        $this->email = $_GET['verEmpleado'];
        #EMAIL
        if (trim($this->email) == '') {
            $this->errores[] = '\nEl campo email es requerido';
        }  
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errores[] = '\nEmail invalido';
        }
        if (strlen($this->email) < 10 || strlen($this->email) > 50) {
            $this->errores[] = '\nLa longitud de caracteres de su correo debe ser mayor de 10 caracteres';
        }   

    } */


}
