<?php

require_once "../model/usuarioModel.php";

$option = $_REQUEST['op'];


$objUsuario = new UsuarioModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrUsuario = $objUsuario->ListarUsuarios();

    if (!empty($arrUsuario)) {
        for ($i = 0; $i < count($arrUsuario); $i++) {
            $id_usuario = $arrUsuario[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-usuario/' . $id_usuario . '"><i class="fa-solid fa-pen-to-square"></i></a>
            <button class="btn btn-outline-danger" onclick="eliminarUsuario(' . $id_usuario . ');"><i class="fa-solid fa-trash"></i></button>';
            $arrUsuario[$i]->options = $options;
        }
        $arrResponse['status'] = true;
        $arrResponse['data'] = $arrUsuario;
    }
    echo json_encode($arrResponse);
}

if ($option == "registrar") {
    //print_r($_POST);
    if ($_POST) {
        if (empty($_POST['dni']) || empty($_POST['nombres']) || empty($_POST['fecha_nacimiento']) || empty($_POST['genero']) || empty($_POST['talla']) || empty($_POST['peso']) || empty($_POST['tipo_usuario'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $dni = trim($_POST['dni']);
            $cip = trim($_POST['cip']);
            $nombres = ucwords(trim($_POST['nombres']));
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $genero = ucwords(trim($_POST['genero']));
            $talla = trim($_POST['talla']);
            $peso = trim($_POST['peso']);
            $grado = ucwords(trim($_POST['grado']));
            $cia = ucwords(trim($_POST['cia']));
            $tipo_usuario = ucwords(trim($_POST['tipo_usuario']));
            $password = password_hash($dni, PASSWORD_DEFAULT);

            $arrUsuario = $objUsuario->registrarUsuario($dni, $cip, $nombres, $fecha_nacimiento, $genero, $talla, $peso, $grado, $cia, $tipo_usuario, $password);
            if ($arrUsuario->res > 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error al guardar datos, DNI ya existe");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
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
    //print_r($_POST);
    if ($_POST) {
        if (empty($_POST['id']) || empty($_POST['dni']) || empty($_POST['cip']) || empty($_POST['nombres']) || empty($_POST['fecha_nacimiento']) || empty($_POST['genero']) || empty($_POST['talla']) || empty($_POST['peso']) || empty($_POST['grado']) || empty($_POST['cia']) || empty($_POST['tipo_usuario'])) {
            $arrResponse = array('status' => false, 'msg' => "Error de datos");
        } else {
            $id = trim($_POST['id']);
            $dni = trim($_POST['dni']);
            $cip = ucwords(trim($_POST['cip']));
            $nombres = ucwords(trim($_POST['nombres']));
            $fecha_nacimiento = ucwords(trim($_POST['fecha_nacimiento']));
            $genero = trim($_POST['genero']);
            $talla = trim($_POST['talla']);
            $peso = trim($_POST['peso']);
            $grado = trim($_POST['grado']);
            $cia = trim($_POST['cia']);
            $tipo_usuario = trim($_POST['tipo_usuario']);

            $arrUsuario = $objUsuario->actualizarUsuario($id, $dni, $cip, $nombres, $fecha_nacimiento, $genero, $talla, $peso, $grado, $cia, $tipo_usuario);
            //print_r($arrUsuario);
            if ($arrUsuario->id_p > 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos Actualizados correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error al Actualizar datos, Código ya existe");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}


if ($option == "eliminar") {
    if ($_POST) {
        $id_usuario = $_POST['idusuario'];
        $arrUsuario = $objUsuario->eliminarUsario($id_usuario);
        if (empty($arrUsuario)) {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Eliminado correctamente", 'data' => $arrUsuario);
        }
        echo json_encode($arrResponse);
    }
}
