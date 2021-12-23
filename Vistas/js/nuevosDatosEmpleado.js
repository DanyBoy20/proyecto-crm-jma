/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { nuevosDatosEmpleados as actualizarEmpleado } from "./funciones/validarNuevosDatosEmpleado.js";

/**
 * Elementos HTML de la seccion evaluar capacidad de credito.
 */
const archivo = document.getElementById("archivo");
const zonaArrastre = document.getElementById("zona_arrastre");
const idFormulario = document.getElementById("formEditarEmpleado");
const celularE = document.getElementById("celular");
const telefonoE = document.getElementById("telefono");
const direccionE = document.getElementById("direccion");
const estadoE = document.getElementById("estado");
const ciudadE = document.getElementById("ciudad");
const cpE = document.getElementById("cp");
const coloniaE = document.getElementById("colonia");
const rolE = document.getElementById("rol");
const botonValidarForm = document.getElementById("validarIngreso");

/**
 * Expresiones regulares (REGEX) para validacion de datos.
 */
const tipoArchivos = /.(jpg|jpeg|png)$/i;

/**
 * Ejecutar la funcion borrarError cuando celularE tenga el enfoque.
 */
celularE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validación de la caja de texto celular cuando esta pierda el enfoque.
 */
celularE.addEventListener("blur", (e) => {
  actualizarEmpleado.validarNumeroCelular(e);
});

/**
 * Ejecutar la función borrarError cuando telefonoE tenga el enfique
 */
telefonoE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validación de la caja de texto telefono cuando este pierda el enfique.
 */
telefonoE.addEventListener("blur", (e) => {
  actualizarEmpleado.validarNumeroTelefono(e);
});

/**
 * Ejecutar la función borrarError cuando direccionE tenga el enfoque.
 */
direccionE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validacion de direccionE cuando este pierda el enfoque.
 */
direccionE.addEventListener("blur", (e) => {
  actualizarEmpleado.validarDireccion(e);
});

/**
 * Ejecutar la función borrarError cuando estadoE tenga el enfoque.
 */
estadoE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validacion de estadoE cambie de valor.
 */
estadoE.addEventListener("change", (e) => {
  actualizarEmpleado.validarEstado(e);
});

/**
 * Ejecutar la función borrarError cuando ciudadE tenga el enfoque.
 */
ciudadE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validacion de ciudadE cambie de valor.
 */
ciudadE.addEventListener("change", (e) => {
  actualizarEmpleado.validarCiudad(e);
});

/**
 * Ejecutar la función borrarError cuando cpE tenga el enfoque.
 */
cpE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validacion de cpE cuando cambie de valor.
 */
cpE.addEventListener("change", (e) => {
  actualizarEmpleado.validarCodigoPostal(e);
});

/**
 * Ejecutar la función borrarError cuando coloniaE tenga el enfoque.
 */
coloniaE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validacion de coloniaE cambie de valor.
 */
coloniaE.addEventListener("change", (e) => {
  actualizarEmpleado.validarColonia(e);
});

/**
 * Ejecutar la función borrarError cuando rolE tenga el enfoque.
 */
rolE.addEventListener("focus", (e) => {
  actualizarEmpleado.borrarError(e);
});

/**
 * Ejecutar la validacion de rolE cambie de valor.
 */
rolE.addEventListener("change", (e) => {
  actualizarEmpleado.validarRol(e);
});

/**
 * Al clickear en zoneDrop, ejecutaremos el click del fileInput dicho de otra forma, es como si pulsaramos el boton de examinar
 */
zonaArrastre.addEventListener("click", () => {
  archivo.click();
});

/**
 * Al pasar (dragover) sobre la zona, añadimos una clase CSS al elemento
 */
zonaArrastre.addEventListener("dragover", (e) => {
  e.preventDefault();
  zonaArrastre.classList.add("zona_arrastre--active");
});

/**
 * Al salir (dragleave) la zona, removemos una clase CSS al elemento
 */
zonaArrastre.addEventListener("dragleave", (e) => {
  e.preventDefault();
  zonaArrastre.classList.remove("zona_arrastre--active");
});

/**
 * Al soltar el elemento en la zona de arrastre, añadimos la informacion del archivo al fileInput, es decir, sin haber tenido que hacer clic para buscar en el explorador
 */
zonaArrastre.addEventListener("drop", (e) => {
  actualizarEmpleado.validarImagen(e, zonaArrastre, archivo);
});

/**
 * Ejecutar la validacion de botonValidarForm cuando se haga click en el.
 */
botonValidarForm.addEventListener("click", () => {
  actualizarEmpleado.validarFormulario(idFormulario);
});
