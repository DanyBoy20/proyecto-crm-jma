<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

/**
 * Representa los empleados - modelo, hereda métodos de acceso a base de datos de la clase Conexión
 */
class EmpleadosModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    /**
     * Selecciona los empleados de la BBDD
     *
     * @return array
     * Arreglo de empleados devuelto en valores campo=>valor
     */
    public function consultar() : array {
        try {
            $this->bd->consultaSQL("SELECT idempleado, nombre, apellidopaterno, apellidomaterno, fecharegistro, correo, condicion, descripcion, foto FROM empleados
                                INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE condicion <> :condicion ");
            $this->bd->enlazarValor(':condicion', $this->condicion);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    /**
     * Busca y selecciona un empleado pasado por parametro
     *
     * @param string $valorBuscado
     * Cadena de caracteres a seleccionar/buscar en la BBDD 
     * @return array
     * Arreglo con los campos del empleado(s). 
     */
    public function buscarEmpleadolista(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT idempleado, nombre, apellidopaterno, apellidomaterno, fecharegistro, condicion, descripcion, correo FROM empleados INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE nombre LIKE '" . $valorBuscado . "%' OR apellidopaterno LIKE '" . $valorBuscado . "%' OR apellidomaterno LIKE '" . $valorBuscado . "%'");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    /**
     * Guarda el registro del nuevo empleado en la base de datos
     *
     * @param array $datos
     * Arreglo con los valores del empleado
     * @return bool
     * TRUE si la insercion fue exitosa, FALSE en caso contrario
     */
    public function guardar(array $datos) : bool {
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO empleados(nombre, apellidopaterno, apellidomaterno, direccion, ciudad, estado, codigopostal, colonia, numeromovil, numerotelefono, correo, contrasenia, idrol, condicion, fecharegistro, intentos, foto) VALUES (:nombre, :apellidopaterno, :apellidomaterno, :direccion, :ciudad, :estado, :codigopostal, :colonia, :numeromovil, :numerotelefono, :correo, :contrasenia, :idrol, :condicion, :fecharegistro, :intentos, :foto) ");
            $this->bd->enlazarValor(':nombre', $datos['nombre']);
            $this->bd->enlazarValor(':apellidopaterno', $datos['apellidop']);
            $this->bd->enlazarValor(':apellidomaterno', $datos['apellidom']);
            $this->bd->enlazarValor(':direccion', $datos['direccion']);
            $this->bd->enlazarValor(':ciudad', $datos['ciudad']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            $this->bd->enlazarValor(':codigopostal', $datos['cp']);
            $this->bd->enlazarValor(':colonia', $datos['colonia']);
            $this->bd->enlazarValor(':numeromovil', $datos['celular']);
            $this->bd->enlazarValor(':numerotelefono', $datos['telefono']);
            $this->bd->enlazarValor(':correo', $datos['email']);
            $this->bd->enlazarValor(':contrasenia', $datos['contrasenia']);
            $this->bd->enlazarValor(':idrol', $datos['rol']);
            $this->bd->enlazarValor(':condicion', $datos['condicion']);
            $this->bd->enlazarValor(':fecharegistro', $datos['fechareg']);
            $this->bd->enlazarValor(':intentos', $datos['intentos']);
            $this->bd->enlazarValor(':foto', $datos['foto']);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }       
    }

    /**
     * Selecciona los datos del empleado a actualizar
     *
     * @param string $dato
     * Cadena representando un correo valido
     * @return array
     * Arreglo devuelto con datos del empleado
     */
    public function consultaActualizar(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT direccion, ciudad, estado, numerotelefono, numeromovil, fecharegistro FROM empleados WHERE correo = :identificador");
            $this->bd->enlazarValor(':identificador', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (Exception $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    /**
     * Actualiza la contraseña del empleado
     *
     * @param array $dato
     * Cadena de caracteres con correo válido
     * @return bool
     * TRUE si la actualización fue correcta, FALSE en caso contrario
     */
    public function actualizarContrasenia(array $dato) : bool {
        try {
            $this->bd->consultaSQL("UPDATE empleados SET contrasenia = :nuevacontrasenia WHERE correo = :email");
            $this->bd->enlazarValor(':email', $dato['correo']);
            $this->bd->enlazarValor(':nuevacontrasenia', $dato['contraseniaActualizada']);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return true;
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            return false;
        }        
    }


    /**
     * Desactiva (eliminado logico) el registro
     *
     * @param array $dato
     * Arreglo con los datos del empleado a desactivar
     * @return bool
     * TRUE si la desactivación fue correcta, FALSE en caso contrario
     */
    public function eliminar(array $dato) : bool {
        #ELIMINADO LOGICO
        try {
            $this->bd->consultaSQL("UPDATE empleados SET condicion = :condicion WHERE correo = :email");
            $this->bd->enlazarValor(':condicion', $dato['condicion']);
            $this->bd->enlazarValor(':email', $dato['email']);
            $this->bd->ejecutar();
            return true;
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            return false;
        }
        #ELIMINADO FISICO - Se crea solo para presentación
        /* try {
            $this->bd->consultaSQL("DELETE FROM empleados WHERE correo = :email");
            $this->bd->enlazarValor(':email', $dato);
            $this->bd->ejecutar();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        } */ 
    }

    /**
     * Selecciona el empleado a visualizar
     *
     * @param string $dato
     * Cadena con un correo valido
     * @return array
     * Arreglo con los datos del empleado
     */
    public function verEmpleado(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT idempleado, nombre, apellidopaterno, apellidomaterno, direccion, ciudad, estado, codigopostal, colonia, numeromovil, numerotelefono, fecharegistro, correo, condicion, descripcion, foto FROM empleados
                                INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE correo = :correo ");
            $this->bd->enlazarValor(':correo', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    /**
     * Selecciona los datos del empleado a editar
     *
     * @param string $dato
     * Cadena con un correo válido
     * @return array
     * Arreglo con los datos del empleado
     */
    public function editarEmpleado(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT nombre, apellidopaterno, apellidomaterno, direccion, ciudad, estado, codigopostal, colonia, numeromovil, numerotelefono, correo, condicion, empleados.idrol AS rolid, tipoempleados.descripcion AS descripcionE FROM empleados INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE correo = :correo");
            $this->bd->enlazarValor(':correo', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    /**
     * Actualiza los datos del empleado
     *
     * @param array $datos
     * Arreglo con los datos del empleado a actualizar
     * @return bool
     * TRUE si actualizo el registro, FALSE en caso contrario
     */
    public function actualizarEmpleado(array $datos) : bool {
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE empleados SET nombre = :nombre, apellidopaterno = :apellidopaterno, apellidomaterno = :apellidomaterno, direccion = :direccion, ciudad = :ciudad, estado = :estado, codigopostal = :codigopostal, colonia = :colonia, numeromovil = :numeromovil, numerotelefono = :numerotelefono, idrol = :idrol, condicion = :condicion, foto = :foto WHERE correo = :correo");
            $this->bd->enlazarValor(':nombre', $datos['nombre']);
            $this->bd->enlazarValor(':apellidopaterno', $datos['apellidop']);
            $this->bd->enlazarValor(':apellidomaterno', $datos['apellidom']);
            $this->bd->enlazarValor(':direccion', $datos['direccion']);
            $this->bd->enlazarValor(':ciudad', $datos['ciudad']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            $this->bd->enlazarValor(':codigopostal', $datos['cp']);
            $this->bd->enlazarValor(':colonia', $datos['colonia']);
            $this->bd->enlazarValor(':numeromovil', $datos['celular']);
            $this->bd->enlazarValor(':numerotelefono', $datos['telefono']);
            $this->bd->enlazarValor(':idrol', $datos['rol']);
            $this->bd->enlazarValor(':condicion', $datos['condicion']);
            $this->bd->enlazarValor(':foto', $datos['foto']);
            $this->bd->enlazarValor(':correo', $datos['email']);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    }

    /* public function buscar($dato){} */

}