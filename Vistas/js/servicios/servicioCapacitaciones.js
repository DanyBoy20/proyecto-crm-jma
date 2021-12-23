/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

 const crearSelectCapacitacion = (dato, capacitacion) => {
    const fragment = document.createDocumentFragment();
      for (const servicioInstalaciones of dato) {
        const option = document.createElement("OPTION");
        option.setAttribute("value", servicioInstalaciones.idtipocapacitaciones);
        option.textContent = servicioInstalaciones.descripcion;
        fragment.append(option);
      }      
    capacitacion.appendChild(fragment);
  }

 const cargaCapacitacion = async (elemento) => {   
    try {
      let valor = "todos";
      const url = `Controladores/ApiFetchCapacitaciones.php?tipo=${valor}`;
      const res = await fetch(url);
      const data = await res.json();
      crearSelectCapacitacion(data, elemento);
    } catch (err) {
      console.log(err);    
    }
  }

  /* ******** CARGAR PRODUCTOS SEGUN ESCRITURA ******** */
  /* ************************************************** */

  const crearlistarProductos = (res, lista) => {
    lista.innerHTML = "";
    const fragment = document.createDocumentFragment();
    for (const elementos of res) {
      const option = document.createElement("OPTION");
      option.setAttribute("value", elementos.idproducto);
      option.setAttribute("data-value", elementos.descripcion);
      option.textContent = elementos.descripcion;
      fragment.append(option);
    }
    lista.appendChild(fragment);
  };

  const cargarProductosFiltrados = async (entrada, elemento) => {  
    elemento.innerHTML = "";
    try {
        const url = `Controladores/ApiFetchDemos.php?producto=${entrada.value}`;
        const res = await fetch(url);
        const data = await res.json();
        if(data.length === 0){
            alert("Su busqueda no arrojo ningun dato");
            elemento.previousElementSibling.value = "";
            elemento.innerHTML = "";
        }else{
            elemento.innerHTML = "";
            crearlistarProductos(data, elemento);
        }
    } catch (error) {
        elemento.previousElementSibling.value = "";
        elemento.innerHTML = "";
        alert("Por el momento no podemos ejecutar su solicitud");
    }
}

  const productosBuscados = (event, elemento) => {
    let entrada = event.target;
    let caracteresMinimos = 0;
    let soloTexto = /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/;

    if(event.keyCode === 32){
      elemento.innerHTML = ""; 
      entrada.value = "";   
      return;
    }else if(entrada.value.length < caracteresMinimos){
        elemento.innerHTML = ""; 
        entrada.value = "";   
        return;
    }else if(!soloTexto.test(event.target.value)){
        entrada.value = "";
    }else{
        cargarProductosFiltrados(entrada, elemento);
    }
}

const cargarIdElementoProducto = (event, elementoid, elementodescripcion) => {
  if(event.inputType == "insertReplacementText" || event.inputType == null) {
    elementoid.value =  event.target.value;
    let arreglo = event.target.list.children;
    for(let i = 0; i< arreglo.length; i++){
      if(event.target.value == event.target.list.children[i].value){
        elementodescripcion.value = event.target.list.children[i].dataset.value;
        break;
      }
    }
  }
}


/* ******** CARGAR HOSPITALES SEGUN ESCRITURA ******** */
/* ************************************************** */
const crearlistarHospitales = (res, lista) => {
  lista.innerHTML = "";
  const fragment = document.createDocumentFragment();
  for (const elementos of res) {
    const option = document.createElement("OPTION");
    option.setAttribute("value", elementos.idhospital);
    option.setAttribute("data-value", elementos.nombreh);
    option.textContent = `${elementos.nombreh} | ${elementos.estadoh}`;
    fragment.append(option);
  }
  lista.appendChild(fragment);
};

const cargarHospitalesFiltrados = async (entrada, elemento) => {  
  elemento.innerHTML = "";
  try {
      const url = `Controladores/ApiFetchDemos.php?hospitales=${entrada.value}`;
      const res = await fetch(url);
      const data = await res.json();
      if(data.length === 0){
          alert("Su busqueda no arrojo ningun dato");
          elemento.previousElementSibling.value = "";
          elemento.innerHTML = "";
      }else{
          elemento.innerHTML = "";
          crearlistarHospitales(data, elemento);
      }
  } catch (error) {
      elemento.previousElementSibling.value = "";
      elemento.innerHTML = "";
      alert("Por el momento no podemos ejecutar su solicitud");
  }
}

const hospitalesBuscados = (event, elemento, solicitante) => {
  let entrada = event.target;
  let caracteresMinimos = 0;
  let soloTexto = /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/;

  if(event.keyCode === 32){
    elemento.innerHTML = ""; 
    entrada.value = "";
    limpiarSelect(solicitante);
    return;
  }else if(entrada.value.length < caracteresMinimos){
      elemento.innerHTML = ""; 
      entrada.value = ""; 
      limpiarSelect(solicitante);  
      return;
  }else if(!soloTexto.test(event.target.value)){
      entrada.value = "";
      limpiarSelect(solicitante);
  }else{
      cargarHospitalesFiltrados(entrada, elemento);
  }
}

// cargarIdElementoHospital(event, idhospital, hospital, solicitante);
const cargarIdElementoHospital = (event, elementoid, elementodescripcion, solicitante) => {
  if(event.inputType == "insertReplacementText" || event.inputType == null) {
    elementoid.value =  event.target.value;
    let arreglo = event.target.list.children;
    for(let i = 0; i< arreglo.length; i++){
      if(event.target.value == event.target.list.children[i].value){
        elementodescripcion.value = event.target.list.children[i].dataset.value;
        cargarContactos(elementoid.value, solicitante);
        break;
      }
    }
  }
}

/* ******** CARGAR CONTACTOS SEGUN HOSPITAL ******** */
/* ************************************************* */


const crearSelectContactos = (data, selectContactos) => {
  const fragment = document.createDocumentFragment();
  const option1 = document.createElement("OPTION");
  option1.setAttribute("value", "undefined");
  option1.textContent = "¿Quien solicita la demostración?";
  fragment.append(option1); 
  for (const contacto of data) {
    const option = document.createElement("OPTION");
    option.setAttribute("value", contacto.idcontacto);
    option.textContent = `${contacto.titulo} ${contacto.hnombre} ${contacto.hapellidop} ${contacto.hapellidom}`;
    fragment.append(option);
  }
  if (selectContactos.children[0]) {
    while (selectContactos.options.length) {
      selectContactos.remove(0);
    }
  }
  selectContactos.appendChild(fragment);
}

const cargarContactos = async (hospital, contactosH) => {
  try {
    const url = `Controladores/ApiFetchContactos.php?id=${hospital}`;
    const res = await fetch(url);
    const data = await res.json();
    crearSelectContactos(data, contactosH);
  } catch (error) {
    console.log(err);
  }
}

const limpiarSelect = (elemento) => {
  if (elemento.children[0]) {
    while (elemento.options.length) {
      elemento.remove(0);
    }
  }
};



 export const servicioCapacitaciones = {
    cargaCapacitacion,
    productosBuscados,
    hospitalesBuscados,
    cargarIdElementoProducto,
    cargarIdElementoHospital
  };