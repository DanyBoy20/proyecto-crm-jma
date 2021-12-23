/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroDemos as instalacion } from "./funciones/validarRegistroCapacitacion.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 const formRegistroCapacitacion = document.getElementById("formRegistroCapacitacion");
 const solicitante = document.getElementById("solicitante");
 const producto = document.getElementById("producto");
 const hospital = document.getElementById("hospital");
 const tipocapacitacion = document.getElementById("tipocapacitacion");
 const mensaje = document.getElementById("mensaje");
 const validarIngreso = document.getElementById("validarIngreso");
 
  /**
  * Ejecutar la funcion borrarError cuando estadoE tenga el enfoque.
  */
   tipocapacitacion.addEventListener("focus", (e) => {
    instalacion.borrarError(e);
  });
  
  /**
   * Ejecutar la validacion de estadoE cuando cambie de valor.
   */
  tipocapacitacion.addEventListener("change", (e) => {
    instalacion.validarCapacitacion(e);
  });
 

 /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
producto.addEventListener("focus", (e) => {
  instalacion.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
producto.addEventListener("blur", (e) => {
  instalacion.validarProducto(e);
});

/**
 * Ejecutar la funcion borrarError cuando apellidopE tenga el enfoque.
 */
hospital.addEventListener("focus", (e) => {
  instalacion.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de apellidopE cuando cambie de valor.
 */
hospital.addEventListener("blur", (e) => {
  instalacion.validarHospital(e);
});
 
 /**
  * Ejecutar la funcion borrarError cuando ciudadE tenga el enfoque.
  */
 solicitante.addEventListener("focus", (e) => {
   instalacion.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de ciudadE cuando cambie de valor.
  */
 solicitante.addEventListener("change", (e) => {
   instalacion.validarSolicitante(e);
 });
 
  /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
mensaje.addEventListener("focus", (e) => {
  instalacion.borrarErrorTextArea(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
mensaje.addEventListener("blur", (e) => {
  instalacion.validarComentarios(e);
});
 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  validarIngreso.addEventListener("click", (event) => {
   event.preventDefault();
   instalacion.validarFormulario(formRegistroCapacitacion);
 });
 