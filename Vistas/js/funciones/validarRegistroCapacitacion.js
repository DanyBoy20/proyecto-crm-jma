/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloTextoNumeroDir,
    camposRegistroCapacitacion
  } from "./constantes.js";
  
  let camposCapacitaciones = [    
    'tipo capacitación',
    'hospital', 
    'solicitante',
    'producto', 
    'mensaje'
  ]
  
  /**
   * Función para borrar el contenido que muestra el mensaje de error.
   * @param {HTMLElement} elemento El elemento del cual se seleccionara su hermano adyacente para borrar el contenido de este ultimo.
   */
  const borrarError = (elemento) => {
    elemento.target.nextSibling.innerHTML = "";
  };

  const borrarErrorList = (elemento) => {
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "";
  };

  const borrarErrorTextArea = (elemento) => {
    elemento.target.nextSibling.nextElementSibling.innerHTML = "";
  };

  const validarCapacitacion = (elemento) => {
    if (elemento.target.value == "undefined" || elemento.target.value == "") {
      elemento.target.nextSibling.innerHTML = "Debe elegir una opcion valida de la lista";
    } else {
      elemento.target.nextSibling.innerHTML = "";
      camposRegistroCapacitacion.tipocapacitacion = true;
    }
  };
  

const validarProducto = (elemento) => {
  let longitudTexto1 = elemento.target.value.trim().length;
  if (longitudTexto1 === 0) {
    elemento.target.value = "";
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "El campo producto es obligatorio.";
  } else if (longitudTexto1 < 0 || longitudTexto1 > 100) {
    elemento.target.value = "";
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "Debe ingresar un nombre de producto valido.";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "Solo se permiten letras en este campo.";
  } else {
    camposRegistroCapacitacion.producto = true;
  }
};


const validarHospital = (elemento) => {
  let longitudTexto1 = elemento.target.value.trim().length;
  if (longitudTexto1 === 0) {
    elemento.target.value = "";
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "El campo hospital es obligatorio.";
  } else if (longitudTexto1 < 2 || longitudTexto1 > 100) {
    elemento.target.value = "";
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "Debe ingresar mas de 1 letra.";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "Solo se permiten letras en este campo.";
  } else {
    camposRegistroCapacitacion.hospital = true;
  }
};

const validarSolicitante = (elemento) => {
  if (elemento.target.value == "undefined" || elemento.target.value == "") {
    elemento.target.nextSibling.innerHTML = "Debe elegir una opcion valida de la lista";
  } else {
    elemento.target.nextSibling.innerHTML = "";
    camposRegistroCapacitacion.solicitante = true;
  }
};

const validarComentarios = (elemento) => {
  /* console.log(elemento.target.nextSibling.nextElementSibling); */
  let longitudTexto1 = elemento.target.value.trim().length;
  if (longitudTexto1 === 0) {
    elemento.target.value = "";
    elemento.target.nextSibling.nextElementSibling.innerHTML = "El campo comentarios es obligatorio.";
  } else if (longitudTexto1 > 150) {
    elemento.target.value = "";
    elemento.target.nextSibling.nextElementSibling.innerHTML = "Debe ingresar un comentario valido.";
  } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.nextElementSibling.innerHTML = "Solo se permiten letras y numeros en este campo.";
  } else {
    camposRegistroCapacitacion.mensaje = true;
  }
};
  
  /**
     * Función que valida el objeto que contiene las propiedades del formulario.
     * @param {HTMLElement} identificadorFormulario Representa el formulario
     * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
     */
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(camposRegistroCapacitacion);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + camposCapacitaciones[valido] + " es obligatorio");
      return false;
    }
  
  };
  
  /**
   * Objeto con las funciones de validación
   */
  export const validarRegistroDemos = {
    validarFormulario,
    validarProducto,
    validarHospital,
    validarSolicitante,
    validarCapacitacion,
    validarComentarios,
    borrarError,
    borrarErrorList,
    borrarErrorTextArea
  };
  