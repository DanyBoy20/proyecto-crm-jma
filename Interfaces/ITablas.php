<?php namespace Interfaces;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Interface Usuarios: Metodos CRUD
 */
interface ITablas{    
    
    public function guardarCategoria();

    public function guardarMarca();

    public function guardarEquipo(); 
    
    public function guardarCargo();    

    public function guardarDemo(); 

    public function guardarCapacitacion(); 

    public function guardarPoliza(); 
    

}