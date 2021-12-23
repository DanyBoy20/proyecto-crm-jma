/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloTextoNumeroDir,
    campoTipoDemo,
    campoTiposCapacitacion,
    campoTiposPoliza
  } from "./constantes.js";
  
  let campoTipoDemos = [
    "tipo demo"
  ];

  let campoTipoCapacitacion = [
    "tipo capacitación"
  ];

  let campoTipoPoliza = [
    "tipo póliza"
  ];

  
  const borrarError = (elemento) => {
    elemento.target.nextSibling.innerHTML = "";
  };

 
  const validarTipoDemo = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El campo tipo demostracion es obligatorio.";
    } else if (longitudNumero < 4 || longitudNumero > 70) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Escriba al menos 5 caracteres";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo puede ingresar texto y numero en este campo";
    } else {
      campoTipoDemo.demo = true;
    }
  };  
  
  
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(campoTipoDemo);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + campoTipoDemos[valido] + " es obligatorio");
      return false;
    }  
  };

  const validarTipoCapacitacion = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Campo es obligatorio.";
    } else if (longitudNumero < 4 || longitudNumero > 70) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Escriba al menos 5 caracteres";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo puede ingresar texto y numero en este campo";
    } else {
        campoTiposCapacitacion.capacitacion = true;
    }
  };  
  
  
   const validarFormularioCap = (identificadorFormulario) => {
    const valoresCampos = Object.values(campoTiposCapacitacion);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + campoTipoCapacitacion[valido] + " es obligatorio");
      return false;
    }  
  };
  
  const validarTipoPoliza = (elemento) => {
    let longitudNumero = elemento.target.value.trim().length;
    if (longitudNumero == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Campo es obligatorio.";
    } else if (longitudNumero < 4 || longitudNumero > 70) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Escriba al menos 5 caracteres";
    } else if (!soloTextoNumeroDir.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo puede ingresar texto y numero en este campo";
    } else {
        campoTiposPoliza.poliza = true;
    }
  };  
  
  
   const validarFormularioTipoPoliza = (identificadorFormulario) => {
    const valoresCampos = Object.values(campoTiposPoliza);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      identificadorFormulario.submit();
    } else {
      alert("El campo " + campoTipoPoliza[valido] + " es obligatorio");
      return false;
    }  
  };
  
  export const validarRegistroTiposSolicitud = {
    validarFormulario,
    validarFormularioCap,
    validarFormularioTipoPoliza,
    validarTipoDemo,
    validarTipoCapacitacion,
    validarTipoPoliza,
    borrarError
  };
  