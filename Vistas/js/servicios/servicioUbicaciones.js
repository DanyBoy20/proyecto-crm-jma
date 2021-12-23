/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Construye las opciones de la lista estados
 * @param {JSON} dato Datos a cargar en el opciones de lista
 * @param {HTMLElement} estado Lista donde se caragaran las opciones
 */
 const crearSelectEstado = (dato, estado) => {
    const fragment = document.createDocumentFragment();
      for (const estados of dato) {
        const option = document.createElement("OPTION");
        option.setAttribute("value", estados.estado);
        option.textContent = estados.estado;
        fragment.append(option);
      }      
    estado.appendChild(fragment);
  }

/**
 * Construye las opciones de la lista ciudades/municipios
 * @param {JSON} data Datos a cargar en las opciones de la lista
 * @param {HTMLElement} ciudad Cuadro de lista donde se cargaran las opciones
 */
 const crearSelectMunicipios = (data, ciudad) => {
    const fragment = document.createDocumentFragment();
    const option1 = document.createElement("OPTION");
    option1.setAttribute("value", "undefined");
    option1.textContent = "Seleccione una ciudad";
    fragment.append(option1); 
    for (const ciudades of data) {
      const option = document.createElement("OPTION");
      option.setAttribute("value", ciudades.municipio);
      option.textContent = ciudades.municipio;
      fragment.append(option);
    }
    if (ciudad.children[0]) {
      while (ciudad.options.length) {
        ciudad.remove(0);
      }
    }
    ciudad.appendChild(fragment);
  }

  /**
   * Construye las opciones de la lista codigos postales
   * @param {JSON} dato Datos a cargar en las opciones de la lista
   * @param {HTMLElement} codigoPostal Cuadro de lista donde se cargaran las opciones
   */
  const crearSelectCodigoPostal = (dato, codigoPostal) => {
    const fragment = document.createDocumentFragment();
    const option1 = document.createElement("OPTION");
    option1.setAttribute("value", "undefined");
    option1.textContent = "Seleccione un codigo postal";
    fragment.append(option1);
    for (const codigosP of dato.response.cp) {
      const option = document.createElement("OPTION");
      option.setAttribute("value", codigosP);
      option.textContent = codigosP;
      fragment.append(option);
    }
    if (codigoPostal.children[0]) {
      while (codigoPostal.options.length) {
        codigoPostal.remove(0);
      }
    }
    codigoPostal.appendChild(fragment);
  }

  /**
   * Construye las opciones de la lista colonias
   * @param {JSON} dato Datos a cargar en las opciones de la lista
   * @param {HTMLElement} col Cuadro de lista donde se cargaran las opciones
   */
  const crearSelectColonia = (dato, col) => {
    const fragment = document.createDocumentFragment();
    const option1 = document.createElement("OPTION");
    option1.setAttribute("value", "undefined");
    option1.textContent = "Seleccione una colonia";
    fragment.append(option1);
    for (const nombreColonia of dato.response.colonia) {
      const option = document.createElement("OPTION");
      option.setAttribute("value", nombreColonia);
      option.textContent = nombreColonia;
      fragment.append(option);
    }
    if (col.children[0]) {
      while (col.options.length) {
        col.remove(0);
      }
    }
    col.appendChild(fragment);
  }


/**
 * Carga los estados de la republica mexicana
 * @param {HTMLElement} elemento Elemento lista donde se cargaran los estados
 */
 const cargaEstados = async (elemento) => {   
    try {
      let valor = "todos";
      const url = `Controladores/ApiFetchUbicaciones.php?estados=${valor}`;
      const res = await fetch(url);
      const data = await res.json();
      crearSelectEstado(data, elemento);
    } catch (err) {
      console.log(err);    
    }
  }

  /**
 * Carga los municipios correspondientes al estado pasado por parametro
 * @param {String} estado Nombre del estado
 */

/**
 * Carga las ciudades de la republica mexicana
 * @param {String} estado NOmbre del estado de la republica mexicana
 * @param {HTMLElement} ciudad Elemento lista donde se cargaran las ciudades
 */
const cargarMunicipios = async (estado, ciudad) => {
    try {
      const url = `Controladores/ApiFetchUbicaciones.php?id=${estado}`;
      const res = await fetch(url);
      const data = await res.json();
      crearSelectMunicipios(data, ciudad);
    } catch (error) {
      console.log(error);
    }
  }

  /**
   * Carga los codigos postales de la ciudad seleccionada
   * @param {String} municipio Nombre de la ciudad
   * @param {HTMLElement} codigoPostal Elemento lista donde se cargaran los codigos postales
   */
  const cargarCodigosPostales = async (municipio, codigoPostal) => {
    try {
      const url = `https://api.copomex.com/query/get_cp_por_municipio/${municipio}?token=e54ba1bd-2628-4211-b94a-b702ba3022fc`;
      const res = await fetch(url);
      const data = await res.json();
      crearSelectCodigoPostal(data, codigoPostal);
    } catch (error) {
      console.log(error);
    }
  }

  /**
   * Carga las colonias del codigo postal seleccionado
   * @param {String} codigo Numero de codigo postal
   * @param {HTMLElement} colonia Elemento lista donde se cargaran las colonias
   */
  const cargarColonias = async (codigo, colonia) => {
    try {
      const url = `https://api.copomex.com/query/get_colonia_por_cp/${codigo}?token=e54ba1bd-2628-4211-b94a-b702ba3022fc`;
      const res = await fetch(url);
      const data = await res.json();
      crearSelectColonia(data, colonia);
    } catch (error) {
      console.log(error);    
    }
  }


 export const servicioUbicaciones = {
    cargaEstados,
    cargarMunicipios,
    cargarCodigosPostales,
    cargarColonias
  };