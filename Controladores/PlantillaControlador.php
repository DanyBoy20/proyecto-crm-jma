<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Representa la plantilla donde se cargaran las vistas requeridas
 */
class PlantillaControlador{

    public function plantilla(){
        include "Vistas/plantilla.php";
    }
    
}