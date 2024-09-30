

<?php
require_once "./config/config.php";
require_once "./control/vistasControlador.php";
$mostrar =  new vistasControlador();

$vistas = $mostrar->obtener_vistas_controlador();
if ($vistas =="login" || $vistas =="404") {
    require_once "./view/".$vistas."-view.php";
}else {
    

    include "./view/include/header.php";
    include $vistas;
    include "./view/include/footer.php"; 
    }?>



    