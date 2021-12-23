<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiAreasHospital;
require_once "../Modelos/ApiAreasHospital.php";

class ApiFetchAreasHospital{

    public $valorBuscado;
    
    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function mostrarAreas(){
        $valor = $this->valorBuscado;
        $mostrarProductos = new ApiAreasHospital();
        $respuesta = $mostrarProductos->seleccionarAreas($valor);
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idarea" => $item['idarea'],
                                "descripcionarea" => $item['descripcionarea']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function mostrarHospitales(){
        $valor = $this->valorBuscado;
        $mostrarProductos = new ApiAreasHospital();
        $respuesta = $mostrarProductos->seleccionarHospitales($valor);
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idhospital" => $item['idhospital'],
                                "nombreh" => $item['nombreh'],
                                "estadoh" => $item['estadoh'],

            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-contactos | registro-poliza
    public function mostrarAreasHospital(){
        $valor = $this->valorBuscado;
        $mostrarProductos = new ApiAreasHospital();
        $respuesta = $mostrarProductos->seleccionarAreasHospital($valor);
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "descripcionarea" => $item['descripcionarea'],
                                "cvearea" => $item['cvearea']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

}

// ********* PARA MOSTRAR EN: registro-areas-hospital
if(isset($_GET['area'])){
	$seleccionarProductos = new ApiFetchAreasHospital;
    $seleccionarProductos->valorBuscado = $_GET['area'];
	$seleccionarProductos->mostrarAreas();	
}

// ********* PARA MOSTRAR EN: registro-areas-hospital
if(isset($_GET['hospitales'])){
	$seleccionarProductos = new ApiFetchAreasHospital;
    $seleccionarProductos->valorBuscado = $_GET['hospitales'];
	$seleccionarProductos->mostrarHospitales();	
}

// ********* PARA MOSTRAR EN: registro-instalacion | registro-contactos | registro-poliza
if(isset($_GET['idhospital'])){
	$seleccionarProductos = new ApiFetchAreasHospital;
    $seleccionarProductos->valorBuscado = $_GET['idhospital'];
	$seleccionarProductos->mostrarAreasHospital();	
}

