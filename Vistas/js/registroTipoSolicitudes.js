/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroTiposSolicitud as tiposolicitud } from "./funciones/validarTipoSolicitudes.js";

  
 const idFormulario = document.getElementById("formRegistroTipoDemo");
 const demo = document.getElementById("demo");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 
 demo.addEventListener("focus", (e) => {
   tiposolicitud.borrarError(e);
 });
 
 
 demo.addEventListener("blur", (e) => {
   tiposolicitud.validarTipoDemo(e);
 }); 
 


  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   tiposolicitud.validarFormulario(idFormulario);
 });
 