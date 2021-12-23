<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Exception;
use \PDOException;
require_once "Conexion.php";


class ContactosModelo extends Conexion{

    private $condicion = "eliminado";
    private $bd;
    private $res = [];

    function __construct(){
        $this->bd = new Conexion;        
    }

    
    public function consultar() : array {
        try {
            $this->bd->consultaSQL("SELECT idhospital, nombreh, tipo, estadoh, municipioh FROM hospitales");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            /* echo $e->getMessage(); */
            $resultados = [];
            return $resultados;
        }
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | solicitud-demostracion | registro-poliza
    public function listaContactosHospital(string $valorBuscado) : array {
        try {
            $this->bd->consultaSQL("SELECT idcontacto, titulo, hnombre, hapellidop, hapellidom FROM contactoshospital WHERE idhospital = :condicion");
            $this->bd->enlazarValor(':condicion', $valorBuscado);
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    // ********* PARA MOSTRAR EN: registro-contactos
    public function listaCargosContactos() : array {
        try {
            $this->bd->consultaSQL("SELECT idcargo, descripcioncargo
            FROM cargoscontactos");
            $resultados = $this->bd->obtenerConjuntoRegistros1();
            return $resultados;
        } catch (PDOException $e) {
            $resultados = [];
            return $resultados;
        }     
    }

    // ********* PARA MOSTRAR EN: registro-contactos
    public function guardaContactosHospital (array $datos) : string {

        try{
            
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO contactoshospital(titulo, hnombre, hapellidop, hapellidom, idcargo, hcorreoc, contraseniah, telc, celc, idhospital, condicionc, cvearea) VALUES (:titulo, :nombre, :apellidopaterno, :apellidomaterno, :cargo, :email, :contrasenia, :telefono, :celular, :idhospital, :condicion, :area)");
            $this->bd->enlazarValor(':titulo', $datos['titulo']);
            $this->bd->enlazarValor(':nombre', $datos['nombre']);
            $this->bd->enlazarValor(':apellidopaterno', $datos['apellidop']);
            $this->bd->enlazarValor(':apellidomaterno', $datos['apellidom']);
            $this->bd->enlazarValor(':cargo', $datos['cargo']);
            $this->bd->enlazarValor(':email', $datos['email']);
            $this->bd->enlazarValor(':contrasenia', $datos['contrasenia']);
            $this->bd->enlazarValor(':telefono', $datos['telefono']);
            $this->bd->enlazarValor(':celular', $datos['celular']);
            $this->bd->enlazarValor(':idhospital', $datos['idhospital']);
            $this->bd->enlazarValor(':condicion', $datos['condicion']);
            $this->bd->enlazarValor(':area', $datos['area']);
            $this->bd->ejecutar();
            $this->bd->ejecutarTransaccion();            
            $registroinsertado = "ok";
            return $registroinsertado;
        }catch(PDOException $e){
            $this->bd->deshacerTransaccion();
            $registronoinsertado = "error";
            return $registronoinsertado;
        }       

    }

    
    public function guardar(array $datos) : bool {
        try{
            $this->bd->iniciarTransaccion();
            $this->bd->consultaSQL("INSERT INTO empleados(nombre, apellidopaterno, apellidomaterno, direccion, ciudad, estado, codigopostal, colonia, numeromovil, numerotelefono, correo, contrasenia, idrol, condicion, fecharegistro, intentos, foto) VALUES (:nombre, :apellidopaterno, :apellidomaterno, :direccion, :ciudad, :estado, :codigopostal, :colonia, :numeromovil, :numerotelefono, :correo, :contrasenia, :idrol, :condicion, :fecharegistro, :intentos, :foto) ");
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
            $this->bd->enlazarValor(':correo', $datos['email']);
            $this->bd->enlazarValor(':contrasenia', $datos['contrasenia']);
            $this->bd->enlazarValor(':idrol', $datos['rol']);
            $this->bd->enlazarValor(':condicion', $datos['condicion']);
            $this->bd->enlazarValor(':fecharegistro', $datos['fechareg']);
            $this->bd->enlazarValor(':intentos', $datos['intentos']);
            $this->bd->enlazarValor(':foto', $datos['foto']);
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


    public function verHospital(string $dato) : array {
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

            return array($resultados, $resultados1);
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