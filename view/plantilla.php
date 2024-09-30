

<?php

require_once "./control/vistasControlador.php";
$mostrar =  new vistasControlador();

$vistas = $mostrar->obtener_vistas_controlador();
if ($vistas =="login" || $vistas =="404") {
    require_once "./view/".$vistas."-view.php";
}else {
    

    include "./View/include/header.php";
    include $vistas;
    include "./View/include/footer.php"; 
    }?>



    