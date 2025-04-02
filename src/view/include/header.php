<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SIGI - IES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Sistema Integrado de Gestión Institucional" name="description" />
    <meta content="AnibalYucraC" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo BASE_URL ?>src/view/pp/assets/images/favicon.ico">

    <!-- Plugins css -->
    <script src="<?php echo BASE_URL ?>src/view/js/principal.js"></script>
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alerts css -->
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo BASE_URL ?>src/view/pp/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/include/styles.css" rel="stylesheet" type="text/css" />
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
        const session_session = '<?php echo $_SESSION['sesion_sigi_id']; ?>';
        const token_token = '<?php echo $_SESSION['sesion_sigi_token']; ?>';
    </script>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            <header id="page-topbar">
                <div class="navbar-header">
                    <?php
                    $pagina = explode("/", $_GET['views']);
                    $nom_sistema = '';
                    switch ($pagina['0']) {
                        case 'intranet':
                            $nom_sistema = "INTRANET";
                            break;
                        case 'admin':
                            $nom_sistema = "GESTION";
                            break;
                        case 'academico':
                            $nom_sistema = "ACADEMICO";
                            break;
                        case 'biblioteca':
                            $nom_sistema = "BIBLIOTECA";
                            break;
                        default:
                            $nom_sistema = "";
                            break;
                    }
                    ?>
                    <!-- LOGO -->
                    <div class="navbar-brand-box d-flex align-items-left">
                        <a href="<?php echo BASE_URL ?>" class="logo">
                            <i class="mdi mdi-album"></i>
                            <span>
                                SIGI - <?php echo $nom_sistema; ?>
                            </span>
                        </a>

                        <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect waves-light"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-sm-inline-block ml-1" id="menu_sede">Huanta</span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="contenido_menu_sede">
                            </div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect waves-light"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-sm-inline-block ml-1" id="menu_periodo">2023-II</span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" id="contenido_menu_periodo">
                            </div>
                        </div>
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn header-item waves-effect waves-light"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png">
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $_SESSION['sesion_sigi_usuario_nom']; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    Mi perfil
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <span>Cambiar mi Contraseña</span>
                                </a>
                                <button class="dropdown-item d-flex align-items-center justify-content-between" onclick="cerrar_sesion();">
                                    <span>Cerrar Sesión</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </header>

            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <?php


                                if ($pagina['0'] == "admin") {
                                ?>
                                    <!-- ---------------------------------------------- INICIO MENU SIGI ------------------------------------------------------------ -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo BASE_URL ?>admin">
                                            <i class="mdi mdi-home"></i>Inicio
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-diamond-stone"></i>Gestión IES <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                                            <a href="<?php echo BASE_URL ?>admin/periodo-academico" class="dropdown-item">Periodo Académico</a>
                                            <a href="<?php echo BASE_URL ?>admin/docentes" class="dropdown-item">Docentes</a>
                                            <a href="<?php echo BASE_URL ?>admin/sedes" class="dropdown-item">Sedes</a>
                                            <a href="<?php echo BASE_URL ?>admin/programa-estudio" class="dropdown-item">Programas de Estudio</a>
                                            <a href="<?php echo BASE_URL ?>admin/modulo-formativo" class="dropdown-item">Módulos Formativos</a>
                                            <a href="<?php echo BASE_URL ?>admin/semestre" class="dropdown-item">Semestre</a>
                                            <a href="<?php echo BASE_URL ?>admin/unidad-didactica" class="dropdown-item">Unidades Didácticas</a>
                                            <a href="<?php echo BASE_URL ?>admin/competencia" class="dropdown-item">Competencias</a>
                                            <a href="<?php echo BASE_URL ?>admin/capacidad" class="dropdown-item">Capacidades</a>
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Configuración <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                                    <a href="<?php echo BASE_URL ?>admin/institucion" class="dropdown-item">Información IES</a>
                                                    <a href="<?php echo BASE_URL ?>admin/sistema" class="dropdown-item">Sistema</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- ---------------------------------------------- FIN MENU SIGI ------------------------------------------------------------ -->
                                <?php
                                }
                                if ($pagina['0'] == "academico") {
                                ?>
                                    <!-- ---------------------------------------------- INICIO MENU ACADEMICO ------------------------------------------------------------ -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo BASE_URL ?>academico">
                                            <i class="mdi mdi-home"></i>Inicio
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-diamond-stone"></i>Planificación <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                                            <a href="<?php echo BASE_URL ?>academico/programacion" class="dropdown-item">Programación de Clases</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-diamond-stone"></i>Estudiantes <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                                            <a href="<?php echo BASE_URL ?>academico/estudiantes" class="dropdown-item">Estudiantes</a>
                                            <a href="<?php echo BASE_URL ?>academico/matriculas" class="dropdown-item">Matrículas</a>
                                            <a href="<?php echo BASE_URL ?>academico/licencias" class="dropdown-item">Licencias</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-diamond-stone"></i>Unidades Didácticas <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                                            <a href="<?php echo BASE_URL ?>academico/mis-unidades-didacticas" class="dropdown-item">Mis Unidades Didacticas</a>
                                            <a href="<?php echo BASE_URL ?>academico/unidades-didacticas" class="dropdown-item">Unidades Didácticas</a>
                                            <a href="<?php echo BASE_URL ?>academico/evaluaciones" class="dropdown-item">Evaluaciones</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-diamond-stone"></i>Reportes <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                                            <a href="<?php echo BASE_URL ?>academico/reporte-matricula" class="dropdown-item">Reporte de Matrículas</a>
                                            <a href="<?php echo BASE_URL ?>academico/reporte-calificaciones" class="dropdown-item">Reporte de Calificaciones</a>
                                            <a href="<?php echo BASE_URL ?>academico/reporte-consolidado" class="dropdown-item">Reporte Consolidado</a>
                                            <a href="<?php echo BASE_URL ?>academico/reporte-primeros-puestos" class="dropdown-item">Reporte Primeros Puestos</a>
                                        </div>
                                    </li>
                                    <!-- ---------------------------------------------- FIN MENU ACADEMICO ------------------------------------------------------------ -->
                                <?php
                                }
                                if ($pagina['0'] == "biblioteca") {
                                ?>
                                    <!-- ---------------------------------------------- INICIO MENU BIBLIOTECA ----------------------------------------------------- -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo BASE_URL ?>biblioteca">
                                            <i class="mdi mdi-home"></i>Inicio
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo BASE_URL ?>biblioteca/libros">
                                            <i class="fa fa-book"></i>Biblioteca
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo BASE_URL ?>biblioteca/favoritos">
                                            <i class="fa fa-bookmark"></i>Favoritos
                                        </a>
                                    </li>
                                    <!-- ---------------------------------------------- FIN MENU BIBLIOTECA ------------------------------------------------------------ -->
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>


            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->

                    <!-- Popup de carga -->
                    <div id="popup-carga" style="display: none;">
                        <div class="popup-overlay">
                            <div class="popup-content">
                                <div class="spinner"></div>
                                <p>Cargando, por favor espere...</p>
                            </div>
                        </div>
                    </div>
                    <script>
                        cargar_datos_menu(<?php echo $_SESSION['sesion_sigi_sede']; ?>, <?php echo $_SESSION['sesion_sigi_periodo']; ?>);
                    </script>