<?php  namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

 class ApiAreasHospital extends Conexion{

    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function seleccionarAreas(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT idarea, descripcionarea FROM areas WHERE descripcionarea LIKE '" . $valorBuscado . "%'");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function seleccionarHospitales(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT idhospital, nombreh, estadoh FROM hospitales
            WHERE nombreh LIKE '" . $valorBuscado . "%' ORDER BY idhospital");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-contactos | registro-poliza
    public function seleccionarAreasHospital(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT areas.descripcionarea, areashospital.cvearea FROM areas INNER JOIN areashospital ON areas.idarea = areashospital.idarea WHERE areashospital.idhospital = :idhospital");
            $this->bd->enlazarValor(':idhospital', $valorBuscado);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }
    }

 }