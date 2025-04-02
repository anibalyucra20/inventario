function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_periodos();
}
async function listar_periodos() {
    try {
        mostrarPopupCarga();
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla = document.getElementById('busqueda_tabla').value;
        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla', busqueda_tabla);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/PeriodoAcademico.php?tipo=listar_tabla', {
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
                            <th>Periodo Académico</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Director</th>
                            <th>Fecha Actas</th>
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
                generarfilastabla(item, json.directores);
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
function generarfilastabla(item, directores) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";


    lista_director = `<option value="">Seleccione</option>`;
    directores.forEach(director => {
        director_selected = "";
        if (director.id == item.director) {
            director_selected = "selected";
        }
        lista_director += `<option value="${director.id}" ${director_selected}>${director.apellidos_nombres}</option>`;
    })

    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.nombre}</td>
                            <td>${item.fecha_inicio}</td>
                            <td>${item.fecha_fin}</td>
                            <td>${item.nombre_director}</td>
                            <td>${item.fecha_actas}</td>
                            <td>${item.options}</td>
                `;
    document.querySelector('#modals_editar').innerHTML += `<div class="modal fade modal_editar${item.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h4" id="myLargeModalLabel">Editar Periodo Academico</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="frmActualizar${item.id}">
                                        <div class="form-group row mb-2">
                                            <label for="periodo${item.id}" class="col-3 col-form-label">Periodo Académico</label>
                                            <div class="col-9">
                                                <input type="hidden" id="id${item.id}" name="id" value="${item.id}">
                                                <input type="text" class="form-control" id="periodo${item.id}" placeholder="" name="periodo" value="${item.nombre}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-3 col-form-label">Fecha de Inicio</label>
                                            <div class="col-9">
                                                <input type="date" class="form-control" id="fecha_inicio${item.id}" name="fecha_inicio" value="${item.fecha_inicio}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-3 col-form-label">Fecha de Finalización</label>
                                            <div class="col-9">
                                                <input type="date" class="form-control" id="fecha_fin${item.id}" name="fecha_fin" value="${item.fecha_fin}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-3 col-form-label">Director</label>
                                            <div class="col-sm-9 mb-2 mb-sm-0">
                                                <select class="form-control form-control-user" id="director${item.id}" name="director">
                                                ${lista_director}</select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label  class="col-3 col-form-label">Fecha para Actas</label>
                                            <div class="col-9">
                                                <input type="date" class="form-control" id="fecha_actas${item.id}" name="fecha_actas" value="${item.fecha_actas}">
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 justify-content-end row text-center">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                <button type="reset" class="btn btn-light waves-effect waves-light">Deshacer cambios</button>
                                                <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarPeriodo(${item.id});">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>`;
    document.querySelector('#contenido_tabla').appendChild(nueva_fila);
}


async function registrar_periodo() {
    let anio = document.getElementById('anio').value;
    let semestre = document.querySelector('#semestre').value;
    let fecha_inicio = document.querySelector('#fecha_inicio').value;
    let fecha_fin = document.querySelector('#fecha_fin').value;
    let director = document.querySelector('#director').value;
    let fecha_actas = document.querySelector('#fecha_actas').value;
    if (anio == "" || semestre == "" || fecha_inicio == "" || fecha_fin == "" || director == "" || fecha_actas == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/PeriodoAcademico.php?tipo=registrar', {
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
                text: 'Registrado Correctamente',
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


async function listar_director(id = "", id2 = 0) {
    // generamos el formulario
    const formData = new FormData();
    formData.append('sesion', session_session);
    formData.append('token', token_token);
    try {
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
            document.getElementById('director' + id).innerHTML = contenido_select;
        } else {
            alerta_sesion();
        }
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar categorias" + e);
    }
}


async function actualizarPeriodo(id) {
    let semestre = document.querySelector('#periodo' + id).value;
    let fecha_inicio = document.querySelector('#fecha_inicio' + id).value;
    let fecha_fin = document.querySelector('#fecha_fin' + id).value;
    let director = document.querySelector('#director' + id).value;
    let fecha_actas = document.querySelector('#fecha_actas' + id).value;
    if (semestre == "" || fecha_inicio == "" || fecha_fin == "" || director == "" || fecha_actas == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/PeriodoAcademico.php?tipo=actualizar', {
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
        //console.log(json);
    } catch (e) {
        console.log("Error al actualizar periodo" + e);
    }
}
