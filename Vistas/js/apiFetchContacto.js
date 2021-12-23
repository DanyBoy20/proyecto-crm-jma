/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { servicioDemostraciones as contactosH } from "./servicios/servicioContactoAreaHospital.js";

/**
 * Elementos HTML que contendran los datos devueltos por la API de ubicaciones de México.
 */


const hospital = document.getElementById("hospital");
const listahospital = document.getElementById("listahospital");
const idhospital = document.getElementById("idhospital");
const area = document.getElementById("area");
const cargo = document.getElementById("cargo");

addEventListener("load", () => {

  contactosH.cargarCargosContactos(cargo);

  hospital.addEventListener('keyup', (event) => {
    contactosH.hospitalesBuscados(event, listahospital, area);    
  });
  hospital.addEventListener("input", (event) => {
    contactosH.cargarIdElementoHospital(event, idhospital, hospital, area);
  });

});
