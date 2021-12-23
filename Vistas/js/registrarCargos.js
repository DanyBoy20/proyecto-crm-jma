/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroCargo as cargos } from "./funciones/validarCargosContactos.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 
 const idFormulario = document.getElementById("formRegistroArea");
 const cargo = document.getElementById("cargo");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 /**
  * Ejecutar la funcion borrarError cuando direccionE tenga el enfoque.
  */
 cargo.addEventListener("focus", (e) => {
   cargos.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de direccionE cuando cambie de valor.
  */
 cargo.addEventListener("blur", (e) => {
   cargos.validarCargo(e);
 }); 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   cargos.validarFormulario(idFormulario);
 });
 