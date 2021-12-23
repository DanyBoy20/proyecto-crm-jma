<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\ICapacitaciones;
use Modelos\CapacitacionesModelo;
use Servicios\CapacitacionesServicios;

class CapacitacionesControlador implements ICapacitaciones {
    
    private $variablesIndefinidas = [];
    private $camposinvalidos; 

    
    public function consultar(){
    }
    
    // ********* PARA MOSTRAR EN: registro-instalacion
    public function guardar(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $campos = ['tipocapacitacion', 'hospital', 'solicitante', 'producto', 'mensaje', 'idproducto', 'idhospital'];
            foreach ($campos as $campoformulario) {
                if(!isset($_POST[$campoformulario]) || empty($_POST[$campoformulario])){
                    $this->variablesIndefinidas = $campoformulario;
                    break; 
                    exit ();
                }                
            }
            if(!empty($this->variablesIndefinidas)){
                echo '<script type="text/javascript">alert("El campo aqui '. $this->variablesIndefinidas . ' es obligatorio");</script>';
            }else{
                $serviciocapacitacion = new CapacitacionesServicios();
                $serviciocapacitacion->validarCapacitacion($_POST);
                if(!empty($serviciocapacitacion->errores)){
                    $this->camposinvalidos = implode(",", $serviciocapacitacion->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $capacitacion = new CapacitacionesModelo();
                    $identificadorproducto = (int)$_POST['idproducto'];
                    $res = $capacitacion->consultarProductoValido($identificadorproducto);
                    $identificadorcapacitacion = (int)$_POST['tipocapacitacion'];
                    $res2 = $capacitacion->consultarCapacitacionValido($identificadorcapacitacion);
                    if($res <= 0){
                        echo '<script type="text/javascript">alert("No existe el producto");</script>';
                    }else if($res2 <= 0){
                        echo '<script type="text/javascript">alert("No existe la capacitación");</script>';
                    }else{
                        $hospitalid = (int)$_POST['idhospital'];
                        $contactoid = (int)$_POST['solicitante'];                        
                        $resultado = $capacitacion->validarDatosHospital($hospitalid, $contactoid);
                        if($resultado <= 0){
                            echo '<script type="text/javascript">alert("ERROR: Los datos recibidos no son validos");</script>';
                        }else{
                            $datos = array(
                                "tipocapacitacion" => $_POST['tipocapacitacion'],
                                "idhospital" => $_POST['idhospital'],
                                "idcontacto" => $_POST['solicitante'],                                
                                "fechasolicitud" => date('Y-m-d'),
                                "observaciones" => $_POST['mensaje'],
                                "estado" => 'Pendiente',
                                "idproducto" => $_POST['idproducto'],
                                "barra" => 34
                            );
                            $altacorrecta = $capacitacion->guardarCapacitacion($datos);
                            if(!$altacorrecta){
                                echo '<script type="text/javascript">alert("Por el momento no podemos guardar los datos, intente más tarde");</script>';
                                echo '<script>window.location.href = "inicio"</script>';
                            }else{
                                echo '<script type="text/javascript">alert("Instalacion registrada");</script>';
                                echo '<script>window.location.href = "expedientes"</script>';
                            }
                        }
                    }
                }
            }
        }
        
    }

    
    public function actualizarContraseña(){}

    
    public function ver(){}


    public function editar(){}


}
