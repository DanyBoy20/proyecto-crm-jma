<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiInstalaciones;
require_once "../Modelos/ApiInstalaciones.php";

class ApiFetchInstalaciones{

    public $valorBuscado;

    
    public function mostrarCapacitaciones(){
        $mostrarDemos = new ApiInstalaciones();
        $respuesta = $mostrarDemos->seleccionarInstalaciones();
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idtipocapacitaciones" => $item['idtipocapacitaciones'],
                                "descripcion" => $item['descripcion']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }    

}

if(isset($_GET['tipo'])){
	$seleccionarDemos = new ApiFetchInstalaciones;
	$seleccionarDemos->mostrarCapacitaciones();	
}
