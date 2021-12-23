<?php
namespace Servicios;
include ("Constantes.php");
use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class PolizasServicios {

    public $errores = [];
    private $tipopoliza;
    private $hospital; 
    private $solicitante;
    private $area;
    private $producto; 
    private $serie;
    private $mensaje; 
    private $idproducto; 
    private $idhospital;

    private $soloNumeros = SOLO_NUMEROS;
    private $soloLetrasNumeros = SOLO_LETRAS_NUMEROS;

    public function validarPoliza(array $post){
        $this->tipopoliza = $post['tipopoliza'];
        $this->hospital = $post['hospital'];
        $this->solicitante = $post['solicitante'];
        $this->area = $post['area'];
        $this->mensaje = $post['mensaje'];
        $this->producto = $post['producto'];
        $this->serie = $post['sn'];        
        $this->idproducto = $post['idproducto'];
        $this->idhospital = $post['idhospital'];
        # ID TIPO CAPACITACION
        if (trim($this->tipopoliza) == '' || $this->tipopoliza == 'undefined') {
            $this->errores[] = '\nDebe elegir un tipo de poliza';
        }
        if (preg_match($this->soloNumeros, $this->tipopoliza) == 0) {
            $this->errores[] = '\nEl valor del campo tipo poliza es incorrecto';
        }
        if (strlen($this->tipopoliza) < 0 || strlen($this->tipopoliza) > 100) {
            $this->errores[] = '\nLongitud de campo tipo poliza invalido';
        }
        # NOMBRE HOSPITAL
        if (trim($this->hospital) == '') {
            $this->errores[] = '\nEl campo hospital es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->hospital) == 0) {
            $this->errores[] = '\nEl valor del campo hospital es invalido';
        }
        if (strlen($this->hospital) < 0 || strlen($this->hospital) > 50) {
            $this->errores[] = '\nLongitud de nombre de hospital invalida';
        }
        # ID SOLICITANTE
        if (trim($this->solicitante) == '' || $this->solicitante == 'undefined') {
            $this->errores[] = '\nDebe elegir la persona solicitante';
        }
        if (preg_match($this->soloNumeros, $this->solicitante) == 0) {
            $this->errores[] = '\nEl valor del campo solicitante es incorrecto';
        }
        if (strlen($this->solicitante) < 0 || strlen($this->solicitante) > 100) {
            $this->errores[] = '\nLongitud de campo solicitante invalido';
        }
        # ID AREA
        if (trim($this->area) == '' || $this->area == 'undefined') {
            $this->errores[] = '\nDebe elegir el area del hospital';
        }
        if (preg_match($this->soloNumeros, $this->area) == 0) {
            $this->errores[] = '\nEl valor del campo area es incorrecto';
        }
        if (strlen($this->area) < 0 || strlen($this->area) > 100) {
            $this->errores[] = '\nLongitud de campo area invalido';
        }
        # NOMBRE PRODUCTO
        if (trim($this->producto) == '') {
            $this->errores[] = '\nEl campo producto es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->producto) == 0) {
            $this->errores[] = '\nEl valor del campo producto es invalido';
        }
        if (strlen($this->producto) < 0 || strlen($this->producto) > 50) {
            $this->errores[] = '\nLongitud de nombre de producto invalida';
        }
        #NUMERO SERIE
        if (trim($this->serie) == '') {
            $this->errores[] = '\nEl numero de serie es requerido';
        }
        if (preg_match('/^[0-9\-\(\)\/\+\s]*$/im', $this->serie) == 0) {
            $this->errores[] = '\nEl formato para el campo numero de serie es invalido';
        }
        if (strlen($this->serie) < 7 || strlen($this->serie) > 10) {
            $this->errores[] = '\nCampo numero de serie debe contener 10 numeros';
        }
        # MENSAJE
        if (trim($this->mensaje) == '') {
            $this->errores[] = '\nEl campo mensaje es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->mensaje) == 0) {
            $this->errores[] = '\nEl valor del campo mensaje es invalido';
        }
        if (strlen($this->mensaje) < 0 || strlen($this->mensaje) > 150) {
            $this->errores[] = '\nSolo se permiten letras y numeros en el campo mensaje';
        }
        # ID PRODUCTO
        if (trim($this->idproducto) == '' || $this->idproducto == 'undefined') {
            $this->errores[] = '\n1. Debe elegir un hospital';
        }
        if (preg_match($this->soloNumeros, $this->idproducto) == 0) {
            $this->errores[] = '\n2. Debe elegir un hospital';
        }
        if (strlen($this->idproducto) < 0 || strlen($this->idproducto) > 100) {
            $this->errores[] = '\n3. Debe elegir un hospital';
        }
        # ID HOSPITAL
        if (trim($this->idhospital) == '' || $this->idhospital == 'undefined') {
            $this->errores[] = '\n1. Debe elegir un hospital';
        }
        if (preg_match($this->soloNumeros, $this->idhospital) == 0) {
            $this->errores[] = '\n2. Debe elegir un hospital';
        }
        if (strlen($this->idhospital) < 0 || strlen($this->idhospital) > 100) {
            $this->errores[] = '\n3. Debe elegir un hospital';
        }

    }
    
    public function enviarCorreo(string $correoelectronico){
        $para = $correoelectronico;
        $as = 'Cuenta de empleado creada';
        $saltolinea = "\r\n";
        $mensaje = 'DATOS DE LA CUENTA CREADA: '. $saltolinea . '' . $this->nombre . $saltolinea . '' . $this->email . $saltolinea . '' . $this->claveacceso;
        $encabezados = 'From: ' . $correoelectronico;
        try {
            mail($para,$as,$mensaje,$encabezados);
        } catch (Exception $e) {
            /* echo $e->getMessage(); */
            echo '<script type="text/javascript">alert("OCURRIÓ UN PROBLEMA AL ENVIAR LOS DATOS POR CORREO ELECTRÓNICO");</script>';
        }

    }


}
