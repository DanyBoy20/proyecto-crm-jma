/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarActualizacionDemo as actualizardemo } from "./funciones/validarActualizacionDemo.js";
 
 let verifica = true;
 const idFormulario = document.getElementById("formularioActualizarDemo");
 const imprimirform = document.getElementById("imprimir");
 const mensaje = document.getElementById("mensaje");
/*  const fechaprogramada = document.getElementById("fechaprogramada");  */
const botonActualizar = document.getElementById("btnActualizar");
const botonImprimir = document.getElementById("botonImprimir");
 const botonValidarForm = document.getElementById("validarIngreso");

 botonActualizar.addEventListener('click', (e) => {
   if(verifica){
     idFormulario.classList.remove('ocultar');
     verifica = false;
     botonActualizar.innerText = "DEJAR PENDIENTE";
   }else{
    idFormulario.classList.add('ocultar');
    verifica = true;
    botonActualizar.innerText = "ACTUALIZAR";
   }
 })


mensaje.addEventListener("focus", (e) => {
  actualizardemo.borrarError(e);
  console.log(e.target);
});
mensaje.addEventListener("blur", (e) => {
  actualizardemo.validarComentarios(e);
});


  botonValidarForm.addEventListener("click", (event) => {
   event.preventDefault();
   actualizardemo.validarFormulario(idFormulario);
 });


 botonImprimir.addEventListener("click", (event) => {
  event.preventDefault();
  actualizardemo.imprimirform(imprimirform);
});

 