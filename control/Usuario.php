<?php

require_once "../model/usuarioModel.php";

$option = $_REQUEST['op'];


$objUsuario = new UsuarioModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrUsuario = $objUsuario->ListarUsuarios();

    if (!empty($arrUsuario)) {
        for ($i=0; $i < count($arrUsuario); $i++) { 
            $id_usuario = $arrUsuario[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-usuario/' . $id_usuario . '"><i class="fa-solid fa-pen-to-square"></i></a>
            <button class="btn btn-outline-danger" onclick="eliminarUsuario(' . $id_usuario . ');"><i class="fa-solid fa-trash"></i></button>';
            $arrUsuario[$i]->options = $options;
        }
        $arrResponse['status']=true;
        $arrResponse['data']=$arrUsuario;
    }
    echo json_encode($arrResponse);
}

if ($option == "registrar") {
    # code...
}

if ($option == "ver_id") {
    if ($_POST) {
        $id_usuario = $_POST['id_usuario'];
        $arrUsuario = $objUsuario->getUsuario($id_usuario);
        if (empty($arrUsuario)) {
            $arrResponse = array('status' => false, 'msg' => "Error, Usuario no existe");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Datos encontrados", 'data' => $arrUsuario);
        }
        echo json_encode($arrResponse);
    }
}
if ($option == "ver_dni") {
    if ($_POST) {
        $dni_usuario = $_POST['dni_usuario'];
        $arrUsuario = $objUsuario->getUsuarioDni($dni_usuario);
        if (empty($arrUsuario)) {
            $arrResponse = array('status' => false, 'msg' => "Error, Usuario no existe");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Datos encontrados", 'data' => $arrUsuario);
        }
        echo json_encode($arrResponse);
    }
}


if ($option == "actualizar") {
    # code...
}


if ($option == "eliminar") {
    # code...
}




?>