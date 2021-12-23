<nav id='barraNavegacion' class='navegacion'>

    <!-- LOGO MARCA -->
    <div class='navegacion__marca'>
        <a href='inicio'>
            <img class='encabezado_logo' src='Vistas/img/LOGOJUAMA2.svg' alt='Logo GR'>
        </a>
        <i id='navegacion__marca-cerrar' class='iconoCerrarMenu navegacion__marca-cerrar'></i>
    </div>

    <!-- IMAGEN PERFIL Y ROL -->
    <a class='linkMenu' href='perfil'>
        <div class='navegacion__perfil'>
            <img class='navegacion__perfil-avatar' src='<?php echo $_SESSION['foto']; ?>' alt=''>
            <div class='navegacion__perfil-titulo texto-normal'><?php echo $_SESSION['rol']; ?></div>
        </div>
    </a>

    <!-- BLOQUE LISTADO MENU -->
    <div class='fila--alineacion-v-centro fila--alineacion-h-centro'>
        <ul class='listaNav'>

            <!-- ESCRITORIO INICIAL -->
            <a class='linkMenu' href='inicio'>
                <li class='listaNav__encabezado'>
                    Panel Inicial<i class='icono iconoPanel'></i>
                </li>
            </a>

            <!-- Empleados -->
            <?php if($_SESSION['idrol'] == 1 || $_SESSION['idrol'] == 2){
                echo "
                    <li>                
                        <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                            <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoHospitales'></i></span>
                            <span class='listaNav__subencabezado-titulo'>Clientes</span>
                        </div>
                        <ul class='sublista sublista--oculto'>
                            <a class='linkMenu' href='expedientes'>
                                <li class='sublista__item'>Expedientes</li>
                            </a>
                            <a class='linkMenu' href='registro-hospital'>
                                <li class='sublista__item'>Nuevo Expediante</li>
                            </a>
                            <a class='linkMenu' href='registro-areas-hospital'>
                                <li class='sublista__item'>Registro Areas Hospital</li>
                            </a>
                            <a class='linkMenu' href='registro-contactos'>
                                <li class='sublista__item'>Registro contactos</li>
                            </a>
                            
                        </ul>
                    </li>                
                ";
            }
            ?>

            <!-- Contactos -->
            <!-- <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'>
                        <i class='icono__subtitulos iconoEmpleado'></i></span>
                    </span>
                    <span class='listaNav__subencabezado-titulo' role='presentation'>Contactos</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Nuevo</li>
                    </a>
                    <?php if($_SESSION['idrol'] != 4){
                    echo "
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Lista</li>
                    </a>"
                    ;} ?>

                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Buscar</li>
                    </a>
                </ul>
            </li> -->

            <!-- Solicitudes -->
            <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoSolicitud'></i></span>
                    <span class='listaNav__subencabezado-titulo'>Solicitudes</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='demos'>
                        <li class='sublista__item'>Demostración</li>
                    </a>
                    <a class='linkMenu' href='registro-instalacion'>
                        <li class='sublista__item'>Instalación</li>
                    </a>
                    <a class='linkMenu' href='registro-capacitacion'>
                        <li class='sublista__item'>Capacitación</li>
                    </a>
                    <a class='linkMenu' href='registro-poliza'>
                        <li class='sublista__item'>Pólizas</li>
                    </a>
                </ul>
            </li>

            <!-- Soporte -->
            <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoSoporte'></i></span>
                    <span class='listaNav__subencabezado-titulo'>Soporte</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Nuevo</li>
                    </a>
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Lista</li>
                    </a>

                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Buscar</li>
                    </a>

                </ul>
            </li>
            <!-- REPORTES -->
            <?php if($_SESSION['idrol'] != 4){
            echo "
                <li class='listaNav__encabezado'>
                    Reportes<i class='icono iconoReportes'></i>
                </li>

                <li>
                    <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                        <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoHospitales'></i></span>
                        <span class='listaNav__subencabezado-titulo'>Clientes</span>
                    </div>
                    <ul class='sublista sublista--oculto'>
                        <li class='sublista__item'>Mensual</li>
                        <li class='sublista__item'>Anual</li>
                        <li class='sublista__item'>Personalizado</li>
                    </ul>
                </li>

                <li>
                    <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                        <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoSolicitud'></i></span>
                        <span class='listaNav__subencabezado-titulo'>Solicitudes</span>
                    </div>
                    <ul class='sublista sublista--oculto'>
                        <li class='sublista__item'>Mensual</li>
                        <li class='sublista__item'>Anual</li>
                        <li class='sublista__item'>Personalizado</li>
                    </ul>
                </li>";
            } ?>


            <!-- HERRAMIENTAS -->
            <li class='listaNav__encabezado'>
                Tablas<i class='icono iconTablasBD'></i>
            </li>

            <!-- INICIA -->

            <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'>
                        <i class='icono__subtitulos iconProducto'></i></span>
                    </span>
                    <span class='listaNav__subencabezado-titulo' role='presentation'>Productos</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='registro-categorias'>
                        <li class='sublista__item'>Categorias</li>
                    </a>                    
                    <a class='linkMenu' href='registro-marcas'>
                        <li class='sublista__item'>Marcas</li>
                    </a>
                    <a class='linkMenu' href='registro-equipos'>
                        <li class='sublista__item'>Equipos</li>
                    </a>                    
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Consumibles</li>
                    </a>  
                </ul>
            </li>
            <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'>
                        <i class='icono__subtitulos iconoHospitales'></i></span>
                    </span>
                    <span class='listaNav__subencabezado-titulo' role='presentation'>Hospitales</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='registro-areas'>
                        <li class='sublista__item'>Areas</li>
                    </a>                    
                    <a class='linkMenu' href='registro-cargos'>
                        <li class='sublista__item'>Cargos contactos</li>
                    </a>  
                </ul>
            </li>

            <!-- Solicitudes -->
            <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoSolicitud'></i></span>
                    <span class='listaNav__subencabezado-titulo'>Solicitudes</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='registro-tipo-demos'>
                        <li class='sublista__item'>Demostraciones</li>
                    </a>
                    <a class='linkMenu' href='registro-tipo-capacitaciones'>
                        <li class='sublista__item'>Capacitaciones</li>
                    </a>
                    <a class='linkMenu' href='registro-tipo-polizas'>
                        <li class='sublista__item'>Polizas</li>
                    </a>
                </ul>
            </li>

            <!-- TERMINA -->

            <!-- SISTEMA -->            
            <li class='listaNav__encabezado'>
                Sistema<i class='icono iconoSistema'></i>
            </li>
            <!-- Contactos -->
            <li>
                <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                    <span class='listaNav__subencabezado-icono'>
                        <i class='icono__subtitulos iconoClientes'></i></span>
                    </span>
                    <span class='listaNav__subencabezado-titulo' role='presentation'>Usuarios</span>
                </div>
                <ul class='sublista sublista--oculto'>
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Nuevo</li>
                    </a>
                    <a class='linkMenu' href='#'>
                        <li class='sublista__item'>Lista</li>
                    </a>
                </ul>
            </li>

            <!-- MI CUENTA -->
            <?php if($_SESSION['idrol'] == 1){
            echo "
                <li class='listaNav__encabezado'>
                    Mi Cuenta<i class='icono iconoMicuenta'></i>
                </li>
                
                <li>
                    <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                        <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoPerfil'></i></span>
                        <span class='listaNav__subencabezado-titulo'>Perfil</span>
                    </div>
                    <ul class='sublista sublista--oculto'>
                        <a class='linkMenu' href='#'>
                            <li class='sublista__item'>Datos</li>
                        </a>
                        <a class='linkMenu' href='#'>
                            <li class='sublista__item'>Editar</li>
                        </a>
                    </ul>
                </li>";
            } ?>

            <!-- SESION -->
            <li class='listaNav__encabezado'>
                Sesión<i class='icono iconoSesion'></i>
            </li>

            <a class='linkMenu' href='salir'>
                <li>
                    <div class='listaNav__subencabezado fila fila--alineacion-v-centro'>
                        <span class='listaNav__subencabezado-icono'><i class='icono__subtitulos iconoCerrar'></i></span>
                        <span class='listaNav__subencabezado-titulo'>Salir del sistema</span>
                    </div>
                </li>
            </a>

        </ul>
    </div>
</nav>