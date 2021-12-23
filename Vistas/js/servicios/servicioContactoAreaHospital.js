/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

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

// cargarIdElementoHospital(event, idhospital, hospital, area);
const cargarIdElementoHospital = (event, elementoid, elementodescripcion, solicitante) => {
  if(event.inputType == "insertReplacementText" || event.inputType == null) {
    elementoid.value =  event.target.value;
    let arreglo = event.target.list.children;
    for(let i = 0; i< arreglo.length; i++){
      if(event.target.value == event.target.list.children[i].value){
        elementodescripcion.value = event.target.list.children[i].dataset.value;
        cargarAreas(elementoid.value, solicitante);
        break;
      }
    }
  }
}

/* ******** CARGAR AREAS SEGUN HOSPITAL ******** */
/* ************************************************* */


const crearSelectAreas = (data, selectAreas) => {
  const fragment = document.createDocumentFragment();
  const option1 = document.createElement("OPTION");
  option1.setAttribute("value", "undefined");
  option1.textContent = "Seleccionar";
  fragment.append(option1); 
  for (const area of data) {
    const option = document.createElement("OPTION");
    option.setAttribute("value", area.cvearea);
    option.textContent = `${area.descripcionarea}`;
    fragment.append(option);
  }
  if (selectAreas.children[0]) {
    while (selectAreas.options.length) {
      selectAreas.remove(0);
    }
  }
  selectAreas.appendChild(fragment);
}

const cargarAreas = async (hospital, areasH) => {
  try {
    const url = `Controladores/ApiFetchAreasHospital.php?idhospital=${hospital}`;
    const res = await fetch(url);
    const data = await res.json();
    crearSelectAreas(data, areasH);
  } catch (error) {
    console.log(error);
  }
}

const limpiarSelect = (elemento) => {
  if (elemento.children[0]) {
    while (elemento.options.length) {
      elemento.remove(0);
    }
  }
};

/* ******** CARGAR AREAS SEGUN HOSPITAL ******** */
/* ************************************************* */

const crearSelectCargos = (data, elemento) => {
    const fragment = document.createDocumentFragment();
    for (const cargos of data) {
        const option = document.createElement("OPTION");
        option.setAttribute("value", cargos.idcargo);
        option.textContent = cargos.descripcioncargo;
        fragment.append(option);        
    }
    elemento.appendChild(fragment);
}

const cargarCargosContactos = async (elemento) => {
    try {
        const url = `Controladores/ApiFetchContactos.php?idcargo=cargos`;
        const res = await fetch(url);
        const data = await res.json();
        crearSelectCargos(data, elemento);
    } catch (error) {
        console.log(error);
        
    }
}


/* ******** exportar funciones ******** */
/* ************************************************* */
 export const servicioDemostraciones = {
    cargarCargosContactos,
    hospitalesBuscados,
    cargarIdElementoHospital
  };