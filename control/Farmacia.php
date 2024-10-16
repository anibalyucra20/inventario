<?php

require_once "../model/farmaciaModel.php";
require_once "../model/productoModel.php";
require_once "../model/tratamientoModel.php";


$option = $_REQUEST['op'];

session_start();



$objFarmacia = new FarmaciaModel();
$objMedicamento = new ProductoModel();
$objTratamiento = new tratamientoModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrConsulta = $objFarmacia->getAtenciones();

    if (!empty($arrConsulta)) {
        for ($i = 0; $i < count($arrConsulta); $i++) {
            $id_consulta = $arrConsulta[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'consulta/' . $id_consulta . '"><i class="fa-solid fa-pen-to-square"></i></a>
        ';
            $arrConsulta[$i]->options = $options;
        }
        $arrResponse['status'] = true;
        $arrResponse['data'] = $arrConsulta;
    }
    echo json_encode($arrResponse);
}
if ($option == "registrar_salida") {
    if ($_POST) {
        //print_r($_POST);

        if (empty($_POST['tipo']) || empty($_POST['cantidad']) || empty($_POST['id_tratamiento']) || empty($_POST['id_medicamento'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $tipo = trim($_POST['tipo']);
            $cantidad = trim($_POST['cantidad']);
            $id_tratamiento = trim($_POST['id_tratamiento']);
            $id_medicamento = trim($_POST['id_medicamento']);
            $detalle = trim($_POST['detalle']);
            $procedencia = trim($_POST['procedencia']);
            $id_usuario = $_SESSION['id_inventario'];


            $arr_medicamento = $objMedicamento->getProductoStock($id_medicamento);
            //print_r($arr_medicamento);
            if ($arr_medicamento->stock < $cantidad) {
                $arrResponse = array('status' => false, 'msg' => "Error, Cantidad no disponible");
            } else {
                //actualizar cantidad
                $n_cantidad = $arr_medicamento->stock - $cantidad;
                $objMedicamento->actualizarCantidad($id_medicamento, $n_cantidad);

                //registrar salida de medicamento
                $arrRespuesta = $objFarmacia->registrarSalida($tipo, $id_tratamiento, $id_medicamento, $cantidad, $detalle, $procedencia, $id_usuario);

                if ($arrRespuesta->id > 0) {
                    $arrResponse = array('status' => true, 'msg' => "Atención Registrada correctamente");
                } else {
                    $arrResponse = array('status' => false, 'msg' => "Error, No se pudo Guardar");
                }
            }



            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "reporte") {
    //print_r($_POST);

    if ($_POST) {
        if (empty($_POST['id_usuario'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, de sesión");
        } else {
            $id_usuario = trim($_POST['id_usuario']);
            $fecha = trim($_POST['fecha']);
            $arrResponse = array('status' => false, 'data' => "");
            $arrFarmacia = $objFarmacia->getConsultasReporte($id_usuario, $fecha);

            if (!empty($arrFarmacia)) {
                for ($i = 0; $i < count($arrFarmacia); $i++) {

                    $id_trata = $arrFarmacia[$i]->id_tratamiento;
                    $arrTratamientos = $objTratamiento->getTratamiento($id_trata);
                    foreach ($arrTratamientos as $datos) {
                        $arrFarmacia[$i]->datos_tratamiento = $datos;
                    }
                    

                    /*$nacimiento = $arrFarmacia[$i]->fecha_nacimiento;
                    $fch = explode("-", $nacimiento);
                    $tfecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];

                    $dias = explode("-", $tfecha, 3);
                    $dias = mktime(0, 0, 0, $dias[1], $dias[0], $dias[2]);
                    $edad = (int)((time() - $dias) / 31556926);
                    $arrFarmacia[$i]->edad = '' . $edad . '';*/
                }
                $arrResponse['status'] = true;
                $arrResponse['data'] = $arrFarmacia;
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
