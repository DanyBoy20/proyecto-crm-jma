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
class TablasModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    /* private $ultimoIdInsertado; */
    private $respuesta = true;

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: registro-poliza
    public function consultarCategoriaValido(int $dato) : int {
        try {
            $this->bd->consultaSQL("SELECT idcategoria, descripcioncategoria FROM categorias
            WHERE idcategoria = :categoria"); 
            $this->bd->enlazarValor(':categoria', $dato);        
            $this->bd->obtenerConjuntoRegistros1();
            $numeroRegistros = $this->bd->cantidadRegistros();
            return $numeroRegistros;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            return 0;
        }
    }

    // ********* PARA MOSTRAR EN: registro-poliza
    public function consultarMarcaValido(int $dato) : int {
        try {
            $this->bd->consultaSQL("SELECT idmarca, descripcionm FROM marcas
            WHERE idmarca = :idmarca"); 
            $this->bd->enlazarValor(':idmarca', $dato);        
            $this->bd->obtenerConjuntoRegistros1();
            $numeroRegistros = $this->bd->cantidadRegistros();
            return $numeroRegistros;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            return 0;
        }
    }

    // ********* PARA MOSTRAR EN: registro-categoria 
    public function guardarCategoria(string $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO categorias (descripcioncategoria) VALUES (:categoria) ");
            $this->bd->enlazarValor(':categoria', $datos);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    }

    // ********* PARA MOSTRAR EN: registro marca
    public function guardarMarca(string $datos){

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO marcas (descripcionm) VALUES (:marca) ");
            $this->bd->enlazarValor(':marca', $datos);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
        
    }

    // ********* PARA MOSTRAR EN: registro marca
    public function guardarProducto(array $datos){

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO productos (pdescripcion, modelo, idcategoria, idmarca) VALUES (:descripcion, :modelo, :idcategoria, :idmarca)");
            $this->bd->enlazarValor(':descripcion', $datos['producto']);
            $this->bd->enlazarValor(':modelo', $datos['modelo']);            
            $this->bd->enlazarValor(':idcategoria', $datos['categoria']);            
            $this->bd->enlazarValor(':idmarca', $datos['marca']);            
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
        
    }

    public function guardarCargo(string $dato){

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO cargoscontactos (descripcioncargo) VALUES (:cargo) ");
            $this->bd->enlazarValor(':cargo', $dato);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            /* echo $e->getMessage(); */
            return false;
        }
        
    }    

    public function guardarDemo(string $dato){

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO tiposdemos (descripcion) VALUES (:demo) ");
            $this->bd->enlazarValor(':demo', $dato);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            /* echo $e->getMessage(); */
            return false;
        }
        
    } 

    public function guardarCapacitacion(string $dato){

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO tiposcapacitaciones (descripcion) VALUES (:capacitacion) ");
            $this->bd->enlazarValor(':capacitacion', $dato);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            /* echo $e->getMessage(); */
            return false;
        }
        
    } 

    public function guardarPoliza(string $dato){

        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO tipospolizas (descripcion) VALUES (:poliza) ");
            $this->bd->enlazarValor(':poliza', $dato);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            /* echo $e->getMessage(); */
            return false;
        }
        
    }
    







    public function guardar(array $datos) : bool {        
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO demos (idtipodemo, idhospital, idcontacto, fechasolicitud, comentarios, estado) VALUES (:idtipodemo, :idhospital, :idcontacto, :fechasolicitud, :comentarios, :estado)");
            $this->bd->enlazarValor(':idtipodemo', $datos['tipodemo']);
            $this->bd->enlazarValor(':idhospital', $datos['idhospital']);
            $this->bd->enlazarValor(':idcontacto', $datos['solicitante']);
            $this->bd->enlazarValor(':fechasolicitud', $datos['fechasolicitud']);
            $this->bd->enlazarValor(':comentarios', $datos['mensaje']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            if($this->bd->ejecutar() === FALSE){
                $this->bd->deshacerTransaccion();
                $this->respuesta = false;
                return $this->respuesta;
            }else{
                $IdInsertado = $this->bd->idInsertado();
                $this->bd->consultaSQL("INSERT INTO demosdetalle (iddemostracion, idproducto) VALUES (:iddemostracion, :idproducto)");
                $this->bd->enlazarValor(':iddemostracion', $IdInsertado);
                $this->bd->enlazarValor(':idproducto', $datos['idproducto']);
                $this->bd->ejecutar();
                $this->bd->ejecutarTransaccion();
                return $this->respuesta;
            }
        }catch(PDOException$e){            
            echo $e->getMessage();
            return false;
        }       
    }


}