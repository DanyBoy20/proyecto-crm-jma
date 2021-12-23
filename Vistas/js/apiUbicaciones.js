/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioUbicaciones as ubicacion } from "./servicios/servicioUbicaciones.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */
const estado = document.getElementById("estado");
const ciudad = document.getElementById("ciudad");
const codigoPostal = document.getElementById("cp");
const colonia = document.getElementById("colonia");

/* =================================================================================== */
/* ****** MANEJADORES DE EVENTOS DE LOS SELECT DEL FORMULARIO PARA LA DIRECCION ****** */
/* =================================================================================== */

/**
 * Al cargar la pagina obtenemos la API de los estados de la republica mexicana
 */
addEventListener("load", () => {
  ubicacion.cargaEstados(estado);
});

/**
 * Escuchador del evento "change" sobre el elemento HTML estado.
 * @type {HTMLElement} El elemento HTML, representa al estado.
 * @listens estado#change El evento que se escuchara del elemento HTML.
 */
estado.addEventListener("change", (e) => {
  let identificador = e.target.value;
  if(identificador == undefined){
    while(ciudad.options.length){
      ciudad.remove(0);
    }
  }else{
    ubicacion.cargarMunicipios(identificador, ciudad);
  }
});

/**
 * Escuchador del evento "change" sobre el elemento HTML ciudad.
 * @type {HTMLElement} El elemento HTML, representa al ciudad.
 * @listens ciudad#change El evento que se escuchara del elemento HTML.
 */
 ciudad.addEventListener("change", (e) => {
  let id = e.target.value;
  if(id == undefined){
    while(codigoPostal.options.length){
      codigoPostal.remove(0);
    }
  }else{
    ubicacion.cargarCodigosPostales(id, codigoPostal);
  }
});

/**
 * Escuchador del evento "change" sobre el elemento HTML codigoPostal.
 * @type {HTMLElement} El elemento HTML, representa al codigo postal.
 * @listens codigoPostal#change El evento que se escuchara del elemento HTML.
 */
 codigoPostal.addEventListener("change", (e) => {
  let id = e.target.value;
  if(id == undefined){
    while(colonia.options.length){
      colonia.remove(0);
    }
  }else{
    ubicacion.cargarColonias(id, colonia);
  }
});
