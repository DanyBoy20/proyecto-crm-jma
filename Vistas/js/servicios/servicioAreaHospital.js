/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

  /* ******** CARGAR AREAS HOSPITAL SEGUN ESCRITURA ******** */
  /* ************************************************** */

  const crearlistarAreas = (res, lista) => {
    lista.innerHTML = "";
    const fragment = document.createDocumentFragment();
    for (const elementos of res) {
      const option = document.createElement("OPTION");
      option.setAttribute("value", elementos.idarea);
      option.setAttribute("data-value", elementos.descripcionarea);
      option.textContent = elementos.descripcionarea;
      fragment.append(option);
    }
    lista.appendChild(fragment);
  };

  const cargarAreasFiltrados = async (entrada, elemento) => {  
    elemento.innerHTML = "";
    try {
        const url = `Controladores/ApiFetchAreasHospital.php?area=${entrada.value}`;
        const res = await fetch(url);
        const data = await res.json();
        if(data.length === 0){
            alert("Su busqueda no arrojo ningun dato");
            elemento.previousElementSibling.value = "";
            elemento.innerHTML = "";
        }else{
            elemento.innerHTML = "";
            crearlistarAreas(data, elemento);
        }
    } catch (error) {
        elemento.previousElementSibling.value = "";
        elemento.innerHTML = "";
        alert("Por el momento no podemos ejecutar su solicitud");
    }
}

  const areasBuscadas = (event, elemento) => {
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
        cargarAreasFiltrados(entrada, elemento);
    }
}

const cargarIdElementoArea = (event, elementoid, elementodescripcion) => {
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
      const url = `Controladores/ApiFetchAreasHospital.php?hospitales=${entrada.value}`;
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

const hospitalesBuscados = (event, elemento) => {
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
      cargarHospitalesFiltrados(entrada, elemento);
  }
}

const cargarIdElementoHospital = (event, elementoid, elementodescripcion) => {
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

 export const servicioAreas = {
    areasBuscadas,
    hospitalesBuscados,
    cargarIdElementoArea,
    cargarIdElementoHospital
  };