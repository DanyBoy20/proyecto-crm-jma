<?php 
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ProductosModelo;
require_once "../Modelos/ProductosModelo.php";

/**
 * Representa la API para las consultas asincronas
 */
class ApiFetchRegProductos{
    

    // ********* PARA MOSTRAR EN: registro-equipos
    public function cargarCategorias(){
        $seleccionarcategorias = new ProductosModelo();
        $respuesta = $seleccionarcategorias->listaCategorias();
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idcategoria" => $item['idcategoria'],
                "descripcioncategoria" => $item['descripcioncategoria']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }

    // ********* PARA MOSTRAR EN: registro-equipos
    public function cargarMarcas(){
        $seleccionarmarcas = new ProductosModelo();
        $respuesta = $seleccionarmarcas->listaMarcas();
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idmarca" => $item['idmarca'],
                "descripcionm" => $item['descripcionm']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }
  
}

// ********* PARA MOSTRAR EN: registro-equipos
if (isset($_GET["idcategoria"])) {
    $categoriaBuscado = trim($_GET["idcategoria"]);
    if ($categoriaBuscado != "") {
        $buscarcategorias = new ApiFetchRegProductos();
        $buscarcategorias->cargarCategorias();
    } 
}

// ********* PARA MOSTRAR EN: registro-equipos
if (isset($_GET["idmarcas"])) {
    $marcaBuscado = trim($_GET["idmarcas"]);
    if ($marcaBuscado != "") {
        $buscarmarcas = new ApiFetchRegProductos();
        $buscarmarcas->cargarMarcas();
    } 
}

