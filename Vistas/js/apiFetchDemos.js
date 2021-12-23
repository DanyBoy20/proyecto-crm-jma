/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { serviciosDemos as demo } from "./servicios/servicioDemo.js";

/**
 * Elementos HTML de la seccion lista empleados para la busqueda asincronica.
 */
const nombre = document.getElementById('nombre');
const contenedorlistaempleados = document.getElementById('contenedor_lista_hospitales');
const filademo = document.getElementById("fila_demo");


addEventListener("load", () => {
    nombre.addEventListener("keyup", (event) => {
        if(event.target.value == ""){
            demo.cargarDemos(filademo);
        }else{
            filademo.innerHTML = "";
            demo.valorBuscado(event, filademo);
        }

    });
});
