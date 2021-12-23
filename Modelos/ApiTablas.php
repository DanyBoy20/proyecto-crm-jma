<?php  namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";

 class ApiTablas extends Conexion{

    private $bd;

    function __construct(){
        $this->bd = new Conexion;        
    }

    
    public function seleccionarCategorias(){
        try {
            $this->bd->consultaSQL("SELECT * FROM categorias ORDER BY idcategoria ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarMarcas(){
        try {
            $this->bd->consultaSQL("SELECT * FROM marcas ORDER BY idmarca ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarEquipos(){
        try {
            $this->bd->consultaSQL("SELECT categorias.descripcioncategoria, productos.pdescripcion, productos.modelo, marcas.descripcionm
            FROM categorias INNER JOIN productos ON categorias.idcategoria = productos.idcategoria INNER JOIN marcas ON productos.idmarca = marcas.idmarca ORDER BY productos.idproducto ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarAreas(){
        try {
            $this->bd->consultaSQL("SELECT idarea, descripcionarea FROM areas ORDER BY idarea ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarCargos(){
        try {
            $this->bd->consultaSQL("SELECT idcargo, descripcioncargo FROM cargoscontactos ORDER BY idcargo ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarDemos(){
        try {
            $this->bd->consultaSQL("SELECT idtipodemo, descripcion FROM tiposdemos ORDER BY idtipodemo ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarCapacitaciones(){
        try {
            $this->bd->consultaSQL("SELECT idtipocapacitaciones, descripcion FROM tiposcapacitaciones ORDER BY idtipocapacitaciones ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    public function seleccionarTipoPolizas(){
        try {
            $this->bd->consultaSQL("SELECT idtipopoliza, descripcion FROM tipospolizas ORDER BY idtipopoliza ASC");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }


 }