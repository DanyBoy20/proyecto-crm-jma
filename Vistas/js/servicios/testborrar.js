const crearlistarHospitales = (res, lista) => {
  lista.innerHTML = "";
  const fragment = document.createDocumentFragment();
  for (const elementos of res) {
    const option = document.createElement("OPTION");
    option.setAttribute("value", elementos.idhospital);
    option.setAttribute("data-value", elementos.nombreh);
    option.textContent = elementos.nombreh;
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

const hospitalesBuscados = (event, elemento) => {
  /* console.log(event.keyCode); */
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

const cargarIdElemento = (event, elementoid, elementodescripcion) => {
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