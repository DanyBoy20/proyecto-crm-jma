/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { validarRecuperacionCuenta as recuperar } from "./funciones/validarRecuperacionPws.js";

/**
 * Elementos HTML de la seccion evaluar capacidad de credito.
 */
const formulario = document.getElementById("recuperar");
const email = document.getElementById("usuario");
const botonValidarForm = document.getElementById("validarIngreso");

/**
 * Ejecutar la funcion borrarError cuando email tenga el enfoque.
 */
email.addEventListener("focus", (e) => {
  recuperar.borrarError(e);
});

/**
 * Validar el correo electronico cuando el elemento HTML pierda el enfoque
 */
email.addEventListener("focusout", (e) => {
  recuperar.validarCorreo(e);
});

/**
 * Ejecutar la validacion del formulario.
 */
botonValidarForm.addEventListener("click", () => {
  recuperar.validarFormRecuperacion(formulario);
});
