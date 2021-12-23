/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Funcion asincrona que carga los datos del empleado
 * @param {HTMLElement} elemento Elemento html donde se insertaran los datos
 */
 const cargarHospitales = async (elemento) => {
    elemento.innerHTML = "";
    try {
        const url = "Controladores/ApiFetchHospitales.php?todos=verdadero";
        const res = await fetch(url);
        const data = await res.json();
        construirListaHospitales(data, elemento);
    } catch (error) {
        elemento.innerHTML = "";
        elemento.innerHTML = "<tr><td colspan='5' class='celda__contenido'>Por el momento, no podemos procesar su solicitud. Intente mas tarde</td></tr>";
    }      
};

const cargarHospitalFiltrado = async (entrada, elemento) => {    
    try {
        const url = `Controladores/ApiFetchHospitales.php?busqueda=${entrada.value}`;
        const res = await fetch(url);
        const data = await res.json();
        if(data.length === 0){
            elemento.innerHTML = "";
            elemento.innerHTML = "<tr><td colspan='5' class='celda__contenido'>Su busqueda no arrojo ningun dato</td></tr>";
        }else{
            elemento.innerHTML = "";
            construirListaHospitales(data, elemento);
        }
    } catch (error) {
        elemento.innerHTML = "";
        elemento.innerHTML = "<tr><td colspan='5' class='celda__contenido'>Por el momento no podemos ejecutar su busqueda, intente más tarde</td></tr>";
    }
}

/**
 * Función asincrona que carga datos del empleado segun el valor epresado por la tecla presionada
 * @param {Event} event Indica sobre que tecla se hizo clic
 * @param {HTMLElement} elemento HTML sobe el cual se cargaran la respuesta
 * @returns false si no hay datos
 */
const valorBuscado = (event, elemento) => {
    let entrada = event.target;
    let caracteresMinimos = 0;
    let soloTexto = /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/;
    if(entrada.value.length < caracteresMinimos){
        elemento.innerHTML = "";    
        return;
    }else if(!soloTexto.test(event.target.value)){
        alert("Solo se aceptan letras en el campo de busqueda");
        nombre.value = "";
        cargarHospitales(elemento);

    }else if(event.keyCode == 32){
        alert("Debe escribir los datos del hospital a buscar");
        nombre.value = "";
        cargarHospitales(elemento);    

    }else{
        cargarHospitalFiltrado(entrada, elemento);
    }
}


/**
 * Esta funcion construye el bloque de la tabla para mostrar los usuarios
 * @param {JSON} datos Los datos (empleado) devueltos por FETCH para construir el bloque de la tabla
 */
 const construirListaHospitales = (datos, elementoFormulario) => {
    const fragment = document.createDocumentFragment();
        for (const elementos of datos) {
            /* FILA Y CELDAS */
            const fila = document.createElement("TR");
            const celdanombre = document.createElement("TD");
            const celdatipo = document.createElement("TD");
            const celdaestado = document.createElement("TD");
            const celdamunicipio = document.createElement("TD");
            const celdaaccion = document.createElement("TD");

            celdanombre.setAttribute("class", "celda__contenido");
            celdatipo.setAttribute("class", "celda__contenido");
            celdaestado.setAttribute("class", "celda__contenido");
            celdamunicipio.setAttribute("class", "celda__contenido");
            celdaaccion.setAttribute("class", "celda__contenido");                
            
            /* VER */
            var formVer = document.createElement("FORM");
            formVer.setAttribute("class", "formeliminar");
            formVer.setAttribute("name", "form");
            formVer.setAttribute("method", "post");
            formVer.setAttribute("action", "expediente-hospital"); 

            var valorVer = document.createElement("INPUT");
            valorVer.setAttribute("type", "hidden");
            valorVer.setAttribute("name", "idhospital");
            valorVer.setAttribute("value", elementos.idhospital);             
            var valorEstadoVer = document.createElement("INPUT");
            valorEstadoVer.setAttribute("type", "hidden");
            valorEstadoVer.setAttribute("name", "estado");
            valorEstadoVer.setAttribute("value", elementos.estado);
            var verSubmit = document.createElement("INPUT");
            verSubmit.setAttribute("class", "btnVerde5");
            verSubmit.setAttribute("type", "submit");
            verSubmit.setAttribute("value", "Ver");
            formVer.appendChild(valorVer);  
            formVer.appendChild(valorEstadoVer);         
            formVer.appendChild(verSubmit); 
            
            /* EDITAR */
            var formEditar = document.createElement("FORM");
            formEditar.setAttribute("class", "formeliminar");
            formEditar.setAttribute("name", "form");
            formEditar.setAttribute("method", "post");
            formEditar.setAttribute("action", "editar-empleado");            
            var valorEditar = document.createElement("INPUT");
            valorEditar.setAttribute("type", "hidden");
            valorEditar.setAttribute("name", "correoeditar");
            valorEditar.setAttribute("value", elementos.idhospital);  
            var editarSubmit = document.createElement("INPUT");
            editarSubmit.setAttribute("class", "btnAzul");
            editarSubmit.setAttribute("type", "submit");
            editarSubmit.setAttribute("value", "Editar");                   
            formEditar.appendChild(valorEditar);                 
            formEditar.appendChild(editarSubmit); 

            /* FORMULARIO ELIMINAR */
            /* var formEliminar = document.createElement("FORM");
            formEliminar.setAttribute("class", "formeliminar eliminarRegistro");
            formEliminar.setAttribute("name", "form");
            formEliminar.setAttribute("method", "post");            
            var valorEliminar = document.createElement("INPUT");
            valorEliminar.setAttribute("type", "hidden");
            valorEliminar.setAttribute("name", "correo");
            valorEliminar.setAttribute("value", elementos.idhospital);  
            var eliminarSubmit = document.createElement("INPUT");
            eliminarSubmit.setAttribute("class", "btnRojo botonEliminar");
            eliminarSubmit.setAttribute("type", "submit");
            eliminarSubmit.setAttribute("value", "Eliminar");                   
            formEliminar.appendChild(valorEliminar);                 
            formEliminar.appendChild(eliminarSubmit);  */

            celdanombre.innerHTML = elementos.nombreh;
            celdatipo.innerHTML = elementos.tipo;
            celdaestado.innerHTML = elementos.estadoh;
            celdamunicipio.innerHTML = elementos.municipioh;

            celdaaccion.appendChild(formVer);
            celdaaccion.appendChild(formEditar);
            /* celdaaccion.appendChild(formEliminar); */
            fila.appendChild(celdanombre);
            fila.appendChild(celdatipo);
            fila.appendChild(celdaestado);
            fila.appendChild(celdamunicipio);
            fila.appendChild(celdaaccion);

            fragment.append(fila);
        }
        elementoFormulario.appendChild(fragment);
}


/**
   * Objeto con las funciones de validación
   */
 export const serviciosHospitales = {
    cargarHospitales,
    valorBuscado,
    cargarHospitalFiltrado
  };