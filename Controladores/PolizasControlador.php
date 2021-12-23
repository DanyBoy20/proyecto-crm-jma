<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IPolizas;
use Modelos\PolizasModelo;
use Servicios\PolizasServicios;

class PolizasControlador implements IPolizas {
    
    private $variablesIndefinidas = [];
    private $camposinvalidos; 

    
    public function consultar(){
    }
    
    // ********* PARA MOSTRAR EN: registro-instalacion
    public function guardar(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $campos = ['tipopoliza', 'hospital', 'solicitante', 'area', 'mensaje', 'producto', 'sn', 'idproducto', 'idhospital'];
            foreach ($campos as $campoformulario) {
                if(!isset($_POST[$campoformulario]) || empty($_POST[$campoformulario])){
                    $this->variablesIndefinidas = $campoformulario;
                    break; 
                    exit ();
                }                
            }
            if(!empty($this->variablesIndefinidas)){
                echo '<script type="text/javascript">alert("El campo '. $this->variablesIndefinidas . ' es obligatorio");</script>';
            }else{
                $serviciopolizas = new PolizasServicios();
                $serviciopolizas->validarPoliza($_POST);
                if(!empty($serviciopolizas->errores)){
                    $this->camposinvalidos = implode(",", $serviciopolizas->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $poliza = new PolizasModelo();
                    $identificadorproducto = (int)$_POST['idproducto'];
                    $res = $poliza->consultarProductoValido($identificadorproducto);
                    $identificadorpoliza = (int)$_POST['tipopoliza'];
                    $res2 = $poliza->consultarPolizaValido($identificadorpoliza);
                    if($res <= 0){
                        echo '<script type="text/javascript">alert("No existe el producto");</script>';
                    }else if($res2 <= 0){
                        echo '<script type="text/javascript">alert("No existe la capacitación");</script>';
                    }else{
                        $hospitalid = (int)$_POST['idhospital'];
                        $contactoid = (int)$_POST['solicitante'];
                        $area = (int)$_POST['area'];
                        $resultado = $poliza->validarDatosHospital($hospitalid, $contactoid, $area);
                        if($resultado <= 0){
                            echo '<script type="text/javascript">alert("ERROR: Los datos recibidos no son validos");</script>';
                        }else{
                            $datos = array(
                                "tipopoliza" => $_POST['tipopoliza'],
                                "fecharegistro" => date('Y-m-d'),
                                "idhospital" => $_POST['idhospital'],
                                "solicitante" => $_POST['solicitante'],
                                "area" => $_POST['area'],
                                "observaciones" => $_POST['mensaje'],
                                "idproducto" => $_POST['idproducto'],
                                "sn" => $_POST['sn']
                            );
                            $altacorrecta = $poliza->guardarCapacitacion($datos);
                            if(!$altacorrecta){
                                echo '<script type="text/javascript">alert("Por el momento no podemos guardar los datos, intente más tarde");</script>';
                                echo '<script>window.location.href = "inicio"</script>';
                            }else{
                                echo '<script type="text/javascript">alert("Registro de políza correcto");</script>';
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
