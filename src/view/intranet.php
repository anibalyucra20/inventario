<?php 
require_once "./src/config/config.php";


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>INTRANET</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="INTRANET SIGI" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="./src/view/pp/assets/images/favicon.ico">
    <!-- App css -->
    <link href="./src/view/pp/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./src/view/pp/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="./src/view/pp/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div>
        <div class="container">
            <div class="row col-12">
                <div class="col-md-12 pt-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">INSTITUTO DE EDUCACION SUPERIOR TECNOLOGICO PUBLICO "MANUEL ANTONIO HIERRO POZO"</h4>
                            <p class="card-text">Hola, <?php echo $_SESSION['sesion_sigi_usuario_nom']; ?></p>
                            <p class="card-text">Usted Tiene acceso a las Siguientes Sistemas:</p>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-header">
                            Sistema Administrador
                        </div>
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREHjj0QVmfJLo5BrdEKQZ5td36QsOqjgTQFg&s" alt="Card image cap">
                            <p class="card-text"></p>
                            <a href="<?php echo BASE_URL ?>admin" class="btn btn-primary waves-effect waves-light">Acceder</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-header">
                            Sistema Académico
                        </div>
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREHjj0QVmfJLo5BrdEKQZ5td36QsOqjgTQFg&s" alt="Card image cap">
                            <p class="card-text"></p>
                            <a href="<?php echo BASE_URL ?>academico" class="btn btn-primary waves-effect waves-light">Acceder</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-header">
                            Biblioteca Institucional
                        </div>
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREHjj0QVmfJLo5BrdEKQZ5td36QsOqjgTQFg&s" alt="Card image cap">
                            <p class="card-text"></p>
                            <a href="<?php echo BASE_URL ?>biblioteca" class="btn btn-primary waves-effect waves-light">Acceder</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-header">
                            Sistema de Tutoría
                        </div>
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREHjj0QVmfJLo5BrdEKQZ5td36QsOqjgTQFg&s" alt="Card image cap">
                            <p class="card-text"></p>
                            <a href="<?php echo BASE_URL ?>tutoria" class="btn btn-primary waves-effect waves-light">Acceder</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-header">
                            Sistema de Admisión
                        </div>
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREHjj0QVmfJLo5BrdEKQZ5td36QsOqjgTQFg&s" alt="Card image cap">
                            <p class="card-text"></p>
                            <a href="<?php echo BASE_URL ?>admision" class="btn btn-primary waves-effect waves-light">Acceder</a>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        <!-- jQuery  -->
        <script src="./src/view/pp/assets/js/jquery.min.js"></script>
        <script src="./src/view/pp/assets/js/bootstrap.bundle.min.js"></script>
        <script src="./src/view/pp/assets/js/waves.js"></script>
        <script src="./src/view/pp/assets/js/simplebar.min.js"></script>
        <!-- App js -->
        <script src="./src/view/pp/assets/js/theme.js"></script>

</body>

</html>