function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_docentesOrdenados();
}
async function listar_docentesOrdenados() {
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_dni = document.getElementById('busqueda_tabla_dni').value;
        let busqueda_tabla_nomap = document.getElementById('busqueda_tabla_nomap').value;
        let busqueda_tabla_pe = document.getElementById('busqueda_tabla_pe').value;
        let busqueda_tabla_estado = document.getElementById('busqueda_tabla_estado').value;
        let busqueda_tabla_sede = document.getElementById('busqueda_tabla_sede').value;
        // asignamos valores para guardar
        document.getElementById('filtro_dni').value = busqueda_tabla_dni;
        document.getElementById('filtro_nomap').value = busqueda_tabla_nomap;
        document.getElementById('pe_actual_filtro').value = busqueda_tabla_pe;
        document.getElementById('filtro_estado').value = busqueda_tabla_estado;
        document.getElementById('sede_actual_filtro').value = busqueda_tabla_sede;

        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_dni', busqueda_tabla_dni);
        formData.append('busqueda_tabla_nomap', busqueda_tabla_nomap);
        formData.append('busqueda_tabla_pe', busqueda_tabla_pe);
        formData.append('busqueda_tabla_estado', busqueda_tabla_estado);
        formData.append('busqueda_tabla_sede', busqueda_tabla_sede);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=listar_docentes_ordenados_tabla', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        let json = await respuesta.json();
        document.getElementById('tablas').innerHTML = `<table id="" class="table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>DNI</th>
                            <th>Apellidos y Nombres</th>
                            <th>Género</th>
                            <th>Sede</th>
                            <th>Programa de Estudio</th>
                            <th>Cargo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
        document.querySelector('#modals_editar').innerHTML = ``;
        document.querySelector('#modals_permisos').innerHTML = ``;
        if (json.status) {
            let datos = json.contenido;
            datos.forEach(item => {
                generarfilastabla(item, json.sedes, json.programas, json.sistemas, json.roles);
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            document.getElementById('tablas').innerHTML = `no se encontraron resultados`;
        }
        let paginacion = generar_paginacion(json.total, cantidad_mostrar);
        let texto_paginacion = generar_texto_paginacion(json.total, cantidad_mostrar);
        document.getElementById('texto_paginacion_tabla').innerHTML = texto_paginacion;
        document.getElementById('lista_paginacion_tabla').innerHTML = paginacion;
        //cargar datos a filtro
        cargar_programa_estudio_filtro(json.programas);
        cargar_sede_filtro(json.sedes);
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar categorias" + e);
    } finally {
        ocultarPopupCarga();
    }
}
async function datos_form() {
    try {
        mostrarPopupCarga();
        const formData = new FormData();
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=datos_registro', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();
        if (json.status) {
            listar_sedes(json.sedes);
            listar_programa_estudio(json.programas);
            listar_roles(json.roles);
        } else {
            alerta_sesion();
        }
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar datos" + e);
    } finally {
        ocultarPopupCarga();
    }
}
function generarfilastabla(item, sedes, programas, sistemas, roles) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";

    activo_si = "";
    activo_no = "";
    if (item.estado == 1) {
        estado = "ACTIVO";
        activo_si = "selected";
    } else {
        estado = "INACTIVO";
        activo_no = "selected";
    }
    discapacidad_si = "";
    discapacidad_no = "";
    if (item.discapacidad == "SI") {
        discapacidad_si = "selected";
    } else {
        discapacidad_no = "selected";
    }

    genero_m = "";
    genero_f = "";
    if (item.genero == "M") {
        genero_m = "selected";
    } else {
        genero_f = "selected";
    }


    contenido_sistemas = ``;
    //console.log(sistemas);

    sistemas.forEach(element => {
        valor_si = "";
        valor_no = "";
        id_rol = 0;
        if (item.permisos[element.id]) {
            valor_si = "selected";
            id_rol = item.permisos[element.id].id_rol;
        } else {
            valor_no = "selected";
        }
        lista_roles_permiso = `<option value="0">Seleccione</option>`;
        roles.forEach(roles => {
            rol_selected = "";
            if (roles.id == id_rol) {
                rol_selected = "selected";
            }
            lista_roles_permiso += `<option value="${roles.id}" ${rol_selected}>${roles.nombre}</option>`;
        })
        lista_sedes = `<option value="">Seleccione</option>`;
        sedes.forEach(sede => {
            sede_selected = "";
            if (sede.id == item.id_sede) {
                sede_selected = "selected";
            }
            lista_sedes += `<option value="${sede.id}" ${sede_selected}>${sede.nombre}</option>`;
        })
        lista_pe = `<option value="">Seleccione</option>`;
        programas.forEach(programa => {
            pe_selected = "";
            if (programa.id == item.id_programa_estudios) {
                pe_selected = "selected";
            }
            lista_pe += `<option value="${programa.id}" ${pe_selected}>${programa.nombre}</option>`;
        })

        lista_roles = `<option value="">Seleccione</option>`;
        roles.forEach(rol => {
            rol_selected = "";
            if (rol.id == item.id_rol) {
                rol_selected = "selected";
            }
            lista_roles += `<option value="${rol.id}" ${rol_selected}>${rol.nombre}</option>`;
        })


        contenido_sistemas += `<div class="form-group row mb-2">
                                                        <div class="form-group row mb-2 col-5">
                                                            <label for="${element.codigo}${item.id}" class="col-8 col-form-label">${element.nombre}</label>
                                                            <div class="col-4">
                                                                <select name="${element.codigo}${item.id}" id="${element.codigo}${item.id}" class="form-control">
                                                                    <option value="1" `+ valor_si + `>SI</option>
                                                                    <option value="0" `+ valor_no + `>NO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-2 col-5">
                                                            <label for="rol${element.codigo}${item.id}" class="col-3 col-form-label">ROL</label>
                                                            <div class="col-9">
                                                                <select name="rol${element.codigo}${item.id}" id="rol${element.codigo}${item.id}" class="form-control">
                                                                ${lista_roles_permiso}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>`;
    });

    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.dni}</td>
                            <td>${item.apellidos_nombres}</td>
                            <td>${item.genero}</td>
                            <td>${item.sede}</td>
                            <td>${item.programa_estudios}</td>
                            <td>${item.rol}</td>
                            <td>${estado}</td>
                            <td>${item.options}</td>
                `;
    document.querySelector('#modals_editar').innerHTML += `<div class="modal fade modal_editar${item.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title h4 " id="myLargeModalLabel">Actualizar datos de docente</h5>
                                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <form class="form-horizontal" id="frmActualizar${item.id}">
                                                    <div class="form-group row mb-2">
                                                        <label for="dni${item.id}" class="col-3 col-form-label">DNI</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="dni${item.id}" name="dni" value="${item.dni}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="apellidos_nombres${item.id}" class="col-3 col-form-label">Apellidos y Nombres</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="apellidos_nombres${item.id}" name="apellidos_nombres"  value="${item.apellidos_nombres}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="genero${item.id}" class="col-3 col-form-label">Género</label>
                                                        <div class="col-9">
                                                            <select name="genero" id="genero${item.id}" class="form-control">
                                                                <option value=""></option>
                                                                <option value="M" `+ genero_m + `>M</option>
                                                                <option value="F" `+ genero_f + `>F</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="fecha_nac${item.id}" class="col-3 col-form-label">Fecha de Nacimiento</label>
                                                        <div class="col-9">
                                                            <input type="date" class="form-control" id="fecha_nac${item.id}" name="fecha_nac" value="${item.fecha_nac}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="direccion${item.id}" class="col-3 col-form-label">Dirección </label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="direccion${item.id}" name="direccion"  value="${item.direccion}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="correo${item.id}" class="col-3 col-form-label">Correo Electrónico</label>
                                                        <div class="col-9">
                                                            <input type="email" class="form-control" id="correo${item.id}" name="correo"  value="${item.correo}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="telefono${item.id}" class="col-3 col-form-label">Teléfono </label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="telefono${item.id}" name="telefono"  value="${item.telefono}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="discapacidad${item.id}" class="col-3 col-form-label">Discapacidad </label>
                                                        <div class="col-9">
                                                            <select name="discapacidad" id="discapacidad${item.id}" class="form-control" value="${item.discapacidad}" >
                                                                <option value=""></option>
                                                                <option value="NO" `+ discapacidad_no + `>NO</option>
                                                                <option value="SI" `+ discapacidad_si + `>SI</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="id_sede${item.id}" class="col-3 col-form-label">Sede </label>
                                                        <div class="col-9">
                                                            <select name="id_sede" id="id_sede${item.id}" class="form-control">
                                                            ${lista_sedes}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="id_rol${item.id}" class="col-3 col-form-label">Cargo </label>
                                                        <div class="col-9">
                                                            <select name="id_rol" id="id_rol${item.id}" class="form-control">
                                                             ${lista_roles}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="id_programa_estudios${item.id}" class="col-3 col-form-label">Programa de Estudio </label>
                                                        <div class="col-9">
                                                            <select name="id_programa_estudios" id="id_programa_estudios${item.id}" class="form-control">
                                                            ${lista_pe}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="estado${item.id}" class="col-3 col-form-label">ESTADO </label>
                                                        <div class="col-9">
                                                            <select name="estado" id="estado${item.id}" class="form-control">
                                                                <option value=""></option>
                                                                <option value="1" `+ activo_si + `>ACTIVO</option>
                                                                <option value="0" `+ activo_no + `>INACTIVO</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0 justify-content-end row text-center">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarUsuario(${item.id})">Actualizar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
    document.querySelector('#modals_permisos').innerHTML += `<div class="modal fade modal_permisos${item.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title h4 " id="myLargeModalLabel">Permisos de Usuario</h5>
                                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <form class="form-horizontal" id="frm_permisos_${item.id}">
                                                    <div class="form-group row mb-2">
                                                        <label for="dni${item.id}" class="col-3 col-form-label">DNI</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="dni${item.id}" disabled value="${item.dni}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="apellidosnombres${item.id}" class="col-3 col-form-label">Apellidos y Nombres</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="apellidosnombres${item.id}" disabled value="${item.apellidos_nombres}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label class="col-3 col-form-label">Sistemas :</label>
                                                        <div class="col-9">
                                                        </div>
                                                    </div>
                                                    <div id="permisos${item.id}">
                                                    ${contenido_sistemas}
                                                    </div>
                                                    
                                                    
                                                    <br>
                                                    <div class="form-group mb-0 justify-content-end row text-center">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizar_permisos(${item.id});">Actualizar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
    document.querySelector('#contenido_tabla').appendChild(nueva_fila);

}

async function listar_sedes(datos) {
    try {
        let contenido_select = '<option value="">Seleccione</option>';
        if (Array.isArray(datos)) {
            datos.forEach(element => {
                let selected = "";
                contenido_select += '<option value="' + element.id + '" ' + selected + '>' + element.nombre + '</option>';
            });
            document.getElementById('id_sede').innerHTML = contenido_select;
        }
    } catch (error) {
        console.log("ocurrio un error al listar sedes " + error);
    }

}

async function listar_programa_estudio(datos) {
    let contenido_select = '<option value="">Seleccione</option>';
    if (Array.isArray(datos)) {
        datos.forEach(element => {
            let selected = "";
            contenido_select += '<option value="' + element.id + '" ' + selected + '>' + element.nombre + '</option>';
        });
        document.getElementById('id_programa_estudios').innerHTML = contenido_select;
    }
}

async function listar_roles(datos) {
    let contenido_select = '<option value="">Seleccione</option>';
    if (Array.isArray(datos)) {
        datos.forEach(element => {
            let selected = "";
            contenido_select += '<option value="' + element.id + '" ' + selected + '>' + element.nombre + '</option>';
        });
        document.getElementById('id_rol').innerHTML = contenido_select;
    }
}

async function registrar_docente() {
    let dni = document.getElementById('dni').value;
    let apellidos_nombres = document.querySelector('#apellidos_nombres').value;
    let genero = document.querySelector('#genero').value;
    let fecha_nac = document.querySelector('#fecha_nac').value;
    let direccion = document.querySelector('#direccion').value;
    let correo = document.querySelector('#correo').value;
    let telefono = document.querySelector('#telefono').value;
    let discapacidad = document.querySelector('#discapacidad').value;
    let id_sede = document.querySelector('#id_sede').value;
    let id_rol = document.querySelector('#id_rol').value;
    let id_programa_estudios = document.querySelector('#id_programa_estudios').value;
    if (dni == "" || apellidos_nombres == "" || genero == "" || fecha_nac == "" || direccion == "" || correo == "" || telefono == "" || discapacidad == "" || id_sede == "" || id_rol == "" || id_programa_estudios == "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos...',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: ''
        })
        return;
    }
    try {
        // capturamos datos del formulario html
        const datos = new FormData(frmRegistrar);
        datos.append('sesion', session_session);
        datos.append('token', token_token);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            document.getElementById("frmRegistrar").reset();
            Swal.fire({
                type: 'success',
                title: 'Registro',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });

        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        //console.log(json);
    } catch (e) {
        console.log("Oops, ocurrio un error " + e);
    }
}

async function actualizarUsuario(id) {
    let dni = document.getElementById('dni' + id).value;
    let apellidos_nombres = document.querySelector('#apellidos_nombres' + id).value;
    let genero = document.querySelector('#genero' + id).value;
    let fecha_nac = document.querySelector('#fecha_nac' + id).value;
    let direccion = document.querySelector('#direccion' + id).value;
    let correo = document.querySelector('#correo' + id).value;
    let telefono = document.querySelector('#telefono' + id).value;
    let discapacidad = document.querySelector('#discapacidad' + id).value;
    let id_sede = document.querySelector('#id_sede' + id).value;
    let id_rol = document.querySelector('#id_rol' + id).value;
    let id_programa_estudios = document.querySelector('#id_programa_estudios' + id).value;
    let estado = document.querySelector('#estado' + id).value;
    if (dni == "" || apellidos_nombres == "" || genero == "" || fecha_nac == "" || direccion == "" || correo == "" || telefono == "" || discapacidad == "" || id_sede == "" || id_rol == "" || id_programa_estudios == "" || estado == "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos...',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: '',
            timer: 1000
        })
        return;
    }

    const formulario = document.getElementById('frmActualizar' + id);
    const datos = new FormData(formulario);
    datos.append('data', id);
    datos.append('sesion', session_session);
    datos.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            $('.modal_editar' + id).modal('hide');
            Swal.fire({
                type: 'success',
                title: 'Actualizar',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        //console.log(json);
    } catch (e) {
        console.log("Error al actualizar periodo" + e);
    }
}
//-------------------------------------------------------- RESETEAR CONTRASEÑA -------------------------------------------------------------
function reset_password(id) {
    Swal.fire({
        title: "¿Estás seguro de generar nueva contraseña?",
        text: "Se generará un nueva contraseña para este usuario",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: 'Cancelar'
    }).then(function (result) {
        if (result.value) {
            reniciar_password(id);
        }
    });
}
async function reniciar_password(id) {

    // generamos el formulario
    const formData = new FormData();
    formData.append('id', id);
    formData.append('sesion', session_session);
    formData.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=reiniciar_password', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            Swal.fire({
                type: 'success',
                title: 'Actualizar',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                confirmButtonText: "Aceptar"
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        //console.log(json);
    } catch (e) {
        console.log("Error al actualizar periodo" + e);
    }


}
// ------------------------------------------------------ FUNCIONES DE PERMISOS----------------------------------------------------------------
async function actualizar_permisos(id) {
    const formulario = document.getElementById('frm_permisos_' + id);
    const datos = new FormData(formulario);
    datos.append('data', id);
    datos.append('sesion', session_session);
    datos.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=actualizar_permisos', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            $('.modal_permisos' + id).modal('hide');
            Swal.fire({
                type: 'success',
                title: 'Actualizar',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        //console.log(json);
    } catch (e) {
        console.log("Error al actualizar periodo" + e);
    }
}

// ----------------------------------------------------- FIN FUNCIONES PERMISOS--------------------------------------------------------