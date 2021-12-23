<?php
namespace Servicios;
include ("Constantes.php");
use Exception;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class AreasServicios {

    public $errores;
    private $soloLetrasNumeros = SOLO_LETRAS_NUMEROS;
    private $numeros = SOLO_NUMEROS;
    public $arregloerrores = [];
    public $hospital;
    public $area;
    public $idhospital;
    public $idarea;

    // ********* PARA MOSTRAR EN: registro-areas
    public function validarArea(string $dato){
        
        if (trim($dato) == '') {
            $this->errores = '\nEl campo area es requerido';
        }
        if (preg_match($this->soloLetrasNumeros, $dato) == 0) {
            $this->errores = '\nSolo letras y numeros en el campo area';
        }
        if (strlen($dato) < 7 || strlen($dato) > 90) {
            $this->errores = '\nLongitud de nombre area debe tener al menos 7 caracteres';
        }
    }

    // ********* PARA MOSTRAR EN: registro-areas-hospital
    public function validarAreaHospital(array $datosPOST){

        $this->hospital = $datosPOST['hospital'];
        $this->area = $datosPOST['area'];
        $this->idhospital = $datosPOST['idhospital'];
        $this->idarea = $datosPOST['idarea'];

        #HOSPITAL
        if (trim($this->hospital) == '') {
            $this->arregloerrores[] = '\nEl nombre del hospital es requerido';
        }
        if (preg_match('/^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->hospital) == 0) {
            $this->arregloerrores[] = '\nSolo letras en el campo hospital';
        }
        if (strlen($this->hospital) < 3 || strlen($this->hospital) > 70) {
            $this->arregloerrores[] = '\nLongitud de nombre del hospital mas de 3 letras';
        }

        #AREA
        if (trim($this->area) == '') {
            $this->arregloerrores[] = '\nEl nombre del area es requerido';
        }
        if (preg_match('/^[A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,]+$/im', $this->area) == 0) {
            $this->arregloerrores[] = '\nSolo letras en el campo area';
        }
        if (strlen($this->area) < 3 || strlen($this->area) > 70) {
            $this->arregloerrores[] = '\nLongitud de nombre de area mas de 3 letras';
        }
        
        #IDHOSPITAL 
        if (trim($this->idhospital) == '') {
            $this->arregloerrores[] = '\Todos los campos son obligatorios';
        }
        if (preg_match('/^[0-9]*$/', $this->idhospital) == 0) {
            $this->arregloerrores[] = '\nDatos invalidos, intente nuevamente';
        }
        if (strlen($this->idhospital) < 0 || strlen($this->idhospital) > 100) {
            $this->arregloerrores[] = '\nDatos invalidos, intente nuevamente';
        }

        #IDAREA 
        if (trim($this->idarea) == '') {
            $this->arregloerrores[] = '\Todos los campos son obligatorios';
        }
        if (preg_match('/^[0-9]*$/', $this->idarea) == 0) {
            $this->errores[] = '\nDatos invalidos, intente nuevamente';
        }
        if (strlen($this->idarea) < 0 || strlen($this->idarea) > 100) {
            $this->arregloerrores[] = '\nDatos invalidos, intente nuevamente';
        }


    }


}
