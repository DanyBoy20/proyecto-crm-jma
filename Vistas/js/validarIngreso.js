/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { validacionesIngreso as ingreso } from "./funciones/validarIngresoSistema.js";

/* -------------- FORMULARIO INGRESO --------------  */
const contactoForm = document.getElementById("ingreso");
const correoElectronico = document.getElementById("usuario");
const contrasenia = document.getElementById("contrasenia");
const botonValidarForm = document.getElementById("validarIngreso");

/**
 * Ejecutar la función borrarError cuando correoElectronico tenga el enfoque.
 */
correoElectronico.addEventListener("focus", (e) => {
  ingreso.borrarError(e);
});

/**
 * Validar el correo electronico
 */
correoElectronico.addEventListener("focusout", (e) => {
  ingreso.validarCorreo(e);
});

/**
 * Ejecutar la función borrarError cuando contrasenia tenga el enfoque.
 */
contrasenia.addEventListener("focus", (e) => {
  ingreso.borrarError(e);
});

/**
 * Validar la contraseña
 */
contrasenia.addEventListener("focusout", (e) => {
  ingreso.validarContrasenia(e);
});

/**
 * Ejecutar la validacion del formulario.
 */
botonValidarForm.addEventListener("click", () => {
  ingreso.validarIngreso(contactoForm);
});
