<?php  namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

 class ApiDemos extends Conexion{

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

    // ********* PARA MOSTRAR EN: solicitud-demostracion
    public function seleccionarDemos(){
        try {
            $this->bd->consultaSQL("SELECT idtipodemo, descripcion FROM tiposdemos");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | solicitud-demostracion | registro-poliza
    public function seleccionarProductos(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT idproducto, pdescripcion AS descripcion, modelo, descripcioncategoria AS categoria, descripcionm AS marca FROM productos INNER JOIN categorias ON productos.idcategoria = categorias.idcategoria INNER JOIN marcas ON productos.idmarca = marcas.idmarca 
            WHERE pdescripcion LIKE '" . $valorBuscado . "%'");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | registro-contactos | solicitud-demostracion | registro-poliza
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


    // ********* PARA MOSTRAR EN: demos
    public function consultar(){
        try {
            $this->bd->consultaSQL("SELECT hospitales.nombreh, demos.iddemostracion, demos.fechasolicitud, tiposdemos.descripcion, productos.pdescripcion
            FROM hospitales
            INNER JOIN demos ON hospitales.idhospital = demos.idhospital
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN demosdetalle ON demos.iddemostracion = demosdetalle.iddemostracion
            INNER JOIN productos ON demosdetalle.idproducto = productos.idproducto");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }

    }

    // ********* PARA MOSTRAR EN: demos
    public function seleccionarDemoFiltrado(string $dato) : array{
        try {
            $this->bd->consultaSQL("SELECT nombreh, demos.iddemostracion AS demoId, fechasolicitud, descripcion, pdescripcion
            FROM hospitales
            INNER JOIN demos ON hospitales.idhospital = demos.idhospital
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN demosdetalle ON demos.iddemostracion = demosdetalle.iddemostracion
            INNER JOIN productos ON demosdetalle.idproducto = productos.idproducto
            WHERE tiposdemos.descripcion LIKE '".$dato."%' 
            OR hospitales.nombreh LIKE '".$dato."%'");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

 }