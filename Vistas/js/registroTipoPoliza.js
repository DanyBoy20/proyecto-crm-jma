/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroTiposSolicitud as tiposolicitud } from "./funciones/validarTipoSolicitudes.js";

  
 const idFormulario = document.getElementById("formRegistroTipoPoliza");
 const poliza = document.getElementById("poliza");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 
 poliza.addEventListener("focus", (e) => {
   tiposolicitud.borrarError(e);
 });
 
 
 poliza.addEventListener("blur", (e) => {
   tiposolicitud.validarTipoPoliza(e);
 }); 
 


  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   tiposolicitud.validarFormularioTipoPoliza(idFormulario);
 });
 