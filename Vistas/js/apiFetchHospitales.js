/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { serviciosHospitales as hospital } from "./servicios/servicioHospital.js";

/**
 * Elementos HTML de la seccion lista empleados para la busqueda asincronica.
 */
const nombre = document.getElementById('nombre');
const contenedorlistaempleados = document.getElementById('contenedor_lista_hospitales');
const filahospital = document.getElementById("fila_hospital");

/**
 * Al cargar la pagina estaremos escuchando el evento "Keyup", para ejecutar la funcion que busca al empleado
 */
addEventListener("load", () => {
    nombre.addEventListener("keyup", (event) => {
        if(event.target.value == ""){
            hospital.cargarHospitales(filahospital);
        }else{
            filahospital.innerHTML = "";
            hospital.valorBuscado(event, filahospital);
        }

    });
});

/**
 * Permite eliminar un empleado segun los datos pasados por el formulario.
 * @type {NodeListOf<HTMLElement>} El elemento HTML, representa a los formularios de eliminacion.
 * @param {HTMLElement} formulario El formulario de donde se envo el dato a eliminar.
 */
document.querySelectorAll('.eliminarRegistro').forEach((formulario) => {
    /**
    * Escuchador del evento "click" sobre el formulario HTML.
    * @type {HTMLElement} El elemento HTML, representa al formulario.
    * @listens formulario#click El evento que se escuchara del elemento HTML.
    * @param {HTMLElement} e EL formulario que dispara el evento click.
    * @returns {Boolean} Retorna false si se cancela la eliminacion, en caso contrario, envia el formulario.
    */
    formulario.addEventListener("submit", (e) => {
        e.preventDefault();
        console.log(e.target);
        var confirmarEliminar=confirm("¿Esta seguro de eliminar el registro?");
        if (confirmarEliminar==true){
            e.target.submit();
        }else{
            return false;
        }        
    });
});
