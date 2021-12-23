/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioCapacitacion as capacitacion } from "./servicios/servicioTablaCapacitacion.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

const fila_empleado = document.getElementById("fila_empleado");

/**
 * Al cargar la pagina obtenemos la API de los estados de la republica mexicana
 */
addEventListener("load", () => {

  capacitacion.cargarCapacitaciones(fila_empleado);

});
