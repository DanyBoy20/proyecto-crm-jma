<?php 
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\HospitalesModelo;
require_once "../Modelos/HospitalesModelo.php";

/**
 * Representa la API para las consultas asincronas
 */
class ApiFetchHospitales{

    public $valorBuscado;

    // ********* PARA MOSTRAR EN: expedientes
    public function buscar(){
        $valor = $this->valorBuscado;
        $buscarHospital = new HospitalesModelo();
        $respuesta = $buscarHospital->buscarHospitallista($valor);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idhospital" => $item['idhospital'],
                "nombreh" => $item['nombreh'],
                "tipo" => $item['tipo'],
                "estadoh" => $item['estadoh'],
                "municipioh" => $item['municipioh'],
                "estado" => $item['estado']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }

    // ********* PARA MOSTRAR EN: expedientes
    public function listaHospitales(){
        $listahospitales = new HospitalesModelo();
        $respuesta = $listahospitales->consultar();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idhospital" => $item['idhospital'],
                "nombreh" => $item['nombreh'],
                "tipo" => $item['tipo'],
                "estadoh" => $item['estadoh'],
                "municipioh" => $item['municipioh'],
                "estado" => $item['estado']
			);
		}
		echo json_encode($salidaDatos);
		exit;
    }

    
    public function buscarRegistroActualizar(){
        $valor = $this->valorBuscado;
        $buscarHospital = new HospitalesModelo();        
        $respuesta = $buscarHospital->consultaActualizar($valor);
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

// ********* PARA MOSTRAR EN: expedientes
if (isset($_GET["busqueda"])) {
    $valorBuscado = trim($_GET["busqueda"]);
    if ($valorBuscado != "") {
        $buscarEmpleadoLista = new ApiFetchHospitales();
        $buscarEmpleadoLista->valorBuscado = $valorBuscado;
        $buscarEmpleadoLista->buscar();
    } 
}

// ********* PARA MOSTRAR EN: expedientes
if (isset($_GET["todos"])) {
        $buscarEmpleadoLista = new ApiFetchHospitales();
        $buscarEmpleadoLista->listaHospitales();
}


if (isset($_GET["identificadorActualizar"])) {
    $valorBuscado = trim($_GET["identificadorActualizar"]);
    $buscarEmpleadoActualizar = new ApiFetchHospitales();
    $buscarEmpleadoActualizar->valorBuscado = $valorBuscado;
    $buscarEmpleadoActualizar->buscarRegistroActualizar();
}