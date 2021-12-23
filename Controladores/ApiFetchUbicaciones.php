<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiUbicaciones;
require_once "../Modelos/ApiUbicaciones.php";

class ApiFetchUbicaciones{

    public $valorBuscado;

    /**
     * Función que regresa los estados de la republica mexicana.
     *
     * @return void
     */
    public function mostrarEstados(){
        $mostrarEstados = new ApiUbicaciones();
        $respuesta = $mostrarEstados->seleccionarEstados();
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idestado" => $item['idestado'],
                                "estado" => $item['estado']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }

    /**
     * Funcion que regresa las ciudades/municipios del estado seleccionado
     *
     * @return void
     */
    public function seleccionarMunicipio(){
        $valor = $this->valorBuscado;
        $buscarMunicipio = new ApiUbicaciones();        
        $respuesta = $buscarMunicipio->seleccionarMunicipio($valor);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                                "idmunicipio" => $item['idmunicipio'],
                                "municipio" => $item['municipio']
			);
		}
		echo json_encode($salidaDatos);
		exit;   
    }

}


if(isset($_GET['estados'])){
	$seleccionarEstados = new ApiFetchUbicaciones;
	$seleccionarEstados -> mostrarEstados();	
}

if(isset($_GET['id'])){
	$seleccionarMunicipios = new ApiFetchUbicaciones;
	$seleccionarMunicipios -> valorBuscado = $_GET['id'];
	$seleccionarMunicipios -> seleccionarMunicipio();	
}


