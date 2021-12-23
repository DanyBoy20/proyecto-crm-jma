/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioActualizarDemo as fecha } from "./servicios/servicioActualizarDemo.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

 const fechasolicitud = document.getElementById("fechasolicitud");
const fechaprogramada = document.getElementById("fechaprogramada");

/**
 * Al cargar la pagina obtenemos la API de los estados de la republica mexicana
 */
addEventListener("load", () => {

    fecha.cargarFechaSolicitud(fechasolicitud, fechaprogramada);

});
