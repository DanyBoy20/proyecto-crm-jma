/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */


const crearTablaCategoria = (res, filas) => {
  const fragment = document.createDocumentFragment();
  for (const elementos of res) {
    const fila = document.createElement("TR");
    const celdaidentificador = document.createElement("TD");
    const celdadescripcion = document.createElement("TD");
    celdaidentificador.setAttribute("class", "celda__contenido");
    celdadescripcion.setAttribute("class", "celda__contenido");
    celdaidentificador.innerHTML = elementos.idcategoria ;
    celdadescripcion.innerHTML = elementos.descripcioncategoria;
    fila.appendChild(celdaidentificador);
    fila.appendChild(celdadescripcion);
    fragment.append(fila);
  }
  filas.appendChild(fragment);
};

const crearTablaVaciaCategoria = (filas) => {
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

const crearTablaErrorCategoria = (filas) => {
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

const cargarCategorias = async (fila) => {  
  let elemento = "todos";
  try {
      const url = `Controladores/ApiFetchTablas.php?idcategoria=${elemento}`;
      const res = await fetch(url);
      const data = await res.json();
      if(data.length === 0){
            crearTablaVaciaCategoria(fila);
      }else{
          crearTablaCategoria(data, fila);
      }
  } catch (error) {
      console.log(error);
    crearTablaErrorCategoria(fila);
  }
}

 export const servicioCategorias = {
    cargarCategorias
  };