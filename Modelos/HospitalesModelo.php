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
class HospitalesModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    private $vacio = [];

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: expedientes
    public function consultar() : array {
        try {
            $this->bd->consultaSQL("SELECT idhospital, nombreh, tipo, estadoh, municipioh, estado FROM hospitales");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: expedientes
    public function buscarHospitallista(string $valorBuscado) : array {
        try {
            /* $stmt = "SELECT idhospital, nombreh, tipo, estadoh, municipioh FROM hospitales WHERE nombreh LIKE '" . $valorBuscado . " %' OR tipo LIKE '" . $valorBuscado . " %' OR estadoh LIKE '" . $valorBuscado . " %' OR municipioh LIKE '" . $valorBuscado . " %'"; */
            $this->bd->consultaSQL("SELECT idhospital, nombreh, tipo, estadoh, municipioh, estado 
            FROM hospitales 
            WHERE nombreh LIKE '" . $valorBuscado . "%' 
            OR tipo LIKE '" . $valorBuscado . "%' 
            OR estadoh LIKE '" . $valorBuscado . "%' 
            OR municipioh LIKE '" . $valorBuscado . "%'");
            /* $this->bd->enlazarValor(':condicion', $valorBuscado); */
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    // ********* PARA MOSTRAR EN: registro-hospital
    public function guardar(array $datos) : bool {
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO hospitales(nombreh, tipo, direccionh, estadoh, municipioh, cp, coloniah, fecharegistroh, telefonoh, estado) VALUES (:nombre, :tipo, :direccionh, :estadoh, :municipioh, :cp, :coloniah, :fecharegistroh, :telefono, :estatus) ");
            $this->bd->enlazarValor(':nombre', $datos['nombre']);
            $this->bd->enlazarValor(':tipo', $datos['tipohospital']);            
            $this->bd->enlazarValor(':direccionh', $datos['direccion']);            
            $this->bd->enlazarValor(':estadoh', $datos['estado']);
            $this->bd->enlazarValor(':municipioh', $datos['ciudad']);
            $this->bd->enlazarValor(':cp', $datos['cp']);
            $this->bd->enlazarValor(':coloniah', $datos['colonia']);
            $this->bd->enlazarValor(':fecharegistroh', $datos['fechareg']);
            $this->bd->enlazarValor(':telefono', $datos['telefono']);
            $this->bd->enlazarValor(':estatus', $datos['estatus']);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }       
    }

    
    public function consultaActualizar(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT direccion, ciudad, estado, numerotelefono, numeromovil, fecharegistro FROM empleados WHERE correo = :identificador");
            $this->bd->enlazarValor(':identificador', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (Exception $e) {
            echo $e->getMessage();
            $resultados = [];
            return $resultados;
        }
    }

    
    public function actualizarContrasenia(array $dato) : bool {
        try {
            $this->bd->consultaSQL("UPDATE empleados SET contrasenia = :nuevacontrasenia WHERE correo = :email");
            $this->bd->enlazarValor(':email', $dato['correo']);
            $this->bd->enlazarValor(':nuevacontrasenia', $dato['contraseniaActualizada']);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return true;
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            return false;
        }        
    }


    
    public function eliminar(array $dato) : bool {
        #ELIMINADO LOGICO
        try {
            $this->bd->consultaSQL("UPDATE empleados SET condicion = :condicion WHERE correo = :email");
            $this->bd->enlazarValor(':condicion', $dato['condicion']);
            $this->bd->enlazarValor(':email', $dato['email']);
            $this->bd->ejecutar();
            return true;
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            return false;
        }
        #ELIMINADO FISICO - Se crea solo para presentación
        /* try {
            $this->bd->consultaSQL("DELETE FROM empleados WHERE correo = :email");
            $this->bd->enlazarValor(':email', $dato);
            $this->bd->ejecutar();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        } */ 
    }

    
    /* public function verHospital(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT nombreh, tipo, direccionh, estadoh, municipioh, cp, coloniah, fecharegistroh, telefonoh, 
            titulo, hnombre, hapellidop, hapellidom, hcorreoc, telc, descripcioncargo, descripcionarea 
            FROM hospitales
            INNER JOIN contactoshospital ON hospitales.idhospital = contactoshospital.idhospital
            INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo
            INNER JOIN areashospital ON contactoshospital.cvearea = areashospital.cvearea
            INNER JOIN areas ON areashospital.idarea = areas.idarea WHERE hospitales.idhospital = :hospital");            
            $this->bd->enlazarValor(':hospital', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }
    } */


    public function verHospitalContactosInstlacionesDemos(string $dato) : array {
        try {

            $this->bd->consultaSQL("SELECT nombreh, tipo, direccionh, estadoh, municipioh, cp, coloniah, fecharegistroh, telefonoh, 
            titulo, hnombre, hapellidop, hapellidom, hcorreoc, telc, descripcioncargo, descripcionarea 
            FROM hospitales
            INNER JOIN contactoshospital ON hospitales.idhospital = contactoshospital.idhospital
            INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo
            INNER JOIN areashospital ON contactoshospital.cvearea = areashospital.cvearea
            INNER JOIN areas ON areashospital.idarea = areas.idarea WHERE hospitales.idhospital = :hospital ORDER BY cargoscontactos.idcargo ASC");            
            $this->bd->enlazarValor(':hospital', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();

            $this->bd->consultaSQL("SELECT
            productos.pdescripcion, instalacionesdetalle.numeroserie, areas.descripcionarea, salashospital.descripcionsala, instalaciones.ifechaprogramada AS fechainstalado, instalaciones.estado
            FROM productos
            INNER JOIN instalacionesdetalle ON productos.idproducto = instalacionesdetalle.idproducto
            INNER JOIN instalaciones ON instalacionesdetalle.idinstalacion = instalaciones.idinstalacion
            INNER JOIN areashospital ON instalaciones.cvearea = areashospital.cvearea
            INNER JOIN areas ON areashospital.idarea = areas.idarea
            INNER JOIN salashospital ON instalacionesdetalle.idsala = salashospital.idsala
            WHERE instalaciones.idhospital = :hospital1");            
            $this->bd->enlazarValor(':hospital1', $dato);
            $resultados1 = $this->bd->obtenerConjuntoRegistros1();

            $this->bd->consultaSQL("SELECT areas.descripcionarea, contactoshospital.titulo, contactoshospital.hnombre, contactoshospital.hapellidop, contactoshospital.hapellidom, cargoscontactos.descripcioncargo, demos.fechasolicitud, demos.estado, tiposdemos.descripcion, productos.pdescripcion
            FROM areas
            INNER JOIN areashospital ON areas.idarea = areashospital.idarea
            INNER JOIN contactoshospital ON areashospital.cvearea = contactoshospital.cvearea
            INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo
            INNER JOIN demos ON contactoshospital.idcontacto = demos.idcontacto
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN demosdetalle ON demos.iddemostracion = demosdetalle.iddemostracion
            INNER JOIN productos ON demosdetalle.idproducto = productos.idproducto
            WHERE demos.idhospital = :hospital1");            
            $this->bd->enlazarValor(':hospital1', $dato);
            $resultados2 = $this->bd->obtenerConjuntoRegistros1();

            return array($resultados, $resultados1, $resultados2);
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    public function verHospitalInicial($dato) : array {
        $this->bd->consultaSQL("SELECT nombreh, tipo, direccionh, estadoh, municipioh, cp, coloniah, fecharegistroh, telefonoh FROM hospitales WHERE idhospital = :hospital ORDER BY idhospital ASC");            
        $this->bd->enlazarValor(':hospital', $dato);
        $hospital = $this->bd->obtenerConjuntoRegistros1();
        return $hospital;
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    public function verContacto(string $dato) : array {
        $this->bd->consultaSQL("SELECT titulo, hnombre, hapellidop, hapellidom, hcorreoc, telc, descripcioncargo,descripcionarea FROM contactoshospital INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo INNER JOIN areashospital ON contactoshospital.cvearea = areashospital.cvearea INNER JOIN areas ON areashospital.idarea = areas.idarea WHERE contactoshospital.idhospital = :hospital ORDER BY contactoshospital.idhospital ASC");
        $this->bd->enlazarValor(':hospital', $dato);
        $contacto1 = $this->bd->obtenerConjuntoRegistros1();
        $contacto = $contacto1 ?: $this->vacio;
        return $contacto;
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    public function verEquipos(string $dato) : array {
        /* $this->bd->consultaSQL("SELECT productos.pdescripcion, instalacionesdetalle.numeroserie, areas.descripcionarea, salashospital.descripcionsala, instalaciones.ifechaprogramada AS fechainstalado, instalaciones.estado FROM productos INNER JOIN instalacionesdetalle ON productos.idproducto = instalacionesdetalle.idproducto INNER JOIN instalaciones ON instalacionesdetalle.idinstalacion = instalaciones.idinstalacion INNER JOIN areashospital ON instalaciones.cvearea = areashospital.cvearea INNER JOIN areas ON areashospital.idarea = areas.idarea INNER JOIN salashospital ON instalacionesdetalle.idsala = salashospital.idsala WHERE instalaciones.idhospital = :hospital1"); */      
        $this->bd->consultaSQL("SELECT productos.pdescripcion, instalacionesdetalle.numeroserie, areas.descripcionarea, instalaciones.ifechasolicitud AS fechasol, instalaciones.ifechaprogramada AS fechainstalado, instalaciones.estado, indicadoresinstalaciones.barra
        FROM productos 
        INNER JOIN instalacionesdetalle ON productos.idproducto = instalacionesdetalle.idproducto 
        INNER JOIN instalaciones ON instalacionesdetalle.idinstalacion = instalaciones.idinstalacion 
        INNER JOIN areashospital ON instalaciones.cvearea = areashospital.cvearea 
        INNER JOIN areas ON areashospital.idarea = areas.idarea 
        INNER JOIN indicadoresinstalaciones ON instalaciones.idinstalacion = indicadoresinstalaciones.idindicador
        WHERE instalaciones.idhospital = :hospital1");      
        $this->bd->enlazarValor(':hospital1', $dato);
        $resultados = $this->bd->obtenerConjuntoRegistros1();
        $equipos = $resultados ?: $this->vacio;
        return $equipos;
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    public function verDemos(string $dato) : array {
        $this->bd->consultaSQL("SELECT areas.descripcionarea, contactoshospital.titulo, contactoshospital.hnombre, contactoshospital.hapellidop, contactoshospital.hapellidom, cargoscontactos.descripcioncargo, demos.iddemostracion, demos.fechasolicitud, demos.estado, tiposdemos.descripcion, productos.pdescripcion, indicadoresdemos.barra 
        FROM areas 
        INNER JOIN areashospital ON areas.idarea = areashospital.idarea 
        INNER JOIN contactoshospital ON areashospital.cvearea = contactoshospital.cvearea 
        INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo 
        INNER JOIN demos ON contactoshospital.idcontacto = demos.idcontacto 
        INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo 
        INNER JOIN demosdetalle ON demos.iddemostracion = demosdetalle.iddemostracion 
        INNER JOIN productos ON demosdetalle.idproducto = productos.idproducto
        INNER JOIN indicadoresdemos ON demos.iddemostracion = indicadoresdemos.idindicador
        WHERE demos.idhospital = :hospital1");            
        $this->bd->enlazarValor(':hospital1', $dato);
        $resultados = $this->bd->obtenerConjuntoRegistros1();
        $demos = $resultados ?: $this->vacio;
        return $demos;
    }

    // ********* PARA MOSTRAR EN: expediente-hospital
    public function verCapacitaciones(string $dato) : array {
        $this->bd->consultaSQL("SELECT tiposcapacitaciones.descripcion, contactoshospital.titulo, contactoshospital.hnombre, contactoshospital.hapellidop, cargoscontactos.descripcioncargo, capacitaciones.idcapacitacion, capacitaciones.fechasolicitudc, capacitaciones.observaciones, capacitaciones.estado, productos.pdescripcion, indicadorescapacitaciones.barra FROM tiposcapacitaciones INNER JOIN capacitaciones ON tiposcapacitaciones.idtipocapacitaciones = capacitaciones.idtipocapacitaciones INNER JOIN capacitacionesdetalle ON capacitaciones.idcapacitacion = capacitacionesdetalle.idcapacitacion INNER JOIN contactoshospital ON capacitaciones.idcontacto = contactoshospital.idcontacto 
        INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo INNER JOIN productos ON capacitacionesdetalle.idproducto = productos.idproducto INNER JOIN indicadorescapacitaciones ON capacitaciones.idcapacitacion = indicadorescapacitaciones.idindicador WHERE capacitaciones.idhospital = :hospital1");            
        $this->bd->enlazarValor(':hospital1', $dato);
        $resultados = $this->bd->obtenerConjuntoRegistros1();
        $capacitaciones = $resultados ?: $this->vacio;
        return $capacitaciones;
    }




    
    public function editarEmpleado(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT nombre, apellidopaterno, apellidomaterno, direccion, ciudad, estado, codigopostal, colonia, numeromovil, numerotelefono, correo, condicion, empleados.idrol AS rolid, tipoempleados.descripcion AS descripcionE FROM empleados INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE correo = :correo");
            $this->bd->enlazarValor(':correo', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    
    public function actualizarEmpleado(array $datos) : bool {
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE empleados SET nombre = :nombre, apellidopaterno = :apellidopaterno, apellidomaterno = :apellidomaterno, direccion = :direccion, ciudad = :ciudad, estado = :estado, codigopostal = :codigopostal, colonia = :colonia, numeromovil = :numeromovil, numerotelefono = :numerotelefono, idrol = :idrol, condicion = :condicion, foto = :foto WHERE correo = :correo");
            $this->bd->enlazarValor(':nombre', $datos['nombre']);
            $this->bd->enlazarValor(':apellidopaterno', $datos['apellidop']);
            $this->bd->enlazarValor(':apellidomaterno', $datos['apellidom']);
            $this->bd->enlazarValor(':direccion', $datos['direccion']);
            $this->bd->enlazarValor(':ciudad', $datos['ciudad']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            $this->bd->enlazarValor(':codigopostal', $datos['cp']);
            $this->bd->enlazarValor(':colonia', $datos['colonia']);
            $this->bd->enlazarValor(':numeromovil', $datos['celular']);
            $this->bd->enlazarValor(':numerotelefono', $datos['telefono']);
            $this->bd->enlazarValor(':idrol', $datos['rol']);
            $this->bd->enlazarValor(':condicion', $datos['condicion']);
            $this->bd->enlazarValor(':foto', $datos['foto']);
            $this->bd->enlazarValor(':correo', $datos['email']);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();
            return true;
        }catch(PDOException$e){
            $this->bd->deshacerTransaccion();
            echo $e->getMessage();
            return false;
        }
    }

    /* public function buscar($dato){} */

}