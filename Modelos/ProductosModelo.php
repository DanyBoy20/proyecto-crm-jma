<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";


class ProductosModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    private $res = [];

    function __construct(){
        $this->bd = new Conexion;        
    }    

    // ********* PARA MOSTRAR EN: registro-equipos
    public function listaCategorias() : array {
        try {
            $this->bd->consultaSQL("SELECT idcategoria, descripcioncategoria FROM categorias");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    // ********* PARA MOSTRAR EN: registro-equipos
    public function listaMarcas() : array {
        try {
            $this->bd->consultaSQL("SELECT idmarca, descripcionm FROM marcas");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

}