/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import {
  soloTextoNumeroDir,
  soloNumero,
  camposRegistroHospital,
} from "./constantes.js";

let camposHospital = [
  "nombre",
  "tipo hospital",
  "telefono",
  "direccion",
  "estado",
  "ciudad",
  "codigo postal",
  "colonia",
]

/**
 * Función para borrar el contenido que muestra el mensaje de error.
 * @param {HTMLElement} elemento El elemento del cual se seleccionara su hermano adyacente para borrar el contenido de este ultimo.
 */
const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

/**
 * Funcion para validar el nombre.
 * @param {HTMLElement} elemento Representa la caja de texto para el nombre
 */
const validarNombre = (elemento) => {
  let longitudTexto1 = elemento.target.value.trim().length;
  if (longitudTexto1 == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML = "El campo nombre es obligatorio.";
  } else if (longitudTexto1 < 3 || longitudTexto1 > 50) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El nombre debe tener al menos 3 caracteres.";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Solo se permiten letras en este campo.";
  } else {
    camposRegistroHospital.nombre = true;
  }
};


/**
 * Función para validar el rol del empleado.
 * @param {HTMLElement} campoLista Representa el cuadro de lista para la asignación de roles.
 */
 const validarTipoH = (campoLista) => {
  if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposRegistroHospital.asignarrol = true;
  }
};


/**
 * Función para validar el telefono.
 * @param {HTMLElement} elemento Representa el input del formulario con el numero de telefono.
 */
const validarNumeroTelefono = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El campo numero de telefono es obligatorio.";
  } else if (longitudNumero < 7 || longitudNumero > 11) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Debe incluir un numero completo sin espacios.";
  } else if (!soloNumero.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Solo se aceptan numeros en este campo.";
  } else {
    camposRegistroHospital.telefono = true;
  }
};


/**
 * Función para validar la dirección.
 * @param {HTMLElement} elemento Representa la caja de texto con la dirección.
 */
const validarDireccion = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El campo direccion es obligatorio.";
  } else if (longitudNumero < 7 || longitudNumero > 70) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "La dirección debe tener cuando menos 10 caracteres";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Solo puede ingresar texto y numero en este campo";
  } else {
    camposRegistroHospital.direccion = true;
  }
};

/**
 * Función para validar el estado.
 * @param {HTMLElement} elemento Representa el cuadro de lista con los estados
 */
const validarEstado = (elemento) => {
  if (elemento.target.value == "undefined" || elemento.target.value == "") {
    elemento.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    elemento.target.nextSibling.innerHTML = "";
    camposRegistroHospital.estado = true;
  }
};

/**
 * Función para validar la ciudad.
 * @param {HTMLElement} campoLista Representa el cuadro de lista con las ciudades.
 */
const validarCiudad = (campoLista) => {
  if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposRegistroHospital.ciudad = true;
  }
};

/**
 * Función para validar el codigo postal.
 * @param {HTMLElement} campoLista Representa el cuadro de lista codigo postal.
 */
const validarCodigoPostal = (campoLista) => {
  if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposRegistroHospital.codigoPostal = true;
  }
};

/**
 * Función para validar la colonia.
 * @param {HTMLElement} campoLista Representa el cuadro de lista con las colonias.
 */
const validarColonia = (campoLista) => {
  if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposRegistroHospital.colonia = true;
  }
};


/**
   * Función que valida el objeto que contiene las propiedades del formulario.
   * @param {HTMLElement} identificadorFormulario Representa el formulario
   * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
   */
 const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(camposRegistroHospital);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido === -1) {
    identificadorFormulario.submit();
  } else {
    alert("El campo " + camposHospital[valido] + " es obligatorio");
    return false;
  }

};

/**
 * Objeto con las funciones de validación
 */
export const validarRegistroHospitales = {
  validarFormulario,
  validarTipoH,
  validarColonia,
  validarCodigoPostal,
  validarCiudad,
  validarEstado,
  validarDireccion,
  validarNumeroTelefono,
  validarNombre,
  borrarError,
};
