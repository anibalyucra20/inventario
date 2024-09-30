<?php

require_once "../model/categoriaModel.php";

$option = $_REQUEST['op'];



$objCategorias = new categoriaModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrCategorias= $objCategorias->getCategorias();

    if (!empty($arrCategorias)) {
        for ($i = 0; $i < count($arrCategorias); $i++) {
            $id_categoria = $arrCategorias[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-categoria/' . $id_categoria . '"><i class="fa-solid fa-pen-to-square"></i></a>
        <button class="btn btn-outline-danger" onclick="eliminarCategoria(' . $id_categoria . ');"><i class="fa-solid fa-trash"></i></button>';
            $arrCategorias[$i]->options = $options;
        }
        $arrResponse['status'] = true;
        $arrResponse['data'] = $arrCategorias;
    }
    echo json_encode($arrResponse);
}
if ($option == "registrar") {
    
    if ($_POST) {
        //print_r($_POST);
        if (empty($_POST['nombre'])) {
            $arrResponse = array('status' => false, 'msg' => "Error de datos");
        } else {
            $nombre = ucwords(trim($_POST['nombre']));
            $arrCategoria = $objCategorias->registrarCategoria($nombre);
            
            if ($arrCategoria->id > 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardador correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error al guardar datos, Categoría ya existe");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "ver") {
    if ($_POST) {
        $id_categoria = $_POST['idcategoria'];
        $arrCategoria = $objCategorias->getCategoria($id_categoria);
        if (empty($arrCategoria)) {
            $arrResponse = array('status' => false, 'msg' => "Error al buscar datos");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Datos encontrados", 'data' => $arrCategoria);
        }
        echo json_encode($arrResponse);
    }
}
if ($option == "actualizar") {
    //print_r($_POST);
    if ($_POST) {
        if (empty($_POST['id_c']) || empty($_POST['nombre'])) {
            $arrResponse = array('status' => false, 'msg' => "Error de datos");
        } else {
            $id_c = trim($_POST['id_c']);
            $nombre = ucwords(trim($_POST['nombre']));

            $arrCategoria = $objCategorias->actualizarCategoria($id_c, $nombre);
            //print_r($arrCategoria);
            if ($arrCategoria->id_p > 0) {
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
        $id_categoria = $_POST['idcategoria'];
        $arrCategoria = $objCategorias->eliminarCategoria($id_categoria);
        if ($arrCategoria->id > 0) {
            $arrResponse = array('status' => true, 'msg' => "Eliminado correctamente", 'data' => $arrCategoria);
        } else {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar");
        }
        echo json_encode($arrResponse);
    }
}


die();
