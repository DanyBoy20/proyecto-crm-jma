<?php
if(isset($_SESSION['validar'])){
    echo '<script>window.location.href="inicio"</script>';
}
$iniciarSesion = new Controladores\IngresoControlador;
$iniciarSesion->inicioSesionControlador();
?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<div class="contenedor__ingreso">
    <div class="contenedor__login">    
        <div class="contenedor__logo__ingreso">
            <img class="logo__ingreso" src="Vistas/img/LOGOJUAMA1.svg" alt="Logo GR">
        </div>
        <form name="formulario" method="post" id="ingreso">
            <div class="contenedor_elementos_formulario">
                <label for="usuario"><i class="icono iconoUsuarioAcceso"></i>Usuario</label>
                <input type="email" id="usuario" name="usuario" placeholder="Escriba su correo electrónico" class="contactoForm_elemento-dimension" minlength="10" maxlength="50" required /><span class="avisoErrorSesion"></span>
            </div>
            <div class="contenedor_elementos_formulario">
                <label for="contrasenia"><i class="icono__login iconoContrasenia"></i>&nbsp;Contraseña</label>
                <input type="password" id="contrasenia" name="contrasenia" placeholder="Escriba su contraseña" class="contactoForm_elemento-dimension" minlength="8" maxlength="8" required /><span class="avisoErrorSesion"></span>
            </div>
            <div class="contenedor_submit">
                <div class="g-recaptcha" data-sitekey="6LdIPCoaAAAAAL65WFrIO9vI1uHbsFdjubwM0P4P"></div>
            </div>
            <div class="contenedor_submit">
                <button class="btnGris1" id="validarIngreso">Entrar<i class="icono_contenidos iconoLogIn"></i></button>
            </div>
        </form>
        <a href="recuperar-contrasenia"><p class="texto__recuperacion">Olvide la contraseña.</p></a>
    </div>
</div>
<script src="Vistas/js/validarIngreso.js" type="module"></script>