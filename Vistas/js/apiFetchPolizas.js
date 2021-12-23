/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioPolizas as polizas } from "./servicios/servicioPolizas.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

const tipopoliza = document.getElementById("tipopoliza");
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

  polizas.cargaPolizas(tipopoliza);

  producto.addEventListener('keyup', (event) => {
    polizas.productosBuscados(event, lista);    
  });
  producto.addEventListener("input", (event) => {
    polizas.cargarIdElementoProducto(event, idproducto, producto);
  });

  hospital.addEventListener('keyup', (event) => {
    polizas.hospitalesBuscados(event, listahospital, solicitante);    
  });
  
  hospital.addEventListener("input", (event) => {
    polizas.cargarIdElementoHospital(event, idhospital, hospital, solicitante, area);
  });

});
