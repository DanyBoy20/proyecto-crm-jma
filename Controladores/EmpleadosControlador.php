<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IUsuarios;
use Modelos\EmpleadosModelo;
use Servicios\EmpleadosServicios;

class EmpleadosControlador implements IUsuarios {

    private $errores = [];
    private $variablesIndefinidas = [];
    private $claveacceso;
    private $contraseniaActualizada; 

    /**
     * Consultar la lista de empleados
     *
     * @return void
     */
    public function consultar(){    
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!isset($_POST['correo']) || $_POST['correo'] == ""){
                echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
            }else{
                $correoEmpleado = new EmpleadosModelo();
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
            $listaempleados = new EmpleadosModelo();
            $resultados = $listaempleados->consultar();
            $contador = 0;
            EmpleadosServicios::tablaMostrarListaEmpleados($resultados, $contador);
        }  
    }
    
    /**
     * Guardar (insertar) usuario empleado en la base de datos
     *
     * @return void
     */
    public function guardar(){        
        $campos = ['nombre', 'apellidop', 'apellidom', 'celular', 'telefono', 'email', 'direccion', 'estado', 'ciudad', 'cp', 'colonia', 'rol'];
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
                $servicioempleados = new EmpleadosServicios();
                $servicioempleados->validarDatosEmpleado($_POST);
                if(!empty($servicioempleados->errores)){
                    $camposInvalidos = implode(",", $servicioempleados->errores);
                    echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';

                }else{
                    /* Obtener datos del archivo: dimensiones y tipo */
                    $archivo = getimagesize($_FILES['archivo']['tmp_name']);
                    list($ancho, $alto) = $archivo = getimagesize($_FILES['archivo']['tmp_name']);

                    if (!preg_match('/image\//',$archivo['mime']) || $_FILES['archivo']['error'] == 4 || $_FILES['archivo']['size'] >= 500000 || $ancho != $alto) { 
                        
                        echo "<script>alert('Debe elegir un archivo con formato jpg | png, que no sea mayor a 500kb y que sea una imagem cuadrada');</script>";
                    }else{
                        /* $nombreFoto = $this->nombre . $this->apellidop . $this->rol; */
                        $nombreFoto = $servicioempleados->nombre;
                        $numeroFoto = rand(100,1000);
                        $extensionFoto = explode(".", basename($_FILES["archivo"]["name"]));
                        $nuevoNombre = $nombreFoto . $numeroFoto . '.' . end($extensionFoto); // concatenamos el nombre, numero y la extension extraida
                        $carpeta=  "Vistas/img/empleados/";
                        $ubicacion = $carpeta . $nuevoNombre;
                        $servicioempleados->claveacceso = EmpleadosServicios::crearContrasenia(1);
                        $contrasenia = password_hash($servicioempleados->claveacceso, PASSWORD_DEFAULT);
                        $resultado = new EmpleadosModelo();
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
                                        "contrasenia" => $contrasenia,
                                        "rol" => $servicioempleados->rol,
                                        "condicion" => "activo",
                                        "fechareg" => date('Y-m-d'),
                                        "intentos" => 0,
                                        "foto" => $ubicacion             
                        );
                        $resultado->guardar($datosUsuario);
                        if($resultado){
                            move_uploaded_file($_FILES["archivo"]["tmp_name"], "Vistas/img/empleados/" . $nuevoNombre);
                            $correo = 'dhernandez@dhwebdesignmx.com';
                            /* $correo = $servicioempleados->email; */
                            $servicioempleados->enviarCorreo($correo);
                            echo '<script>window.location.href="lista-empleados"</script>';
                        }else{
                            echo "<script>alert('No se pudo guardar el registro, intente mas tarde');</script>";
                        }                        
                    }
                }
            }            
        }
    }

    /**
     * Actualizar contraseña del empleado
     *
     * @return void
     */
    public function actualizarContraseña(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST['contrasenia']) || !isset($_POST['repetircontrasenia'])) {
                echo '<script type="text/javascript">alert("No se recibio ningun dato, intente nuevamente");</script>';
            }else{
                $servicioempleados = new EmpleadosServicios();
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
                    $resultado = new EmpleadosModelo();                    
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

    /**
     * Seleccionar empleado para su visualización
     *
     * @return [type]
     */
    public function ver(){
        if(!isset($_POST['correover']) || $_POST['correover'] == ""){
            echo '<script type="text/javascript">alert("NO SE RECIBIERON DATOS");</script>';
        }else{
            $servicioempleados = new EmpleadosServicios();
            $servicioempleados->validarCorreoPost($_POST['correover']);
            if(!empty($servicioempleados->errores)){
                $camposInvalidos = implode(",", $servicioempleados->errores);
                echo '<script type="text/javascript">alert("ERRORES EN LOS DATOS ENVIADOS: '.$camposInvalidos.'");</script>';
            }else{
                $verEmpleado = new EmpleadosModelo();
                $resultados = $verEmpleado->verEmpleado($servicioempleados->email);
                EmpleadosServicios::mostrarEmpleado($resultados);                
            }
        }        
    }

    /**
     * Selecciona y edita respectivamente los datos del empleado 
     *
     * @return void
     */
    public function editar(){  
        if(isset($_POST['correoeditar'])){
            /* if(!isset($_POST['correoeditar']) || $_POST['correoeditar'] == ""){ */
            if($_POST['correoeditar'] == ""){
                echo '<script type="text/javascript">alert("No se recibieron datos, intente nuevamente");</script>';
                echo '<script>window.location.href = "inicio"</script>';
            }else{
                $datosEmpleado = $_POST['correoeditar'];
                $empleadoEditar = new EmpleadosModelo();
                $resultados = $empleadoEditar->editarEmpleado($datosEmpleado);
                EmpleadosServicios::tablaEditarEmpleados($resultados);
            }
        }else if(isset($_POST['nombre']) && isset($_POST['apellidop']) && isset($_POST['apellidom'])){
            $servicioempleados = new EmpleadosServicios();
            $servicioempleados->validarDatosEmpleado($_POST);
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
                    $resultado = new EmpleadosModelo();
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
