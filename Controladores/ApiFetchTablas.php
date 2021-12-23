<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ApiTablas;
require_once "../Modelos/ApiTablas.php";

class ApiFetchTablas{

    public function mostrarCategorias(){
        $mostrarcategorias = new ApiTablas();
        $respuesta = $mostrarcategorias->seleccionarCategorias();
        echo json_encode($respuesta);
        exit;
    }  
    
    public function mostrarMarcas(){
        $mostrarmarcas = new ApiTablas();
        $respuesta = $mostrarmarcas->seleccionarMarcas();
        echo json_encode($respuesta);
        exit;
    }

    public function mostrarEquipos(){
        $mostrarequipos= new ApiTablas();
        $respuesta = $mostrarequipos->seleccionarEquipos();
        echo json_encode($respuesta);
        exit;
    }

    public function mostrarAreas(){
        $mostrarareas= new ApiTablas();
        $respuesta = $mostrarareas->seleccionarAreas();
        echo json_encode($respuesta);
        exit;
    }

    public function mostrarCargos(){
        $mostrarcargos= new ApiTablas();
        $respuesta = $mostrarcargos->seleccionarCargos();
        echo json_encode($respuesta);
        exit;
    }

    public function mostrarDemos(){
        $mostrardemos= new ApiTablas();
        $respuesta = $mostrardemos->seleccionarDemos();
        echo json_encode($respuesta);
        exit;
    }

    public function mostrarCapacitaciones(){
        $mostrarcapacitaciones= new ApiTablas();
        $respuesta = $mostrarcapacitaciones->seleccionarCapacitaciones();
        echo json_encode($respuesta);
        exit;
    }

    public function mostrarTiposPolizas(){
        $mostrarpolizas= new ApiTablas();
        $respuesta = $mostrarpolizas->seleccionarTipoPolizas();
        echo json_encode($respuesta);
        exit;
    }

}


if(isset($_GET['idcategoria'])){
	$seleccionarcategorias = new ApiFetchTablas;
	$seleccionarcategorias->mostrarCategorias();	
}

if(isset($_GET['idmarcas'])){
	$seleccionarmarcas = new ApiFetchTablas;
	$seleccionarmarcas->mostrarMarcas();	
}

if(isset($_GET['equipos'])){
	$seleccionarequipos = new ApiFetchTablas;
	$seleccionarequipos->mostrarEquipos();	
}

if(isset($_GET['areas'])){
	$seleccionarareas = new ApiFetchTablas;
	$seleccionarareas->mostrarAreas();	
}

if(isset($_GET['cargos'])){
	$seleccioncargos = new ApiFetchTablas;
	$seleccioncargos->mostrarCargos();	
}

if(isset($_GET['demos'])){
	$selecciondemos = new ApiFetchTablas;
	$selecciondemos->mostrarDemos();	
}

if(isset($_GET['capacitaciones'])){
	$seleccioncapacitaciones = new ApiFetchTablas;
	$seleccioncapacitaciones->mostrarCapacitaciones();	
}

if(isset($_GET['polizas'])){
	$seleccionpolizas = new ApiFetchTablas;
	$seleccionpolizas->mostrarTiposPolizas();	
}


