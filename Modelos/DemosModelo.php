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
class DemosModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    /* private $ultimoIdInsertado; */
    private $respuesta = true;

    function __construct(){
        $this->bd = new Conexion;        
    }

    // ********* PARA MOSTRAR EN: solicitud-demostracion
    public function consultarDatos($datos){
        try {
            $this->bd->consultaSQL("SELECT productos.idproducto, hospitales.idhospital, contactoshospital.idcontacto, tiposdemos.idtipodemo
            FROM productos, hospitales, contactoshospital, tiposdemos 
            WHERE productos.idproducto = :idproducto
            AND hospitales.idhospital = :idhospital 
            AND contactoshospital.idcontacto = :solicitante 
            AND tiposdemos.idtipodemo = :tipodemo"); 
            $this->bd->enlazarValor(':idproducto', $datos['idproducto']);
            $this->bd->enlazarValor(':idhospital', $datos['idhospital']);
            $this->bd->enlazarValor(':solicitante', $datos['solicitante']);
            $this->bd->enlazarValor(':tipodemo', $datos['tipodemo']);          
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: demos
    public function consultar() : array {
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

    
    public function buscarEmpleadolista(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT idempleado, nombre, apellidopaterno, apellidomaterno, fecharegistro, condicion, descripcion, correo FROM empleados INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE nombre LIKE '" . $valorBuscado . "%' OR apellidopaterno LIKE '" . $valorBuscado . "%' OR apellidomaterno LIKE '" . $valorBuscado . "%'");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    // ********* PARA MOSTRAR EN: solicitud-demostracion
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

                $this->bd->consultaSQL("INSERT INTO indicadoresdemos (idindicador, barra, estado) VALUES (:indicador, :barra, :estado)");
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

    // ********* PARA MOSTRAR EN: demostracion
    public function buscarDemostracion(int $dato){
        try {
            $this->bd->consultaSQL("SELECT tiposdemos.descripcion, demos.iddemostracion, demos.fechasolicitud, demos.comentarios, demos.estado, demosdetalle.idproducto, productos.pdescripcion, productos.modelo, contactoshospital.titulo, contactoshospital.hnombre, contactoshospital.hapellidop, contactoshospital.hapellidom, cargoscontactos.descripcioncargo, hospitales.nombreh, hospitales.tipo, hospitales.direccionh, hospitales.estadoh, hospitales.municipioh, hospitales.cp, hospitales.coloniah, hospitales.telefonoh
            FROM productos
            INNER JOIN demosdetalle ON productos.idproducto = demosdetalle.idproducto
            INNER JOIN demos ON demosdetalle.iddemostracion = demos.iddemostracion
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN contactoshospital ON demos.idcontacto = contactoshospital.idcontacto
            INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo
            INNER JOIN hospitales ON contactoshospital.idhospital = hospitales.idhospital
            WHERE demos.iddemostracion = :iddemostracion");
            $this->bd->enlazarValor(':iddemostracion', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: demostracion
    public function buscarDemostracionPDF(int $dato){
        try {
            $this->bd->consultaSQL("SELECT tiposdemos.descripcion, demos.iddemostracion, demos.fechasolicitud, demos.comentarios, demos.estado, demosdetalle.idproducto, productos.pdescripcion, productos.modelo, contactoshospital.titulo, contactoshospital.hnombre, contactoshospital.hapellidop, contactoshospital.hapellidom, cargoscontactos.descripcioncargo, hospitales.nombreh, hospitales.tipo, hospitales.direccionh, hospitales.estadoh, hospitales.municipioh, hospitales.cp, hospitales.coloniah, hospitales.telefonoh
            FROM productos
            INNER JOIN demosdetalle ON productos.idproducto = demosdetalle.idproducto
            INNER JOIN demos ON demosdetalle.iddemostracion = demos.iddemostracion
            INNER JOIN tiposdemos ON demos.idtipodemo = tiposdemos.idtipodemo
            INNER JOIN contactoshospital ON demos.idcontacto = contactoshospital.idcontacto
            INNER JOIN cargoscontactos ON contactoshospital.idcargo = cargoscontactos.idcargo
            INNER JOIN hospitales ON contactoshospital.idhospital = hospitales.idhospital
            WHERE demos.iddemostracion = :iddemostracion");
            $this->bd->enlazarValor(':iddemostracion', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: demostracion
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

    // ********* ACTUALIZAR DEMOSTRACION A 'EN PROCESO' BARRA PROGRESO 67
    public function actualizarSolicitudDemostracion(array $datos){
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("UPDATE demos SET fechaprogramada = :fechaprogramada, estado = :estado, comentarios2 = :comentarios2 WHERE iddemostracion = :iddemostracion");
            $this->bd->enlazarValor(':fechaprogramada', $datos['fechaprogramada']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            $this->bd->enlazarValor(':comentarios2', $datos['mensaje']);
            $this->bd->enlazarValor(':iddemostracion', $datos['iddemo']);
            if($this->bd->ejecutar() === false){
                $this->bd->deshacerTransaccion();
                return false;
            }else{
                $this->bd->consultaSQL("UPDATE indicadoresdemos SET barra = :barra, estado = :estado WHERE idindicador = :idindicador");
                $this->bd->enlazarValor(':barra', $datos['barra']);
                $this->bd->enlazarValor(':estado', $datos['estado']);
                $this->bd->enlazarValor(':idindicador', $datos['iddemo']);
                $this->bd->ejecutar();
                $this->bd->ejecutarTransaccion();
                return true;            
            }            
        }catch(PDOException$e){   
            $this->bd->deshacerTransaccion();         
            echo $e->getMessage();
            return false;
        }


       
            
            /* $this->bd->consultaSQL("UPDATE demos SET fechaprogramada = :fechaprogramada, estado = :estado, comentarios2 = :comentarios2 WHERE iddemostracion = :iddemostracion");
            $this->bd->enlazarValor(':fechaprogramada', $datos['fechaprogramada']);
            $this->bd->enlazarValor(':estado', $datos['estado']);
            $this->bd->enlazarValor(':comentarios2', $datos['mensaje']);
            $this->bd->enlazarValor(':iddemostracion', $datos['iddemo']);
            if($this->bd->ejecutar() === FALSE){                
                $this->respuesta = false;
                return $this->respuesta;
            }else{
                $this->bd->consultaSQL("UPDATE indicadoresdemos SET barra = :barra, estado = :estado WHERE idindicador = :idindicador");
                $this->bd->enlazarValor(':barra', $datos['barra']);
                $this->bd->enlazarValor(':estado', $datos['estado']);
                $this->bd->enlazarValor(':idindicador', $datos['iddemo']);
                $this->bd->ejecutar();
                return $this->respuesta;            
            }   */          
        





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

    
    public function verEmpleado(string $dato) : array {
        try {
            $this->bd->consultaSQL("SELECT idempleado, nombre, apellidopaterno, apellidomaterno, direccion, ciudad, estado, codigopostal, colonia, numeromovil, numerotelefono, fecharegistro, correo, condicion, descripcion, foto FROM empleados
                                INNER JOIN tipoempleados ON empleados.idrol = tipoempleados.idrol WHERE correo = :correo ");
            $this->bd->enlazarValor(':correo', $dato);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
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

    
    

    /* public function buscar($dato){} */

}