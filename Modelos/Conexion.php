<?php namespace Modelos;
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

/* include (__DIR__ .'../../../../conn/Configuracion.php'); */

/* local */
include ("Configuracion.php");

use \PDO, \PDOException;

class Conexion{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbcharset = DB_CHARSET;

     // propiedades privadas para la conexion y sentencias SQL
    // privadas por que solo esta clase tendra acceso a ellas
    private $conexion;
    private $error;
    private $sentencia;
    private $dbconectado = false;

    // constructor: creara la conexion
    protected function __construct(){
        // ESTABLECEMOS CONEXION A BD CON PDO
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=' . $this->dbcharset;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Creamos una nueva instancia de PDO
        try {
            $this->conexion = new PDO($dsn, $this->user, $this->pass, $opciones);
            $this->dbconectado = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }        
    }

    // Metodo que obtiene el error
    protected function obtenerError(){
        return $this->error;
    }

    // Metodo para saber si hay conexion (true o false)
    protected function estaConectado(){
        return $this->dbconectado;
    }

    // Preparamos la sentencia con la consulta SQL pasada por parametro
    protected function consultaSQL($query){
        $this->sentencia = $this->conexion->prepare($query);
    }

    // Metodo para la ejecucion de las sentencias preparadas
    protected function ejecutar(){
        return $this->sentencia->execute();
    }

    // Metodo para la iniciar de la transaccion
    protected function iniciarTransaccion(){
        /* return $this->sentencia->beginTransaction(); */
        return $this->conexion->beginTransaction();
    }

    // Metodo para la ejecucion de la transaccion
    protected function ejecutarTransaccion(){
        /* return $this->sentencia->commit(); */
        return $this->conexion->commit();
    }

    // Deshacer transaccion
    protected function deshacerTransaccion(){
        /* return $this->sentencia->rollback(); */
        return $this->conexion->rollback();
    }

    // Devolver ultimo ID insertado
    protected function idInsertado(){
        return $this->conexion->lastInsertId();
    }

    // Obtener como resultado de la sentencia el conjunto de registros
    // como un arreglo de objetos.
    // fetchAll devuelve un conjunto de registros
    protected function obtenerConjuntoRegistros(){
        $this->ejecutar();
        return $this->sentencia->fetchAll(PDO::FETCH_OBJ);
        /* return $this->sentencia->fetchAll(); */
    }

    protected function obtenerConjuntoRegistros1(){
        $this->ejecutar();
        /* return $this->sentencia->fetchAll(PDO::FETCH_OBJ); */
        return $this->sentencia->fetchAll();
    }

    // para devolver la cantidad de registros de la sentencia preparada
    protected function cantidadRegistros(){
        return $this->sentencia->rowCount();
    }

    // Obtener de la consulta un solo registro como objeto
    // fetch devuelve un solo registro 
    protected function obtenerRegistro(){
        $this->ejecutar();
        /* return $this->sentencia->fetch(PDO::FETCH_OBJ); */
        return $this->sentencia->fetch();
    }

    // asociar/enlazar (bind) los valores con el nombres
    // que representa la variable a buscar
    // SELECT * FROM tabla WHERE campo = :nombre (puede ser: campo = ?)
    // bindvalue enlaza el valor con ese nombre o signo ' ? '
    protected function enlazarValor($param, $valor, $tipo = null){
        if(is_null($tipo)){
            switch (true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                break;
                default:
                    $tipo = PDO::PARAM_STR;
            }
        }
        $this->sentencia->bindValue($param, $valor, $tipo);
    }

}