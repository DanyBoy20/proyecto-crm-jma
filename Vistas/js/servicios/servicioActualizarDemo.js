/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

  /* ******** CARGAR AREAS HOSPITAL SEGUN ESCRITURA ******** */
  /* ************************************************** */

 const cargarFechaSolicitud = (fechaS, fechaP) => {
     const fechaSolicitud = new Date(fechaS.innerHTML);
     const fechaProgramada = new Date();
     const fechaMinima = new Date();
     const fechaMinima2 = new Date();
     fechaMinima.setDate(fechaMinima2.getDate() + 5);
     fechaProgramada.setDate(fechaSolicitud.getDate() + 15);
     fechaP.minAsdate = fechaMinima;
     fechaP.valueAsDate = fechaProgramada;
 }

 export const servicioActualizarDemo = {
    cargarFechaSolicitud
  };