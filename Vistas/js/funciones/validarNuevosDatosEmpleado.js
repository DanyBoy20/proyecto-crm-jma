/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

import {
  soloTextoNumeroDir,
  soloNumero,
  tipoArchivos,
  camposActualizarEmpleado,
} from "./constantes.js";

/**
 * Función para eliminar el contenido del elemento adyacente al elemento del formulario pasado por parametro.
 * @param {HTMLElement} elemento Representa el elemento HTML del cual elegir el elemento adyacente para eliminar el contenido de este ultimo.
 * @returns {void}
 */
const borrarError = (elemento) => {
  elemento.target.nextSibling.innerHTML = "";
};

/**
 * Funcion para validar la entrada del numero de celular
 * @param {HTMLElement} elemento Representa la caja del formulario html para validar el numero de celular.
 * @returns {void}
 */
const validarNumeroCelular = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El campo numero de celular es obligatorio.";
  } else if (longitudNumero < 7 || longitudNumero > 11) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Debe incluir un numero completo sin espacios.";
  } else if (!soloNumero.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Solo se aceptan numeros en este campo.";
  } else {
    camposActualizarEmpleado.celular = true;
  }
};

/**
 * Función para validar el numero de telefono.
 * @param {HTMLElement} elemento Representa la caja del formulario para validar el numero de telefono.
 * @returns {void}
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
    camposActualizarEmpleado.telefono = true;
  }
};

/**
 * Función para validar la dirección.
 * @param {HTMLElement} elemento Representa a caja de texto del formulario para validar la dirección.
 * @returns {void}
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
    camposActualizarEmpleado.direccion = true;
  }
};

/**
 * Función para validar el estado
 * @param {HTMLElement} elemento Representa el cuadro de lista para los valores de estado
 * @returns {void}
 */
const validarEstado = (elemento) => {
  if (elemento.target.value == "undefined" || elemento.target.value == "") {
    elemento.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    elemento.target.nextSibling.innerHTML = "";
    camposActualizarEmpleado.estado = true;
  }
};

/**
 * Función para validar la ciudad
 * @param {HTMLElement} campoLista Representa el cuadro de lista para los valores de ciudades
 * @returns {void}
 */
const validarCiudad = (campoLista) => {
  if (campoLista.target.value == "undefined" || elemento.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposActualizarEmpleado.ciudad = true;
  }
};

/**
 * Función para validar el codigo postal
 * @param {HTMLElement} campoLista Representa el cuadro de lista con los valores de codigos postales.
 * @returns {void}
 */
const validarCodigoPostal = (campoLista) => {
  if (campoLista.target.value == "undefined" || elemento.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposActualizarEmpleado.codigoPostal = true;
  }
};

/**
 * Función para validar la colonia.
 * @param {HTMLElement} campoLista Representa el cuadro de lista con los valores de las colonias.
 * @returns {void}
 */
const validarColonia = (campoLista) => {
  if (campoLista.target.value == "undefined" || elemento.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposActualizarEmpleado.colonia = true;
  }
};

/**
 * Función para validar la asignación del rol del empleado.
 * @param {HTMLElement} campoLista Representa el cuadro de lista rol.
 * @returns {void}
 */
const validarRol = (campoLista) => {
  if (campoLista.target.value == "undefined" || elemento.target.value == "") {
    campoLista.target.nextSibling.innerHTML =
      "Debe elegir una opcion valida de la lista";
  } else {
    campoLista.target.nextSibling.innerHTML = "";
    camposActualizarEmpleado.asignarrol = true;
  }
};

/**
 * Función para validar el archivo a cargar..
 * @param {HTMLElement} elemento Representa el elemento ARCHIVO (FILE) del formulario
 * @param {HTMLElement} zona Representa la zona de carga del ARCHIVO
 * @param {Object} archivo Representa el archivo a subir
 */
const validarImagen = (elemento, zona, archivo) => {
  elemento.preventDefault();
  let imagen = elemento.dataTransfer.files[0];
  let tamanio = imagen.size;
  let tipo = imagen.type;
  if (Number(tamanio) >= 500000) {
    zona.classList.remove("zona_arrastre--active");
    alert("El peso de la imagen debe ser inferior a 500kb");
    zona.classList.remove("zona_arrastre--active");
  } else if (!imagen.name.match(tipoArchivos)) {
    zona.classList.remove("zona_arrastre--active");
    alert("Debe subir imagenes en formato .jpg o png");
    zona.classList.remove("zona_arrastre--active");
  } else {
    archivo.files = elemento.dataTransfer.files;
    camposRegistroEmpleado.foto = true;
  }
};

/**
 * Función que evalua que todas las propiedades del objeto camposActualizarFormulario estan en true para poder enviar el formulario.
 * @param {HTMLElement} identificadorFormulario Representa el formulario, con la evaluacion de las propiedades objeto camposActualizarFormulario a true.
 * @returns {Boolean} Retorna falso si al menos una propiedad del objeto camposActualizarFormulario esta en falso.
 */
const validarFormulario = (identificadorFormulario) => {
  const valoresCampos = Object.values(camposActualizarEmpleado);
  const valido = valoresCampos.findIndex((value) => value === false);
  if (valido == -1) {
    identificadorFormulario.submit();
  } else {
    alert("Hay campos vacios o con datos invalidos");
    return false;
  }
};

/**
 * Objeto con las funciones de validación
 */
export const nuevosDatosEmpleados = {
  borrarError,
  validarNumeroCelular,
  validarNumeroTelefono,
  validarDireccion,
  validarEstado,
  validarCiudad,
  validarCodigoPostal,
  validarColonia,
  validarRol,
  validarImagen,
  validarFormulario,
};
