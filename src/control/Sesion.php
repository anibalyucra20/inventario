<?php
require_once('../model/admin-sesionModel.php');
$tipo = $_REQUEST['tipo'];

//instanciar la clase periodo model
$objSesion = new SessionModel();

if ($tipo == "buscar") {
    $id_sesion = $_POST['id_sesion'];
    //repuesta
    $arr_Respuesta = array('status' => false, 'contenido' => '');
    $arr_Sesion = $objSesion->buscarSesionLoginById($id_sesion);
    if (!empty($arr_Sesion)) {
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_Sesion;
    }
    echo json_encode($arr_Respuesta);
    
}
if ($tipo == "validar_sesion") {
    $id_sesion = $_GET['sesion'];
    $token = $_GET['token'];

    $resultado = $objSesion->verificar_sesion_si_activa($id_sesion, $token);
    echo $resultado;
}

