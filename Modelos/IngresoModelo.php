<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use \PDOException;

/**
 * Representara el ingreso al sistema, hereda metodos de acceso a base de datos de la clase Conexion
 */
class IngresoModelo extends Conexion{

    private $bd;
    private $estadoempleado = "activo";

    function __construct(){
        $this->bd = new Conexion;        
    }

    /**
     * Selecciona los datos de acceso a ser evaluados.
     * 
     * @param string $datosSesion
     * Cadena de caracteres con el correo del usuario
     * @return array
     * Arreglo con los datos de acceso del usuario
     */
    public function inicioSesionModelo(string $datosSesion) : array {  
        $error = array("correo" => "noexiste123456@correonoexiste.com", "intentos" => 3);
        try {
            $this->bd->consultaSQL("SELECT idusuario, nombre, apellidop, apellidom, correo, contrasenia, usuarios.idrol as rol, intentos, foto, descripcion
            FROM usuarios INNER JOIN rolesusuario ON usuarios.idrol = rolesusuario.idrol
            WHERE correo = :usuario AND condicion = :condicion");
            $this->bd->enlazarValor(':usuario', $datosSesion);
            $this->bd->enlazarValor(':condicion', $this->estadoempleado);
            $resultados = $this->bd->obtenerRegistro();
            $arreglo = $resultados ? $resultados : $error;            
            return $arreglo; 
        } catch(PDOException $e){
            echo $e->getMessage();
            return $error;
        }
    }

    /**
     * Actualiza los intentos de ingreso en la base de datos
     * 
     * @param array $datosUsuario
     * Arreglo con el usuario e intentos a actualizar
     * @return void
     */
    public function intentosIngreso(array $datosUsuario){
        $this->bd->consultaSQL("UPDATE usuarios SET intentos = :intentos WHERE correo = :usuario");
        $this->bd->enlazarValor(':intentos', $datosUsuario['intentos']);
        $this->bd->enlazarValor(':usuario', $datosUsuario['usuario']);
        $this->bd->ejecutar();
    }

    /**
     * Actualiza la cuenta del usuario (valor = bloqueado)
     * 
     * @param array $datosUsuario
     * Arreglo con los datos del usuario a actualizar
     * @return void
     */
    public function bloquearCuenta(array $datosUsuario){
        $this->bd->consultaSQL("UPDATE usuarios SET condicion = :condicion, intentos = :intentos WHERE correo = :usuario");
        $this->bd->enlazarValor(':condicion', $datosUsuario['condicion']);
        $this->bd->enlazarValor(':intentos', $datosUsuario['intentos']);
        $this->bd->enlazarValor(':usuario', $datosUsuario['usuario']);
        $this->bd->ejecutar();
    }

}