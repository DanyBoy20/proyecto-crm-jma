/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioRegistroProductos as regproductos } from "./servicios/servicioRegistroEquipo.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

const marca = document.getElementById("marca");
const categoria = document.getElementById("categoria");
const fila_empleado = document.getElementById("fila_empleado");

addEventListener("load", () => {

  regproductos.cargarCategorias(categoria);
  regproductos.cargarMarcas(marca);
  regproductos.cargarProductos(fila_empleado);

});
