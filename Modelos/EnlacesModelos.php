<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 */

/**
 * Representa los enlaces/links/URL's de las peticiones que hace el controlador- modelo
 */
class EnlacesModelos{

    /**
     * Valida la URL requerida por el controlador
     *
     * @param string $enlaces
     * Cadena de caracteres con una URL amigable
     * @return string
     * Devuelve la direccion relativa del link requerido
     */
    public function enlacesModelo(string $enlaces) : string{
        $paginas = array(
            "acceso-restringido",
            "demodoc",
            "demos",
            "demostracion",
            "expediente-hospital",
            "expedientes",
            "inicio",
            "pagina-no-encontrada",
            "recuperar-contrasenia", 
            "registro-areas-hospital", 
            "registro-areas",
            "registro-capacitacion",
            "registro-cargos",
            "registro-categorias",
            "registro-contactos",
            "registro-equipos",
            "registro-hospital", 
            "registro-instalacion",
            "registro-marcas", 
            "registro-poliza",
            "registro-tipo-demos",
            "registro-tipo-capacitaciones",
            "registro-tipo-polizas", 
            "salir",
            "solicitud-demostracion");
        if(in_array($enlaces, $paginas, TRUE)){
            $modulos = "Vistas/modulos/" . $enlaces . ".php";
        }else{
            $modulos = "Vistas/modulos/index.php";
        }               
        return $modulos;
    }

}
