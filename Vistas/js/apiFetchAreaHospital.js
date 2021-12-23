/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioAreas as areas } from "./servicios/servicioAreaHospital.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */

const area = document.getElementById("area");
const lista = document.getElementById("lista");
const idarea = document.getElementById("idarea");
const hospital = document.getElementById("hospital");
const listahospital = document.getElementById("listahospital");
const idhospital = document.getElementById("idhospital");

/**
 * Al cargar la pagina obtenemos la API de los estados de la republica mexicana
 */
addEventListener("load", () => {

  area.addEventListener('keyup', (event) => {
    areas.areasBuscadas(event, lista);    
  });

  area.addEventListener("input", (event) => {
    areas.cargarIdElementoArea(event, idarea, area);
  });


  hospital.addEventListener('keyup', (event) => {
    areas.hospitalesBuscados(event, listahospital);    
  });
  hospital.addEventListener("input", (event) => {
    areas.cargarIdElementoHospital(event, idhospital, hospital);
  });

});
