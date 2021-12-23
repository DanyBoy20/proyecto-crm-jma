/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloTextoNumeroDir,
    camposRegistroAreaHospital
  } from "./constantes.js";
  

  let camposAreaHospital = [
    "hospital",
    "area"
    /* "idhospital",
    "idarea" */
  ]

  const borrarErrorList = (elemento) => {
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "";
  };

const validarArea = (elemento) => {
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
    camposRegistroAreaHospital.area = true;
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
    camposRegistroAreaHospital.hospital = true;
  }
};
  
  /**
     * Función que valida el objeto que contiene las propiedades del formulario.
     * @param {HTMLElement} identificadorFormulario Representa el formulario
     * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
     */
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(camposRegistroAreaHospital);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + camposAreaHospital[valido] + " es obligatorio");
      return false;
    }
  
  };
  
  /**
   * Objeto con las funciones de validación
   */
  export const validarRegistroAreaHospital = {
    validarFormulario,
    validarArea,
    validarHospital,
    borrarErrorList
  };
  