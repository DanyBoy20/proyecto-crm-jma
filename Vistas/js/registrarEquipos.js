/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarRegistroProductos as equipos } from "./funciones/validarRegistroEquipos.js";

 /**
  * Elementos HTML de la seccion evaluar capacidad de credito.
  */
 
 const idFormulario = document.getElementById("formRegistroProductos");
 const producto = document.getElementById("producto");
 const modelo = document.getElementById("modelo");
 const botonValidarForm = document.getElementById("validarRegistro");
 
 
 producto.addEventListener("focus", (e) => {
   equipos.borrarError(e);
 });
 
 
 producto.addEventListener("blur", (e) => {
   equipos.validarProducto(e);
 }); 


 modelo.addEventListener("focus", (e) => {
    equipos.borrarError(e);
  });
  
  
  modelo.addEventListener("blur", (e) => {
    equipos.validarModelo(e);
  });

  categoria.addEventListener("focus", (e) => {
    equipos.borrarError(e);
  });
  
  categoria.addEventListener("change", (e) => {
    equipos.validarCategoria(e);
  });

  marca.addEventListener("focus", (e) => {
    equipos.borrarError(e);
  });
  
  marca.addEventListener("change", (e) => {
    equipos.validarMarca(e);
  });



 
 /**
   * Ejecutar la validacion del formulario.
   */
  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   equipos.validarFormulario(idFormulario);
 });
 