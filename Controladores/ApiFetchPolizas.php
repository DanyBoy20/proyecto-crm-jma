<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiPolizas;
require_once "../Modelos/ApiPolizas.php";

class ApiFetchPolizas{

    public $valorBuscado;

    // ********* PARA MOSTRAR EN: registro-poliza
    public function mostrarPolizas(){
        $mostrarpolizas = new ApiPolizas();
        $respuesta = $mostrarpolizas->seleccionarTiposPolizas();
        $salidaDatos = array();
        foreach ($respuesta as $item) {
            $salidaDatos[] = array(
                                "idtipopoliza" => $item['idtipopoliza'],
                                "descripcion" => $item['descripcion']
            );
        }
        echo json_encode($salidaDatos);
        exit;
    }    

}

// ********* PARA MOSTRAR EN: registro-poliza
if(isset($_GET['tipo'])){
	$seleccionarpolizas = new ApiFetchPolizas;
	$seleccionarpolizas->mostrarPolizas();	
}
