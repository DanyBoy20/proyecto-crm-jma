/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    /* soloNumero, */
    soloTextoNumeroDir,
    camposActualizarDemo
  } from "./constantes.js";
  
  let camposActualDemo = [
    "mensaje",
  ]
  
  const borrarError = (elemento) => {
    elemento.target.nextElementSibling.innerHTML = "";
  };
  
  /* const validarId = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Campos vacios.";
    } else if (longitudNumero <= 0) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Debe ingresar un dato a enviar.";
    } else if (!soloNumero.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo se aceptan numeros en este campo.";
    } else {
      camposActualizarDemo.id = true;
    }
  }; */


  /* const validarfecha = (elemento) => {
    console.log(elemento);
    var today =new Date();
      var inputDate = new Date(elemento.target.value);
      if (inputDate.value == " "){
          return false;
      } else if (inputDate > today) {
          return false;
      } else {
          return true;
      }
  } */


  const validarComentarios = (elemento) => {
    /* console.log(elemento.target.nextSibling.nextElementSibling); */
    let longitudTexto1 = elemento.target.value.trim().length;
    if (longitudTexto1 === 0) {
      elemento.target.value = "";
      elemento.target.nextElementSibling.innerHTML = "El campo comentarios es obligatorio.";
    } else if (longitudTexto1 > 150) {
      elemento.target.value = "";
      elemento.target.nextElementSibling.innerHTML = "Debe ingresar un comentario valido.";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextElementSibling.innerHTML = "Solo se permiten letras y numeros en este campo.";
    } else {
      camposActualizarDemo.mensaje = true;
    }
  };
  
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(camposActualizarDemo);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + camposActualDemo[valido] + " es obligatorio");
      return false;
    }
  
  };

  const imprimirform = (identificadorFormulario) => {
      identificadorFormulario.submit();  
  };

  export const validarActualizacionDemo = {
    validarFormulario,
    imprimirform,
    /* validarId,
    validarfecha, */
    validarComentarios,
    borrarError,
  };
  