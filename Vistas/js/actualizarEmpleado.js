/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 import { validarContrasenias as actualizaContra } from "./funciones/validarCambioPws.js";

/**
 * Elementos HTML de la sección actualizar empleados.
 */
const formularioActualizar = document.getElementById('idformularioactualizar');
const celular = document.getElementById('celu');
const email = document.getElementById('email');
const fecharegistro = document.getElementById('fecharegistro');
const contrasenia = document.getElementById('contrasenia');
const repetircontrasenia = document.getElementById('repetircontrasenia');
const btnActualizar = document.getElementById('btnactualizar');
const telefono = document.getElementById('tel');
const direccion = document.getElementById('direccion');
const ciudadestado = document.getElementById('cdestado');

/**
 * Mostrar los datos en los elementos de la interfaz
 * @param {JSON} res Datos obtenidos de la llamada FETCH a URL
 */
const mostrarDatos = (res) => {
    for (const datos of res) {
        telefono.textContent = datos.telefono;
        celular.textContent = datos.numeromovil;
        direccion.textContent = datos.direccion;
        ciudadestado.textContent = datos.ciudad + ", " + datos.estado;
        fecharegistro.textContent = datos.fecharegistro;
    }
}

/**
 * Cargar los datos recuperados del servidor
 * @param {String} codigo Identificador para traer datos del empleado
 */
const cargarDatos = async (codigo) => {
    try {
        const url = `Controladores/ApiFetchEmpleados.php?identificadorActualizar=${codigo}`;
        const res = await fetch(url);
        const data = await res.json();
        mostrarDatos(data);
    } catch (error) {
        console.log(error);    
    }
}

/**
 * Instrucciones iniciales | al cargar la pagina, traer datos del empleado.
 */
window.addEventListener("load", () => {   
    let valor = email.textContent;
    cargarDatos(valor);
});

/**
 * Escuchador del evento "focus" sobre el elemento HTML contraseña.
 * @type {HTMLElement} El elemento HTML, representa al campo contraseña.
 * @listens contrasenia#focus El evento que se escuchara del elemento HTML.
 */
contrasenia.addEventListener('focus', (e) => {
    actualizaContra.borrarError(e);
});

/**
 * Escuchador del evento "blur" sobre el elemento HTML contraseña.
 * @type {HTMLElement} El elemento HTML, representa al campo contraseña.
 * @listens contrasenia#blur El evento que se escuchara del elemento HTML.
 */
contrasenia.addEventListener('blur', (e) => {
    actualizaContra.validarContraUno(e);
});

/**
 * Escuchador del evento "focus" sobre el elemento HTML repetir contraseña.
 * @type {HTMLElement} El elemento HTML, representa al campo repetir contraseña.
 * @listens repetircontrasenia#focus El evento que se escuchara del elemento HTML.
 */
repetircontrasenia.addEventListener('focus', (e) => {
    actualizaContra.borrarError(e);
});

/**
 * Escuchador del evento "blur" sobre el elemento HTML repetir contraseña.
 * @type {HTMLElement} El elemento HTML, representa al campo repetir contraseña.
 * @listens repetircontrasenia#blur El evento que se escuchara del elemento HTML.
 */
repetircontrasenia.addEventListener('blur', (e) => {
    actualizaContra.validarContraDos(e);
});

/**
 * Escuchador del evento "click" sobre el elemento HTML repetir contraseña.
 * @type {HTMLElement} El elemento HTML, representa al boton que enviara el formulario de actalizacion.
 * @listens btnActualizar#click El evento que se escuchara del elemento HTML.
 */
btnActualizar.addEventListener("click", () => {
    actualizaContra.validarFormulario(formularioActualizar);
});