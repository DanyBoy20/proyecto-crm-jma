<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\ITablas;
use Modelos\TablasModelo;
use Servicios\TablasServicios;

class TablasControlador implements ITablas {
    
    private $variablesIndefinidas = [];
    private $camposinvalidos; 
    
    // ********* PARA MOSTRAR EN: registro-categoria
    public function guardarCategoria(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['categoria']) || empty($_POST['categoria'])){
                echo '<script type="text/javascript">alert("El campo categoria es obligatorio");</script>';
            }else{
                $serviciocategoria = new TablasServicios();
                $serviciocategoria->validarcategoria($_POST['categoria']);
                if(!empty($serviciocategoria->errores)){
                    $this->camposinvalidos = implode(",", $serviciocategoria->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $categoria = new TablasModelo();
                    $altacorrecta = $categoria->guardarCategoria($_POST['categoria']);
                    ($altacorrecta) ? $this->success() : $this->error();                 
                }
            }
        }        
    }

    // ********* PARA MOSTRAR EN: registro-marca
    public function guardarMarca(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['marca']) || empty($_POST['marca'])){
                echo '<script type="text/javascript">alert("El campo marca es obligatorio");</script>';
            }else{
                $serviciomarca = new TablasServicios();
                $serviciomarca->validarMarca($_POST['marca']);
                if(!empty($serviciomarca->errores)){
                    $this->camposinvalidos = implode(",", $serviciomarca->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $marca = new TablasModelo();
                    $altacorrecta = $marca->guardarMarca($_POST['marca']);
                    ($altacorrecta) ? $this->success() : $this->error();                 
                }
            }
        }

    }

    // ********* PARA MOSTRAR EN: registro-equipos
    public function guardarEquipo(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $campos = ['categoria', 'marca', 'producto', 'modelo'];
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
                $serviciotablas = new TablasServicios();
                $serviciotablas->validarEquipo($_POST);
                if(!empty($serviciotablas->errores)){
                    $this->camposinvalidos = implode(",", $serviciotablas->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $validar = new TablasModelo();
                    $identificadorcategoria = (int)$_POST['categoria'];
                    $res = $validar->consultarCategoriaValido($identificadorcategoria);
                    $identificadormarca = (int)$_POST['marca'];
                    $res2 = $validar->consultarMarcaValido($identificadormarca);
                    if($res <= 0){
                        echo '<script type="text/javascript">alert("No existe la categoria");</script>';
                    }else if($res2 <= 0){
                        echo '<script type="text/javascript">alert("No existe la marca");</script>';
                    }else{
                        $datos = array(
                            "categoria" => $_POST['categoria'],
                            "marca" => $_POST['marca'],
                            "producto" => $_POST['producto'],
                            "modelo" => $_POST['modelo']
                        );
                        $altacorrecta = $validar->guardarProducto($datos);
                        ($altacorrecta) ? $this->success() : $this->error();  
                    }
                }
            }
        }
    }

    public function guardarCargo(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['cargo']) || empty($_POST['cargo'])){
                echo '<script type="text/javascript">alert("El campo cargo es obligatorio");</script>';
            }else{
                $serviciocargo = new TablasServicios();
                $serviciocargo->validarCargo($_POST['cargo']);
                if(!empty($serviciocargo->errores)){
                    $this->camposinvalidos = implode(",", $serviciocargo->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $cargo = new TablasModelo();
                    $altacorrecta = $cargo->guardarCargo($_POST['cargo']);
                    ($altacorrecta) ? $this->success() : $this->error();                 
                }
            }
        }

    }    

    public function guardarDemo(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['demo']) || empty($_POST['demo'])){
                echo '<script type="text/javascript">alert("El campo demo es obligatorio");</script>';
            }else{
                $serviciodemo = new TablasServicios();
                $serviciodemo->validarDemostracion($_POST['demo']);
                if(!empty($serviciodemo->errores)){
                    $this->camposinvalidos = implode(",", $serviciodemo->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $demo = new TablasModelo();
                    $altacorrecta = $demo->guardarDemo($_POST['demo']);
                    ($altacorrecta) ? $this->success() : $this->error();                 
                }
            }
        }

    } 

    public function guardarCapacitacion(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['capacitacion']) || empty($_POST['capacitacion'])){
                echo '<script type="text/javascript">alert("El campo capacitacion es obligatorio");</script>';
            }else{
                $serviciocapacitacion = new TablasServicios();
                $serviciocapacitacion->validarCapacitacion($_POST['capacitacion']);
                if(!empty($serviciocapacitacion->errores)){
                    $this->camposinvalidos = implode(",", $serviciocapacitacion->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $capacitacion = new TablasModelo();
                    $altacorrecta = $capacitacion->guardarCapacitacion($_POST['capacitacion']);
                    ($altacorrecta) ? $this->success() : $this->error();                 
                }
            }
        }

    } 

    public function guardarPoliza(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['poliza']) || empty($_POST['poliza'])){
                echo '<script type="text/javascript">alert("El campo poliza es obligatorio");</script>';
            }else{
                $serviciopoliza = new TablasServicios();
                $serviciopoliza->validarPoliza($_POST['poliza']);
                if(!empty($serviciopoliza->errores)){
                    $this->camposinvalidos = implode(",", $serviciopoliza->errores);
                    echo '<script type="text/javascript">alert("CAMPOS CON DATOS INCORRECTOS:  '. $this->camposinvalidos . '");</script>';
                }else{
                    $poliza = new TablasModelo();
                    $altacorrecta = $poliza->guardarPoliza($_POST['poliza']);
                    ($altacorrecta) ? $this->success() : $this->error();                 
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
        /* echo '<script>window.location.href = "inicio"</script>'; */
    }

}
