<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IDocumentos;
use Modelos\DemosModelo;
require_once "../Interfaces/IDocumentos.php";
require_once "../Modelos/DemosModelo.php";

class Documentos implements IDocumentos {

    private $errores = [];
    private $variablesIndefinidas = [];
    public $respuesta = [];


    private $claveacceso;
    private $contraseniaActualizada; 

    public function ver($dato){
        $id = (int)$dato;
        $buscardemostracion = new DemosModelo();
        $demostracion = $buscardemostracion->buscarDemostracion($id);
        $this->respuesta = $demostracion;
        return $this->respuesta;
    }

    // ********* PARA MOSTRAR EN: demos
    public function consultar(){     
    }
    
    // ********* PARA MOSTRAR EN: solicitud-demostracion
    public function guardar(){  
    }

    public function editar(){  
    }

    
    public function actualizarContraseña(){        
    }
    


}
