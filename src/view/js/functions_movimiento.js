function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_MovimientosOrdenados();
}
async function listar_MovimientosOrdenados() {
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_amb_origen = document.getElementById('busqueda_tabla_amb_origen').value;
        let busqueda_tabla_amb_destino = document.getElementById('busqueda_tabla_amb_destino').value;
        let busqueda_fecha_desde = document.getElementById('busqueda_fecha_desde').value;
        let busqueda_fecha_hasta = document.getElementById('busqueda_fecha_hasta').value;
        // asignamos valores para guardar
        document.getElementById('filtro_ambiente_origen').value = busqueda_tabla_amb_origen;
        document.getElementById('filtro_ambiente_destino').value = busqueda_tabla_amb_destino;
        document.getElementById('filtro_fecha_inicio').value = busqueda_fecha_desde;
        document.getElementById('filtro_fecha_fin').value = busqueda_fecha_hasta;

        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_amb_origen', busqueda_tabla_amb_origen);
        formData.append('busqueda_tabla_amb_destino', busqueda_tabla_amb_destino);
        formData.append('busqueda_fecha_desde', busqueda_fecha_desde);
        formData.append('busqueda_fecha_hasta', busqueda_fecha_hasta);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        formData.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Movimiento.php?tipo=listar_movimientos_ordenados_tabla', {
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
                            <th>Fecha de registro</th>
                            <th>Ambiente de Origen</th>
                            <th>Ambiente de Destino</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
        document.querySelector('#modals_editar').innerHTML = ``;
        if (json.status) {
            let datos = json.contenido;
            cargar_ambientes_filtro(json.ambientes, "busqueda_tabla_amb_origen", 'filtro_ambiente_origen');
            cargar_ambientes_filtro(json.ambientes, "busqueda_tabla_amb_destino", 'filtro_ambiente_destino');
            datos.forEach(item => {
                generarfilastabla(item, json.ambientes, item.detalle_bienes);
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
function generarfilastabla(item, ambientes, bienes) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";

    nombre_amb_origen = '';
    nombre_amb_destino = '';
    ambientes.forEach(ambiente => {
        if (ambiente.id == item.ambiente_origen) {
            nombre_amb_origen = ambiente.detalle;
        }
        if (ambiente.id == item.ambiente_destino) {
            nombre_amb_destino = ambiente.detalle;
        }
    });
    contar_bienes = 1;
    let lista_bienes_ver = '';
    bienes.forEach(bien => {
        lista_bienes_ver += `<tr>`;
        lista_bienes_ver += `
                        <th>${contar_bienes}</th>
                        <td>${bien.cod_patrimonial}</td>
                        <td>${bien.denominacion}</td>
            `;
        contar_bienes++;
        lista_bienes_ver += `</tr>`;
    });

    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.fecha_registro}</td>
                            <td>${nombre_amb_origen}</td>
                            <td>${nombre_amb_destino}</td>
                            <td>${item.usuario_registro}</td>
                            <td>${item.options}</td>
                `;
    document.querySelector('#modals_editar').innerHTML += `<div class="modal fade modal_ver${item.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                        <label for="ambiente_origen${item.id}" class="col-3 col-form-label">Ambiente de Origen :</label>
                                                        <input type="hidden" id="sede_actual_filtro" value="0">
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="ambiente_origen${item.id}" value="${nombre_amb_origen}" readonly>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="ambiente_destino${item.id}" class="col-3 col-form-label">Ambiente de Destino :</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="ambiente_destino${item.id}" value="${nombre_amb_destino}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="fecha_${item.id}" class="col-3 col-form-label">Fecha de Registro :</label>
                                                        <div class="col-9">
                                                            <input type="date" class="form-control" id="fecha_${item.id}" value="${item.fecha_registro}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label for="usuario${item.id}" class="col-3 col-form-label">Usuario :</label>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="usuario${item.id}" value="${item.usuario_registro}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <label class="col-3 col-form-label">Bienes :</label>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <table class="table table-bordered" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nro</th>
                                                                    <th>Código Patrimonial</th>
                                                                    <th>Denominación</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            ${lista_bienes_ver}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <br>
                                                    <div class="form-group mb-0 justify-content-end row text-center">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cerrar</button>
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
async function datos_form() {
    try {
        mostrarPopupCarga();
        // capturamos datos del formulario html
        const datos = new FormData();
        datos.append('sesion', session_session);
        datos.append('token', token_token);
        datos.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Ambiente.php?tipo=listar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            listar_ambientes(json.contenido, 'ambiente_origen');
            listar_ambientes(json.contenido, 'ambiente_destino');
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
function generarfilastablabienes(item, ambientes) {
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";

    nombre_amb = '';
    ambientes.forEach(ambiente => {
        if (item.id_ambiente == ambiente.id) {
            nombre_amb = ambiente.detalle;
        }
    })
    nueva_fila.innerHTML = `
                            <td>${item.cod_patrimonial}</td>
                            <td>${item.denominacion}</td>
                            <td>${nombre_amb}</td>
                            <td>${item.options}</td>
                `;
    document.querySelector('#detalle_busqueda_bienes').appendChild(nueva_fila);
}
async function buscar_bien() {
    try {
        mostrarPopupCarga();
        let codigo_patrimonial_form = document.getElementById('codigo_patrimonial_form').value;
        let ambiente_origen = document.getElementById('ambiente_origen').value;
        if (ambiente_origen == "") {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Debe seleccionar el ambiente de origen',
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: ''
            })
            return;
        }
        // generamos el formulario
        const formData = new FormData();
        formData.append('dato_busqueda', codigo_patrimonial_form);
        formData.append('ambiente', ambiente_origen);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        formData.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Bien.php?tipo=buscar_bien_movimiento', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();
        document.getElementById('tabla_bienes').innerHTML = `<table id="" class="table table-bordered dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Código Patrimonial</th>
                            <th>Denominación</th>
                            <th>Ambiente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="detalle_busqueda_bienes">
                    </tbody>
                </table>`;
        if (json.status) {
            let datos = json.contenido;
            // asignamos todos los resultados a la variable bienes
            bienes = datos;
            datos.forEach(item => {
                generarfilastablabienes(item, json.ambientes);
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            document.getElementById('tabla_bienes').innerHTML = `no se encontraron resultados`;
        }
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar categorias" + e);
    } finally {
        ocultarPopupCarga();
    }
}
async function listar_ambientes(datos, ambiente = 'ambiente') {
    try {
        let contenido_select = '<option value="">Seleccione</option>';
        if (Array.isArray(datos)) {
            v_ambientes = datos;
            datos.forEach(element => {
                let selected = "";
                contenido_select += '<option value="' + element.id + '" ' + selected + '>' + element.detalle + '</option>';
            });
            document.getElementById(ambiente).innerHTML = contenido_select;
        }

    } catch (error) {
        console.log("ocurrio un error al listar sedes " + error);
    }

}
function listar_bienes_movimiento() {
    try {
        mostrarPopupCarga();
        document.querySelector('#contenido_bienes_tabla_movimientos').innerHTML = '';
        let index = 0;
        let cont = 1;
        lista_bienes_movimiento.forEach(item => {
            let nueva_fila = document.createElement("tr");
            nueva_fila.id = "fila" + item.id;
            nueva_fila.className = "filas_tabla_bienes_movimiento";

            nombre_amb = '';
            v_ambientes.forEach(ambiente => {
                if (ambiente.id == item.id_ambiente) {
                    nombre_amb = ambiente.detalle;
                }
            })
            nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.cod_patrimonial}</td>
                            <td>${item.denominacion}</td>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_bien_movimiento(${index});"><i class="fa fa-trash"></i></button></td>
                `;
            cont++;
            index++;
            document.querySelector('#contenido_bienes_tabla_movimientos').appendChild(nueva_fila);
        });
        //console.log(lista_bienes_movimiento);

    } catch (error) {
        console.log("ocurrio un error al agregar el bien " + error);
    } finally {
        ocultarPopupCarga();
    }

}
async function agregar_bien_movimiento(id) {
    try {
        mostrarPopupCarga();
        let contar = 0;
        lista_bienes_movimiento.forEach(item => {
            if (item.id == id) {
                contar++;
            }
        });
        bienes.forEach(element => {
            if (contar > 0) {
                Swal.fire({
                    type: 'warning',
                    title: 'Listar',
                    text: 'El bien ya se encuentra en la lista de movimiento',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                    footer: '',
                    timer: 2000
                });
            } else if (id == element.id && contar == 0) {
                lista_bienes_movimiento.push(element);
            }
        });
        //console.log("bienes: "+bienes.json());
        //eliminamos duplicados
        uniqueArr = [... new Set(lista_bienes_movimiento)];
        lista_bienes_movimiento = uniqueArr;
        listar_bienes_movimiento();
    } catch (error) {
        console.log("ocurrio un error al agregar el bien " + error);
    } finally {
        ocultarPopupCarga();
    }
}
function eliminar_bien_movimiento(index) {
    lista_bienes_movimiento.splice(index, 1);
    listar_bienes_movimiento();
}
function reiniciar_movimiento() {
    bienes = '';
    lista_bienes_movimiento = [];
    document.querySelector('#detalle_busqueda_bienes').innerHTML = '';
    listar_bienes_movimiento();
}
async function registrar_movimiento() {
    let ambiente_origen = document.querySelector('#ambiente_origen').value;
    let ambiente_destino = document.querySelector('#ambiente_destino').value;
    let descripcion = document.querySelector('#descripcion').value;
    if (ambiente_origen == ambiente_destino) {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'El ambiente de origen no puede ser igual al de destino',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: ''
        })
        return;
    }
    if (ambiente_origen == "" || ambiente_destino == "" || descripcion == "" || lista_bienes_movimiento.length == 0) {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos y/o no se tiene ningun bien para mover',
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
        datos.append('bienes', JSON.stringify(lista_bienes_movimiento));
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Movimiento.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            document.getElementById("frmRegistrar").reset();
            document.getElementById("contenido_bienes_tabla_movimientos").innerHTML = '';
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

async function actualizarMovimiento(id) {
    let ambiente = document.querySelector('#ambiente' + id).value;
    let cod_patrimonial = document.querySelector('#cod_patrimonial' + id).value;
    let denominacion = document.querySelector('#denominacion' + id).value;
    let marca = document.querySelector('#marca' + id).value;
    let modelo = document.querySelector('#modelo' + id).value;
    let tipo = document.querySelector('#tipo' + id).value;
    let color = document.querySelector('#color' + id).value;
    let serie = document.querySelector('#serie' + id).value;
    let dimensiones = document.querySelector('#dimensiones' + id).value;
    let valor = document.querySelector('#valor' + id).value;
    let situacion = document.querySelector('#situacion' + id).value;
    let estado_conservacion = document.querySelector('#estado_conservacion' + id).value;
    let observaciones = document.querySelector('#observaciones' + id).value;
    if (ambiente == "" || cod_patrimonial == "" || denominacion == "" || marca == "" || modelo == "" || tipo == "" || color == "" || serie == "" || dimensiones == "" || valor == "" || situacion == "" || estado_conservacion == "" || observaciones == "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: ''
        })
        return;
    }
    const formulario = document.getElementById('frmActualizar' + id);
    const datos = new FormData(formulario);
    datos.append('data', id);
    datos.append('sesion', session_session);
    datos.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Bien.php?tipo=actualizar', {
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

