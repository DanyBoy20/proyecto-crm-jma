<?php
namespace Servicios;
include ("Constantes.php");
use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class DemosServicios {

    public $errores = [];
    public $tipodemo; 
    public $producto; 
    public $hospital; 
    public $solicitante; 
    public $mensaje; 
    public $idproducto; 
    public $idhospital;

    private $soloNumeros = SOLO_NUMEROS;
    private $soloLetrasNumeros = SOLO_LETRAS_NUMEROS;

    // ********* PARA MOSTRAR EN: demos
    static function tablaMostrarListaDemos(array $resultados, int $contador){
        if (!empty($resultados)) {
            foreach ($resultados as $demos) {
                echo '<tr>
                    <td class="celda__contenido">' . $demos["descripcion"] . '</td>
                    <td class="celda__contenido">' . $demos["pdescripcion"] . '</td>
                    <td class="celda__contenido">' . $demos["nombreh"] . '</td>
                    <td class="celda__contenido">' . $demos["fechasolicitud"] . '</td>
                    <td class="celda__contenido">
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="demostracion">
                        <input type="hidden" name="iddemostracion" value="' . $demos["iddemostracion"] . '">
                        <input class="btnVerde5" type="submit" value="Ver">
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

    
    static function mostrarEmpleado(array $resultados){
        if (!empty($resultados)) {
            foreach ($resultados as $empleado) {
                echo "
                <div class='contenedor__secciones_titulos'>
                    <div class='seccion__titulo color_titulo_seccion'>
                        <div class='contenedor__seccion__descripcion'>
                            <h3 class='contenedor__seccion__titulo texto-normal'>" .
                    $empleado['nombre'] . " " . $empleado['apellidopaterno'] . " " . $empleado['apellidomaterno'] . "
                            </h3>
                        </div>
                    </div>
                </div>
                <div class='principal1'>
                    <section class=division_secciones>
                        <div class='contenedor_izq_der'>
                            <div class='caja__izq_perfil'>
                                <div class='foto_perfil'>
                                    <img class='imagen_perfil' src='" . $empleado['foto'] . "' alt=''>
                                </div>
                                <div class='datos'>
                                    <h2 class='usuario_campo'>Teléfono:</h2>
                                    <p id='tel' class='usuario_valor'>" . $empleado['numerotelefono'] . "</p>
                                    <h2 class='usuario_campo'>Celular:</h2>
                                    <p id='celu' class='usuario_valor'>" . $empleado['numeromovil'] . "</p>                       
                                    <h2 class='usuario_campo'>Fecha de registro:</h2>
                                    <p id='fecharegistro' class='usuario_valor'>" . $empleado['fecharegistro'] . "</p>
                                </div>
                            </div>
                            <div class='caja__der'>
                                <div id='seccion__izquierda' class='seccion__izquierda'>
                                    <div class='contenedor_elementos_fieldset'>
                                        <div class='elemento_individual_form'>
                                            <h2 id='email' name='email' class='email elemento_individual_form_self2'>Dirección</h2>
                                            <p for='email'>" . $empleado['direccion'] . " " . $empleado['codigopostal'] . " " . $empleado['colonia'] . "</p>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 id='email' name='email' class='email elemento_individual_form_self2'>Ciudad</h2>
                                            <p for='email'>" . $empleado['ciudad'] . "</p>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 id='email' name='email' class='email elemento_individual_form_self2'>Estado</h2>
                                            <p for='email'>" . $empleado['estado'] . "</p>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 id='email' name='email' class='email elemento_individual_form_self2'>Correo</h2>
                                            <p for='email'>" . $empleado['correo'] . "</p>
                                        </div>
                                        <div class='elemento_individual_form'>                            
                                            <h2 id='email' name='email' class='email elemento_individual_form_self2'>Rol</h2>
                                            <p for='email'>" . $empleado['descripcion'] . "</p>
                                        </div>
                                        <form class='formeliminar' name='form' method='post' action='editar-empleado'>
                                            <input type='hidden' name='correoeditar' value='" . $empleado['correo'] . "'>
                                            <input class='btnVerde4' type='submit' value='Editar'>
                                        </form>                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            ";
            }
        } else {
            echo '<script type="text/javascript">alert("Por el momento no podemos ejecutar su consulta, intente más tarde");</script>';
        }
    }

    
    static function tablaMostrarDemo(array $resultados){
        if (!empty($resultados)) {
            $diractual = getcwd();
            foreach ($resultados as $demo) {
                echo "
                <div class='caja__der'>
                    <fieldset id='seccion__izquierda' class='seccion__izquierda'>
                        <img class='logo_docus' src='Vistas/img/logoDocusJuama.svg' alt='Logo GR'>
                        <div class='titulos_docs'><h1>" . strtoupper($demo['descripcion']) . "<h1></div>
                            <div class='contenedor_elementos_fieldset'>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Cliente:</label>
                                    <p>" . $demo['titulo'] . " " . $demo['hnombre'] . " " . $demo['hapellidop'] . " " . $demo['hapellidom'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Cargo:</label>
                                    <p>" . $demo['descripcioncargo'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Fecha solicitud:</label>
                                    <p id='fechasolicitud'>" . $demo['fechasolicitud'] . "</p>
                                </div>
                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Hospital:</label>
                                    <p>" . $demo['nombreh'] . "</p>
                                </div>

                                <div class='elemento_individual_form'>
                                    <label for='nombre'>Dirección::</label>
                                    <p>" . $demo['direccionh'] . "<br>" . $demo['coloniah'] . ", C.P. " .  $demo['cp'] . "</p>
                                </div>

                                <div class='elemento_individual_form'>
                                <label for='nombre'>Municipio, Estado:</label>
                                    <p>" . $demo['municipioh'] . ", " . $demo['estadoh'] . "</p>
                                </div>

                                <div class='elemento_individual_form'>
                                <label for='nombre'>Producto / Modelo:</label>
                                    <p>" . $demo['pdescripcion'] . ", " . $demo['modelo'] . "</p>
                                </div>

                                <div class='elemento_individual_form'>
                                <label for='nombre'>Estado solicitud:</label>
                                    <p>" . $demo['estado'] . "</p>
                                </div>

                                <div class='elemento_individual_form'>
                                <label for='nombre'>Comentarios:</label>
                                    <p>" . $demo['comentarios'] . "</p>
                                </div>

                                <div class='elemento_individual_form_self'>
                                    <form id='imprimir' class='formeliminar' name='form' method='post' action='./Docs/demodoc.php' target='_blank'>
                                        <input type='hidden' name='id' value='" . $demo["iddemostracion"] . "'>                                    
                                        <button class='boton__cambio btnAzulBr' id='botonImprimir'>IMPRIMIR</button> 
                                    </form>
                                </div>

                                <div class='elemento_individual_form_self'>
                                    <a id='btnActualizar' class='boton__cambio btnAzulBr'>ACTUALIZAR</a>
                                </div> 
                                <div class='espacio1'>                                
                                    <p>&nbsp;</p>
                                </div>
                                <div>                                
                                    <p>&nbsp;</p>
                                </div>
                                <div>                                
                                    <p>&nbsp;</p>
                                </div>
                                <div>                                
                                    <p>&nbsp;</p>
                                </div>
                                
                            </div>
                    </fieldset>                    
                </div>

                <form id='formularioActualizarDemo' method='post' class='contenido-atajo2 ocultar'>
                    <div class='elemento_individual_form_self5'>
                        <label for='nombre'><div class='dato_obligatorio'></div>Fecha programada:</label>
                        <input type='date' id='fechaprogramada' name='fechaprogramada'>                                    
                        <span class='avisoError'></span>  
                    </div>
                    <div class='elemento_individual_form_self5'>
                        <label for='mensaje'><div class='dato_obligatorio'></div>Observaciones:</label>
                        <textarea class='contactoForm_elemento-dimension' name='mensaje' id='mensaje' cols='30' rows='50' minlength='10' maxlength='150' placeholder='Comentarios' required></textarea>
                        <span id='avisoError' class='avisoError'></span>
                    </div>
                    <div class='elemento_individual_form_self6'>
                        <input type='hidden' name='id' value='" . $demo["iddemostracion"] . "'>                                    
                        <button class='boton__cambio btnAzulBr' name='actualizarDemo' id='validarIngreso'>GUARDAR<i class='icono_contenidos iconoGuardar'></i></button> 
                    </div>
                <form>";
            }
        } else {
            echo '<tr>
                    <td colspan="5" class="celda__contenido">Por el momento no podemos realizar su consulta, intente mas tarde</td>                 
                </tr>';
        }
    }


    // ********* PARA MOSTRAR EN: solicitud-demostracion
    public function validarDatosDemos(array $datosPOST){
        /*
        'tipodemo', 'producto', 'hospital', 'solicitante', 'mensaje', 'idproducto', 'idhospital'
        */

        $this->tipodemo = $datosPOST['tipodemo'];
        $this->producto = $datosPOST['producto'];
        $this->hospital = $datosPOST['hospital'];
        $this->solicitante = $datosPOST['solicitante'];
        $this->mensaje = $datosPOST['mensaje'];
        $this->idproducto = $datosPOST['idproducto'];
        $this->idhospital = $datosPOST['idhospital'];

        #TIPODEMO
        if (trim($this->tipodemo) == '' || $this->tipodemo == 'undefined') {
            $this->errores[] = '\nEl campo tipo de demostración es requerido';
        }
        if (preg_match($this->soloNumeros, $this->tipodemo) == 0) {
            $this->errores[] = '\nEl valor del campo demostracion es incorrecto';
        }
        // 100 equivale el numero de demostraciones, incrementar segun necesidades
        if (strlen($this->tipodemo) < 0 || strlen($this->tipodemo) > 100) {
            $this->errores[] = '\nLongitud de campo demostracion invalido';
        }

        #PRODUCTO
        if (trim($this->producto) == '') {
            $this->errores[] = '\nEl campo hospital es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->producto) == 0) {
            $this->errores[] = '\nEl valor del campo hospital es invalido';
        }
        if (strlen($this->producto) < 0 || strlen($this->producto) > 50) {
            $this->errores[] = '\nLongitud de nombre de hospital invalida';
        }

        #HOSPITAL
        if (trim($this->hospital) == '') {
            $this->errores[] = '\nEl campo producto es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->hospital) == 0) {
            $this->errores[] = '\nEl valor del campo producto es invalido';
        }
        if (strlen($this->hospital) < 0 || strlen($this->hospital) > 50) {
            $this->errores[] = '\nLongitud de nombre más de 5 letras';
        }

        #SOLICITANTE
        if (trim($this->solicitante) == '' || $this->solicitante == 'undefined') {
            $this->errores[] = '\nEl campo solicitante es requerido';
        }
        if (preg_match($this->soloNumeros, $this->solicitante) == 0) {
            $this->errores[] = '\nEl valor del campo solicitante son erroneos';
        }
        // 100 equivale el numero del id del solicitante, incrementar segun necesidades
        if (strlen($this->solicitante) < 0 || strlen($this->solicitante) > 100) {
            $this->errores[] = '\nLongitud de campo demostracion invalido';
        }

        #MENSAJE
        if (trim($this->mensaje) == '') {
            $this->errores[] = '\nEl campo hospital es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->mensaje) == 0) {
            $this->errores[] = '\nEl valor del campo hospital es invalido';
        }
        if (strlen($this->mensaje) < 0 || strlen($this->mensaje) > 150) {
            $this->errores[] = '\nSolo se permiten letras y numeros en el campo mensaje';
        }

        #1. IDPRODUCTO
        if (trim($this->idproducto) == '') {
            $this->errores[] = '\n1. Datos de formulario invalido, intente nuevamente';
        }
        if (preg_match($this->soloNumeros, $this->idproducto) == 0) {
            $this->errores[] = '\n1. DDatos de formulario invalido, intente nuevamente';
        }
        if (strlen($this->idproducto) < 0) {
            $this->errores[] = '\n1. DDatos de formulario invalido, intente nuevamente';
        }

        #2. IDHOSPITAL
        if (trim($this->idhospital) == '') {
            $this->errores[] = '\n2. Datos de formulario invalido, intente nuevamente';
        }
        if (preg_match($this->soloNumeros, $this->idhospital) == 0) {
            $this->errores[] = '\n2. Datos de formulario invalido, intente nuevamente';
        }
        if (strlen($this->idhospital) < 0 || strlen($this->idhospital) > 50) {
            $this->errores[] = '\n2. Datos de formulario invalido, intente nuevamente';
        }

    }

    // ********* ENVIAR CORREO SOLICITUD DE DEMOSTRACION ACTUALIZADA
    static function enviarCorreoNotificacion(string $correoelectronico, array $datos){
        $para = $correoelectronico;
        $as = 'SE HA ASIGNADO FECHA A SU SOLICITUD DE DEMOSTRACION';
        $saltolinea = "\r\n";
        $mensaje = 'Fecha programada: ' . $datos["fechaprogramada"] . $saltolinea . 'Comentarios: ' . $datos["mensaje"] . $saltolinea . 'Estado solicitud: ' . $datos["estado"] . $saltolinea;
        $encabezados = 'From: dhernandez@dhwebdesignmx.com';
        try {
            mail($para,$as,$mensaje,$encabezados);
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            echo '<script type="text/javascript">alert("OCURRIÓ UN PROBLEMA AL ENVIAR LOS DATOS POR CORREO ELECTRÓNICO");</script>';
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


}
