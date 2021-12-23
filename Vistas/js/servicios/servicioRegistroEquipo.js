/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */
  
  /* ******** CARGAR CATEGORIAS ******** */
  /* ************************************************* */
  
  const crearSelectCategorias = (data, elemento) => {
      const fragment = document.createDocumentFragment();
      for (const categorias of data) {
          const option = document.createElement("OPTION");
          option.setAttribute("value", categorias.idcategoria);
          option.textContent = categorias.descripcioncategoria;
          fragment.append(option);        
      }
      elemento.appendChild(fragment);
  }
  
  const cargarCategorias = async (elemento) => {
      try {
          const url = `Controladores/ApiFetchRegProductos.php?idcategoria=categorias`;
          const res = await fetch(url);
          const data = await res.json();
          crearSelectCategorias(data, elemento);
      } catch (error) {
          console.log(error);
          
      }
  }
  
  /* ******** CARGAR CATEGORIAS ******** */
  /* ************************************************* */
  
  const crearSelectMarcas = (data, elemento) => {
    const fragment = document.createDocumentFragment();
    for (const marcas of data) {
        const option = document.createElement("OPTION");
        option.setAttribute("value", marcas.idmarca);
        option.textContent = marcas.descripcionm;
        fragment.append(option);        
    }
    elemento.appendChild(fragment);
}

const cargarMarcas = async (elemento) => {
    try {
        const url = `Controladores/ApiFetchRegProductos.php?idmarcas=marcas`;
        const res = await fetch(url);
        const data = await res.json();
        crearSelectMarcas(data, elemento);
    } catch (error) {
        console.log(error);
        
    }
}

/************************************************************** */
/*******************INICIA************************* */

const crearTablaEquipos = (res, filas) => {
    const fragment = document.createDocumentFragment();
    for (const elementos of res) {
      const fila = document.createElement("TR");
      const celdacategoria = document.createElement("TD");
      const celdaequipo = document.createElement("TD");
      const celdamodelo = document.createElement("TD");
      const celdamarca = document.createElement("TD");
      celdacategoria.setAttribute("class", "celda__contenido");
      celdaequipo.setAttribute("class", "celda__contenido");
      celdamodelo.setAttribute("class", "celda__contenido");
      celdamarca.setAttribute("class", "celda__contenido");
      celdacategoria.innerHTML = elementos.descripcioncategoria;
      celdaequipo.innerHTML = elementos.pdescripcion;
      celdamodelo.innerHTML = elementos.modelo;
      celdamarca.innerHTML = elementos.descripcionm;
      fila.appendChild(celdacategoria);
      fila.appendChild(celdaequipo);
      fila.appendChild(celdamodelo);
      fila.appendChild(celdamarca);
      fragment.append(fila);
    }
    filas.appendChild(fragment);
  };
  
  const crearTablaVaciaEquipos = (filas) => {
      const fragment = document.createDocumentFragment();
      
        const fila = document.createElement("TR");
        const celdavacia = document.createElement("TD");
        celdavacia.setAttribute("class", "celda__contenido");
        celdavacia.setAttribute("colspan", "4");
        celdavacia.innerHTML = "NO HAY REGISTROS PARA MOSTRAR";
        fila.appendChild(celdavacia);
        fragment.append(fila);
      
      filas.appendChild(fragment);
  };
  
  const crearTablaErrorEquipos = (filas) => {
      const fragment = document.createDocumentFragment();
      
        const fila = document.createElement("TR");
        const celdavacia = document.createElement("TD");
        celdavacia.setAttribute("class", "celda__contenido");
        celdavacia.setAttribute("colspan", "4");
        celdavacia.innerHTML = "OCURRIO UN ERROR AL EJECUTAR LA CONSULTA A LA BASE DE DATOS";
        fila.appendChild(celdavacia);
        fragment.append(fila);
      
      filas.appendChild(fragment);
  };
  
  const cargarProductos = async (fila) => {  
    let elemento = "todos";
    try {
        const url = `Controladores/ApiFetchTablas.php?equipos=${elemento}`;
        const res = await fetch(url);
        const data = await res.json();
        if(data.length === 0){
              crearTablaVaciaEquipos(fila);
        }else{
            crearTablaEquipos(data, fila);
        }
    } catch (error) {
        console.log(error);
      crearTablaErrorEquipos(fila);
    }
  }


/*********************TERMINA******************************* */
/************************************************************** */
  
  /* ******** exportar funciones ******** */
  /* ************************************************* */
   export const servicioRegistroProductos = {
      cargarCategorias,
      cargarMarcas,
      cargarProductos
    };