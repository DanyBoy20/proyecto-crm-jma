/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Al cargar la pagina, cargamos la funcion iniciar.
 */
addEventListener('load', iniciar, false);

/**
 * @function
 * @name iniciar
 */
function iniciar(){
    desplegarmenuPerfil();
    desplegarMenuNavegacion();
    redimencionar();
    abrirMenuNav();
    cerrarMenuNavIcono();
}

/**
 * 
 * @param {Object} elemento El elemento HTML que se le cambiara la clase
 * @param {String} nombreClase El nombre de la clase a intercambiar (añadir/quitar)
 */
const intercambiarClase = (elemento, nombreClase) => {
    if(elemento.classList.contains(nombreClase)){
        elemento.classList.remove(nombreClase);
    }else{
        elemento.classList.add(nombreClase);
    }
}

/**
 * Desplegar el submenu del contenedor avatar
 */
const desplegarmenuPerfil = () => {
    const avatarUsuario = document.getElementById('encabezado__avatar');    
    avatarUsuario.addEventListener('click', (e) => {
        /* const desplegable = e.target.firstElementChild; */
        const desplegable = document.getElementById('menu__avatar'); 
        intercambiarClase(desplegable, 'desplegable--activo');
    });
}

/**
 * Desplegar todos los sub menus
 */
const desplegarMenuNavegacion = () => {
    const subencabezados = document.querySelectorAll('.listaNav__subencabezado');
    const abrirClaseSubEncabezado = 'listaNav__subencabezado--abrir';
    const cerrarClaseSubEncabezado = 'sublista--oculto';

    subencabezados.forEach((subElementoEncabezado) => {
        subElementoEncabezado.addEventListener('click', (e) => {
            const subElementoLista = e.target.nextElementSibling;
            intercambiarClase(subElementoEncabezado, abrirClaseSubEncabezado);
            subElementoLista.classList.toggle(cerrarClaseSubEncabezado);
            
        });
    });
}

/**
 * si el usuario abre un menu, y expande el viewport sin haber cerrado el menu, asegurar que el scroll este habilitado y que la clase activa del menu de navegacion sea removida
 */
const redimencionar = () => {    
    const menuNavegacion = document.getElementById('barraNavegacion');
    const gridPrincipal = document.getElementById('cuadrilla');
    const claseNavegacionActiva = 'navegacion--activa';
    const claseGridSinScroll = 'grid--nodesplazar';
    addEventListener('resize', (e) => {
        const ancho = window.innerWidth;
        if(ancho > 992){
            menuNavegacion.classList.remove(claseNavegacionActiva);
            gridPrincipal.classList.remove(claseGridSinScroll);
        }
    });
}

/**
 * Abrir menu de navegacion (intercambio de clases), disponible solo en moviles
 */
const abrirMenuNav = () => { 
    const menuNavegacion = document.getElementById('barraNavegacion');
    const gridPrincipal = document.getElementById('cuadrilla');
    const claseNavegacionActiva = 'navegacion--activa';
    const claseGridSinScroll = 'grid--nodesplazar';
    const menuCabeceraAbrirCerrar = document.getElementById('encabezado__menu');
    menuCabeceraAbrirCerrar.addEventListener('click', () => {
        /* console.log('Hizo clic en el icono del menu');
        console.log(gridPrincipal);
        console.log(menuNavegacion); */
        menuNavegacion.classList.toggle(claseNavegacionActiva);
        gridPrincipal.classList.toggle(claseGridSinScroll);
    });
}

/**
 * Cerrar Menu de navegacion (intercambio de clases)
 */
const cerrarMenuNavIcono = () => {
    const iconoCerrarMenuNav = document.getElementById('navegacion__marca-cerrar');
    const menuNavegacion = document.getElementById('barraNavegacion');
    const gridPrincipal = document.getElementById('cuadrilla');
    const claseNavegacionActiva = 'navegacion--activa';
    const claseGridSinScroll = 'grid--nodesplazar';
    iconoCerrarMenuNav.addEventListener('click', () => {
        // console.log(iconoCerrarMenuNav);
        menuNavegacion.classList.toggle(claseNavegacionActiva);
        gridPrincipal.classList.toggle(claseGridSinScroll);
    });   

}
