/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import { soloEmail, campoEmailRecuperar } from "./constantes.js";

/**
 * Función para borrar el contenido que muestra el mensaje de error.
 * @param {HTMLElement} elemento El elemento del cual se seleccionara su hermano adyacente para borrar el contenido de este ultimo.
 */
const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

/**
 * Función para validar el correo electronico.
 * @param {HTMLElement} elemento Representa la caja de texto con formato de correo.
 */
const validarCorreo = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;El campo correo es obligatorio.&nbsp;&nbsp;";
  } else if (longitudNumero < 10 || longitudNumero > 50) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;El correo debe tener cuando menos 10 caracteres.&nbsp;&nbsp;";
  } else if (!soloEmail.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;El correo no es valido.&nbsp;&nbsp;";
  } else {
    campoEmailRecuperar.campoCorreo = true;
  }
};

/**
 * Función que valida el objeto que contiene las propiedades del formulario.
 * @param {HTMLElement} formulario Representa el formulario
 * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
 */
const validarFormRecuperacion = (formulario) => {
  const valoresCampos = Object.values(campoEmailRecuperar);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido == -1) {
    formulario.submit();
  } else {
    return false;
  }
};

/**
 * Objeto con las funciones de validación
 */
export const validarRecuperacionCuenta = {
  borrarError,
  validarCorreo,
  validarFormRecuperacion,
};
