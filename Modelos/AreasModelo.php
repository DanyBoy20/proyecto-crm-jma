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
class AreasModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    /* private $ultimoIdInsertado; */
    private $respuesta = true;

    function __construct(){
        $this->bd = new Conexion;        
    }
    
    // ********* PARA MOSTRAR EN: registro-areas
    public function guardar(string $dato) : bool {    
        
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO areas(descripcionarea) VALUES (:area)");
            $this->bd->enlazarValor(':area', $dato);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }    
            
    }

    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function guardarAreaHospital(array $datos) : bool{
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO areashospital(idarea, idhospital) VALUES (:idarea, :idhospital)");
            $this->bd->enlazarValor(':idarea', $datos['idarea']);
            $this->bd->enlazarValor(':idhospital', $datos['idhospital']);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }

    }

}