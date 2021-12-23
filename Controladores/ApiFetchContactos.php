<?php 
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Modelos\ContactosModelo;
require_once "../Modelos/ContactosModelo.php";

/**
 * Representa la API para las consultas asincronas
 */
class ApiFetchContactos{

    public $valorBuscado;
    public $datosform = [];
    public $contrasenia;
    public $status = 'activo';

    // ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | solicitud-demostracion | registro-poliza
    public function contactosHospital(){
        $valor = $this->valorBuscado;
        $buscarHospital = new ContactosModelo();
        $respuesta = $buscarHospital->listaContactosHospital($valor);
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idcontacto" => $item['idcontacto'],
                "titulo" => $item['titulo'],
                "hnombre" => $item['hnombre'],
                "hapellidop" => $item['hapellidop'],
                "hapellidom" => $item['hapellidom']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }

    // ********* PARA MOSTRAR EN: registro-contactos
    public function cargosContactosH(){
        $seleccionarcargoh = new ContactosModelo();
        $respuesta = $seleccionarcargoh->listaCargosContactos();
        $salidaDatos = array();
        foreach($respuesta as $item){
			$salidaDatos[] = array(
                "idcargo" => $item['idcargo'],
                "descripcioncargo" => $item['descripcioncargo']
			);
		}
		echo json_encode($salidaDatos);
		exit;        
    }

    // ********* PARA MOSTRAR EN: registro-contactos
    public function guardarContactosHospital(){
        $password = password_hash($this->contrasenia, PASSWORD_DEFAULT);
        $datosPost = $this->datosform;
        $guardardatos = new ContactosModelo();
        $datos = array(
            "titulo" => $datosPost['titulo'],
            "nombre" => $datosPost['nombre'],
            "apellidop" => $datosPost['apellidop'],
            "apellidom" => $datosPost['apellidom'],            
            "cargo" => $datosPost['cargo'],
            "email" => $datosPost['email'],
            "contrasenia" => $password,
            "telefono" => $datosPost['telefono'],
            "celular" => $datosPost['celular'],
            "idhospital" => $datosPost['idhospital'],
            "condicion" => $this->status,
            "area" => $datosPost['area'],            
        );        
        $respuesta = $guardardatos->guardaContactosHospital($datos);
        echo json_encode($respuesta);
    }

    // ********* CREAR CONTRASEÑA PARA CONTACTO (registro-contactos | )
    public function crearContrasenia(int $longitud) : string {

        $minusculas = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $mayusculas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $simbolos = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}');
        $numeros = array('0','1','2','3','4','5','6','7','8','9');
        $arregloCompleto = array($minusculas, $mayusculas, $simbolos, $numeros); 
        
        $contrasenia = $minusculas[array_rand($minusculas, 1)];
        $contrasenia = $contrasenia . $mayusculas[array_rand($mayusculas, 1)];
        $contrasenia = $contrasenia . $simbolos[array_rand($simbolos, 1)];
        $contrasenia = $contrasenia . $numeros[array_rand($numeros, 1)];   
        
        for($i = strlen($contrasenia); $i < max(8, $longitud); $i++){
            
            $temporal = $arregloCompleto[array_rand($arregloCompleto, 1)];
            
            $contrasenia = $contrasenia . $temporal[array_rand($temporal, 1)];
        }
        
        return str_shuffle($contrasenia);
    }
  
}

// ********* PARA MOSTRAR EN: registro-instalacion | registro-capacitacion | solicitud-demostracion | registro-poliza
if (isset($_GET["id"])) {
    $valorBuscado = trim($_GET["id"]);
    if ($valorBuscado != "") {
        $buscarEmpleadoLista = new ApiFetchContactos();
        $buscarEmpleadoLista->valorBuscado = $valorBuscado;
        $buscarEmpleadoLista->contactosHospital();
    } 
}

// ********* PARA MOSTRAR EN: registro-contactos
if (isset($_GET["idcargo"])) {
    $valorBuscado = trim($_GET["idcargo"]);
    if ($valorBuscado != "") {
        $buscarEmpleadoLista = new ApiFetchContactos();
        $buscarEmpleadoLista->cargosContactosH();
    } 
}

// ********* PARA MOSTRAR EN: registro-contactos
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $datos = new ApiFetchContactos();
    $datos->contrasenia = $datos->crearContrasenia(1);
    $datos->datosform = $_POST;
    $datos->guardarContactosHospital();
}
