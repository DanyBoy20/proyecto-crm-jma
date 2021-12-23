<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

use Interfaces\IHospitales;
use Modelos\ContactosModelo;
use Servicios\AplicacionServicios;

class ContactosControlador implements IHospitales {

    private $errores = [];
    private $variablesIndefinidas = [];
    private $claveacceso;
    private $contraseniaActualizada; 

    public function consultar(){      
    }
    
    public function guardar(){ 
          
    }

    public function actualizarContraseña(){
    }
    
    public function ver(){
    }

    public function editar(){  
    }


}
