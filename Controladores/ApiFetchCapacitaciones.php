<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiCapacitaciones;
require_once "../Modelos/ApiCapacitaciones.php";

class ApiFetchCapacitaciones{

    public $valorBuscado;

    // ********* PARA MOSTRAR EN: registro-capacitacion
    public function mostrarCapacitaciones(){
        $mostrarDemos = new ApiCapacitaciones();
        $respuesta = $mostrarDemos->seleccionarTiposCapacitaciones();
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

// ********* PARA MOSTRAR EN: registro-capacitacion
if(isset($_GET['tipo'])){
	$seleccionarDemos = new ApiFetchCapacitaciones;
	$seleccionarDemos->mostrarCapacitaciones();	
}
