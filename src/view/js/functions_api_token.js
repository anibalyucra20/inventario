async function registrar_token() {
    let cliente = document.querySelector('#busqueda_tabla_cliente').value;
    if (cliente == "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos...s',
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
        let respuesta = await fetch(base_url_server + 'src/control/ApiClient.php?tipo=registrarToken', {
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

async function cargar_clientes() {
    const formData = new FormData();
        formData.append('sesion', session_session);
        formData.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/ApiClient.php?tipo=listar_clientes', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();
        clientes = json.contenido;
        lista_cliente = `<option value="">Seleccione</option>`;
        cliente = '';
        clientes.forEach(client => {
            lista_cliente += `<option value="${client.id}">${client.razon_social}</option>`;
        })
        document.getElementById("busqueda_tabla_cliente").innerHTML = lista_cliente;
    } catch (error) {
        console.log(error);
    }
}
function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_tokenOrdenados();
}
async function listar_tokenOrdenados() {
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_cliente = document.getElementById('busqueda_tabla_cliente').value;
        let busqueda_tabla_estado = document.getElementById('busqueda_tabla_estado').value;
        // asignamos valores para guardar
        document.getElementById('filtro_cliente').value = busqueda_tabla_cliente;
        document.getElementById('filtro_estado').value = busqueda_tabla_estado;

        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_cliente', busqueda_tabla_cliente);
        formData.append('busqueda_tabla_estado', busqueda_tabla_estado);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/ApiClient.php?tipo=listar_tokens_ordenados_tabla', {
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
                            <th>RUC</th>
                            <th>Razón Social</th>
                            <th>Token</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
        document.querySelector('#modals_editar').innerHTML = ``;
        if (json.status) {
            let datos = json.contenido;
            let clientes = json.clientes;
            datos.forEach(item => {
                generarfilastabla(item, clientes);
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
function generarfilastabla(item, clientes) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })

    cargar_clientes(clientes);
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

    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.ruc}</td>
                            <td>${item.razon_social}</td>
                            <td>${item.token}</td>
                            <td>${estado}</td>
                            <td>${item.options}</td>
                `;
    document.querySelector('#modals_editar').innerHTML += `<div class="modal fade modal_editar${item.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title h4 " id="myLargeModalLabel">Actualizar estado de token</h5>
                                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <form class="form-horizontal" id="frmActualizar${item.id}">
                                                    <div class="form-group row mb-2">
                                                        <label for="ruc${item.id}" class="col-3 col-form-label">RUC</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="ruc${item.id}" name="ruc" value="${item.ruc}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="razon_social${item.id}" class="col-3 col-form-label">Razón Social</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="razon_social${item.id}" name="razon_social"  value="${item.razon_social}" disabled>
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
                                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarToken(${item.id})">Actualizar</button>
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
async function actualizarToken(id) {
    let estado = document.querySelector('#estado' + id).value;
    if (estado == "") {
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
        let respuesta = await fetch(base_url_server + 'src/control/ApiClient.php?tipo=actualizarToken', {
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