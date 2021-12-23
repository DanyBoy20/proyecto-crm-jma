/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Elementos HTML de la seccion evaluar capacidad de credito.
 */
const anterior = document.getElementById("anterior");
const siguiente = document.getElementById("siguiente");
const botonCambiar = document.querySelectorAll(".boton__cambio");
const izquierda = document.getElementById("seccion__izquierda");
const derecha = document.getElementById("seccion__derecha");

/**
 * Permite mostrar u ocultar los fieldset de los formularios, segun sea el boton siguiente o anterior.
 * @type {NodeListOf<HTMLElement>} El elemento HTML, representa a los botones siguiente y anterior.
 * @param {HTMLElement} boton El boton que haya sido seleccionado (Siguiente o anterior).
 */
botonCambiar.forEach((boton) => {
    /**
    * Escuchador del evento "click" sobre el elemento HTML tipocliente.
    * @type {HTMLElement} El elemento HTML, representa a uno de los botones: siguiente | anterior.
    * @listens boton#click El evento que se escuchara del elemento HTML.
    * @param {HTMLElement} e El boton (siguiente, anterior) que dispara el evento click.
    */
    boton.addEventListener("click", (e) => {
        const opcion = e.target.id;
        if(opcion == "siguiente"){
            derecha.classList.remove('ocultar');
            izquierda.classList.add('ocultar');
        } else{
            derecha.classList.add('ocultar');
            izquierda.classList.remove('ocultar');
        }
    });
});