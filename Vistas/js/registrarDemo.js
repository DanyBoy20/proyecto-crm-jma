/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroDemos as demos } from "./funciones/validarRegistroDemo.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 const formRegistroDemo = document.getElementById("formRegistroDemo");
 const tipodemo = document.getElementById("tipodemo");
 const solicitante = document.getElementById("solicitante");
 const producto = document.getElementById("producto");
 const hospital = document.getElementById("hospital");
 const mensaje = document.getElementById("mensaje");
 const validarIngreso = document.getElementById("validarIngreso");
 
 /**
  * Ejecutar la funcion borrarError cuando estadoE tenga el enfoque.
  */
 tipodemo.addEventListener("focus", (e) => {
   demos.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de estadoE cuando cambie de valor.
  */
 tipodemo.addEventListener("change", (e) => {
   demos.validarDemo(e);
 });

 /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
producto.addEventListener("focus", (e) => {
  demos.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
producto.addEventListener("blur", (e) => {
  demos.validarProducto(e);
});

/**
 * Ejecutar la funcion borrarError cuando apellidopE tenga el enfoque.
 */
hospital.addEventListener("focus", (e) => {
  demos.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de apellidopE cuando cambie de valor.
 */
hospital.addEventListener("blur", (e) => {
  demos.validarHospital(e);
});
 
 /**
  * Ejecutar la funcion borrarError cuando ciudadE tenga el enfoque.
  */
 solicitante.addEventListener("focus", (e) => {
   demos.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de ciudadE cuando cambie de valor.
  */
 solicitante.addEventListener("change", (e) => {
   demos.validarSolicitante(e);
 });
 
  /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
mensaje.addEventListener("focus", (e) => {
  demos.borrarErrorTextArea(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
mensaje.addEventListener("blur", (e) => {
  demos.validarComentarios(e);
});
 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  validarIngreso.addEventListener("click", (event) => {
   event.preventDefault();
   demos.validarFormulario(formRegistroDemo);
 });
 