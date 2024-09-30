<?php

require_once "../model/productoModel.php";

$option = $_REQUEST['op'];



$objProducto = new productoModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrProducto = $objProducto->getProductos();

    if (!empty($arrProducto)) {
        for ($i = 0; $i < count($arrProducto); $i++) {
            $id_producto = $arrProducto[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-medicamento/' . $id_producto . '"><i class="fa-solid fa-pen-to-square"></i></a>
        <button class="btn btn-outline-danger" onclick="eliminarProducto(' . $id_producto . ');"><i class="fa-solid fa-trash"></i></button>';
            $arrProducto[$i]->options = $options;
        }
        $arrResponse['status'] = true;
        $arrResponse['data'] = $arrProducto;
    }
    echo json_encode($arrResponse);
}
if ($option == "registrar") {
    if ($_POST) {
        if (empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['presentacion']) || empty($_POST['stock']) || empty($_POST['fecha_vencimiento']) || empty($_POST['id_categoria'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $codigo = trim($_POST['codigo']);
            $nombre = ucwords(trim($_POST['nombre']));
            $descripcion = ucwords(trim($_POST['descripcion']));
            $presentacion = ucwords(trim($_POST['presentacion']));
            $stock = trim($_POST['stock']);
            $fecha_vencimiento = trim($_POST['fecha_vencimiento']);
            $id_categoria = trim($_POST['id_categoria']);

            $arrProducto = $objProducto->registrarProducto($codigo, $nombre, $descripcion, $presentacion, $stock, $fecha_vencimiento, $id_categoria);

            if ($arrProducto->id > 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos guardados correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error al guardar datos, Código ya existe");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "busqueda") {
    if ($_POST) {
        $bmedicamento = $_POST['bmedicamento'];
        $arrResponse = array('status' => false, 'data' => "");
        $arrProducto = $objProducto->busquedaProducto($bmedicamento);

        if (!empty($arrProducto)) {
            for ($i = 0; $i < count($arrProducto); $i++) {
                $id_producto = $arrProducto[$i]->id;
                $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-medicamento/' . $id_producto . '"><i class="fa-solid fa-pen-to-square"></i></a>
            <button class="btn btn-outline-danger" onclick="eliminarProducto(' . $id_producto . ');"><i class="fa-solid fa-trash"></i></button>';
                $arrProducto[$i]->options = $options;
            }
            $arrResponse['status'] = true;
            $arrResponse['data'] = $arrProducto;
        }
        echo json_encode($arrResponse);
    }
}
if ($option == "ver") {
    if ($_POST) {
        $id_producto = $_POST['idmedicamento'];
        $arrProducto = $objProducto->getProducto($id_producto);
        if (empty($arrProducto)) {
            $arrResponse = array('status' => false, 'msg' => "Error al guardar datos, Código ya existe");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Datos encontrados", 'data' => $arrProducto);
        }
        echo json_encode($arrResponse);
    }
}
if ($option == "actualizar") {
    //print_r($_POST);
    if ($_POST) {
        if (empty($_POST['id_m']) || empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['presentacion']) || empty($_POST['fecha_vencimiento']) || empty($_POST['id_categoria'])) {
            $arrResponse = array('status' => false, 'msg' => "Error de datos");
        } else {
            $id_med = trim($_POST['id_m']);
            $codigo = trim($_POST['codigo']);
            $nombre = ucwords(trim($_POST['nombre']));
            $descripcion = ucwords(trim($_POST['descripcion']));
            $presentacion = ucwords(trim($_POST['presentacion']));
            $fecha_vencimiento = trim($_POST['fecha_vencimiento']);
            $id_categoria = trim($_POST['id_categoria']);

            $arrProducto = $objProducto->actualizarProducto($id_med, $codigo, $nombre, $descripcion, $presentacion, $fecha_vencimiento, $id_categoria);
            //print_r($arrProducto);
            if ($arrProducto->id_p > 0) {
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
        $id_producto = $_POST['idmedicamento'];
        $arrProducto = $objProducto->eliminarProducto($id_producto);
        if (empty($arrProducto)) {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Eliminado correctamente", 'data' => $arrProducto);
        }
        echo json_encode($arrResponse);
    }
}


die();
