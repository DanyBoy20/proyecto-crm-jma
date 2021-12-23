<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use Modelos\IngresoModelo;
use Servicios\Googlercptch;
class IngresoControlador{

    /**
     * Almacenara el numero de intentos de ingreso
     *
     * @var int
     */
    private $intentos;

    /**
     * Almacenara un valor a la condicion del usuario (activo/eliminado/desactivado)
     *
     * @var string
     */
    private $estadoCuenta;

    /**
     * Contiene la expresion regular para validar la contraseña
     *
     * @var string
     */
    private $regexContrasenia = '/^(?=.{8,12}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).+$/';

    public function inicioSesionControlador(){
        // Si estan definidas, significa que ya envio el formulario
        if(isset($_POST["usuario"]) && isset($_POST["contrasenia"]) && isset($_POST['g-recaptcha-response'])){
            $captcha = new Googlercptch();
            $captcha_success = $captcha->verificarGoogleCaptcha($_POST['g-recaptcha-response']);
            // no paso la validacion de google reCAPTCHA
	        if ($captcha_success->success==false) {
                session_destroy();
            echo "<script>alert('Debe verificar el cuadro *No soy un robot*');</script>";
            // Paso la validación de googl reCaptcha
	        } else {
                // si el campo usuario y contraseña contienen datos (no se enviaron vacios)
                if(trim(!empty($_POST["usuario"])) && trim(!empty($_POST["contrasenia"]))){
                    if (filter_var($_POST["usuario"], FILTER_VALIDATE_EMAIL) === false) {
                        session_destroy();
                        echo "<script>alert('El correo no es valido.');</script>";
                    }else if(strlen($_POST["usuario"]) < 10 || strlen($_POST["usuario"]) > 50) {
                        session_destroy();
                        echo "<script>alert('El correo debe ser mayor a 10 caracteres.');</script>";
                    }else if(strlen($_POST["contrasenia"]) < 8 || strlen($_POST["contrasenia"]) > 12) {
                        session_destroy();
                        echo "<script>alert('La contraseña debe ser de 8 a 12 caracteres.');</script>";
                    }else if(!preg_match($this->regexContrasenia, $_POST["contrasenia"])) {
                        session_destroy();
                        echo "<script>alert('La contraseña debe tener al menos\n * Una letra mayuscula,\n * Una letra minuscula,\n * Un numero \n * Un simbolo');</script>";
                    // Paso la validacion de datos del usuario
                    }else{
                        // Manejo de errores con try catch
                        try{    
                            $inicioSesion = new IngresoModelo();
                            $respuesta = $inicioSesion->inicioSesionModelo($_POST["usuario"]);
                            // Validamos el correo enviado con el correo devuelto por la BBDD
                            if($_POST["usuario"] == $respuesta["correo"]){
                                $this->intentos = $respuesta['intentos'];
                                // Si los intentos de ingreso son menores a 3 (<=2)
                                if ($this->intentos <= 2) {                                   
                                    if(password_verify( $_POST["contrasenia"], $respuesta['contrasenia'])){ 
                                        $this->intentos = 0;  
                                        $datosUsuario = array("usuario" => $_POST["usuario"], "intentos" => $this->intentos);
                                        $inicioSesion->intentosIngreso($datosUsuario);
                                        $_SESSION['validar'] = true;
                                        $_SESSION['identificador'] = $respuesta["idusuario"];
                                        $_SESSION['nombre'] = $respuesta["nombre"];
                                        $_SESSION['apellidop'] = $respuesta["apellidop"];
                                        $_SESSION['apellidom'] = $respuesta["apellidom"];
                                        $_SESSION['rol'] = $respuesta["descripcion"];
                                        $_SESSION['foto'] = $respuesta["foto"];
                                        $_SESSION['correo'] = $respuesta["correo"];
                                        $_SESSION['idrol'] = $respuesta["rol"];
                                        echo '<script>window.location.href = "inicio"</script>';  
                                    }else{
                                        session_destroy();
                                        ++$this->intentos;
                                        $datosUsuario = array("usuario" => $_POST["usuario"], "intentos" => $this->intentos);
                                        $inicioSesion->intentosIngreso($datosUsuario);                                       
                                        echo "<script>alert('Los datos que ingreso son incorrectos.');</script>";    
                                    }                                    
                                }else{
                                    // Supero el maximo de intentos de ingreso, se bloquea la cuenta
                                    $this->estadoCuenta = 'Bloqueado';
                                    session_destroy();
                                    $datosUsuario = array("usuario" => $_POST["usuario"], "intentos" => $this->intentos, "condicion" => $this->estadoCuenta);
                                    $inicioSesion->bloquearCuenta($datosUsuario);
                                    echo "<script>alert('Supero el limite de intentos de acceso, su cuenta esta bloqueada, contacte al administrador.');</script>";
                                    /* echo '<script>window.location = "desbloquear-cuenta"</script>'; */
                                }
                            }else{
                                // El usuario que intenta ingresar no existe
                                session_destroy();
                                echo "<script>alert('No hay una cuenta registrada con ese usuario');</script>";
                            } 
                        // No se pudieron ejecutar las validaciones del formulario y/o la actualizacion de datos con la BBDD                   
                        }catch(Exception $e){
                            session_destroy();
                            /* echo $e->getMessage(); */
                            echo "<script>alert('Error en la validacion de datos, intente mas tarde.');</script>";
                        }
                    } 
                // hay campos vacios en el formulario              
                }else{     
                    session_destroy();
                    echo "<script>alert('Debe llenar todos los campos.');</script>";       
                }            
            }                
        }
    }  

}

