/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import {
    soloTexto,
    soloNumero,
    soloEmail,
    soloTextoNumeroDir,
    camposContactos
  } from "./constantes.js";

  let camposContactosVal = [
    /* "idhospital", */
    "hospital",
    "titulo",
    "nombre",
    "apellido paterno",
    "apellido materno",
    "cargo",
    "telefono",
    "celular",    
    "campo correo",    
    "area"
  ]
  
  const validarEntrada = (event) => {
    let entrada = event.target;
    let caracteresMinimos = 0;
    let soloTexto = /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/;  
    /* if(event.keyCode === 32){ 
      entrada.value = "";
      return;
    } */
    if(entrada.value.length < caracteresMinimos){
        entrada.value = "";  
        return;
    }
    if(!soloTexto.test(event.target.value)){
        entrada.value = "";
        return;
    }
  }

  const validarEntradaNumero = (event) => {
    let entrada = event.target;
    let caracteresMinimos = 0;
    let soloNumero = /^[0-9]*$/;  
    if(event.keyCode === 32){ 
      entrada.value = "";
      return;
    }
    if(entrada.value.length < caracteresMinimos){
        entrada.value = "";  
        return;
    }
    if(!soloNumero.test(event.target.value)){
        entrada.value = "";
        return;
    }
  }
  
  const borrarError = (elemento) => {
    elemento.target.nextSibling.innerHTML = "";
  };

  const borrarErrorList = (elemento) => {
    elemento.target.list.nextSibling.nextElementSibling.innerHTML = "";
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
      camposContactos.hospital = true;
    }
  };

  const validarTitulo = (campoLista) => {
    if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
      campoLista.target.nextSibling.innerHTML =
        "Debe elegir una opcion valida de la lista";
    } else {
      campoLista.target.nextSibling.innerHTML = "";
      camposContactos.titulo = true;
    }
  };

  const validarNombre = (elemento) => {
    let longitudTexto1 = elemento.target.value.trim().length;
    if (longitudTexto1 == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML = "El campo nombre es obligatorio.";
    } else if (longitudTexto1 < 3 || longitudTexto1 > 35) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El nombre debe tener al menos 3 caracteres.";
    } else if (!soloTexto.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo se permiten letras en este campo.";
    } else {
      camposContactos.nombre = true;
    }
  };

  const validarApellidoP = (elemento) => {
    let longitudTexto1 = elemento.target.value.trim().length;
    if (longitudTexto1 == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El campo apellido paterno es obligatorio.";
    } else if (longitudTexto1 < 4 || longitudTexto1 > 35) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Esta campo debe tener al menos 4 caracteres.";
    } else if (!soloTexto.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo se permiten letras en este campo.";
    } else {
      camposContactos.apellidop = true;
    }
  };

  const validarApellidoM = (elemento) => {
    let longitudTexto1 = elemento.target.value.trim().length;
    if (longitudTexto1 == "") {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "El campo apellido materno es obligatorio.";
    } else if (longitudTexto1 < 4 || longitudTexto1 > 35) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Este campo debe tener al menos 4 caracteres.";
    } else if (!soloTexto.test(elemento.target.value)) {
      elemento.target.value = "";
      elemento.target.nextSibling.innerHTML =
        "Solo se permiten letras en este campo.";
    } else {
      camposContactos.apellidom = true;
    }
  };

  const validarCargo = (campoLista) => {
    if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
      campoLista.target.nextSibling.innerHTML =
        "Debe elegir una opcion valida de la lista";
    } else {
      campoLista.target.nextSibling.innerHTML = "";
      camposContactos.cargo = true;
    }
  };

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
      camposContactos.telefono = true;
    }
  };

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
      camposContactos.celular = true;
    }
  };
  
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
      camposContactos.email = true;
    }
  };

  const validarArea = (campoLista) => {
    if (campoLista.target.value == "undefined" || campoLista.target.value == "") {
      campoLista.target.nextSibling.innerHTML =
        "Debe elegir una opcion valida de la lista";
    } else {
      campoLista.target.nextSibling.innerHTML = "";
      camposContactos.area = true;
    }
  };

  const limpiarCampos = (identificador) => {
    if (confirm('Registro insertado\n\n¿Desea agregar otro registro?')) {
      window.location = "registro-contactos"
    } else {
      window.location = "inicio"
    }
  }

  const enviarDatosForm = async (identificador) => {

    try {
      const datos = new FormData(identificador);
      const url = 'Controladores/ApiFetchContactos.php';
      const res = await fetch(url, {method: 'POST', body: datos});
      const data = await res.json();
      console.log(data);

      if(data == "ok"){
        limpiarCampos(identificador);
      }else{
        alert("No se pudo guardar el registro, intente más tarde");
        window.location = "inicio";
      }     

    } catch (error) {
      console.log(error);
      alert("Ocurrio un error, intente más tarde");
      /* window.location = "inicio" */

    }

    
}
  
   const validarFormulario = (identificadorFormulario) => {
    const valoresCampos = Object.values(camposContactos);
    const valido = valoresCampos.findIndex((value) => value === false);
    if (valido === -1) {
      enviarDatosForm(identificadorFormulario);
    } else {
      alert("El campo " + camposContactosVal[valido] + " es obligatorio");
      return false;
    }
  };

  export const validarRegistroContactos = {
    validarEntrada,
    validarEntradaNumero,
    validarHospital,
    validarTitulo,
    validarNombre,
    validarApellidoP,
    validarApellidoM,
    validarCargo,
    validarNumeroTelefono,
    validarNumeroCelular,
    validarCorreo,
    validarArea,
    borrarError,
    borrarErrorList,
    validarFormulario,
  };
  