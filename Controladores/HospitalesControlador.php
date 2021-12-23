<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IHospitales;
use Modelos\HospitalesModelo;
use Servicios\HospitalesServicios;

class HospitalesControlador implements IHospitales {

    private $errores = [];
    private $variablesIndefinidas = [];
    private $claveacceso;
    private $contraseniaActualizada; 

    // ********* PARA MOSTRAR EN: expedientes
    public function consultar(){    
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!isset($_POST['correo']) || $_POST['correo'] == ""){
                echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
            }else{
                $correoEmpleado = new HospitalesModelo();
                $datosUsuario = array(
                    "email" => $_POST['correo'],
                    "condicion" => "eliminado"            
                 );
                $resultados = $correoEmpleado->eliminar($datosUsuario);  
                if($resultados){
                    echo '<script type="text/javascript">alert("Registro eliminado");</script>';
                    echo '<script>window.location.href = "lista-empleados"</script>';
                }else{
                    echo '<script type="text/javascript">alert("No se pudo eliminar el registro, intente mas tarde");</script>';
                    echo '<script>window.location.href = "inicio"</script>';
                }              
            }

        }else{
            $expedientesHospitales = new HospitalesModelo();
            $resultados = $expedientesHospitales->consultar();
            $contador = 0;
            HospitalesServicios::tablaMostrarListaHospitales($resultados, $contador);
        }  
    }
    
    // ********* PARA MOSTRAR EN: registro-hospital
    public function guardar(){        
        $campos = ['nombre', 'tipohospital', 'telefono', 'direccion', 'estado', 'ciudad', 'cp', 'colonia'];
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

                $serviciohospital = new HospitalesServicios();
                $serviciohospital->validarDatosHospital($_POST);
                if(!empty($serviciohospital->errores)){
                    $camposInvalidos = implode(",", $serviciohospital->errores);
                    echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';

                }else{
                    /*
                    ("nombre") ("tipohospital") ("telefono") ("direccion") ("estado") ("ciudad") ("cp") ("colonia");
                    */
                    $resultado = new HospitalesModelo();
                    $datosUsuario = array(
                                    "nombre" => $serviciohospital->nombre,
                                    "tipohospital" => $serviciohospital->tipohospital,
                                    "telefono" => $serviciohospital->telefono,
                                    "direccion" => $serviciohospital->direccion,
                                    "ciudad" => $serviciohospital->ciudad,
                                    "estado" => $serviciohospital->estado,
                                    "cp" => $serviciohospital->cp,
                                    "colonia" => $serviciohospital->colonia,
                                    "fechareg" => date('Y-m-d'),
                                    "estatus" => 'activo'
                    );
                    $resultado->guardar($datosUsuario);
                    if($resultado){
                        /* $correo = 'dhernandez@dhwebdesignmx.com';
                        $correo = $servicioempleados->email;
                        $serviciohospital->enviarCorreo($correo); */
                        echo "<script>alert('Registro guardado');</script>";
                        echo '<script>window.location.href="lista-empleados"</script>';
                    }else{
                        echo "<script>alert('No se pudo guardar el registro, intente mas tarde');</script>";
                    }
                    
                }
            }            
        }
    }

    
    public function actualizarContraseña(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST['contrasenia']) || !isset($_POST['repetircontrasenia'])) {
                echo '<script type="text/javascript">alert("No se recibio ningun dato, intente nuevamente");</script>';
            }else{
                $servicioempleados = new HospitalesServicios();
                $this->errores = $servicioempleados->validarContrasenia($_POST['contrasenia'], $_POST['repetircontrasenia']);
                if(!empty($this->errores)){
                    $camposInvalidos = implode(",", $this->errores);
                    echo '<script type="text/javascript">alert("Hay errores en los campos del formulario: '.$camposInvalidos.'");</script>'; 
                }else{
                    $correo = $_SESSION['correo'];
                    $this->claveacceso = $_POST['contrasenia'];
                    $this->contraseniaActualizada = password_hash($this->claveacceso, PASSWORD_DEFAULT);
                    $datosUsuario = array(
                        "correo" => $correo,
                        "contraseniaActualizada" => $this->contraseniaActualizada,           
                    );
                    $resultado = new HospitalesModelo();                    
                    $resultado->actualizarContrasenia($datosUsuario);
                    if(!$resultado){
                        echo '<script type="text/javascript">alert("No fue posible actualizar su contraseña, intente mas tarde");</script>';
                    }else{
                        echo '<script type="text/javascript">alert("Contraseña actualizada, debera usarla en su proximo inicio de sesion");</script>';
                    }
                }  
            }   
        }
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    public function ver(){

        if(!isset($_POST['idhospital']) || $_POST['idhospital'] == ""){
            echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
        }else{
            $verEmpleado = new HospitalesModelo();
           
                $hospital = $verEmpleado->verHospitalInicial($_POST['idhospital']);
                $contactos= $verEmpleado->verContacto($_POST['idhospital']);
                $equipos= $verEmpleado->verEquipos($_POST['idhospital']);
                $demos = $verEmpleado->verDemos($_POST['idhospital']);
                $capacitaciones = $verEmpleado->verCapacitaciones($_POST['idhospital']);
                HospitalesServicios::mostrarHospital($hospital, $contactos, $equipos, $demos, $capacitaciones);
        } 
    }

    
    public function editar(){  
        if(isset($_POST['correoeditar'])){
            /* if(!isset($_POST['correoeditar']) || $_POST['correoeditar'] == ""){ */
            if($_POST['correoeditar'] == ""){
                echo '<script type="text/javascript">alert("No se recibieron datos, intente nuevamente");</script>';
                echo '<script>window.location.href = "inicio"</script>';
            }else{
                $datosEmpleado = $_POST['correoeditar'];
                $empleadoEditar = new HospitalesModelo();
                $resultados = $empleadoEditar->editarEmpleado($datosEmpleado);
                HospitalesServicios::tablaEditarEmpleados($resultados);
            }
        }else if(isset($_POST['nombre']) && isset($_POST['apellidop']) && isset($_POST['apellidom'])){
            $servicioempleados = new HospitalesServicios();
            $servicioempleados->validarDatosHospital($_POST);
            if(!empty($servicioempleados->errores)){
                $camposInvalidos = implode(",", $servicioempleados->errores);
                echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';
                echo "<script>window.location.href='index'</script>";
            }else{
                /* Obtener datos del archivo: dimensiones y tipo */
                $archivo = getimagesize($_FILES['archivo']['tmp_name']);
                list($ancho, $alto) = $archivo = getimagesize($_FILES['archivo']['tmp_name']);
                if (!preg_match('/image\//',$archivo['mime']) || $_FILES['archivo']['error'] == 4 || $_FILES['archivo']['size'] >= 500000 || $ancho != $alto) {    
                    echo "<script>alert('Debe elegir un archivo con formato jpg | png, que no sea mayor a 500kb y que sea una imagem cuadrada');</script>";
                }else{
                    $nombreFoto = $servicioempleados->nombre;
                    $numeroFoto = rand(100,1000);
                    $extensionFoto = explode(".", basename($_FILES["archivo"]["name"]));
                    $nuevoNombre = $nombreFoto . $numeroFoto . '.' . end($extensionFoto); // concatenamos el nombre, numero y la extension extraida
                    $carpeta=  "Vistas/img/empleados/";
                    $ubicacion = $carpeta . $nuevoNombre;
                    $resultado = new HospitalesModelo();
                    $datosUsuario = array(
                                    "nombre" => $servicioempleados->nombre,
                                    "apellidop" => $servicioempleados->apellidop,
                                    "apellidom" => $servicioempleados->apellidom,
                                    "direccion" => $servicioempleados->direccion,
                                    "ciudad" => $servicioempleados->ciudad,
                                    "estado" => $servicioempleados->estado,
                                    "cp" => $servicioempleados->cp,
                                    "colonia" => $servicioempleados->colonia,
                                    "celular" => $servicioempleados->celular,
                                    "telefono" => $servicioempleados->telefono,
                                    "email" => $servicioempleados->email,
                                    "rol" => $servicioempleados->rol,
                                    "condicion" => $_POST['condicion'],
                                    "foto" => $ubicacion             
                    );
                    $resultado->actualizarEmpleado($datosUsuario);
                    if($resultado){
                        move_uploaded_file($_FILES["archivo"]["tmp_name"], "Vistas/img/empleados/" . $nuevoNombre); 
                        echo '<script>window.location.href="lista-empleados"</script>';
                    }else{
                        echo "<script>alert('No se pudo guardar el actualizar, intente mas tarde');</script>";
                        echo "<script>window.location.href='index'</script>";
                    }   
                }
            }
        }else{
            echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
            echo "<script>window.location.href='index'</script>";
        }
    }


}
