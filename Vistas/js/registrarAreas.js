/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroAreas as areas } from "./funciones/validarRegistroArea.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 
 const idFormulario = document.getElementById("formRegistroArea");
 const areaH = document.getElementById("area");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 /**
  * Ejecutar la funcion borrarError cuando direccionE tenga el enfoque.
  */
 areaH.addEventListener("focus", (e) => {
   areas.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de direccionE cuando cambie de valor.
  */
 areaH.addEventListener("blur", (e) => {
   areas.validarDireccion(e);
 }); 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   areas.validarFormulario(idFormulario);
 });
 