<?php
require_once('../model/admin-periodoAcademicoModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/admin-sesionModel.php');
$tipo = $_REQUEST['tipo'];

//instanciar la clase periodo model
$objPeriodoAcademico = new PeriodoAcademicoModel();
$objUsuario = new UsuarioModel();
$objSesion = new SessionModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "listar_tabla") {
    //repuesta
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla = $_POST['busqueda_tabla'];

        $busqueda_filtro = $objPeriodoAcademico->buscarPeriodoAcademico_tabla_filtro($busqueda_tabla);
        $arr_Periodos = $objPeriodoAcademico->buscarPeriodoAcademico_tabla($pagina, $cantidad_mostrar, $busqueda_tabla);
        if (!empty($arr_Periodos)) {
            // recorremos el array para agregar las opciones
            for ($i = 0; $i < count($arr_Periodos); $i++) {
                $id_director = $arr_Periodos[$i]->director;
                $arr_Usuario = $objUsuario->buscarUsuarioById($id_director);
                $arr_Periodos[$i]->nombre_director = $arr_Usuario->apellidos_nombres;
                $id_periodo = $arr_Periodos[$i]->id;

                $opciones = '<button class="btn btn-success" data-toggle="modal" data-target=".modal_editar' . $arr_Periodos[$i]->id . '"><i class="fa fa-edit"></i></button>';
                $arr_Periodos[$i]->options = $opciones;
            }
            $arr_Director = $objUsuario->buscarUsuarioDirector_All();
            $content_directores = [];
            for ($j = 0; $j < count($arr_Director); $j++) {
                $content_directores[$j] = (object) [];
                $content_directores[$j]->id = $arr_Director[$j]->id;
                $content_directores[$j]->dni = $arr_Director[$j]->dni;
                $content_directores[$j]->apellidos_nombres = $arr_Director[$j]->apellidos_nombres;
                $content_directores[$j]->estado = $arr_Director[$j]->estado;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['directores'] = $content_directores;

            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_Periodos;
        }
    }

    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar") {
    $arr_Respuesta = array('status' => false, 'contenido' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {


        //print_r($_POST);
        //repuesta
        $arr_Periodos = $objPeriodoAcademico->buscarPeriodoAcademico();
        if (!empty($arr_Periodos)) {
            // recorremos el array para agregar las opciones
            for ($i = 0; $i < count($arr_Periodos); $i++) {
                $id_director = $arr_Periodos[$i]->director;
                $arr_Usuario = $objUsuario->buscarUsuarioById($id_director);
                $arr_Periodos[$i]->nombre_director = $arr_Usuario->apellidos_nombres;
                $id_periodo = $arr_Periodos[$i]->id;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_Periodos;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "registrar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $anio = $_POST['anio'];
        $semestre = $_POST['semestre'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $director = $_POST['director'];
        $fecha_actas = $_POST['fecha_actas'];

        $periodo = $anio . '-' . $semestre;

        if ($anio == "" || $semestre == "" || $fecha_inicio == "" || $fecha_fin == "" || $director == "" || $fecha_actas == "") {
            //repuesta
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $id_periodo = $objPeriodoAcademico->registrarProductoeriodoAcademico($periodo, $fecha_inicio, $fecha_fin, $director, $fecha_actas);
            if ($id_periodo > 0) {
                $arr_periodo = $objPeriodoAcademico->buscarPeriodoAcadById($id_periodo);
                $id_director = $arr_periodo->director;
                $arr_Usuario = $objUsuario->buscarUsuarioById($id_director);
                $arr_periodo->nombre_director = $arr_Usuario->apellidos_nombres;

                $opciones = '<button class="btn btn-success" data-toggle="modal" data-target=".modal_editar' . $arr_periodo->id . '"><i class="fa fa-edit"></i></button>';
                $arr_periodo->options = $opciones;
                $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso', 'contenido' => $arr_periodo);
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar producto');
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "actualizar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $id = $_POST['id'];
        $periodo = $_POST['periodo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $director = $_POST['director'];
        $fecha_actas = $_POST['fecha_actas'];
        if ($id == "" || $periodo == "" || $fecha_inicio == "" || $fecha_fin == "" || $director == "" || $fecha_actas == "") {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $arr_periodo = $objPeriodoAcademico->actualizarPeriodo($id, $periodo, $fecha_inicio, $fecha_fin, $director, $fecha_actas);
            if ($arr_periodo) {
                $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar producto');
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
