<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IInstalaciones;
use Modelos\InstalacionesModelo;
use Servicios\InstalacionesServicios;

class InstalacionesControlador implements IInstalaciones {
    
    private $variablesIndefinidas = [];
    private $camposinvalidos; 

    
    public function consultar(){
    }
    
    // ********* PARA MOSTRAR EN: registro-instalacion
    public function guardar(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $campos = ['hospital', 'solicitante', 'area', 'producto', 'mensaje', 'idproducto', 'idhospital'];
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
                $servicioinstalaciones = new InstalacionesServicios();
                $servicioinstalaciones->validarInstalacion($_POST);
                if(!empty($servicioinstalaciones->errores)){
                    $this->camposinvalidos = implode(",", $servicioinstalaciones->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $instalacion = new InstalacionesModelo();
                    $identificadorproducto = (int)$_POST['idproducto'];
                    $res = $instalacion->consultarProductoValido($identificadorproducto);
                    if($res <= 0){
                        echo '<script type="text/javascript">alert("No existe el producto");</script>';
                    }else{
                        $hospitalid = (int)$_POST['idhospital'];
                        $contactoid = (int)$_POST['solicitante'];
                        $areacve = (int)$_POST['area'];
                        $resultado = $instalacion->validarDatosHospital($hospitalid, $contactoid, $areacve);
                        if($resultado <= 0){
                            echo '<script type="text/javascript">alert("ERROR: Los datos recibidos no son validos");</script>';
                        }else{
                            $datos = array(
                                "idhospital" => $_POST['idhospital'],
                                "idcontacto" => $_POST['solicitante'],
                                "cvearea" => $_POST['area'],
                                "ifechasolicitud" => date('Y-m-d'),
                                "observaciones" => $_POST['mensaje'],
                                "estado" => 'Pendiente',
                                "idproducto" => $_POST['idproducto'],
                                "barra" => 34
                            );
                            # AQUI ME QUEDE: INSERTAR DATOS
                            $altacorrecta = $instalacion->guardarInstalacion($datos);
                            ($altacorrecta) ? $this->success() : $this->error(); 
                        }
                    }
                }
            }
        } 
    }

    private function error(){
        echo '<script type="text/javascript">alert("Por el momento no podemos ejecutar su solicitud, intente más tarde");</script>';
        echo '<script>window.location.href = "inicio"</script>';
    }

    private function success(){
        echo '<script type="text/javascript">alert("Registro guardado");</script>';
        echo '<script>window.location.href = "inicio"</script>';
    }

    
    public function actualizarContraseña(){}

    
    public function ver(){}


    public function editar(){}


}
