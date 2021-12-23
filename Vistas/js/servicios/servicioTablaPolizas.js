/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */


 const crearTablaPoliza = (res, filas) => {
    const fragment = document.createDocumentFragment();
    for (const elementos of res) {
      const fila = document.createElement("TR");
      const celdaidentificador = document.createElement("TD");
      const celdadescripcion = document.createElement("TD");
      celdaidentificador.setAttribute("class", "celda__contenido");
      celdadescripcion.setAttribute("class", "celda__contenido");
      celdaidentificador.innerHTML = elementos.idtipopoliza;
      celdadescripcion.innerHTML = elementos.descripcion;
      fila.appendChild(celdaidentificador);
      fila.appendChild(celdadescripcion);
      fragment.append(fila);
    }
    filas.appendChild(fragment);
  };
  
  const crearTablaVaciaPoliza = (filas) => {
      const fragment = document.createDocumentFragment();
      
        const fila = document.createElement("TR");
        const celdavacia = document.createElement("TD");
        celdavacia.setAttribute("class", "celda__contenido");
        celdavacia.setAttribute("colspan", "2");
        celdavacia.innerHTML = "NO HAY REGISTROS PARA MOSTRAR";
        fila.appendChild(celdavacia);
        fragment.append(fila);
      
      filas.appendChild(fragment);
  };
  
  const crearTablaErrorPoliza = (filas) => {
      const fragment = document.createDocumentFragment();
      
        const fila = document.createElement("TR");
        const celdavacia = document.createElement("TD");
        celdavacia.setAttribute("class", "celda__contenido");
        celdavacia.setAttribute("colspan", "2");
        celdavacia.innerHTML = "OCURRIO UN ERROR AL EJECUTAR LA CONSULTA A LA BASE DE DATOS";
        fila.appendChild(celdavacia);
        fragment.append(fila);
      
      filas.appendChild(fragment);
  };
  
  const cargarTipoPolizas = async (fila) => {  
    let elemento = "todos";
    try {
        const url = `Controladores/ApiFetchTablas.php?polizas=${elemento}`;
        const res = await fetch(url);
        const data = await res.json();
        if(data.length === 0){
              crearTablaVaciaPoliza(fila);
        }else{
            crearTablaPoliza(data, fila);
        }
    } catch (error) {
        console.log(error);
      crearTablaErrorPoliza(fila);
    }
  }
  
   export const servicioPolizas = {
      cargarTipoPolizas
    };