/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioDemostraciones as demos } from "./servicios/servicioDemostraciones.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

const tipodemo = document.getElementById("tipodemo");
const producto = document.getElementById("producto");
const lista = document.getElementById("lista");
const idproducto = document.getElementById("idproducto");
const hospital = document.getElementById("hospital");
const listahospital = document.getElementById("listahospital");
const idhospital = document.getElementById("idhospital");
const solicitante = document.getElementById("solicitante");

/**
 * Al cargar la pagina obtenemos la API de los estados de la republica mexicana
 */
addEventListener("load", () => {
  demos.cargaDemos(tipodemo);

  producto.addEventListener('keyup', (event) => {
    demos.productosBuscados(event, lista);    
  });
  producto.addEventListener("input", (event) => {
    demos.cargarIdElementoProducto(event, idproducto, producto);
  });

  hospital.addEventListener('keyup', (event) => {
    demos.hospitalesBuscados(event, listahospital, solicitante);    
  });
  hospital.addEventListener("input", (event) => {
    demos.cargarIdElementoHospital(event, idhospital, hospital, solicitante);
  });

});
