/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroAreaHospital as areaHospital } from "./funciones/validarAreaHospital.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 const formRegistroDemo = document.getElementById("formRegistroDemo");
 const area = document.getElementById("area");
 const hospital = document.getElementById("hospital");
 const validarIngreso = document.getElementById("validarIngreso");
 const idarea = document.getElementById("idarea");
 const idhospital = document.getElementById("idhospital");

 /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
area.addEventListener("focus", (e) => {
  areaHospital.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
area.addEventListener("blur", (e) => {
  areaHospital.validarArea(e);
});

/**
 * Ejecutar la funcion borrarError cuando apellidopE tenga el enfoque.
 */
hospital.addEventListener("focus", (e) => {
  areaHospital.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de apellidopE cuando cambie de valor.
 */
hospital.addEventListener("blur", (e) => {
  areaHospital.validarHospital(e);
});
 
 /**
   * Ejecutar la validacion del formulario.
   */
  validarIngreso.addEventListener("click", (event) => {
   event.preventDefault();
   areaHospital.validarFormulario(formRegistroDemo);
 });
 