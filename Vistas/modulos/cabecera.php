<header class="encabezado">
    <!-- ICONO MENU HAMBURGUESA -->
    <i id="encabezado__menu" class="iconoHamburguesa icono__atajos encabezado__menu"></i>
    <!-- TITULO ENCABEZADO -->
    <div class="encabezado__titulo">
        BITÁCORA ADMINISTRATIVA
    </div>
    <!-- AVATAR PERFIL ENCABEZADO -->
    <div id="encabezado__avatar" class="encabezado__avatar">
        <img src="<?php echo $_SESSION['foto']; ?>" alt="">
        <!-- Bloque Menu Perfil Avatar -->
        <div id="menu__avatar" class="desplegable">
            <ul class="desplegable__lista">
                <a class="linkMenu" href="#">
                    <li class="desplegable__lista-item">
                        <i class="icono iconoPerfil"></i>
                        <span class="desplegable__titulo">
                            Perfil
                        </span>
                    </li>
                </a>
                <a class="linkMenu" href="salir">
                    <li class="desplegable__lista-item">
                        <span class="desplegable__icono"><i class="icono iconoCerrar"></i></span>
                        <span class="desplegable__titulo">
                            Salir
                        </span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</header>