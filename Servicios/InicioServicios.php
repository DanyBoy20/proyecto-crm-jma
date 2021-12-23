<?php

namespace Servicios;

use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class InicioServicios {

    public $errores = [];
    public $nombre;
    public $apellidop;
    public $apellidom;
    public $celular;
    public $telefono;
    public $email;
    public $claveacceso;
    public $claveacceso2;
    public $direccion;
    public $estado;
    public $ciudad;
    public $cp;
    public $colonia;
    public $rol;

    
    static function tablaMostrarListaHospitales(array $resultados, int $contador){
        if (!empty($resultados)) {
            echo "";
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
                        <input class="btnVerde5" type="submit" value="Ver">
                    </form>
                    <form class="formeliminar" name="form' . ++$contador . '" method="post" action="editar-empleado">
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

    // ********* PARA MOSTRAR EN: inicio
    static function mostrarDatosInicio(array $resultados1, array $resultados2, array $resultados3, string $rol){

        if(empty($resultados1) || empty($resultados2) || empty($resultados3)){
            echo '<script type="text/javascript">alert("SIN REGISTROS");</script>';
        }else{
            # OPCIONES USUARIO ADMINISTRADOR
            if($rol == 1 || $rol == 2){        
            echo 
                "
                <div class='contenido-atajo'>
                    <!-- Tarjeta Atajo -->
                    <a class='linkMenu' href='expedientes'>
                    <div class='atajo color_tarjeta'>
                        <div class='atajo-icono atajo__iconoFondo--clientes'>
                            <i class='icono__atajos iconoHospitales'></i>
                        </div>
                        <div class='atajo-descripcion'>
                            <h3 class='atajo-titulo texto-normal'>
                                Total Clientes
                            </h3>
                            <p class='atajo-subtitulo'>" . $resultados1[0]['numhospitales'] . "</p>
                        </div>
                    </div>
                    </a>
                    <!-- Tarjeta Atajo -->
                    <a class='linkMenu' href='demos'>
                    <div class='atajo color_tarjeta'>
                        <div class='atajo-icono atajo__iconoFondo--clientes'>
                            <i class='icono__atajos iconoPrestamosaprobados'></i>
                        </div>
                        <div class='atajo-descripcion'>
                            <h3 class='atajo-titulo text-normal'>
                                Demos
                            </h3>
                            <p class='atajo-subtitulo'>" . $resultados1[0]['numdemos'] . "</p>
                        </div>
                    </div>
                    </a>
                    <!-- Tarjeta Atajo -->
                    <a class='linkMenu' href=''>
                    <div class='atajo color_tarjeta'>
                        <div class='atajo-icono atajo__iconoFondo--clientes'>
                            <i class='icono__atajos2 iconoPendiente'></i>
                        </div>
                        <div class='atajo-descripcion'>
                            <h3 class='atajo-titulo texto-normal'>
                                Instalaciones
                            </h3>
                            <p class='atajo-subtitulo'>345</p>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- CONTENIDOS TARJETAS (BLOQUES) PRINCIPALES -->
                <div class='contenido__tarjetas'>
                    <!-- TARJETA -->
                    <div class='tarjeta'>
                        <!-- Barra titulo | Link | Icono -->
                        <div class='tarjeta__cabecera'>
                            <div class='tarjeta__cabecera-titulo texto-normal'>
                                Expedientes
                            </div>
                            <div class='tarjeta__cabecera_icono'>
                                <a class='linkMenu' href='expedientes'>
                                    Buscar&nbsp;&nbsp;<i class='icono__subtitulos iconoCarpeta'></i>
                                </a>
                            </div>
                        </div>
                        <!-- Contenido -->
                        <div class='tarjeta'>
                            <div class='tabla__contenidos' tabindex='0'>
                                <table class='tabla__general'>
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Estado</th>
                                            <th>Municipio</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    $contador = 1;
                                    foreach ($resultados2 as $expedientes) {
                                        echo "
                                        <tr>
                                            <td class='celda__contenido'>" . $expedientes['nombreh'] . "</td>
                                            <td class='celda__contenido'>" . $expedientes['tipo'] . "</td>
                                            <td class='celda__contenido'>" . $expedientes['estadoh'] . "</td>
                                            <td class='celda__contenido'>" . $expedientes['municipioh'] . "</td>
                                            <td class='celda__contenido'>
                                                <form class='formeliminar' name='form'" . ++$contador . "' method='post' action='expediente-hospital'>
                                                <input type='hidden' name='idhospital' value='" . $expedientes["idhospital"] . "'>
                                                <input type='hidden' name='estado' value='" . $expedientes["estado"] . "'>
                                                <input class='btnVerde5' type='submit' value='Ver'>
                                            </form>
                                            </td>    
                                        </tr>
                                    ";
                                    }
                                    echo "  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- TARJETA -->
                    <div class='tarjeta'>
                        <!-- Barra titulo | Link | Icono -->
                        <div class='tarjeta__cabecera'>
                            <div class='tarjeta__cabecera-titulo texto-normal'>
                                Demos
                            </div>
                            <div class='tarjeta__cabecera_icono'>
                                <a class='linkMenu' href='demos'>
                                    Buscar&nbsp;&nbsp;<i class='icono__subtitulos iconoCarpeta'></i>
                                </a>
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
                                            <th>Hospital</th>
                                            <th>Fecha</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    foreach ($resultados3 as $demos) {
                                        echo "
                                        <tr>
                                            <td class='celda__contenido'>" . $demos['descripcion'] . "</td>
                                            <td class='celda__contenido'>" . $demos['pdescripcion'] . "</td>
                                            <td class='celda__contenido'>" . $demos['nombreh'] . "</td>
                                            <td class='celda__contenido'>" . $demos['fechasolicitud'] . "</td>
                                            <td class='celda__contenido'>
                                                <form class='formeliminar' name='form'" . ++$contador . "' method='post' action='demostracion'><input type='hidden' name='iddemostracion' value='" . $demos["iddemostracion"] . "'><input class='btnVerde5' type='submit' value='Ver'>
                                            </form>
                                            </td> 
                                        </tr>
                                    ";
                                    }
                                    echo "  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                ";
    
            }else{
                echo '<script type="text/javascript">alert("MOSTRAR OPCIONES DIFERENTE USUARIO");</script>';
            }
        }
    }
    
}
