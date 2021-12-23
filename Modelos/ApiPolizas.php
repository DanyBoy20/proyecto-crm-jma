<?php  namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

 class ApiPolizas extends Conexion{

    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: registro-poliza
    public function seleccionarTiposPolizas(){
        try {
            $this->bd->consultaSQL("SELECT idtipopoliza, descripcion FROM tipospolizas");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }


 }