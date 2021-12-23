/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroMarcas as marcas } from "./funciones/validarRegistroMarcas.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 
 const idFormulario = document.getElementById("formRegistroMarcas");
 const marcaP = document.getElementById("marca");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 /**
  * Ejecutar la funcion borrarError cuando direccionE tenga el enfoque.
  */
 marcaP.addEventListener("focus", (e) => {
   marcas.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de direccionE cuando cambie de valor.
  */
 marcaP.addEventListener("blur", (e) => {
   marcas.validarMarca(e);
 }); 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   marcas.validarFormulario(idFormulario);
 });
 