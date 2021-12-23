<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IAreas;
use Modelos\AreasModelo;
use Servicios\AreasServicios;

class AreasControlador implements IAreas {

    private $variablesIndefinidas = [];
    
    // ********* PARA MOSTRAR EN: registro-areas
    public function guardar(){  

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(!isset($_POST['area']) || $_POST['area'] == ""){
                echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
            }else{
                $servicioarea = new AreasServicios();
                $servicioarea->validarArea($_POST["area"]);
                if(!empty($servicioarea->errores)){
                    $camposInvalidos = $servicioarea->errores;
                    echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';
                }else{
                    $resultado = new AreasModelo();
                    $resultado->guardar($_POST["area"]);
                    if($resultado){
                        echo "<script>alert('Registro insertado');</script>";
                        echo '<script>window.location.href="inicio"</script>';
                    }else{
                        echo "<script>alert('Por el momento no podemos ejecutar su solicitud, intente más tarde');</script>";
                        echo '<script>window.location.href="inicio"</script>';
                    }
                }
            }
        }
    }

    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function guardarAreaHospital(){

        $campos = ['hospital', 'area', 'idarea', 'idhospital'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            foreach ($campos as $campoFormulario) {
                if (!isset($_POST[$campoFormulario]) || empty($_POST[$campoFormulario])) {
                    $this->variablesIndefinidas = $campoFormulario;
                    break;
                    exit();                
                }
            }
            if(!empty($this->variablesIndefinidas)){
                echo "<script>alert('El campo " . $this->variablesIndefinidas . " es obligatorio');</script>";

            }else{
                $servicioareahospital = new AreasServicios();
                $servicioareahospital->validarAreaHospital($_POST);
                if(!empty($servicioareahospital->arregloerrores)){
                    $camposInvalidos = implode(",", $servicioareahospital->arregloerrores);
                    echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';

                }else{
                    $resultado = new AreasModelo();
                    $datosareahospital = array(
                                    "idhospital" => $servicioareahospital->idhospital,
                                    "idarea" => $servicioareahospital->idarea
                    );
                    $resultado->guardarAreaHospital($datosareahospital);
                    if($resultado){
                        echo "<script>alert('Registro insertado');</script>";
                        echo '<script>window.location.href="inicio"</script>';
                    }else{
                        echo "<script>alert('Por el momento no podemos ejecutar su solicitud, intente más tarde');</script>";
                        echo '<script>window.location.href="inicio"</script>';
                    }

                }
                
            }
        }
        
    }

}
