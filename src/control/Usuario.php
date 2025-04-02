<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/admin-sedeModel.php');
require_once('../model/admin-programaEstudioModel.php');
require_once('../model/admin-rolesModel.php');
require_once('../model/admin-sistemasIntegradosModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objUsuario = new UsuarioModel();
$objSede = new SedeModel();
$objProgramaEstudio = new ProgramaEstudioModel();
$objRoles = new RolModel();
$objSistemas = new SistemasIntegradosModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "listar_director") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //repuesta
        $arr_Usuario = $objUsuario->buscarUsuarioDirector_All();
        $arr_contenido = [];
        if (!empty($arr_Usuario)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Usuario); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Usuario[$i]->id;
                $arr_contenido[$i]->dni = $arr_Usuario[$i]->dni;
                $arr_contenido[$i]->apellidos_nombres = $arr_Usuario[$i]->apellidos_nombres;
                $arr_contenido[$i]->estado = $arr_Usuario[$i]->estado;
                $opciones = '';
                $arr_Usuario[$i]->options = $opciones;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "datos_registro") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //repuesta
        $arr_Sedes = $objSede->buscarSedes();
        $arr_Respuesta['sedes'] = $arr_Sedes;
        $arr_Pes = $objProgramaEstudio->buscarProgramaEstudios();
        $arr_Respuesta['programas'] = $arr_Pes;
        $arr_Roles = $objRoles->buscarRoles();
        $arr_Respuesta['roles'] = $arr_Roles;
        $arr_Sistemas = $objSistemas->buscarSistemas();
        $arr_Respuesta['sistemas'] = $arr_Sistemas;
        $arr_Respuesta['status'] = true;
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_docentes_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_dni = $_POST['busqueda_tabla_dni'];
        $busqueda_tabla_nomap = $_POST['busqueda_tabla_nomap'];
        $busqueda_tabla_pe = $_POST['busqueda_tabla_pe'];
        $busqueda_tabla_estado = $_POST['busqueda_tabla_estado'];
        $busqueda_tabla_sede = $_POST['busqueda_tabla_sede'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objUsuario->buscarUsuarioDocentesOrderByApellidosNombres_tabla_filtro($busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_pe, $busqueda_tabla_estado, $busqueda_tabla_sede);
        $arr_Usuario = $objUsuario->buscarUsuarioDocentesOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_pe, $busqueda_tabla_estado, $busqueda_tabla_sede);
        $arr_contenido = [];
        if (!empty($arr_Usuario)) {
            $arr_Sedes = $objSede->buscarSedes();
            $arr_Respuesta['sedes'] = $arr_Sedes;
            $arr_Pes = $objProgramaEstudio->buscarProgramaEstudios();
            $arr_Respuesta['programas'] = $arr_Pes;
            $arr_Roles = $objRoles->buscarRoles();
            $arr_Respuesta['roles'] = $arr_Roles;
            $arr_Sistemas = $objSistemas->buscarSistemas();
            $arr_Respuesta['sistemas'] = $arr_Sistemas;
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Usuario); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Usuario[$i]->id;
                $arr_contenido[$i]->dni = $arr_Usuario[$i]->dni;
                $arr_contenido[$i]->apellidos_nombres = $arr_Usuario[$i]->apellidos_nombres;
                $arr_contenido[$i]->genero = $arr_Usuario[$i]->genero;
                $arr_contenido[$i]->fecha_nac = $arr_Usuario[$i]->fecha_nac;
                $arr_contenido[$i]->direccion = $arr_Usuario[$i]->direccion;
                $arr_contenido[$i]->correo = $arr_Usuario[$i]->correo;
                $arr_contenido[$i]->telefono = $arr_Usuario[$i]->telefono;
                $arr_contenido[$i]->discapacidad = $arr_Usuario[$i]->discapacidad;
                $arr_contenido[$i]->id_sede = $arr_Usuario[$i]->id_sede;
                $arr_contenido[$i]->id_programa_estudios = $arr_Usuario[$i]->id_programa_estudios;
                $arr_contenido[$i]->id_rol = $arr_Usuario[$i]->id_rol;
                $arr_contenido[$i]->estado = $arr_Usuario[$i]->estado;

                $id_sede = $arr_Usuario[$i]->id_sede;
                $arr_Sede = $objSede->buscarSedeById($id_sede);
                $arr_contenido[$i]->sede = $arr_Sede->nombre;

                $id_pe = $arr_Usuario[$i]->id_programa_estudios;
                $arr_Pe = $objProgramaEstudio->buscarProgramaEstudioById($id_pe);
                $arr_contenido[$i]->programa_estudios = $arr_Pe->nombre;

                $id_rol = $arr_Usuario[$i]->id_rol;
                $arr_Rol = $objRoles->buscarRolById($id_rol);
                $arr_contenido[$i]->rol = $arr_Rol->nombre;


                $arr_contenido[$i]->permisos = [];
                for ($j = 0; $j < count($arr_Sistemas); $j++) {
                    $arr_Permisos = $objUsuario->buscarPermisoUsuarioByUsuarioSistema($arr_Usuario[$i]->id, $arr_Sistemas[$j]->id);
                    if (!empty($arr_Permisos)) {
                        $arr_contenido[$i]->permisos[$arr_Sistemas[$j]->id] = $arr_Permisos;
                    }
                }
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Usuario[$i]->id . '"><i class="fa fa-edit"></i></button>
                                <button type="button" title="Persimos" class="btn btn-light waves-effect waves-light" data-toggle="modal" data-target=".modal_permisos' . $arr_Usuario[$i]->id . '"><i class="fa fa-folder-open"></i></button>
                                <button class="btn btn-info" title="Resetear Contraseña" onclick="reset_password(' . $arr_Usuario[$i]->id . ')"><i class="fa fa-key"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_docentes_ordenados") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $arr_Usuario = $objUsuario->buscarUsuarioDocentesOrderByApellidosNombres();
        $arr_contenido = [];
        if (!empty($arr_Usuario)) {

            $arr_Sedes = $objSede->buscarSedes();
            $arr_Respuesta['sedes'] = $arr_Sedes;
            $arr_Pes = $objProgramaEstudio->buscarProgramaEstudios();
            $arr_Respuesta['programas'] = $arr_Pes;
            $arr_Roles = $objRoles->buscarRoles();
            $arr_Respuesta['roles'] = $arr_Roles;
            $arr_Sistemas = $objSistemas->buscarSistemas();
            $arr_Respuesta['sistemas'] = $arr_Sistemas;
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Usuario); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Usuario[$i]->id;
                $arr_contenido[$i]->dni = $arr_Usuario[$i]->dni;
                $arr_contenido[$i]->apellidos_nombres = $arr_Usuario[$i]->apellidos_nombres;
                $arr_contenido[$i]->genero = $arr_Usuario[$i]->genero;
                $arr_contenido[$i]->fecha_nac = $arr_Usuario[$i]->fecha_nac;
                $arr_contenido[$i]->direccion = $arr_Usuario[$i]->direccion;
                $arr_contenido[$i]->correo = $arr_Usuario[$i]->correo;
                $arr_contenido[$i]->telefono = $arr_Usuario[$i]->telefono;
                $arr_contenido[$i]->discapacidad = $arr_Usuario[$i]->discapacidad;
                $arr_contenido[$i]->id_sede = $arr_Usuario[$i]->id_sede;
                $arr_contenido[$i]->id_programa_estudios = $arr_Usuario[$i]->id_programa_estudios;
                $arr_contenido[$i]->id_rol = $arr_Usuario[$i]->id_rol;
                $arr_contenido[$i]->estado = $arr_Usuario[$i]->estado;
            }
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
            $dni = $_POST['dni'];
            $apellidos_nombres = $_POST['apellidos_nombres'];
            $genero = $_POST['genero'];
            $fecha_nac = $_POST['fecha_nac'];
            $direccion = $_POST['direccion'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $discapacidad = $_POST['discapacidad'];
            $id_sede = $_POST['id_sede'];
            $id_rol = $_POST['id_rol'];
            $id_programa_estudios = $_POST['id_programa_estudios'];
            $id_periodo_actual = $_SESSION['sesion_sigi_periodo'];

            if ($dni == "" || $apellidos_nombres == "" || $genero == "" || $fecha_nac == "" || $direccion == "" || $correo == "" || $telefono == "" || $discapacidad == "" || $id_sede == "" || $id_rol == "" || $id_programa_estudios == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Usuario = $objUsuario->buscarUsuarioByDni($dni);
                if ($arr_Usuario) {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Usuario ya se encuentra registrado');
                } else {
                    $id_usuario = $objUsuario->registrarUsuario($dni, $apellidos_nombres, $genero, $fecha_nac, $direccion, $correo, $telefono, $discapacidad, $id_sede, $id_rol, $id_programa_estudios, $id_periodo_actual);
                    if ($id_usuario > 0) {
                        // array con los id de los sistemas al que tendra el acceso con su rol registrado
                        // caso de administrador y director
                        $array_sistemas_docente = [];
                        if ($id_rol == 1 || $id_rol == 2) {
                            $array_sistemas_permisos = [1, 2, 3, 4, 5, 6, 7];
                        }
                        // docentes 
                        if ($id_rol >= 3 && $id_rol <= 6) {
                            $array_sistemas_permisos = [2, 3, 4, 7];
                        }
                        //estudiantes
                        if ($id_rol == 7) {
                            $array_sistemas_permisos = [2, 3, 4];
                        }
                        for ($i = 0; $i < count($array_sistemas_permisos); $i++) {
                            $id_sistema = $array_sistemas_permisos[$i];
                            $registrar_permiso = $objUsuario->registrar_permiso($id_usuario, $id_sistema, $id_rol);
                        }

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
            $dni = $_POST['dni'];
            $apellidos_nombres = $_POST['apellidos_nombres'];
            $genero = $_POST['genero'];
            $fecha_nac = $_POST['fecha_nac'];
            $direccion = $_POST['direccion'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $discapacidad = $_POST['discapacidad'];
            $id_sede = $_POST['id_sede'];
            $id_rol = $_POST['id_rol'];
            $id_programa_estudios = $_POST['id_programa_estudios'];
            $estado = $_POST['estado'];

            if ($id == "" || $dni == "" || $apellidos_nombres == "" || $genero == "" || $fecha_nac == "" || $direccion == "" || $correo == "" || $telefono == "" || $discapacidad == "" || $id_sede == "" || $id_rol == "" || $id_programa_estudios == "" || $estado == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Usuario = $objUsuario->buscarUsuarioByDni($dni);
                if ($arr_Usuario) {
                    if ($arr_Usuario->id == $id) {
                        $consulta = $objUsuario->actualizarUsuario($id, $dni, $apellidos_nombres, $genero, $fecha_nac, $direccion, $correo, $telefono, $discapacidad, $id_sede, $id_rol, $id_programa_estudios, $estado);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'dni ya esta registrado');
                    }
                } else {
                    $consulta = $objUsuario->actualizarUsuario($id, $dni, $apellidos_nombres, $genero, $fecha_nac, $direccion, $correo, $telefono, $discapacidad, $id_sede, $id_rol, $id_programa_estudios, $estado);
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
if ($tipo == "reiniciar_password") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $id_usuario = $_POST['id'];
        $password = $objAdmin->generar_llave(10);
        $pass_secure = password_hash($password, PASSWORD_DEFAULT);
        $actualizar = $objUsuario->actualizarPassword($id_usuario, $pass_secure);
        if ($actualizar) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Contraseña actualizado correctamente a: ' . $password);
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Hubo un problema al actualizar la contraseña, intente nuevamente');
        }
    }
    echo json_encode($arr_Respuesta);
}

// ----------------------------------------------  INICIO PERMISOS ------------------------------------------------
if ($tipo == "actualizar_permisos") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $id_usuario = $_POST['data'];
        //repuesta
        $arr_sistemas = $objSistemas->buscarSistemas();
        for ($i = 0; $i < count($arr_sistemas); $i++) {
            $id_sistema = $arr_sistemas[$i]->id;
            $sistema = $_POST[$arr_sistemas[$i]->codigo . $id_usuario];
            $rol = $_POST['rol' . $arr_sistemas[$i]->codigo . $id_usuario];
            if ($sistema) {
                // en caso de que el sistema este habilitado ACTUALIZAR O REGISTRAR
                $buscar_permiso = $objUsuario->buscarPermisoUsuarioByUsuarioSistema($id_usuario, $id_sistema);
                if ($buscar_permiso) {
                    $id_permiso = $buscar_permiso->id;
                    $actualizar_permiso = $objUsuario->actualizarPermisoUsuarioByUsuarioSistemaRol($id_permiso, $rol);
                } else {
                    if ($rol == 0) {
                        $rol = 5;
                    }
                    $registrar_permiso = $objUsuario->registrar_permiso($id_usuario, $id_sistema, $rol);
                }
            } else {
                // en caso el sistema no este habilitado ELIMINAR
                $buscar_permiso = $objUsuario->buscarPermisoUsuarioByUsuarioSistema($id_usuario, $id_sistema);
                if ($buscar_permiso) {
                    $id_permiso = $buscar_permiso->id;
                    $actualizar_permiso = $objUsuario->eliminarPermisoUsuarioByUsuarioSistemaRol($id_permiso);
                }
            }
        }
        $arr_Respuesta = array('status' => true, 'mensaje' => 'Permisos Actualizados correctamente');
    }
    echo json_encode($arr_Respuesta);
}


// ---------------------------------------------- FIN PERMISOS ---------------------------------------------------