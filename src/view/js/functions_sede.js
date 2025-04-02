async function listar_sedes() {
    try {
        mostrarPopupCarga();
        const formData = new FormData();
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        let respuesta = await fetch(base_url_server + 'src/control/Sede.php?tipo=listar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            document.getElementById('tablas').innerHTML = `<table id="example" class="table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Codigo Modular</th>
                            <th>Nombre</th>
                            <th>Distrito</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
            datos.forEach(item => {
                generarfilastabla(item);
            });
        } else {
            alerta_sesion();
        }
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar sedes" + e);
    } finally {
        ocultarPopupCarga();
    }
}

function generarfilastabla(item) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla odd";


    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.cod_modular}</td>
                            <td>${item.nombre}</td>
                            <td>${item.distrito}</td>
                            <td>${item.direccion}</td>
                            <td>${item.telefono}</td>
                            <td>${item.nombre_responsable}</td>
                            <td>${item.options}</td>
                `;
    document.querySelector('#modals_editar').innerHTML += `<div class="modal fade modal_editar${item.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h4" id="myLargeModalLabel">Editar Sede</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="frmActualizar${item.id}">
                                        <div class="form-group row mb-2">
                                            <label for="codigoModular" class="col-3 col-form-label">Código Modular</label>
                                            <div class="col-9">
                                            <input type="hidden" id="id${item.id}" name="id" value="${item.id}">
                                                <input type="text" class="form-control" id="codigoModular${item.id}" name="codigoModular" value="${item.cod_modular}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="nombre${item.id}" class="col-3 col-form-label">Nombre</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nombre${item.id}" name="nombre" value="${item.nombre}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="departamento${item.id}" class="col-3 col-form-label">Departamento</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="departamento${item.id}" name="departamento" value="${item.departamento}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="provincia${item.id}" class="col-3 col-form-label">Provincia</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="provincia${item.id}" name="provincia" value="${item.provincia}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="distrito${item.id}" class="col-3 col-form-label">Distrito</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="distrito${item.id}" name="distrito" value="${item.distrito}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="direccion${item.id}" class="col-3 col-form-label">Dirección</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="direccion${item.id}" name="direccion" value="${item.direccion}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="telefono${item.id}" class="col-3 col-form-label">Teléfono</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="telefono${item.id}" name="telefono" value="${item.telefono}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="correo${item.id}" class="col-3 col-form-label">Correo Electrónico</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="correo${item.id}" name="correo" value="${item.correo}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="responsable${item.id}" class="col-3 col-form-label">Responsable</label>
                                            <div class="col-sm-9 mb-2 mb-sm-0">
                                                <select class="form-control form-control-user" id="responsable${item.id}" name="responsable" value="${item.responsable}"></select>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 justify-content-end row text-center">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                <button type="reset" class="btn btn-light waves-effect waves-light">Deshacer cambios</button>
                                                <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarSede(${item.id});">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>`;
    document.querySelector('#contenido_tabla').appendChild(nueva_fila);
    listar_director(item.id, item.responsable);
}

async function listar_director(id = "", id2 = 0) {
    try {
        const formData = new FormData();
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        let respuesta = await fetch(base_url_server + 'src/control/Usuario.php?tipo=listar_director', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="">Seleccione</option>';
            datos.forEach(element => {
                let selected = "";
                if (element.id == id2) {
                    selected = "selected";
                }
                contenido_select += '<option value="' + element.id + '" ' + selected + '>' + element.apellidos_nombres + '</option>';
            });
            document.getElementById('responsable' + id).innerHTML = contenido_select;
        } else {
            alerta_sesion();
        }
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar sedes" + e);
    }
}

async function registrar_sede() {
    let codigoModular = document.getElementById('codigoModular').value;
    let nombre = document.querySelector('#nombre').value;
    let departamento = document.querySelector('#departamento').value;
    let provincia = document.querySelector('#provincia').value;
    let distrito = document.querySelector('#distrito').value;
    let direccion = document.querySelector('#direccion').value;
    let telefono = document.querySelector('#telefono').value;
    let correo = document.querySelector('#correo').value;
    let responsable = document.querySelector('#responsable').value;
    if (codigoModular == "" || nombre == "" || departamento == "" || provincia == "" || distrito == "" || direccion == "" || telefono == "" || correo == "" || responsable == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/Sede.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            document.getElementById("frmRegistrar").reset();
            $('.bd-example-modal-new').modal('hide');

            generarfilastabla(json.contenido);
            Swal.fire({
                type: 'success',
                title: 'Registro',
                text: 'Registrado Correctamente',
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });


            /*
            document.getElementById("tablas").innerHTML = "";
            document.getElementById("modals_editar").innerHTML = "";
            listar_periodos();*/

        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Registro Fallido',
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

async function actualizarSede(id) {
    let codigoModular = document.querySelector('#codigoModular' + id).value;
    let nombre = document.querySelector('#nombre' + id).value;
    let departamento = document.querySelector('#departamento' + id).value;
    let provincia = document.querySelector('#provincia' + id).value;
    let distrito = document.querySelector('#distrito' + id).value;
    let direccion = document.querySelector('#direccion' + id).value;
    let telefono = document.querySelector('#telefono' + id).value;
    let correo = document.querySelector('#correo' + id).value;
    let responsable = document.querySelector('#responsable' + id).value;
    if (codigoModular == "" || nombre == "" || departamento == "" || provincia == "" || distrito == "" || direccion == "" || telefono == "" || correo == "" || responsable == "") {
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
    datos.append('sesion', session_session);
    datos.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Sede.php?tipo=actualizar', {
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
                text: 'Actualizado Correctamente',
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
                text: 'Falló al Actualizar',
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        console.log(json);
    } catch (e) {
        console.log("Error al actualizar sede" + e);
    }
}