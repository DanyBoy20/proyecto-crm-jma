/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroPolizas as polizas } from "./funciones/validarRegistroPoliza.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 const formRegistroDemo = document.getElementById("formRegistroDemo");
 const tipopoliza = document.getElementById("tipopoliza");
 const hospital = document.getElementById("hospital");
 const solicitante = document.getElementById("solicitante");
 const area = document.getElementById("area");
 const producto = document.getElementById("producto");
 const numserie = document.getElementById("sn");
 const mensaje = document.getElementById("mensaje");
 const validarIngreso = document.getElementById("validarIngreso");
 
  /**
  * Ejecutar la funcion borrarError cuando estadoE tenga el enfoque.
  */
   tipopoliza.addEventListener("focus", (e) => {
    polizas.borrarError(e);
  });
  
  /**
   * Ejecutar la validacion de estadoE cuando cambie de valor.
   */
  tipopoliza.addEventListener("change", (e) => {
    polizas.validarPoliza(e);
  });
 

 /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
producto.addEventListener("focus", (e) => {
  polizas.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
producto.addEventListener("blur", (e) => {
  polizas.validarProducto(e);
});

/**
 * Ejecutar la funcion borrarError cuando apellidopE tenga el enfoque.
 */
hospital.addEventListener("focus", (e) => {
  polizas.borrarErrorList(e);
});

/**
 * Ejecutar la validacion de apellidopE cuando cambie de valor.
 */
hospital.addEventListener("blur", (e) => {
  polizas.validarHospital(e);
});
 
 /**
  * Ejecutar la funcion borrarError cuando ciudadE tenga el enfoque.
  */
 solicitante.addEventListener("focus", (e) => {
   polizas.borrarError(e);
 });
 
 /**
  * Ejecutar la validacion de ciudadE cuando cambie de valor.
  */
 solicitante.addEventListener("change", (e) => {
   polizas.validarSolicitante(e);
 });

 area.addEventListener("focus", (e) => {
    polizas.borrarError(e);
  });
  
  area.addEventListener("change", (e) => {
    polizas.validarArea(e);
  });
 
  /**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
mensaje.addEventListener("focus", (e) => {
  polizas.borrarErrorTextArea(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
mensaje.addEventListener("blur", (e) => {
  polizas.validarComentarios(e);
});

/**
 * Ejecutar la funcion borrarError cuando telefonoE tenga el enfoque.
 */
 numserie.addEventListener("focus", (e) => {
  polizas.borrarError(e);
});

/**
 * Ejecutar la validacion de telefonoE cuando cambie de valor.
 */
numserie.addEventListener("blur", (e) => {
  polizas.validarNumeroSerie(e);
});
 
 
 /**
   * Ejecutar la validacion del formulario.
   */
  validarIngreso.addEventListener("click", (event) => {
   event.preventDefault();
   polizas.validarFormulario(formRegistroDemo);
 });
 