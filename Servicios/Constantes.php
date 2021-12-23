<?php
/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

define("SOLO_NUMEROS", "/^[0-9]*$/");
define("SOLO_LETRAS_NUMEROS", "/^[0-9A-Za-zñáéíóúÑÁÉÍÓÚüÜ;¡!¿?\.\s\-,\d\(\)\-]+$/");
# ACEPTA NUMEROS, ESPACIOS, GUIONES
define("SOLO_NUMEROS_FORMATO_TELEFONO", "/^[0-9\-\(\)\/\+\s]*$/im");