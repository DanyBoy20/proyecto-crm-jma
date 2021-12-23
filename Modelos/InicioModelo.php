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
class InicioModelo extends Conexion{

    private $bd;
    private $res = [];

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: inicio
    public function consultar() : array {
        try {

            $this->bd->consultaSQL("SELECT
                                    (SELECT COUNT(*) FROM hospitales) AS numhospitales, 
                                    (SELECT COUNT(*) FROM demos) AS numdemos");
            $resultados1 = $this->bd->obtenerConjuntoRegistros1();            

            $this->bd->consultaSQL("SELECT idhospital, nombreh, tipo, estadoh, municipioh, estado FROM hospitales");
            $resultados2 = $this->bd->obtenerConjuntoRegistros1();

            $this->bd->consultaSQL("SELECT hospitales.nombreh, demos.iddemostracion, demos.fechasolicitud, tiposdemos.descripcion, productos.pdescripcion FROM hospitales
            INNER JOIN demos ON hospitales.idhospital = demos.idhospital
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN demosdetalle ON demos.iddemostracion = demosdetalle.iddemostracion
            INNER JOIN productos ON demosdetalle.idproducto = productos.idproducto");
            $resultados3 = $this->bd->obtenerConjuntoRegistros1();
            return array($resultados1, $resultados2, $resultados3);

        } catch (PDOException $e) {

            /* echo $e->getMessage(); */
            $resultados1 = [];
            $resultados2 = [];
            $resultados3 = [];
            return array($resultados1, $resultados2, $resultados3);

        }
    }


}