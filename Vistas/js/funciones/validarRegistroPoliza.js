/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloNumero,
    soloTextoNumeroDir,
    camposRegistroPoliza
  } from "./constantes.js";
  
  let campospolizas = [    
    "tipo poliza",
    "hospital",
    "solicitante",
    "area",
    "mensaje",
    "producto",
    "serie"
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

  const validarPoliza = (elemento) => {
    if (elemento.target.value == "undefined" || elemento.target.value == "") {
      elemento.target.nextSibling.innerHTML = "Debe elegir una opcion valida de la lista";
    } else {
      elemento.target.nextSibling.innerHTML = "";
      camposRegistroPoliza.tipopoliza = true;
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
    camposRegistroPoliza.producto = true;
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
    camposRegistroPoliza.hospital = true;
  }
};

const validarSolicitante = (elemento) => {
  if (elemento.target.value == "undefined" || elemento.target.value == "") {
    elemento.target.nextSibling.innerHTML = "Debe elegir una opcion valida de la lista";
  } else {
    elemento.target.nextSibling.innerHTML = "";
    camposRegistroPoliza.solicitante = true;
  }
};

const validarArea = (campoLista) => {
    if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
      campoLista.target.nextSibling.innerHTML =
        "Debe elegir una opcion valida de la lista";
    } else {
      campoLista.target.nextSibling.innerHTML = "";
      camposRegistroPoliza.area = true;
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
    camposRegistroPoliza.mensaje = true;
  }
};

const validarNumeroSerie = (elemento) => {
  let longitudNumero = elemento.target.value.trim().length;
  if (longitudNumero == "") {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "El campo numero serie es obligatorio.";
  } else if (longitudNumero != 10) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Debe incluir un numero completo de 10 digitos";
  } else if (!soloNumero.test(elemento.target.value)) {
    elemento.target.value = "";
    elemento.target.nextSibling.innerHTML =
      "Solo se aceptan numeros en este campo.";
  } else {
    camposRegistroPoliza.serie = true;
  }
};
  
  /**
     * Función que valida el objeto que contiene las propiedades del formulario.
     * @param {HTMLElement} identificadorFormulario Representa el formulario
     * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
     */
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(camposRegistroPoliza);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + campospolizas[valido] + " es obligatorio");
      return false;
    }
  
  };
  
  /**
   * Objeto con las funciones de validación
   */
  export const validarRegistroPolizas = {
    validarPoliza,
    validarFormulario,
    validarProducto,
    validarHospital,
    validarSolicitante,
    validarArea,
    validarComentarios,
    validarNumeroSerie,
    borrarError,
    borrarErrorList,
    borrarErrorTextArea
  };
  