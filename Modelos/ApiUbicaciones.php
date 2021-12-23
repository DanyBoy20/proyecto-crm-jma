<?php  namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

 class ApiUbicaciones extends Conexion{

    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    public function seleccionarMunicipio(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT idmunicipio, municipio FROM municipiosestado INNER JOIN estadospais ON municipiosestado.idestado = estadospais.idestado WHERE estadospais.estado = :identificador");
            $this->bd->enlazarValor(':identificador', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (Exception $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarEstados(){
        try {
            $this->bd->consultaSQL("SELECT idestado, estado FROM estadospais");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }

    }

 }