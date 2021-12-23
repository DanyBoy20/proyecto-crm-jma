<?php namespace Servicios;

/**
 * @author Daniel Hernandez <dhernandez@dhwebdesignmx.com>
 * @see <a href="https://dhwebdesignmx.com">dh Web Design</a>
 */

class Googlercptch {

    private $scrtcde = "6LdIPCoaAAAAAIpQ7HYa_xrchS2amU9g6aMOY-Zn";
    private $urldata = "https://www.google.com/recaptcha/api/siteverify";

    function verificarGoogleCaptcha(string $identificador){
        /* Verificacion de google reCAPTCHA */
        $url = $this->urldata;
        $data = array(
            'secret' => $this->scrtcde,
            'response' => $identificador
        );
        $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data),
            'header' => 'Content-Type: application/x-www-form-urlencoded'
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success=json_decode($verify);
        return $captcha_success;
    }

}