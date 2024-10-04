<?php session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inventario | </title>

    <!-- Bootstrap -->
    <link href="" rel="stylesheet">
    <link href="<?php echo BASE_URL ?>view/Gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo BASE_URL ?>view/Gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo BASE_URL ?>view/Gentella/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo BASE_URL ?>view/Gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script>
        const base_url = '<?= BASE_URL ?>';
    </script>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo BASE_URL; ?>inicio" class="site_title"><i class="fa fa-paw"></i> <span>Sistema</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Menú de Navegación</h3>
                            <ul class="nav side-menu col-12">
                                <li class="w-100"><a href="<?php echo BASE_URL; ?>inicio"><i class="fa fa-home"></i> Inicio </a></li>
                                <li><a href="<?php echo BASE_URL; ?>usuarios"><i class="fa fa-home"></i> Usuarios </a></li>
                                <li><a href="<?php echo BASE_URL; ?>consultorio"><i class="fa fa-home"></i> Consultorio </a></li>
                                <li><a><i class="fa fa-edit"></i> Farmacia <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo BASE_URL; ?>farmacia">Atención</a></li>
                                        <li><a href="<?php echo BASE_URL; ?>medicamento">Medicamentos</a></li>
                                        <li><a href="<?php echo BASE_URL; ?>categorias">Categorías</a></li>
                                    </ul>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt=""><?php echo $_SESSION['nombres_inventario']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <!--<li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>-->
                                    <li>
                                        <a href="#" onclick="cerrar_sesion();"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->