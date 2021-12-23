<?php
namespace Servicios;
include ("Constantes.php");
use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class TablasServicios {

    public $errores = [];
    private $categoria;
    private $marca;
    private $producto;
    private $modelo;    
    private $cargo;
    private $demostracion;
    private $capacitacion;
    private $poliza;

    private $soloNumeros = SOLO_NUMEROS;
    private $soloLetrasNumeros = SOLO_LETRAS_NUMEROS;

    public function validarcategoria($post){
        $this->categoria = $post;
        # NOMBRE CATEGORIA
        if (trim($this->categoria) == '') {
            $this->errores[] = '\nEl campo categoria es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->categoria) == 0) {
            $this->errores[] = '\nEl valor del campo categoria es invalido';
        }
        if (strlen($this->categoria) < 4 || strlen($this->categoria) > 50) {
            $this->errores[] = '\nEl nombre de la categoria debe tener al menos 4 caracteres';
        }
    }

    public function validarMarca($post){
        $this->marca = $post;
        # NOMBRE MARCA
        if (trim($this->marca) == '') {
            $this->errores[] = '\nEl campo marca es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->marca) == 0) {
            $this->errores[] = '\nEl valor del campo marca es invalido';
        }
        if (strlen($this->marca) < 4 || strlen($this->marca) > 50) {
            $this->errores[] = '\nEl nombre de la marca dene tener al menos 4 caracteres';
        }
    }

    public function validarEquipo(array $post){
        $this->categoria = $post['categoria'];
        $this->marca = $post['marca'];
        $this->producto = $post['producto'];
        $this->modelo = $post['modelo'];
        # CATEGORIA
        if (trim($this->categoria) == '' || $this->categoria == 'undefined') {
            $this->errores[] = '\nDebe elegir una categoria';
        }
        if (preg_match($this->soloNumeros, $this->categoria) == 0) {
            $this->errores[] = '\nEl valor del campo categoria es incorrecto';
        }
        if (strlen($this->categoria) < 0 || strlen($this->categoria) > 100) {
            $this->errores[] = '\nCampo categoria invalido';
        }
        # MARCA
        if (trim($this->marca) == '' || $this->marca == 'undefined') {
            $this->errores[] = '\nDebe elegir una marca';
        }
        if (preg_match($this->soloNumeros, $this->marca) == 0) {
            $this->errores[] = '\nEl valor del campo marca es incorrecto';
        }
        if (strlen($this->marca) < 0 || strlen($this->marca) > 100) {
            $this->errores[] = '\nCampo marca invalido';
        }
        # NOMBRE PRODUCTO
        if (trim($this->producto) == '') {
            $this->errores[] = '\nEl campo producto es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->producto) == 0) {
            $this->errores[] = '\nEl valor del campo producto es invalido';
        }
        if (strlen($this->producto) < 4 || strlen($this->producto) > 50) {
            $this->errores[] = '\nEl nombre de la producto dene tener al menos 4 caracteres';
        }
        # NOMBRE MODELO
        if (trim($this->modelo) == '') {
            $this->errores[] = '\nEl campo modelo es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->modelo) == 0) {
            $this->errores[] = '\nEl valor del campo modelo es invalido';
        }
        if (strlen($this->modelo) < 4 || strlen($this->modelo) > 50) {
            $this->errores[] = '\nEl nombre del modelo dene tener al menos 4 caracteres';
        }
    }

    public function validarCargo($post){
        $this->cargo = $post;
        # NOMBRE CATEGORIA
        if (trim($this->cargo) == '') {
            $this->errores[] = '\nEl campo cargo es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->cargo) == 0) {
            $this->errores[] = '\nEl valor del campo cargo es invalido';
        }
        if (strlen($this->cargo) < 4 || strlen($this->cargo) > 40) {
            $this->errores[] = '\nEl nombre de la cargo debe tener al menos 4 caracteres';
        }
    }

    public function validarDemostracion($post){
        $this->demostracion = $post;
        # NOMBRE CATEGORIA
        if (trim($this->demostracion) == '') {
            $this->errores[] = '\nEl campo demostracion es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->demostracion) == 0) {
            $this->errores[] = '\nEl valor del campo demostracion es invalido';
        }
        if (strlen($this->demostracion) < 4 || strlen($this->demostracion) > 50) {
            $this->errores[] = '\nEl nombre de la demostracion debe tener al menos 4 caracteres';
        }
    }

    public function validarCapacitacion($post){
        $this->capacitacion = $post;
        # NOMBRE CATEGORIA
        if (trim($this->capacitacion) == '') {
            $this->errores[] = '\nEl campo capacitacion es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->capacitacion) == 0) {
            $this->errores[] = '\nEl valor del campo capacitacion es invalido';
        }
        if (strlen($this->capacitacion) < 4 || strlen($this->capacitacion) > 50) {
            $this->errores[] = '\nEl nombre de la capacitacion debe tener al menos 4 caracteres';
        }
    }

    public function validarPoliza($post){
        $this->poliza = $post;
        # NOMBRE CATEGORIA
        if (trim($this->poliza) == '') {
            $this->errores[] = '\nEl campo poliza es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $this->poliza) == 0) {
            $this->errores[] = '\nEl valor del campo poliza es invalido';
        }
        if (strlen($this->poliza) < 4 || strlen($this->poliza) > 50) {
            $this->errores[] = '\nEl nombre de la poliza debe tener al menos 4 caracteres';
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
