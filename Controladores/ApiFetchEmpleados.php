<?php 
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\EmpleadosModelo;
require_once "../Modelos/EmpleadosModelo.php";

/**
 * Representa la API para las consultas asincronas
 */
class ApiFetchEmpleados{

    public $valorBuscado;

    /**
     * Funcion para realizar la busqueda del empleado
     *
     * @return void
     * Con "echo" regresamos un arreglo codificado en JSON
     */
    public function buscar(){
        $valor = $this->valorBuscado;
        $buscarEmpleado = new EmpleadosModelo();
        $respuesta = $buscarEmpleado->buscarEmpleadolista($valor);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idempleado" => $item['idempleado'],
                "nombre" => $item['nombre'],
                "apellidopaterno" => $item['apellidopaterno'],
                "apellidomaterno" => $item['apellidomaterno'],
                "fecharegistro" => $item['fecharegistro'],
                "descripcion" => $item['descripcion'],
                "condicion" => $item['condicion'],
                "correo" => $item['correo']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }

    /**
     * Selecciona todos los empleados
     *
     * @return void
     * Con "echo" regresamos un arreglo codificado en JSON
     */
    public function listaEmpleados(){
        $listaempleados = new EmpleadosModelo();
        $respuesta = $listaempleados->consultar();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idempleado" => $item['idempleado'],
                "nombre" => $item['nombre'],
                "apellidopaterno" => $item['apellidopaterno'],
                "apellidomaterno" => $item['apellidomaterno'],
                "fecharegistro" => $item['fecharegistro'],
                "descripcion" => $item['descripcion'],
                "condicion" => $item['condicion']
			);
		}
		echo json_encode($salidaDatos);
		exit;
    }

    /**
     * Busca el registro empleado a actualizar
     *
     * @return void
     * Con "echo" regresamos un arreglo codificado en JSON
     */
    public function buscarRegistroActualizar(){
        $valor = $this->valorBuscado;
        $buscarEmpleado = new EmpleadosModelo();        
        $respuesta = $buscarEmpleado->consultaActualizar($valor);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                                "direccion" => $item['direccion'],
                                "ciudad" => $item['ciudad'],
                                "estado" => $item['estado'],
                                "telefono" => $item['numerotelefono'],
                                "numeromovil" => $item['numeromovil'],
                                "fecharegistro" => $item['fecharegistro']
			);
		}
		echo json_encode($salidaDatos);
		exit;   
    }
}

/**
 * Si el "action" viene con el valor "busqueda" - Busqueda asincrona del empleado
 */
if (isset($_GET["busqueda"])) {
    $valorBuscado = trim($_GET["busqueda"]);
    if ($valorBuscado != "") {
        $buscarEmpleadoLista = new ApiFetchEmpleados();
        $buscarEmpleadoLista->valorBuscado = $valorBuscado;
        $buscarEmpleadoLista->buscar();
    } 
}

/**
 * Si el "action" viene con el valor "todos" - Seleccionar todos los empleados
 */
if (isset($_GET["todos"])) {
        $buscarEmpleadoLista = new ApiFetchEmpleados();
        $buscarEmpleadoLista->listaEmpleados();
}

/**
 * Si el "action" viene con el valor "identificadorActualizar" - Selecciona datos del empleado a actualizar
 */
if (isset($_GET["identificadorActualizar"])) {
    $valorBuscado = trim($_GET["identificadorActualizar"]);
    $buscarEmpleadoActualizar = new ApiFetchEmpleados();
    $buscarEmpleadoActualizar->valorBuscado = $valorBuscado;
    $buscarEmpleadoActualizar->buscarRegistroActualizar();
}