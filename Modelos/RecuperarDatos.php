<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use \PDOException;

/**
 * Representa la recuperación de datos - modelo, hereda metodos de acceso a base de datos de la clase Conexion
 */
class RecuperarDatos extends Conexion{

    private $bd;
    private $estadoempleado = "activo";

    function __construct(){
        $this->bd = new Conexion;        
    }

    /**
     * Selecciona un empleado y devuelve sus datos en un arreglo
     * 
     * @param string $datosSesion
     * Cadena de caracteres con un correo electronico valido 
     * @return array
     * Arreglo devuelto en valores campo=>valor
     */
    public function recuperarAcceso(string $datosSesion) : array {        
        /* $this->bd->consultaSQL("SELECT correo, condicion
                                FROM usuarios 
                                WHERE correo = :usuario");
        $this->bd->enlazarValor(':usuario', $datosSesion);
        $resultados = $this->bd->obtenerRegistro();
        return $resultados; */
        $this->bd->consultaSQL("SELECT correo, condicion
                                FROM usuarios 
                                WHERE correo = :usuario");
        $this->bd->enlazarValor(':usuario', $datosSesion);
        $resultados = $this->bd->obtenerRegistro();
        if($resultados){
            $respuesta = $resultados;            
        }else{
            $respuesta = array(
                "email" => "incorrectoemail@incorrecto.com",
                "contrasenia" => "passwordincorrecto"           
            );            
        }
        return $respuesta;
    }


    /**
     * Actualiza la contraseña del empleado y devuelve un valor booleano
     * 
     * @param array $datosUsuario
     * Arreglo con los datos del empleado a actualizar
     * @return bool
     * TRUE si la actualización fue exitosa, FALSE en caso contrario
     */
    public function actualizarContraseniaRecuperada(array $datosUsuario) : bool {
        try {
            $this->bd->consultaSQL("UPDATE usuarios SET contrasenia = :contrasenia WHERE correo = :usuario");
            $this->bd->enlazarValor('contrasenia', $datosUsuario['contrasenia']);
            $this->bd->enlazarValor(':usuario', $datosUsuario['email']);
            $this->bd->ejecutar();
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}