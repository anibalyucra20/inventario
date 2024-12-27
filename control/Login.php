<?php
require_once("../model/usuarioModel.php");
$option = $_REQUEST['op'];

$objUsuario = new UsuarioModel();

if ($option == "iniciar_sesion") {
    if ($_POST) {
        //print_r($_POST);
        $usuario = trim($_POST['usuario_inv']);
        $password = trim($_POST['password']);
        $arrUsuario = $objUsuario->getUsuarioDni($usuario);
        if (empty($arrUsuario)) {
            $arrResponse = array('status' => false, 'msg' => "Usuario no esta registrado");
        } else {
            if (password_verify($password, $arrUsuario->contraseña)) {
                //crear variables de sesión
                session_start();
                $_SESSION['id_inventario'] = $arrUsuario->id;
                $_SESSION['nombres_inventario'] = $arrUsuario->apellidos_nombres;
                $_SESSION['tipo_inventario'] = $arrUsuario->tipo_usuario;
                $arrResponse = array('status' => true, 'msg' => "Iniciar Sesión", 'data' => $arrUsuario);
            } else {
                $arrResponse = array('status' => false, 'msg' => "Contraseña Incorrecta");
            }
        }
        echo json_encode($arrResponse);
    }
}
if ($option == "cerrar_sesion") {
    session_start();
    session_unset();
    session_destroy();
    $arrResponse = array('status' => true);
    echo json_encode($arrResponse);
}
