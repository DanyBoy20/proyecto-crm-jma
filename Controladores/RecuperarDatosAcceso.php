<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use Modelos\RecuperarDatos;
use Servicios\EmpleadosServicios;
use Servicios\Googlercptch;

/**
 * Representa la recuperación de datos - controlador
 */
class RecuperarDatosAcceso{

    /**
     * Almacenara un valor a la condicion del usuario (activo/eliminado/desactivado)
     *
     * @var string
     */
    private $estadoCuenta;

    /**
     * Almacenara la nueva contraseña
     *
     * @var string
     */
    private $nuevacontrasenia;

    /**
     * Almacenara el correo del usuario
     *
     * @var string
     */
    private $email;

    /**
     * Valida y actualiza los datos del usuario, envia la contraseña a usuario por correo electrónico.
     *
     * @return void
     */
    public function recuperarDatos(){
        // Si estan definidas, significa que ya envio el formulario
        if(isset($_POST["usuario"]) && isset($_POST['g-recaptcha-response'])){
            /* Verificacion de google reCAPTCHA */
            $captcha = new Googlercptch();
            $captcha_success = $captcha->verificarGoogleCaptcha($_POST['g-recaptcha-response']);
            // No paso la validacion de google reCAPTCHA
	        if ($captcha_success->success==false) {
                session_destroy();
            echo "<script>alert('Debe verificar el cuadro *No soy un robot*');</script>";
            // Paso la validación de googl reCaptcha
	        } else {
                // Si el campo usuario viene con datos (no esta vacio)
                if(trim(!empty($_POST["usuario"]))){
                    // Validamos el formato de correo
                    if (filter_var($_POST["usuario"], FILTER_VALIDATE_EMAIL) === false) {
                        session_destroy();
                        echo "<script>alert('El correo no es valido.');</script>";
                        echo '<script>window.location = "index"</script>';
                    // Validamos la longitud del campo usuario
                    }else if(strlen($_POST["usuario"]) < 10 || strlen($_POST["usuario"]) > 50) {
                        session_destroy();
                        echo "<script>alert('El correo debe ser mayor a 10 caracteres.');</script>";
                        echo '<script>window.location = "index"</script>';
                    // Paso la validacion de datos del usuario
                    }else{
                        // Manejo de errores con try catch
                        try{    
                            $inicioSesion = new RecuperarDatos();
                            $respuesta = $inicioSesion->recuperarAcceso($_POST["usuario"]);
                            // Validamos el valor de la BBDD con el valor enviado
                            if($_POST["usuario"] == $respuesta["correo"]){                                
                                $this->estadoCuenta = $respuesta['condicion'];
                                // Si el usuario no esta activo
                                if($this->estadoCuenta != 'activo'){
                                    session_destroy();
                                    echo "<script>alert('Su cuenta no esta activa, contacte con el administrador.');</script>";
                                    echo '<script>window.location = "index"</script>';
                                }else{             
                                    // Paso la validacion de datos y el usuario existe y esta activo                   
                                    $this->nuevacontrasenia = EmpleadosServicios::crearContrasenia(1);
                                    $enviarContrasenia = $this->nuevacontrasenia;
                                    $contrasenia = password_hash($this->nuevacontrasenia, PASSWORD_DEFAULT);
                                    $this->email = $_POST["usuario"];
                                    $resultado = new RecuperarDatos();
                                    $datosUsuario = array(
                                                    "email" => $this->email,
                                                    "contrasenia" => $contrasenia            
                                    );
                                    $resultado->actualizarContraseniaRecuperada($datosUsuario);
                                    // Si el servidor de base de datos no pudo ejecutar la actualización
                                    if(!$resultado){
                                        session_destroy();
                                        echo "<script>alert('Por el momento, su solicitud no puede ser procesada.');</script>";
                                        echo '<script>window.location = "index"</script>';
                                    }else{
                                        // Se actualizo correctamente, se envia el correo con la contraseña nueva.
                                        $Correo = "dhernandez@dhwebdesignmx.com";
                                        /* $Correo = $this->email; */
                                        /* $this->enviarCorreo($Correo, $enviarContrasenia); */
                                        session_destroy();
                                        echo "<script>alert('Sus nuevos datos de acceso fueron enviados a su correo electrónico.');</script>";
                                        echo '<script>window.location = "index"</script>';
                                    }                                    
                                }
                            }else{
                                // El usuario no existe en BBDD
                                session_destroy();
                                echo "<script>alert('No hay una cuenta registrada con ese usuario');</script>";
                                echo '<script>window.location = "index"</script>';
                            }                         
                        // No se pudieron ejecutar las validaciones del formulario y/o la actualizacion de datos con la BBDD
                        }catch(Exception $e){
                            session_destroy();
                            /* echo $e->getMessage(); */
                            echo "<script>alert('Error en la validacion de datos, intente mas tarde.');</script>";
                            echo '<script>window.location = "index"</script>';
                        }
                    }    
                // Hay campos vacios en el formulario           
                }else{     
                    session_destroy();
                    echo "<script>alert('Debe llenar todos los campos.');</script>";  
                    echo '<script>window.location = "index"</script>';     
                }            
            }                
        }
    }  
    
    /**
     * Envia la contraseña del usuario a un correo
     *
     * @param string $correo
     * Cadena de caracteres con un correo electrónico valido
     * @param string $contra
     * Cadena de caracteres representando una contraseña
     * 
     * @return void
     */
    public function enviarCorreo(string $correo, string $contra){
        $para = $correo;
        $as = 'Datos de Acceso';
        $saltolinea = "\r\n";
        $mensaje = 'DATOS DE LA CUENTA: '. $saltolinea . '' . $this->email . $saltolinea . '' . $contra;
        $encabezados = 'From: dhernandez@dhwebdesignmx.com';
        mail($para,$as,$mensaje,$encabezados);
    }

}

