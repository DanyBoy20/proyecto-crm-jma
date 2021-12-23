/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { validarRegistroHospitales as hospital } from "./funciones/validarRegistroHospital.js";

/**
 * Elementos HTML de la seccion evaluar capacidad de credito.
 */

const idFormulario = document.getElementById("formRegistroEmpleado");
const nombreH = document.getElementById("nombre");
const tipoHospital = document.getElementById("tipohospital");
const telefonoH = document.getElementById("telefono");
const direccionH = document.getElementById("direccion");
const estadoH = document.getElementById("estado");
const ciudadH = document.getElementById("ciudad");
const cpH = document.getElementById("cp");
const coloniaH = document.getElementById("colonia");

const botonValidarForm = document.getElementById("validarIngreso");

/**
 * Expresiones regulares (REGEX) para validacion de datos.
 */

/**
 * Ejecutar la funcion borrarError cuando nombreE tenga el enfoque.
 */
nombreH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de nombreE cuando cambie de valor.
 */
nombreH.addEventListener("blur", (e) => {
  hospital.validarNombre(e);
});

/**
 * Ejecutar la funcion borrarError cuando rolE tenga el enfoque.
 */
 tipoHospital.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de rolE cuando cambie de valor.
 */
tipoHospital.addEventListener("change", (e) => {
  hospital.validarTipoH(e);
});

/**
 * Ejecutar la funcion borrarError cuando telefonoE tenga el enfoque.
 */
telefonoH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de telefonoE cuando cambie de valor.
 */
telefonoH.addEventListener("blur", (e) => {
  hospital.validarNumeroTelefono(e);
});

/**
 * Ejecutar la funcion borrarError cuando direccionE tenga el enfoque.
 */
direccionH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de direccionE cuando cambie de valor.
 */
direccionH.addEventListener("blur", (e) => {
  hospital.validarDireccion(e);
});

/**
 * Ejecutar la funcion borrarError cuando estadoE tenga el enfoque.
 */
estadoH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de estadoE cuando cambie de valor.
 */
estadoH.addEventListener("change", (e) => {
  hospital.validarEstado(e);
});

/**
 * Ejecutar la funcion borrarError cuando ciudadE tenga el enfoque.
 */
ciudadH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de ciudadE cuando cambie de valor.
 */
ciudadH.addEventListener("change", (e) => {
  hospital.validarCiudad(e);
});

/**
 * Ejecutar la funcion borrarError cuando cpE tenga el enfoque.
 */
cpH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de cpE cuando cambie de valor.
 */
cpH.addEventListener("change", (e) => {
  hospital.validarCodigoPostal(e);
});

/**
 * Ejecutar la funcion borrarError cuando coloniaE tenga el enfoque.
 */
coloniaH.addEventListener("focus", (e) => {
  hospital.borrarError(e);
});

/**
 * Ejecutar la validacion de coloniaE cuando cambie de valor.
 */
coloniaH.addEventListener("change", (e) => {
  hospital.validarColonia(e);
});



/**
  * Ejecutar la validacion del formulario.
  */
 botonValidarForm.addEventListener("click", (event) => {
  event.preventDefault();
  hospital.validarFormulario(idFormulario);
});
