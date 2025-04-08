<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-bienModel.php');
require_once('../model/admin-ambienteModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objBien = new BienModel();
$objAmbiente = new AmbienteModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "listar_bienes_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $ies = $_POST['ies'];
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_codigo = $_POST['busqueda_tabla_codigo'];
        $busqueda_tabla_ambiente = $_POST['busqueda_tabla_ambiente'];
        $busqueda_tabla_denominacion = $_POST['busqueda_tabla_denominacion'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objBien->buscarBienesOrderByDenominacion_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_ambiente, $busqueda_tabla_denominacion, $ies);
        $arr_Bienes = $objBien->buscarBienesOrderByDenominacion_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo, $busqueda_tabla_ambiente, $busqueda_tabla_denominacion, $ies);
        $arr_contenido = [];
        $arr_Ambientes = $objAmbiente->buscarAmbienteByInstitucion($ies);
        $arr_Respuesta['ambientes'] = $arr_Ambientes;
        if (!empty($arr_Bienes)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Bienes); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Bienes[$i]->id;
                $arr_contenido[$i]->id_ambiente = $arr_Bienes[$i]->id_ambiente;
                $arr_contenido[$i]->cod_patrimonial  = $arr_Bienes[$i]->cod_patrimonial;
                $arr_contenido[$i]->denominacion = $arr_Bienes[$i]->denominacion;
                $arr_contenido[$i]->marca = $arr_Bienes[$i]->marca;
                $arr_contenido[$i]->modelo = $arr_Bienes[$i]->modelo;
                $arr_contenido[$i]->tipo = $arr_Bienes[$i]->tipo;
                $arr_contenido[$i]->color = $arr_Bienes[$i]->color;
                $arr_contenido[$i]->serie     = $arr_Bienes[$i]->serie;
                $arr_contenido[$i]->dimensiones = $arr_Bienes[$i]->dimensiones;
                $arr_contenido[$i]->valor = $arr_Bienes[$i]->valor;
                $arr_contenido[$i]->situacion = $arr_Bienes[$i]->situacion;
                $arr_contenido[$i]->estado_conservacion = $arr_Bienes[$i]->estado_conservacion;
                $arr_contenido[$i]->observaciones = $arr_Bienes[$i]->observaciones;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Bienes[$i]->id . '"><i class="fa fa-edit"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "registrar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $ambiente = $_POST['ambiente'];
            $cod_patrimonial = $_POST['cod_patrimonial'];
            $denominacion = $_POST['denominacion'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $tipo = $_POST['tipo'];
            $color = $_POST['color'];
            $serie = $_POST['serie'];
            $dimensiones = $_POST['dimensiones'];
            $valor = $_POST['valor'];
            $situacion = $_POST['situacion'];
            $estado_conservacion = $_POST['estado_conservacion'];
            $observaciones = $_POST['observaciones'];
            if ($ambiente == "" || $cod_patrimonial == "" || $denominacion == "" || $marca == "" || $modelo == "" || $tipo == "" || $color == "" || $serie == "" || $dimensiones == "" || $valor == "" || $situacion == "" || $estado_conservacion == "" || $observaciones == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_usuario = $objSesion->buscarSesionLoginById($id_sesion);
                $id_usuario = $arr_usuario->id_usuario;
                $arr_bien = $objBien->buscarBienByCodigoPatrimonial($cod_patrimonial);
                if ($arr_bien) {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Bien ya se encuentra registrado');
                } else {
                    $id_bien = $objBien->registrarBien($ambiente, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones, $id_usuario);
                    if ($id_bien > 0) {
                        // array con los id de los sistemas al que tendra el acceso con su rol registrado
                        // caso de administrador y director
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar producto');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "actualizar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $id = $_POST['data'];
            $ambiente = $_POST['ambiente'];
            $cod_patrimonial = $_POST['cod_patrimonial'];
            $denominacion = $_POST['denominacion'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $tipo = $_POST['tipo'];
            $color = $_POST['color'];
            $serie = $_POST['serie'];
            $dimensiones = $_POST['dimensiones'];
            $valor = $_POST['valor'];
            $situacion = $_POST['situacion'];
            $estado_conservacion = $_POST['estado_conservacion'];
            $observaciones = $_POST['observaciones'];
            if ($ambiente == "" || $cod_patrimonial == "" || $denominacion == "" || $marca == "" || $modelo == "" || $tipo == "" || $color == "" || $serie == "" || $dimensiones == "" || $valor == "" || $situacion == "" || $estado_conservacion == "" || $observaciones == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Bien= $objBien->buscarBienByCodigoPatrimonial($cod_patrimonial);
                if ($arr_Bien) {
                    if ($arr_Bien->id == $id) {
                        $consulta = $objBien->actualizarBien($id, $ambiente, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'codigo patrimonial ya esta registrado');
                    }
                } else {
                    $consulta = $objBien->actualizarBien($id, $ambiente, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones);
                    if ($consulta) {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "datos_registro") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //repuesta
        $arr_Instirucion = $objInstitucion->buscarInstitucionOrdenado();
        $arr_Respuesta['instituciones'] = $arr_Instirucion;
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['msg'] = "Datos encontrados";
    }
    echo json_encode($arr_Respuesta);
}
