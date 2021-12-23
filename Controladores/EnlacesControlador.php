<?php namespace Controladores;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/* include 'utilidades/autocargador.php'; */
/* require 'Modelos/EnlacesModelos.php'; */

use Modelos\EnlacesModelos;

/**
 * Representa los enlaces/links/URL's de las peticiones del usuario - Controlador
 */
class EnlacesControlador{

    /**
     * Almacenara las URL que se procesaron en el Modelo
     *
     * @var string
     */
    public $respuesta;

    /**
     * Valida la URL solicitada por el usuario
     *
     * @return string
     * Devuelve la dirección (URL) requerida
     */
    public function enlacesControlador(){
        $enlaces = (isset($_GET["action"])) ? $enlaces = $_GET["action"] : $enlaces = "index";
        $modulo = new EnlacesModelos();
        $respuesta = $modulo->enlacesModelo($enlaces);       
        include $respuesta;       
    }

}