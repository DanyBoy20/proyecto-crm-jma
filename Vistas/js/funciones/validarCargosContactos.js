/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloTextoNumeroDir,
    campoCargo
  } from "./constantes.js";
  
  let campoCargos = [
    "cargo"
  ]
  
  const borrarError = (elemento) => {
    elemento.target.nextSibling.innerHTML = "";
  };

  /**
   * Función para validar la dirección.
   * @param {HTMLElement} elemento Representa la caja de texto con la dirección.
   */
  const validarCargo = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El campo cargo es obligatorio.";
    } else if (longitudNumero < 5 || longitudNumero > 40) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El cargo debe tener cuando menos 5 caracteres";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo puede ingresar texto y numero en este campo";
    } else {
      campoCargo.cargo = true;
    }
  };  
  
  /**
     * Función que valida el objeto que contiene las propiedades del formulario.
     * @param {HTMLElement} identificadorFormulario Representa el formulario
     * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
     */
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(campoCargo);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + campoCargos[valido] + " es obligatorio");
      return false;
    }
  
  };
  
  /**
   * Objeto con las funciones de validación
   */
  export const validarRegistroCargo = {
    validarFormulario,
    validarCargo,
    borrarError
  };
  