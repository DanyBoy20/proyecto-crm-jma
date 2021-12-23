<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiDemos;
require_once "../Modelos/ApiDemos.php";

class ApiFetchDemos{

    public $valorBuscado;

    // ********* PARA MOSTRAR EN: solicitud-demostracion
    public function mostrarDemos(){
        $mostrarDemos = new ApiDemos();
        $respuesta = $mostrarDemos->seleccionarDemos();
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idtipodemo" => $item['idtipodemo'],
                                "descripcion" => $item['descripcion']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | solicitud-demostracion | registro-poliza
    public function mostrarProductos(){
        $valor = $this->valorBuscado;
        $mostrarProductos = new ApiDemos();
        $respuesta = $mostrarProductos->seleccionarProductos($valor);
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idproducto" => $item['idproducto'],
                                "descripcion" => $item['descripcion'],
                                "modelo" => $item['modelo'],
                                "categoria" => $item['categoria'],
                                "marca" => $item['marca']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | registro-contactos | solicitud-demostracion | registro-poliza
    public function mostrarHospitales(){
        $valor = $this->valorBuscado;
        $mostrarProductos = new ApiDemos();
        $respuesta = $mostrarProductos->seleccionarHospitales($valor);
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idhospital" => $item['idhospital'],
                                "nombreh" => $item['nombreh'],
                                "estadoh" => $item['estadoh']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

    // ********* PARA MOSTRAR EN: demos
    public function seleccionarSolicitudesDemos(){
        $listahospitales = new ApiDemos();
        $respuesta = $listahospitales->consultar();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "descripcion" => $item['descripcion'],
                "pdescripcion" => $item['pdescripcion'],                
                "nombreh" => $item['nombreh'],
                "fechasolicitud" => $item['fechasolicitud'],
                "iddemostracion" => $item['iddemostracion']
			);
		}
		echo json_encode($salidaDatos);
		exit;
    }

    // ********* PARA MOSTRAR EN: demos
    public function mostrarDemoFiltrado(){
        $valor = $this->valorBuscado;
        $mostrardemo = new ApiDemos();
        $respuesta = $mostrardemo->seleccionarDemoFiltrado($valor);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "descripcion" => $item['descripcion'],
                "pdescripcion" => $item['pdescripcion'],                
                "nombreh" => $item['nombreh'],
                "fechasolicitud" => $item['fechasolicitud'],
                "iddemostracion" => $item['demoId']
			);
		}
		echo json_encode($salidaDatos);
		exit;
    }

}

// ********* PARA MOSTRAR EN: solicitud-demostracion 
if(isset($_GET['tipo'])){
	$seleccionarDemos = new ApiFetchDemos;
	$seleccionarDemos->mostrarDemos();	
}

// ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | solicitud-demostracion | registro-poliza
if(isset($_GET['producto'])){
	$seleccionarProductos = new ApiFetchDemos;
    $seleccionarProductos->valorBuscado = $_GET['producto'];
	$seleccionarProductos->mostrarProductos();	
}

// ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | registro-contactos | solicitud-demostracion | registro-poliza
if(isset($_GET['hospitales'])){
	$seleccionarProductos = new ApiFetchDemos;
    $seleccionarProductos->valorBuscado = $_GET['hospitales'];
	$seleccionarProductos->mostrarHospitales();	
}

// ********* PARA MOSTRAR EN: demos
if(isset($_GET['todos'])){
    $seleccionardemos = new ApiFetchDemos;
    $seleccionardemos->seleccionarSolicitudesDemos();
}

// ********* PARA MOSTRAR EN: demos
if(isset($_GET['busqueda'])){
	$demofiltrado = new ApiFetchDemos;
    $demofiltrado->valorBuscado = $_GET['busqueda'];
	$demofiltrado->mostrarDemoFiltrado();	
}


