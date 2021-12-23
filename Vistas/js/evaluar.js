/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { evaluar } from "./funciones/validarEvaluacionCredito.js";

/**
 * Elementos HTML de la seccion evaluar capacidad de credito.
 */
const contenedorpercepcion = document.getElementById('contenedorpercepcion');
const tipocliente = document.getElementById('tipocliente');
const percepcion = document.getElementById('percepcion');
const descuentoJubilado = document.getElementById('descuentoJubilado');
const descuentoPensionado = document.getElementById('descuentoPensionado');
const contenedorDescuentoJubilado = document.getElementById('contenedorDescuentoJubilado');
const contenedorDescuentoPensionado = document.getElementById('contenedorDescuentoPensionado');
const contenedorCantidadDescuentoPensionado = document.getElementById('contenedorCantidadDescuentoPensionado');
const descuento = document.getElementById('descuento');

/**
 * Escuchador del evento "change" sobre el elemento HTML tipocliente.
 * @type {HTMLElement} El elemento HTML, representa a tipoCLiente.
 * @listens tipocliente#change El evento que se escuchara del elemento HTML.
 */
tipocliente.addEventListener('change', (e) => {
    evaluar.seleccionTipoEmpleado(e, contenedorpercepcion);
})

/**
 * Evalua la caja de texto percepción al perder el enfoque (blur)
 * @param {HTMLElement} e Elemento HTML
 * @fires percepcion#blur
 */
 percepcion.addEventListener('blur', (e) => {
    evaluar.percepcionRecibida(e, contenedorDescuentoJubilado, contenedorDescuentoPensionado, tipocliente);  
});

/**
 * Escuchador del evento "change" sobre el elemento HTML descuentojubilado.
 * @type {HTMLElement} El elemento HTML, representa al tipo de descuento del jubilado.
 * @listens descuentoJubilado#change El evento que se escuchara del elemento HTML.
 */
descuentoJubilado.addEventListener('change', (e) => {
    evaluar.descuentoJubilado(e, percepcion);
})    

/**
 * Escuchador del evento "change" sobre el elemento HTML descuentoPensionado.
 * @type {HTMLElement} El elemento HTML, representa al cuadro de lista descuento del pensionado.
 * @listens descuentoPensionado#change El evento que se escuchara del elemento HTML.
 */
descuentoPensionado.addEventListener('change', (e) => {
    evaluar.descuentoPensionado(e, percepcion, contenedorCantidadDescuentoPensionado);
});

/**
 * Escuchador del evento "blur" sobre el elemento HTML descuento.
 * @type {HTMLElement} El elemento HTML, representa al cuadro de texto descuento.
 * @listens descuento#change El evento que se escuchara del elemento HTML.
 */
descuento.addEventListener('blur', (e) => {
    evaluar.cantidadDescuentoPensionado(e, percepcion);
});
