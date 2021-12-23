<?php
if(isset($_SESSION['validar'])){
    echo '<script>window.location.href="inicio"</script>';
}
$iniciarSesion = new Controladores\RecuperarDatosAcceso;
$iniciarSesion->recuperarDatos();
?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<div class="contenedor__ingreso">
    <div class="contenedor__login">    
        <div class="contenedor__logo__ingreso">
            <img class="logo__ingreso" src="Vistas/img/LOGOJUAMA1.svg" alt="Logo GR">
        </div>
        <p class="texto__recuperacion">Recuperar datos de acceso.</p>
        <form name="formulario" method="post" id="recuperar">
            <div class="contenedor_elementos_formulario">
                <label for="usuario"><i class="icono iconoUsuarioAcceso"></i>Usuario</label>
                <input type="email" id="usuario" name="usuario" placeholder="Escriba su correo electrónico" class="contactoForm_elemento-dimension" minlength="10" maxlength="50" required /><span class="avisoErrorSesion"></span>
            </div>
            <div class="contenedor_submit">
                <div class="g-recaptcha" data-sitekey="6LdIPCoaAAAAAL65WFrIO9vI1uHbsFdjubwM0P4P"></div>
            </div>
            <div class="contenedor_submit">
                <button class="btnGris1" id="validarIngreso">Recuperar<i class="icono_contenidos iconoRecuperarContra"></i></button>
            </div>
        </form>
        <a href="index"><p class="texto__recuperacion">Iniciar sesión.</p></a>
    </div>
</div>
<script src="Vistas/js/recuperarContrasenia.js" type="module"></script>