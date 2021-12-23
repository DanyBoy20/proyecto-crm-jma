/**
 * @author Dany Hernández <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/**
 * Expresiones regulares (REGEX) para validacion de datos.
 */
 export const soloTexto = /^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/;
 export const soloTextoNumeroDir = /^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,\d\(\)\-]+$/;
 export const soloNumero = /^[0-9\-\(\)\/\+\s]*$/;
 export const soloNumeroTel = /^[0-9\-\(\)\/\+\s]*$/;
 export const soloEmail = /^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$/;
 export const expresioncontrasenia = /^(?=.{8,12}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
 export const tipoArchivos = /.(jpg|jpeg|png)$/i;
 export const regExContrasenia = /^(?=.{6,8}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
 
 
 export const camposRegistroDemo = {
  demo: false,
  producto: false,
  hospital: false,
  solicitante: false,
  comentarios: false
 };

 export const camposRegistroHospital = {
  nombre: false,
  asignarrol: false,
  telefono: false,
  direccion: false,
  estado: false,
  ciudad : false,
  codigoPostal: false,
  colonia: false
 };

 // CAMPO VALIDAR REGISTRO AREA
 export const camposRegistroArea = {
  area: false
 };

 export const camposRegistroAreaHospital = {
  hospital: false,
  area: false
  /* idhospital: false,
  idarea: false */
 };


 export const camposContactos = {
  /* idhospital: false, */
  hospital: false,  
  titulo: false,
  nombre: false,
  apellidop: false,
  apellidom: false,
  cargo: false,
  telefono: false,
  celular: false,
  email: false,
  area: false,
};

export const camposRegistroInstalacion = {  
  hospital: false,
  solicitante: false,
  area: false,
  producto: false,
  comentarios: false
 };

 export const camposRegistroCapacitacion = {  
  tipocapacitacion : false,
  hospital : false, 
  solicitante : false,
  producto : false, 
  mensaje : false 
 };

 export const camposRegistroPoliza = {  
  tipopoliza: false,
  hospital: false,
  solicitante: false,
  area: false,
  mensaje: false,
  producto: false,
  serie: false
  
 };

 // CAMPO VALIDAR REGISTRO CATEGORIA
 export const camposRegistroCategoria = {
  categoria: false
 };

 // CAMPO VALIDAR REGISTRO MARCA
 export const camposRegistroMarca = {
  marca: false
 };

  // CAMPO VALIDAR REGISTRO EQUIPOS
  export const camposRegistroEquipos = {
    categoria : false,
    marca : false,
    descripcion: false,
    modelo: false    
   };

   // CAMPO VALIDAR CARGO
 export const campoCargo = {
  cargo: false
 };

    // CAMPO VALIDAR TIPO DEMO
    export const campoTipoDemo = {
      demo: false
     };

     // CAMPO VALIDAR TIPO CAPACITACION
    export const campoTiposCapacitacion = {
      capacitacion: false
     };

     // CAMPO VALIDAR TIPO POLIZA
    export const campoTiposPoliza = {
      poliza: false
     };

     export const campoImprimirDemo = {
      id: false
     };

     export const camposActualizarDemo = {  
      /* fecha: false, */
      mensaje: false,      
     };
 
 /**
  * Objeto para validar el ingreso al sistema
  */
 /**
  * @typedef {Object} camposValidarIngreso
  * @property {Boolean} campoCorreo Campo correo electrónico
  * @property {Boolean} campoContrasenia Campo contraseña
  */
 /**
  * @type {camposValidarIngreso}
  */
 export const camposValidarIngreso = {
   campoCorreo: false,
   campoContrasenia: false,
 };
 
 /**
  * Objeto para validar email en recuperacion de contraseña
  */
 /**
  * @typedef {Object} campoEmailRecuperar
  * @property {Boolean} campoCorreo Para la validacion de campoCorreo
  */
 /**
  * @typedef {campoEmailRecuperar}
  */
 export const campoEmailRecuperar = {
   campoCorreo: false,
 };
 
 /**
  * Objeto para validar la actualización de empleado
  */
 /**
  * @typedef {Object} camposActualizarEmpleado
  * @property {Boolean} celular Para el resultado de la validacion del campo celular.
  * @property {Boolean} telefono Para el resultado de la validacion del campo telefono.
  * @property {Boolean} foto Para el resultado de la validacion del campo foto.
  * @property {Boolean} direccion Para el resultado de la validacion del campo dirección.
  * @property {Boolean} estdo Para el resultado de la validacion del campo estado.
  * @property {Boolean} ciudad Para el resultado de la validacion del campo ciudad.
  * @property {Boolean} codigoPostal Para el resultado de la validacion del campo codigo postal.
  * @property {Boolean} colonia Para el resultado de la validacion del campo colonia.
  * @property {Boolean} asignarrol Para el resultado de la validacion del campo asignar rol.
  */
 /**
  * @type {camposActualizarEmpleado}
  */
 export const camposActualizarEmpleado = {
   celular: false,
   telefono: false,
   foto: false,
   direccion: false,
   estado: false,
   ciudad: false,
   codigoPostal: false,
   colonia: false,
   asignarrol: false,
 };
 
 
 /**
  * @typedef {Object} camposActualizarContrasenia
  * @property {Boolean} claveActualizar Validar la contraseña.
  * @property {Boolean} repetirclaveActualizar Validar la contraseña ingresada por segunda vez.
  */
 
 /**
  * @type {camposActualizarContrasenia}
  */
  export const camposActualizarContrasenia = {
   claveActualizar: false,
   repetirclaveActualizar: false,
 };
 