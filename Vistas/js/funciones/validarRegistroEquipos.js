/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloTextoNumeroDir,
    camposRegistroEquipos
  } from "./constantes.js";
  
  let campoEquipos = [
    "categoria",
    "marca",
    "descripcion",
    "modelo"    
  ]
  
  const borrarError = (elemento) => {
    elemento.target.nextSibling.innerHTML = "";
  };

  /**
   * Función para validar la dirección.
   * @param {HTMLElement} elemento Representa la caja de texto con la dirección.
   */
  const validarProducto = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El campo area es obligatorio.";
    } else if (longitudNumero < 4 || longitudNumero > 50) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El nombre del area debe tener cuando menos 10 caracteres";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo puede ingresar texto y numero en este campo";
    } else {
      camposRegistroEquipos.descripcion = true;
    }
  };  


  const validarModelo = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El campo area es obligatorio.";
    } else if (longitudNumero < 4 || longitudNumero > 50) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El nombre del area debe tener cuando menos 10 caracteres";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo puede ingresar texto y numero en este campo";
    } else {
      camposRegistroEquipos.modelo = true;
    }
  };

  const validarCategoria = (campoLista) => {
    if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
      campoLista.target.nextSibling.innerHTML =
        "Debe elegir una opcion valida de la lista";
    } else {
      campoLista.target.nextSibling.innerHTML = "";
      camposRegistroEquipos.categoria = true;
    }
  };

  const validarMarca = (campoLista) => {
    if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
      campoLista.target.nextSibling.innerHTML =
        "Debe elegir una opcion valida de la lista";
    } else {
      campoLista.target.nextSibling.innerHTML = "";
      camposRegistroEquipos.marca = true;
    }
  };
  
  /**
     * Función que valida el objeto que contiene las propiedades del formulario.
     * @param {HTMLElement} identificadorFormulario Representa el formulario
     * @returns {Boolean} Devuelve false si el objeto camposRegistroFormulario devuelve al menos una propiedad false, caso conrario envia el formulario.
     */
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(camposRegistroEquipos);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + campoEquipos[valido] + " es obligatorio");
      return false;
    }
  
  };
  
  /**
   * Objeto con las funciones de validación
   */
  export const validarRegistroProductos = {
    validarFormulario,
    validarProducto,
    validarModelo,
    validarCategoria,
    validarMarca,
    borrarError
  };
  