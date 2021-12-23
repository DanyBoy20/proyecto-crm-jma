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
class CapacitacionesModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    /* private $ultimoIdInsertado; */
    private $respuesta = true;

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: registro-capacitacion
    public function consultarProductoValido(int $dato) : int {
        try {
            $this->bd->consultaSQL("SELECT idproducto FROM productos
            WHERE idproducto = :producto"); 
            $this->bd->enlazarValor(':producto', $dato);        
            $this->bd->obtenerConjuntoRegistros1();
            $numeroRegistros = $this->bd->cantidadRegistros();
            return $numeroRegistros;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            return 0;
        }
    }

    // ********* PARA MOSTRAR EN: registro-capacitacion
    public function consultarCapacitacionValido(int $dato) : int {
        try {
            $this->bd->consultaSQL("SELECT idtipocapacitaciones, descripcion FROM tiposcapacitaciones
            WHERE idtipocapacitaciones = :idtipocapacitacion"); 
            $this->bd->enlazarValor(':idtipocapacitacion', $dato);        
            $this->bd->obtenerConjuntoRegistros1();
            $numeroRegistros = $this->bd->cantidadRegistros();
            return $numeroRegistros;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            return 0;
        }
    }

    // ********* PARA MOSTRAR EN: registro-capacitacion
    public function validarDatosHospital (int $hospital, int $contacto){
        try {
            $this->bd->consultaSQL("SELECT hospitales.idhospital, contactoshospital.idcontacto
            FROM hospitales INNER JOIN contactoshospital
            ON hospitales.idhospital = contactoshospital.idhospital
            WHERE hospitales.idhospital = :hospital
            AND contactoshospital.idcontacto = :contacto"); 
            $this->bd->enlazarValor(':hospital', $hospital);        
            $this->bd->enlazarValor(':contacto', $contacto);
            $this->bd->obtenerConjuntoRegistros1();
            $numeroRegistros = $this->bd->cantidadRegistros();
            return $numeroRegistros;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            /* $resultados = []; */
            return 0;
        }
    }

    // ********* PARA MOSTRAR EN: registro-capacitacion
    public function guardarCapacitacion(array $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO capacitaciones (idtipocapacitaciones, idhospital, idcontacto, fechasolicitudc, observaciones, estado) VALUES (:tipocapacitacion, :idhospital, :idcontacto, :fechasolicitud, :comentarios, :estado)");
            $this->bd->enlazarValor(':tipocapacitacion', $datos['tipocapacitacion']);
            $this->bd->enlazarValor(':idhospital', $datos['idhospital']);
            $this->bd->enlazarValor(':idcontacto', $datos['idcontacto']);
            $this->bd->enlazarValor(':fechasolicitud', $datos['fechasolicitud']);
            $this->bd->enlazarValor(':comentarios', $datos['observaciones']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            if($this->bd->ejecutar() === FALSE){
                $this->bd->deshacerTransaccion();
                $this->respuesta = false;
                return $this->respuesta;
            }else{
                $IdInsertado = $this->bd->idInsertado();
                $this->bd->consultaSQL("INSERT INTO capacitacionesdetalle (idcapacitacion, idproducto) VALUES (:idcapacitacion, :idproducto)");
                $this->bd->enlazarValor(':idcapacitacion', $IdInsertado);
                $this->bd->enlazarValor(':idproducto', $datos['idproducto']);
                $this->bd->ejecutar();
                $this->bd->consultaSQL("INSERT INTO indicadorescapacitaciones (idindicador, barra, estado) VALUES (:idindicador, :barra, :estado)");
                $this->bd->enlazarValor(':idindicador', $IdInsertado);
                $this->bd->enlazarValor(':barra', $datos['barra']);
                $this->bd->enlazarValor(':estado', $datos['estado']);
                $this->bd->ejecutar();
                $this->bd->ejecutarTransaccion();
                return $this->respuesta;
            }
        }catch(PDOException$e){            
            echo $e->getMessage();
            return false;
        }
    }












    
    public function consultar(){
        /* try {
            $this->bd->consultaSQL("SELECT hospitales.nombreh, demos.iddemostracion, demos.fechasolicitud, tiposdemos.descripcion, productos.pdescripcion
            FROM hospitales
            INNER JOIN demos ON hospitales.idhospital = demos.idhospital
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN demosdetalle ON demos.iddemostracion = demosdetalle.iddemostracion
            INNER JOIN productos ON demosdetalle.idproducto = productos.idproducto");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        } */
    }

    
    public function buscarEmpleadolista() {}

    
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