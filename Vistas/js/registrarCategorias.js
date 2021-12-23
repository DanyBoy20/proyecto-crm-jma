/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroAreas as categoria } from "./funciones/validarRegistroCategoria.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 
 const idFormulario = document.getElementById("formRegistroCategorias");
 const categoriaP = document.getElementById("categoria");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 /**
  * Ejecutar la funcion borrarError cuando direccionE tenga el enfoque.
  */
 categoriaP.addEventListener("focus", (e) => {
   categoria.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de direccionE cuando cambie de valor.
  */
 categoriaP.addEventListener("blur", (e) => {
   categoria.validarCategoria(e);
 }); 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   categoria.validarFormulario(idFormulario);
 });
 