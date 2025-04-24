function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_BienesOrdenados();
}
async function listar_BienesOrdenados() {
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_ambiente = document.getElementById('busqueda_tabla_ambiente').value;
        let busqueda_tabla_codigo = document.getElementById('busqueda_tabla_codigo').value;
        let busqueda_tabla_denominacion = document.getElementById('busqueda_tabla_denominacion').value;
        // asignamos valores para guardar
        document.getElementById('filtro_codigo').value = busqueda_tabla_codigo;
        document.getElementById('filtro_ambiente').value = busqueda_tabla_ambiente;
        document.getElementById('filtro_denominacion').value = busqueda_tabla_denominacion;

        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_codigo', busqueda_tabla_codigo);
        formData.append('busqueda_tabla_ambiente', busqueda_tabla_ambiente);
        formData.append('busqueda_tabla_denominacion', busqueda_tabla_denominacion);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        formData.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Bien.php?tipo=listar_bienes_ordenados_tabla', {
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
                            <th>Código patrimonial</th>
                            <th>Detalle</th>
                            <th>Ambiente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
        document.querySelector('#modals_editar').innerHTML = ``;
        if (json.status) {
            let datos = json.contenido;
            cargar_ambientes_filtro(json.ambientes);
            datos.forEach(item => {
                generarfilastabla(item, json.ambientes);
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
function generarfilastabla(item, ambientes) {
    let cont = 1;
    $(".filas_tabla").each(function () {
        cont++;
    })
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.id;
    nueva_fila.className = "filas_tabla";

    lista_ambiente = `<option value="">Seleccione</option>`;
    nombre_amb = '';
    ambientes.forEach(ambiente => {
        amb_selected = "";
        if (ambiente.id == item.id_ambiente) {
            amb_selected = "selected";
            nombre_amb = ambiente.detalle;
        }
        lista_ambiente += `<option value="${ambiente.id}" ${amb_selected}>${ambiente.detalle}</option>`;
    })
    nueva_fila.innerHTML = `
                            <th>${cont}</th>
                            <td>${item.cod_patrimonial}</td>
                            <td>${item.denominacion}</td>
                            <td>${nombre_amb}</td>
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
                        <label for="ambiente${item.id}" class="col-3 col-form-label">Ambiente:</label>
                        <input type="hidden" id="sede_actual_filtro" value="0">
                        <div class="col-9">
                            <select class="form-control" name="ambiente" id="ambiente${item.id}" disabled>
                            ${lista_ambiente}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="cod_patrimonial${item.id}" class="col-3 col-form-label">Código Patrimonial</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="cod_patrimonial${item.id}" name="cod_patrimonial"  value="${item.cod_patrimonial}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="denominacion${item.id}" class="col-3 col-form-label">Denominación</label>
                        <div class="col-9">
                            <textarea name="denominacion" id="denominacion${item.id}" class="form-control">${item.denominacion}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="marca${item.id}" class="col-3 col-form-label">Marca</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="marca${item.id}" name="marca"  value="${item.marca}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="modelo${item.id}" class="col-3 col-form-label">Modelo</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="modelo${item.id}" name="modelo"  value="${item.modelo}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tipo${item.id}" class="col-3 col-form-label">Tipo</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="tipo${item.id}" name="tipo" value="${item.tipo}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="color${item.id}" class="col-3 col-form-label">Color</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="color${item.id}" name="color" value="${item.color}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="serie${item.id}" class="col-3 col-form-label">Serie</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="serie${item.id}" name="serie" value="${item.serie}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="dimensiones${item.id}" class="col-3 col-form-label">Dimensiones</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="dimensiones${item.id}" name="dimensiones" value="${item.dimensiones}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="valor${item.id}" class="col-3 col-form-label">Valor</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="valor${item.id}" name="valor" value="${item.valor}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="situacion${item.id}" class="col-3 col-form-label">Situación</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="situacion${item.id}" name="situacion" value="${item.situacion}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="estado_conservacion${item.id}" class="col-3 col-form-label">Estado de Conservación</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="estado_conservacion${item.id}" name="estado_conservacion" value="${item.estado_conservacion}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="observaciones${item.id}" class="col-3 col-form-label">Observaciones</label>
                        <div class="col-9">
                            <textarea name="observaciones" id="observaciones${item.id}" class="form-control" rows="5">${item.observaciones}</textarea>
                        </div>
                    </div>
                                                    <div class="form-group mb-0 justify-content-end row text-center">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="actualizarBien(${item.id})">Actualizar</button>
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
            listar_ambientes(json.contenido);
            v_ambientes = json.contenido;
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
async function listar_ambientes(datos, ambiente = 'ambiente') {
    try {
        let contenido_select = '<option value="">Seleccione</option>';
        if (Array.isArray(datos)) {
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
function listar_bienes_ingreso() {
    try {
        mostrarPopupCarga();
        document.querySelector('#contenido_bienes_tabla_ingresos').innerHTML = '';
        let cont = 1;
        $(".filas_tabla_bienes").each(function () {
            cont++;
        });
        let index = 0;
        let contador = 0
        lista_bienes_registro.forEach(item => {
            let nueva_fila = document.createElement("tr");
            nueva_fila.id = "fila" + item.id;
            nueva_fila.className = "filas_tabla_bienes";

            nombre_amb = '';

            v_ambientes.forEach(ambiente => {
                if (ambiente.id == item.ambiente) {
                    nombre_amb = ambiente.detalle;
                }
            })
            nueva_fila.innerHTML = `
                            <th>${contador}</th>
                            <td>${item.cod_patrimonial}</td>
                            <td>${item.denominacion}</td>
                            <td>${nombre_amb}</td>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_bien_ingreso(${index});"><i class="fa fa-trash"></i></button></td>
                `;
            document.querySelector('#contenido_bienes_tabla_ingresos').appendChild(nueva_fila);
            index++;
            contador++;
        });
        //console.log(lista_bienes_registro);

    } catch (error) {
        console.log("ocurrio un error al agregar el bien " + error);
    } finally {
        ocultarPopupCarga();
    }
}
function agregar_bien_ingreso() {
    try {
        mostrarPopupCarga();
        let ambiente = document.querySelector('#ambiente').value;
        let cod_patrimonial = document.querySelector('#cod_patrimonial').value;
        let denominacion = document.querySelector('#denominacion').value;
        let marca = document.querySelector('#marca').value;
        let modelo = document.querySelector('#modelo').value;
        let tipo = document.querySelector('#tipo').value;
        let color = document.querySelector('#color').value;
        let serie = document.querySelector('#serie').value;
        let dimensiones = document.querySelector('#dimensiones').value;
        let valor = document.querySelector('#valor').value;
        let situacion = document.querySelector('#situacion').value;
        let estado_conservacion = document.querySelector('#estado_conservacion').value;
        let observaciones = document.querySelector('#observaciones').value;
        if (ambiente == "" || denominacion == "" || marca == "" || modelo == "" || tipo == "" || color == "" || serie == "" || dimensiones == "" || valor == "" || situacion == "" || estado_conservacion == "" || observaciones == "") {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Campos vacíos',
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: ''
            })
            return;
        }
        let cont = 0;
        lista_bienes_registro.forEach(bien => {
            if (bien.cod_patrimonial == cod_patrimonial && cod_patrimonial != "") {
                cont++;
            }
        });
        if (cont == 0) {
            let nuevo_bien = new Object();
            nuevo_bien.ambiente = ambiente;
            nuevo_bien.cod_patrimonial = cod_patrimonial;
            nuevo_bien.denominacion = denominacion;
            nuevo_bien.marca = marca;
            nuevo_bien.modelo = modelo;
            nuevo_bien.tipo = tipo;
            nuevo_bien.color = color;
            nuevo_bien.serie = serie;
            nuevo_bien.dimensiones = dimensiones;
            nuevo_bien.valor = valor;
            nuevo_bien.situacion = situacion;
            nuevo_bien.estado_conservacion = estado_conservacion;
            nuevo_bien.observaciones = observaciones;
            lista_bienes_registro.push(nuevo_bien);
            document.getElementById("frmAgregarBienes").reset();
            //console.log(nuevo_bien);
            console.log(lista_bienes_registro);
            listar_bienes_ingreso();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'El código patrimonial ya esta agregado en la lista de ingreso de bienes',
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: ''
            })
            return;
        }

    } catch (e) {
        console.log("Oops, ocurrio un error al agregar bien a ingreso" + e);
    } finally {
        ocultarPopupCarga();
    }
}
function eliminar_bien_ingreso(index) {
    lista_bienes_registro.splice(index, 1);
    listar_bienes_ingreso();
}
async function registrar_ingreso() {
    let descripcion = document.querySelector('#descripcion').value;
    if (descripcion == "" || lista_bienes_registro.length == 0) {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos y/o falta agregar bienes',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: ''
        })
        return;
    }
    try {
        mostrarPopupCarga();
        // capturamos datos del formulario html
        const datos = new FormData(frmRegistrar);
        datos.append('sesion', session_session);
        datos.append('token', token_token);
        datos.append('ies', session_ies);
        datos.append('bienes', JSON.stringify(lista_bienes_registro));
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Bien.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            document.getElementById("frmRegistrar").reset();
            document.getElementById("contenido_bienes_tabla_ingresos").innerHTML = '';
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
    } finally {
        ocultarPopupCarga();
    }
}
async function actualizarBien(id) {
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
    if (denominacion == "" || marca == "" || modelo == "" || tipo == "" || color == "" || serie == "" || dimensiones == "" || valor == "" || situacion == "" || estado_conservacion == "" || observaciones == "") {
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

