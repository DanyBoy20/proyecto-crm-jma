/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroTiposSolicitud as tiposolicitud } from "./funciones/validarTipoSolicitudes.js";

  
 const idFormulario = document.getElementById("formRegistroTipoCapacitacion");
 const capacitacion = document.getElementById("capacitacion");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 
 capacitacion.addEventListener("focus", (e) => {
   tiposolicitud.borrarError(e);
 });
 
 
 capacitacion.addEventListener("blur", (e) => {
   tiposolicitud.validarTipoCapacitacion(e);
 }); 
 


  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   tiposolicitud.validarFormularioCap(idFormulario);
 });
 