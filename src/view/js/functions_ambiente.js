function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_ambientesOrdenados();
}
async function listar_ambientesOrdenados() {
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_codigo = document.getElementById('busqueda_tabla_codigo').value;
        let busqueda_tabla_ambiente = document.getElementById('busqueda_tabla_ambiente').value;
        // asignamos valores para guardar
        document.getElementById('filtro_codigo').value = busqueda_tabla_codigo;
        document.getElementById('filtro_ambiente').value = busqueda_tabla_ambiente;

        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_codigo', busqueda_tabla_codigo);
        formData.append('busqueda_tabla_ambiente', busqueda_tabla_ambiente);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        formData.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Ambiente.php?tipo=listar_ambientes_ordenados_tabla', {
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
                            <th>Usuario/encargado</th>
                            <th>Código</th>
                            <th>Institución</th>
                            <th>Detalle</th>
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
                generarfilastabla(item, json.instituciones);
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
function generarfilastabla(item, instituciones) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";

    lista_ies = `<option value="">Seleccione</option>`;
    nombre_ies = '';
    instituciones.forEach(ies => {
        pe_selected = "";
        if (ies.id == item.institucion) {
            pe_selected = "selected";
            nombre_ies = ies.nombre;
        }
        lista_ies += `<option value="${ies.id}" ${pe_selected}>${ies.nombre}</option>`;
    })
    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.encargado}</td>
                            <td>${item.codigo}</td>
                            <td>${nombre_ies}</td>
                            <td>${item.detalle}</td>
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
                                                        <label for="id_ies${item.id}" class="col-3 col-form-label">Institución</label>
                                                        <div class="col-9">
                                                            <select name="id_ies" id="id_ies${item.id}" class="form-control">
                                                            ${lista_ies}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="encargado${item.id}" class="col-3 col-form-label">Usuario encargado :</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="encargado${item.id}" name="encargado" value="${item.encargado}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="codigo${item.id}" class="col-3 col-form-label">Código</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="codigo${item.id}" name="codigo" value="${item.codigo}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="detalle${item.id}" class="col-3 col-form-label">Detalle</label>
                                                        <div class="col-9">
                                                        <textarea name="detalle" id="detalle${item.id}" class="form-control">${item.detalle}</textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row mb-2">
                                                        <label for="otros_detalle${item.id}" class="col-3 col-form-label">Otros detalles</label>
                                                        <div class="col-9">
                                                            <textarea name="otros_detalle" id="otros_detalle${item.id}" class="form-control" rows="5">${item.otros_detalle}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0 justify-content-end row text-center">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarAmbiente(${item.id})">Actualizar</button>
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
async function listar_instituciones(datos) {
    try {
        let contenido_select = '<option value="">Seleccione</option>';
        if (Array.isArray(datos)) {
            datos.forEach(element => {
                let selected = "";
                contenido_select += '<option value="' + element.id + '" ' + selected + '>' + element.nombre + '</option>';
            });
            document.getElementById('id_institucion').innerHTML = contenido_select;
        }

    } catch (error) {
        console.log("ocurrio un error al listar sedes " + error);
    }

}
async function registrar_ambiente() {
    let codigo = document.querySelector('#codigo').value;
    let detalle = document.querySelector('#detalle').value;
    let otros_detalle = document.querySelector('#otros_detalle').value;
    if (codigo == "" || detalle == "" || otros_detalle == "") {
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
        datos.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Ambiente.php?tipo=registrar', {
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
async function actualizarAmbiente(id) {
    let id_ies = document.getElementById('id_ies' + id).value;
    let codigo = document.querySelector('#codigo' + id).value;
    let detalle = document.querySelector('#detalle' + id).value;
    let otros_detalle = document.querySelector('#otros_detalle' + id).value;
    if (id_ies == "" || codigo == "" || detalle == "" || otros_detalle == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/Ambiente.php?tipo=actualizar', {
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

