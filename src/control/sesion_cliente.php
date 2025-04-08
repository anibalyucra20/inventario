<?php
$tipo = $_REQUEST['tipo'];

if ($tipo == "iniciar_sesion") {
    session_start();
    $_SESSION['sesion_id'] = $_POST['session'];
    $_SESSION['sesion_usuario'] = $_POST['usuario'];
    $_SESSION['sesion_usuario_nom'] = $_POST['nombres_apellidos'];
    $_SESSION['sesion_token'] = $_POST['token'];
    $_SESSION['sesion_ies'] = $_POST['id_ies'];
}
if ($tipo == "cerrar_sesion") {
    session_start();
    session_unset();
    session_destroy();
    $arrResponse = array('status' => true);
    echo json_encode($arrResponse);
}

if ($tipo == "actualizar_ies_sesion") {
    //print_r($_POST);
    $id_ies = $_POST['id_ies'];
    session_start();
    if ($_SESSION['sesion_ies'] != $id_ies) {
        $_SESSION['sesion_ies'] = $id_ies;
        if ($_SESSION['sesion_ies'] == $id_ies) {
            $arr_Respuesta = array('status' => true, 'contenido' => '');
        } else {
            $arr_Respuesta = array('status' => false, 'contenido' => '');
        }
    } else {
        $arr_Respuesta = array('status' => false, 'contenido' => '');
    }
    echo json_encode($arr_Respuesta);
}
