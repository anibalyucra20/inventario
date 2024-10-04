<?php

require_once "../model/tratamientoModel.php";

$option = $_REQUEST['op'];



$objTratamiento = new tratamientoModel();

if ($option == "registrar") {
    if ($_POST) {
        if (empty($_POST['id_consulta']) || empty($_POST['id_medicamento_frm']) || empty($_POST['cantidad_c']) || empty($_POST['frecuencia_c']) || empty($_POST['dias_c']) || empty($_POST['via_c'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $id_consulta = trim($_POST['id_consulta']);
            $id_medicamento_frm = trim($_POST['id_medicamento_frm']);
            $cantidad_c = trim($_POST['cantidad_c']);
            $frecuencia_c = ucwords(trim($_POST['frecuencia_c']));
            $dias_c = ucwords(trim($_POST['dias_c']));
            $via_c = ucwords(trim($_POST['via_c']));

            $arrProducto = $objTratamiento->registrarTratamiento($id_consulta, $id_medicamento_frm, $cantidad_c, $frecuencia_c, $dias_c, $via_c);

            if ($arrProducto->id > 0) {
                $arrResponse = array('status' => true, 'msg' => "Agregado correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error, Tratamiento ya agregado");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "listar") {
    if ($_POST) {
        $id_consulta = $_POST['id_consulta'];
        $arrResponse = array('status' => false, 'data' => "");
        $arrTratamientos = $objTratamiento->getTratamientos($id_consulta);

        if (!empty($arrTratamientos)) {
            for ($i = 0; $i < count($arrTratamientos); $i++) {
                $id_tratamiento = $arrTratamientos[$i]->id;
                $options = '<button type="button" class="btn btn-info" data-toggle="modal" data-target=".modal_editar_' . $id_tratamiento . '"><i class="fa fa-pen"></i></button>
        <button type="button" class="btn btn-outline-danger" onclick="eliminarTratamiento(' . $id_tratamiento . ');"><i class="fa-solid fa-trash"></i></button>
        
        <!-- MODAL EDITAR -->
                        <div class="modal fade modal_editar_' . $id_tratamiento . '" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Modificar Tratamiento</h4>
                                    </div>
                                    <form id="frm_tratamiento_editar" class="form-horizontal form-label-left">
                                        <br>
                                        <div class="form-group">
                                            <label for="bmedicamento_editar_' . $id_tratamiento . '" class="form-label col-md-3">Medicamento:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control col-md-6" id="bmedicamento_editar_' . $id_tratamiento . '" name="bmedicamento_editar_' . $id_tratamiento . '" required readonly value="'.$arrTratamientos[$i]->nombre.'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cantidad_c_editar_' . $id_tratamiento . '" class="form-label col-md-3">Cantidad:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="cantidad_c_editar_' . $id_tratamiento . '" id="cantidad_c_editar_' . $id_tratamiento . '" required value="'.$arrTratamientos[$i]->cantidad.'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="frecuencia_c_editar_' . $id_tratamiento . '" class="form-label col-md-3">Frecuencia x Hora:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="frecuencia_c_editar_' . $id_tratamiento . '" id="frecuencia_c_editar_' . $id_tratamiento . '" required value="'.$arrTratamientos[$i]->por_hora.'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dias_c_editar_' . $id_tratamiento . '" class="form-label col-md-3">Cantidad de días:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="dias_c_editar_' . $id_tratamiento . '" id="dias_c_editar_' . $id_tratamiento . '" required value="'.$arrTratamientos[$i]->por_dia.'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="via_c_editar_' . $id_tratamiento . '" class="form-label col-md-3">Vía de Administración:</label>
                                            <div class="col-md-9">
                                                <select name="via_c_editar_' . $id_tratamiento . '" id="via_c_editar_' . $id_tratamiento . '" class="form-control" required>
                                                    <option></option>
                                                    <option value="Oral">Oral</option>
                                                    <option value="Intra Muscular">Intra Muscular</option>
                                                    <option value="Intra Venosa">Intra Venosa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="cerrar_modal_editar_' . $id_tratamiento . '" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" onclick="actualizarTratamiento(' . $id_tratamiento . ');">Actualizar</button>
                                        </div>

                                    </form>



                                </div>
                            </div>
                        </div>
                        <!-- /MODAL EDITAR -->
        ';
                $arrTratamientos[$i]->options = $options;
            }
            $arrResponse['status'] = true;
            $arrResponse['data'] = $arrTratamientos;
        }
        echo json_encode($arrResponse);
    }
}


if ($option == "actualizar") {
    //print_r($_POST);
    if ($_POST) {
        if (empty($_POST['idtratamiento']) || empty($_POST['cantidad_t']) || empty($_POST['hora_t']) || empty($_POST['dia_t']) || empty($_POST['via_t'])) {
            $arrResponse = array('status' => false, 'msg' => "Error de datos");
        } else {
            $id_tratamiento = trim($_POST['idtratamiento']);
            $cantidad_t = trim($_POST['cantidad_t']);
            $hora_t = trim($_POST['hora_t']);
            $dia_t = trim($_POST['dia_t']);
            $via_t = ucwords(trim($_POST['via_t']));

            $arrTratamientos = $objTratamiento->actualizarTratamiento($id_tratamiento, $cantidad_t, $hora_t, $dia_t, $via_t);
            //print_r($arrProducto);
            if ($arrTratamientos->id_p > 0) {
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
        $id_tratamiento = $_POST['idtratamiento'];
        $arrTratamientos = $objTratamiento->eliminarTratamiento($id_tratamiento);
        if ($arrTratamientos->res > 0) {
            $arrResponse = array('status' => false, 'msg' => "Error al eliminar");
        } else {
            $arrResponse = array('status' => true, 'msg' => "Eliminado correctamente", 'data' => $arrTratamientos);
        }
        echo json_encode($arrResponse);
    }
}


