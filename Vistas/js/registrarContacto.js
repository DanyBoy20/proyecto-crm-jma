/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroContactos as contactos } from "./funciones/validarRegistroContacto.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */

 const idFormulario = document.getElementById("formRegistroContacto");
 const idhospital = document.getElementById("idhospital");
 const hospital = document.getElementById("hospital"); 
 const titulo = document.getElementById("titulo");
 const nombreC = document.getElementById("nombre");
 const apellidopC = document.getElementById("apellidop");
 const apellidomC = document.getElementById("apellidom");
 const cargo = document.getElementById("cargo");
 const telefonoC = document.getElementById("telefono");
 const celularC = document.getElementById("celular");
 const emailC = document.getElementById("email");
 const area = document.getElementById("area");
 const botonValidarForm = document.getElementById("validarIngreso");


hospital.addEventListener("focus", (e) => {
  contactos.borrarErrorList(e);
});

hospital.addEventListener("blur", (e) => {
  contactos.validarHospital(e);
});

titulo.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

titulo.addEventListener("change", (e) => {
  contactos.validarTitulo(e);
});

nombreC.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

nombreC.addEventListener("blur", (e) => {
  contactos.validarNombre(e);
});

nombreC.addEventListener("keyup", (event) => {
  contactos.validarEntrada(event);
});

apellidopC.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});


apellidopC.addEventListener("blur", (e) => {
  contactos.validarApellidoP(e);
});

apellidopC.addEventListener("keyup", (event) => {
  contactos.validarEntrada(event);
});

apellidomC.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});


apellidomC.addEventListener("blur", (e) => {
  contactos.validarApellidoM(e);
});

apellidomC.addEventListener("keyup", (event) => {
  contactos.validarEntrada(event);
});

cargo.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

cargo.addEventListener("change", (e) => {
  contactos.validarCargo(e);
});

telefonoC.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

telefonoC.addEventListener("blur", (e) => {
  contactos.validarNumeroTelefono(e);
});

telefonoC.addEventListener("keyup", (event) => {
  contactos.validarEntradaNumero(event);
})

celularC.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

celularC.addEventListener("blur", (e) => {
  contactos.validarNumeroCelular(e);
});

celularC.addEventListener("keyup", (event) => {
  contactos.validarEntradaNumero(event);
});

emailC.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

emailC.addEventListener("blur", (e) => {
  contactos.validarCorreo(e);
});

area.addEventListener("focus", (e) => {
  contactos.borrarError(e);
});

area.addEventListener("change", (e) => {
  contactos.validarArea(e);
});


  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   contactos.validarFormulario(idFormulario);
 });
 