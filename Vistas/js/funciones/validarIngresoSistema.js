/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import {
  soloEmail,
  expresioncontrasenia,
  camposValidarIngreso,
} from "./constantes.js";

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
    elemento.target.nextSibling.innerHTML = "El campo correo es obligatorio.";
  } else if (longitudNumero < 10 || longitudNumero > 50) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El correo debe tener cuando menos 10 caracteres";
  } else if (!soloEmail.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "El correo no es valido.";
  } else {
    camposValidarIngreso.campoCorreo = true;
  }
};

/**
 * Función para validar la contraseña
 * @param {HTMLElement} elemento Representa la caja de contraseña
 */
const validarContrasenia = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "" || longitudNumero != 8) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;La contraseña debe ser de 8 caracteres&nbsp;&nbsp;";
  } else if (!expresioncontrasenia.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "&nbsp;&nbsp;Contraseña no valida&nbsp;&nbsp;";
  } else {
    camposValidarIngreso.campoContrasenia = true;
  }
};

/**
 * Función que valida el objeto que contiene las propiedades del formulario.
 * @param {HTMLElement} formulario Representa el formulario
 * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
 */
const validarIngreso = (formulario) => {
  const valoresCampos = Object.values(camposValidarIngreso);
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
export const validacionesIngreso = {
  borrarError,
  validarCorreo,
  validarContrasenia,
  validarIngreso,
};
