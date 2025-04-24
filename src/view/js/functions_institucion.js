function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_instituciones();
}
async function datos_form() {
    try {
        mostrarPopupCarga();
        // capturamos datos del formulario html
        const datos = new FormData();
        datos.append('sesion', session_session);
        datos.append('token', token_token);
        datos.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Institucion.php?tipo=datos_registro', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            listar_usuarios(json.contenido);
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        }
        //console.log(json);
    } catch (e) {
        console.log("Oops, ocurrio un error " + e);
    } finally {
        ocultarPopupCarga();
    }
}
function listar_usuarios(contenido, elemento = 'beneficiario', usuario = 0) {
    try {
        let contenido_select = '<option value="">Seleccione</option>';
        if (Array.isArray(contenido)) {
            contenido.forEach(usuario => {
                contenido_select += '<option value="' + usuario.id + '">' + usuario.nombre + '</option>';
            });
            document.getElementById(elemento).innerHTML = contenido_select;
        }

    } catch (error) {
        console.log("ocurrio un error al listar sedes " + error);
    }

}
async function listar_instituciones() {
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_codigo = document.getElementById('busqueda_tabla_codigo').value;
        let busqueda_tabla_ruc = document.getElementById('busqueda_tabla_ruc').value;
        let busqueda_tabla_insti = document.getElementById('busqueda_tabla_insti').value;
        // asignamos valores para guardar
        document.getElementById('filtro_codigo').value = busqueda_tabla_codigo;
        document.getElementById('filtro_ruc').value = busqueda_tabla_ruc;
        document.getElementById('filtro_insti').value = busqueda_tabla_insti;

        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_codigo', busqueda_tabla_codigo);
        formData.append('busqueda_tabla_ruc', busqueda_tabla_ruc);
        formData.append('busqueda_tabla_insti', busqueda_tabla_insti);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Institucion.php?tipo=listar_instituciones', {
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
                            <th>Código Modular</th>
                            <th>Ruc</th>
                            <th>Institución</th>
                            <th>Beneficiario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
        document.querySelector('#modals_editar').innerHTML = ``;
        if (json.status) {
            let datos = json.contenido;
            datos.forEach(item => {
                generarfilastabla(item, json.usuarios);
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
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar categorias" + e);
    } finally {
        ocultarPopupCarga();
    }
}
function generarfilastabla(item, usuarios) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    lista_usuarios = `<option value="">Seleccione</option>`;
    nombre_usuario= '';
    usuarios.forEach(usuario => {
        usu_selected = "";
        if (usuario.id == item.beneficiario) {
            usu_selected = "selected";
            nombre_usuario = usuario.nombre;
        }
        lista_usuarios += `<option value="${usuario.id}" ${usu_selected}>${usuario.nombre}</option>`;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";
    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.cod_modular}</td>
                            <td>${item.ruc}</td>
                            <td>${item.nombre}</td>
                            <td>${nombre_usuario}</td>
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
                                                        <label for="beneficiario${item.id}" class="col-3 col-form-label">Beneficiario:</label>
                                                        <div class="col-9">
                                                            <select class="form-control" name="beneficiario" id="beneficiario${item.id}">${lista_usuarios}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="cod_modular${item.id}" class="col-3 col-form-label">Código Modular</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="cod_modular${item.id}" name="cod_modular" value="${item.cod_modular}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="ruc${item.id}" class="col-3 col-form-label">Ruc</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="ruc${item.id}" name="ruc"  value="${item.ruc}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row mb-2">
                                                        <label for="nombre${item.id}" class="col-3 col-form-label">Institución</label>
                                                        <div class="col-9">
                                                            <input type="email" class="form-control" id="nombre${item.id}" name="nombre"  value="${item.nombre}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0 justify-content-end row text-center">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarInstitucion(${item.id})">Actualizar</button>
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
async function registrar_institucion() {
    let beneficiario = document.getElementById('beneficiario').value;
    let cod_modular = document.getElementById('cod_modular').value;
    let ruc = document.querySelector('#ruc').value;
    let nombre = document.querySelector('#nombre').value;
    if (cod_modular == "" || ruc == "" || nombre == "" || beneficiario == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/Institucion.php?tipo=registrar', {
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
async function actualizarInstitucion(id) {
    let beneficiario = document.getElementById('beneficiario' + id).value;
    let cod_modular = document.getElementById('cod_modular' + id).value;
    let ruc = document.querySelector('#ruc' + id).value;
    let nombre = document.querySelector('#nombre' + id).value;
    if (cod_modular == "" || ruc == "" || nombre == "" || beneficiario == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/Institucion.php?tipo=actualizar', {
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