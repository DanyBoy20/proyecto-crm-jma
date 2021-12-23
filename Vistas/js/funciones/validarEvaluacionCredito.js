/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

const seleccionTipoEmpleado = (elemento, contenedor) => {
    let tipo = elemento.target.value;
    console.log(elemento.target.value);
    if(tipo == "Jubilado" || tipo == "Pensionado"){
        contenedor.classList.remove('ocultar');
    }else{
        contenedor.classList.toggle('ocultar');
    }
}

/**
 * Evaluar la percepcion del cliente
 * @param {HTMLElement} elemento Caja texto percepcion
 * @param {HTMLElement} descJub Caja de texto descuento jubilado
 * @param {HTMLElement} descPen Caja de texto pensionado
 * @param {HTMLElement} tipoc Caja de lista tipo cliente
 */
const percepcionRecibida = (elemento, descJub, descPen, tipoc) => {
    let cantidadpercepcion = elemento.target.value;
    tipoc.disabled = true;
    if(tipoc.value == "Jubilado"){
        if(cantidadpercepcion >= 4500){
            descJub.classList.remove('ocultar');
        }else{
            alert("No tiene suficiciente liquidez");
            window.location.href = "evaluar-credito";
        }
    }else{
        if(cantidadpercepcion >= 4500){
            descPen.classList.remove('ocultar');
        }else{
            alert("No tiene suficiciente liquidez");
            window.location.href = "evaluar-credito";
        }
    } 
}

/**
 * Evaluar el descuento de cliente jubilado
 * @param {HTMLEelement} elemento Cuadro de lista descuento a elegir
 * @param {HTMLElement} percepcion Caja de texto percepcion
 */
const descuentoJubilado = (elemento, percepcion) => {
    percepcion.disabled = true;
    let respuesta = elemento.target.value;
    if(respuesta === "si"){
        alert("No es posible otorgar creditos con ese tipo de descuentos");  
        window.location.href = "inicio";      
    }else{
        capacidadCredito(percepcion);
        window.location.href = "inicio";
    }
}

/**
 * Evaluar si existe descuento en pensionado
 * @param {HTMLElement} elemento Cuadro de lista desc pensionado
 * @param {HTMLElement} percepcion Caja de texto percepcion
 * @param {HTMLElement} descPension Contenedor DIV con caja texto descuento
 */
const descuentoPensionado = (elemento, percepcion, descPension) => {
    percepcion.disabled = true;
    let respuesta = elemento.target.value;
    if(respuesta === "si"){
        descPension.classList.remove('ocultar');
    }else{
        capacidadCredito(percepcion);
        window.location.href = "inicio";
    }
}

/**
 * Evaluar el descuento del pensionado
 * @param {HTMLElement} elemento Caja texto con descuento
 * @param {HTMLElement} percepcion Caja de texto percepcion
 */
const cantidadDescuentoPensionado = (elemento, percepcion) => {
    let retencion = elemento.target.value;
    let respuesta = (percepcion.value * 0.3) - retencion;
    if(respuesta >= 300){
        alert("Puede iniciar el proceso de solicitud");
        window.location.href = "inicio";
    }else{
        alert("No tiene suficiciente liquidez");
        window.location.href = "evaluar-credito";
    }
}


/**
 * Evaluar la capacidad de credito segun percepción
 * @param {HTMLElement} percepcion Caja de texto percepcion
 */
 const capacidadCredito = (percepcion) => {
    console.log(percepcion);
    let capacidad = percepcion.value * 0.3;
    if(capacidad >= 300){
        alert("Puede iniciar el proceso de solicitud");
        window.location.href = "inicio";
    }else{
        alert("No tiene suficiciente liquidez");
        window.location.href = "evaluar-credito";
    }
}

/**
 * Objeto con las funciones de validación
 */
 export const evaluar = {
    seleccionTipoEmpleado,
    percepcionRecibida,
    descuentoJubilado,
    descuentoPensionado,
    cantidadDescuentoPensionado,
    capacidadCredito
  };