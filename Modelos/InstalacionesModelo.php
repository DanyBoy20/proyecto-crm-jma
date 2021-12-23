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
class InstalacionesModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    /* private $ultimoIdInsertado; */
    private $respuesta = true;

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: registro-instalacion
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
            /* $resultados = []; */
            return 0;
        }
    }

    // ********* PARA MOSTRAR EN: registro-instalacion
    public function validarDatosHospital (int $hospital, int $contacto, int $area){
        try {
            $this->bd->consultaSQL("SELECT hospitales.idhospital, contactoshospital.idcontacto, areashospital.cvearea
            FROM hospitales INNER JOIN contactoshospital
            ON hospitales.idhospital = contactoshospital.idhospital
            INNER JOIN areashospital ON hospitales.idhospital = areashospital.idhospital
            WHERE hospitales.idhospital = :hospital
            AND contactoshospital.idcontacto = :contacto
            AND areashospital.cvearea = :area"); 
            $this->bd->enlazarValor(':hospital', $hospital);        
            $this->bd->enlazarValor(':contacto', $contacto);
            $this->bd->enlazarValor(':area', $area);
            $this->bd->obtenerConjuntoRegistros1();
            $numeroRegistros = $this->bd->cantidadRegistros();
            return $numeroRegistros;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            /* $resultados = []; */
            return 0;
        }

    }

    // ********* PARA MOSTRAR EN: registro-instalacion
    public function guardarInstalacion(array $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO instalaciones (idhospital, idcontacto, cvearea, ifechasolicitud, observaciones, estado) VALUES (:idhospital, :idcontacto, :cvearea, :fechasolicitud, :comentarios, :estado)");
            $this->bd->enlazarValor(':idhospital', $datos['idhospital']);
            $this->bd->enlazarValor(':idcontacto', $datos['idcontacto']);
            $this->bd->enlazarValor(':cvearea', $datos['cvearea']);
            $this->bd->enlazarValor(':fechasolicitud', $datos['ifechasolicitud']);
            $this->bd->enlazarValor(':comentarios', $datos['observaciones']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            if($this->bd->ejecutar() === FALSE){
                $this->bd->deshacerTransaccion();
                $this->respuesta = false;
                return $this->respuesta;
            }else{
                $IdInsertado = $this->bd->idInsertado();
                $this->bd->consultaSQL("INSERT INTO instalacionesdetalle (idinstalacion, idproducto) VALUES (:idinstalacion, :idproducto)");
                $this->bd->enlazarValor(':idinstalacion', $IdInsertado);
                $this->bd->enlazarValor(':idproducto', $datos['idproducto']);
                $this->bd->ejecutar();
                $this->bd->consultaSQL("INSERT INTO indicadoresinstalaciones (idindicador, barra, estado) VALUES (:indicador, :barra, :estado)");
                $this->bd->enlazarValor(':indicador', $IdInsertado);
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

    
    public function consultaActualizar(){}


    public function actualizarContrasenia(){}


    public function eliminar(){}

    public function verEmpleado(){}


    public function editarEmpleado(){}


    public function actualizarEmpleado(){}

}