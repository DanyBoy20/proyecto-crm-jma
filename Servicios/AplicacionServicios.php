<?php
namespace Servicios;
/* include ("Constantes.php"); */
use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class AplicacionServicios {

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

    /* private $soloNumeros = SOLO_NUMEROS; */
    
    static function crearContrasenia(int $longitud) : string {
            $minusculas = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
            $mayusculas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $simbolos = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}');
            $numeros = array('0','1','2','3','4','5','6','7','8','9');
            $arregloCompleto = array($minusculas, $mayusculas, $simbolos, $numeros);             
            $contrasenia = $minusculas[array_rand($minusculas, 1)];
            $contrasenia = $contrasenia . $mayusculas[array_rand($mayusculas, 1)];
            $contrasenia = $contrasenia . $simbolos[array_rand($simbolos, 1)];
            $contrasenia = $contrasenia . $numeros[array_rand($numeros, 1)];  
            for($i = strlen($contrasenia); $i < max(8, $longitud); $i++){
                $temporal = $arregloCompleto[array_rand($arregloCompleto, 1)];
                $contrasenia = $contrasenia . $temporal[array_rand($temporal, 1)];
            }
            return str_shuffle($contrasenia);
    }    
    
    public function enviarCorreo(string $correoelectronico){
        $para = $correoelectronico;
        $as = 'Cuenta de empleado creada';
        $saltolinea = "\r\n";
        $mensaje = 'DATOS DE LA CUENTA CREADA: '. $saltolinea . '' . $this->nombre . $saltolinea . '' . $this->email . $saltolinea . '' . $this->claveacceso;
        $encabezados = 'From: ' . $correoelectronico;
        try {
            mail($para,$as,$mensaje,$encabezados);
        } catch (Exception $e) {
            
            echo '<script type="text/javascript">alert("OCURRIÓ UN PROBLEMA AL ENVIAR LOS DATOS POR CORREO ELECTRÓNICO");</script>';
        }

    }

    public function validarNumero(int $numero){
        /* if (trim($numero) == '') {
            $this->errores[] = '\nEl campo tipo de demostración es requerido';
        } */
        if (preg_match('/^[0-9]*$/', $numero) == 0) {
            $this->errores[] = '\nEl valor del identificador de capacitacion es incorrecto';
        }
        // 100 equivale el numero de demostraciones, incrementar segun necesidades
        if (strlen($numero) < 0 || strlen($numero) > 100) {
            $this->errores[] = '\nLongitud de campo identificador demostracion invalido';
        }
    }


}
