/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioInstalaciones as instalaciones } from "./servicios/servicioInstalaciones.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

const producto = document.getElementById("producto");
const lista = document.getElementById("lista");
const idproducto = document.getElementById("idproducto");
const hospital = document.getElementById("hospital");
const listahospital = document.getElementById("listahospital");
const idhospital = document.getElementById("idhospital");
const solicitante = document.getElementById("solicitante");
const area = document.getElementById("area");

/**
 * Al cargar la pagina obtenemos la API de los estados de la republica mexicana
 */
addEventListener("load", () => {

  producto.addEventListener('keyup', (event) => {
    instalaciones.productosBuscados(event, lista);    
  });
  producto.addEventListener("input", (event) => {
    instalaciones.cargarIdElementoProducto(event, idproducto, producto);
  });

  hospital.addEventListener('keyup', (event) => {
    instalaciones.hospitalesBuscados(event, listahospital, solicitante);    
  });
  
  hospital.addEventListener("input", (event) => {
    instalaciones.cargarIdElementoHospital(event, idhospital, hospital, solicitante, area);
  });

});
