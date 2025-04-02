<?php
$tipo = $_REQUEST['tipo'];

if ($tipo == "iniciar_sesion") {
    session_start();
    $_SESSION['sesion_sigi_id'] = $_POST['session'];
    $_SESSION['sesion_sigi_usuario'] = $_POST['usuario'];
    $_SESSION['sesion_sigi_usuario_nom'] = $_POST['nombres_apellidos'];
    $_SESSION['sesion_sigi_token'] = $_POST['token'];
    $_SESSION['sesion_sigi_periodo'] = $_POST['id_periodo'];
    $_SESSION['sesion_sigi_sede'] = $_POST['id_sede'];
}
if ($tipo == "cerrar_sesion") {
    session_start();
    session_unset();
    session_destroy();
    $arrResponse = array('status' => true);
    echo json_encode($arrResponse);
}
if ($tipo == "actualizar_periodo_sesion") {
    //print_r($_POST);
    $id_periodo = $_POST['id_periodo'];
    session_start();
    if ($_SESSION['sesion_sigi_periodo'] != $id_periodo) {
        $_SESSION['sesion_sigi_periodo'] = $id_periodo;
        if ($_SESSION['sesion_sigi_periodo'] == $id_periodo) {
            $arr_Respuesta = array('status' => true, 'contenido' => '');
        } else {
            $arr_Respuesta = array('status' => false, 'contenido' => '');
        }
    } else {
        $arr_Respuesta = array('status' => false, 'contenido' => '');
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "actualizar_sede_sesion") {
    //print_r($_POST);
    $id_sede = $_POST['id_sede'];
    session_start();
    if ($_SESSION['sesion_sigi_sede'] != $id_sede) {
        $_SESSION['sesion_sigi_sede'] = $id_sede;
        if ($_SESSION['sesion_sigi_sede'] == $id_sede) {
            $arr_Respuesta = array('status' => true, 'contenido' => '');
        } else {
            $arr_Respuesta = array('status' => false, 'contenido' => '');
        }
    } else {
        $arr_Respuesta = array('status' => false, 'contenido' => '');
    }
    echo json_encode($arr_Respuesta);
}
