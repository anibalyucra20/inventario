
async function getConsultas() {
  try {
    let resp = await fetch(base_url + 'control/Farmacia.php?op=listar');
    json = await resp.json();
    if (json.status) {
      let data = json.data;
      let cont = 0;
      data.forEach(item => {
        let newtr = document.createElement("tr");
        newtr.id = "row_" + item.id;
        cont++;
        newtr.innerHTML = `
                  <th scope="row">${cont}</th>
                  <td>${item.fecha}</td>
                  <td>${item.apellidos_nombres}</td>
                  <td>${item.nombre}</td>
          `;
        document.querySelector('#tblFarmacia').appendChild(newtr);
      });
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar usuario ' + error);
  }

}
if (document.querySelector('#tblFarmacia')) {
  getConsultas();
}

async function buscar_consulta() {
  //mostrar consulta sin activar
  let id = document.querySelector('#codigo').value;
  const formData = new FormData();
  formData.append('id_consulta', id);
  try {
    let resp = await fetch(base_url + 'control/Consultorio.php?op=ver', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      document.querySelector('#paciente').value = json.data.apellidos_nombres;
      document.querySelector('#motivo_c').value = json.data.motivo_consulta;
      document.querySelector('#diagnostico_c').value = json.data.diagnostico;
      document.querySelector('#id_consulta').value = json.data.id;
    } else {
      swal("Conaultorio", json.msg, "error");
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar usuario ' + error);
  }
  buscartratamientos();
}


async function buscartratamientos() {
  while (document.querySelector('.element_tbl_tratamiento')) {
    document.querySelector('.element_tbl_tratamiento').remove();
  }
  let id_consulta = document.querySelector('#id_consulta').value;
  const data = new FormData();
  data.append('id_consulta', id_consulta);
  try {
    let resp = await fetch(base_url + 'control/Tratamiento.php?op=listar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: data
    });
    json = await resp.json();
    if (json.status) {
      let data = json.data;
      let cont = 0;
      data.forEach(item => {
        let newtr = document.createElement("tr");
        newtr.id = "row_tratamiento_" + item.id;
        newtr.className = "element_tbl_tratamiento";
        cont++;
        newtr.innerHTML = `
                  <td scope="row">${cont}</td>
                  <td>${item.nombre}</td>
                  <td>${item.cantidad}</td>
                  <td>${item.por_hora}</td>
                  <td>${item.por_dia}</td>
                  <td>${item.via_administracion}</td>
                  <td><button type="button" class="btn btn-info" data-toggle="modal" data-target=".modal_editar_${item.id}"><i class="fa fa-pen"></i></button>
                  
                  <!-- MODAL EDITAR -->
                                  <div class="modal fade modal_editar_${item.id}" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                  </button>
                                                  <h4 class="modal-title" id="myModalLabel">Atender Tratamiento</h4>
                                              </div>
                                              <form id="frm_tratamiento_editar_${item.id}" class="form-horizontal form-label-left">
                                                  <br>
                                                  <div class="form-group">
                                                      <label for="bmedicamento_editar_${item.id}" class="form-label col-md-3">Medicamento:</label>
                                                      <div class="col-md-9">
                                                          <input type="hidden" id="id_med_${item.id}" name="id_med_${item.id}" value="${item.id_medicamento}">
                                                          <input type="text" class="form-control col-md-6" id="bmedicamento_editar_${item.id}" required readonly value="${item.nombre}">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="cantidad_c_editar_${item.id}" class="form-label col-md-3">Cantidad:</label>
                                                      <div class="col-md-9">
                                                          <input type="number" class="form-control" id="cantidad_c_editar_${item.id}" required value="${item.cantidad}" readonly>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="frecuencia_c_editar_${item.id}" class="form-label col-md-3">Frecuencia x Hora:</label>
                                                      <div class="col-md-9">
                                                          <input type="number" class="form-control" id="frecuencia_c_editar_${item.id}" required value="${item.por_hora}" readonly>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="dias_c_editar_${item.id}" class="form-label col-md-3">Cantidad de días:</label>
                                                      <div class="col-md-9">
                                                          <input type="number" class="form-control" id="dias_c_editar_${item.id}" required value="${item.por_dia}" readonly>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="via_c_editar_${item.id}" class="form-label col-md-3">Vía de Administración:</label>
                                                      <div class="col-md-9">
                                                          <select name="via_c_editar_${item.id}" id="via_c_editar_${item.id}" class="form-control" required disabled>
                                                              <option></option>
                                                              <option value="Oral">Oral</option>
                                                              <option value="Intra Muscular">Intra Muscular</option>
                                                              <option value="Intra Venosa">Intra Venosa</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="atendido_${item.id}" class="form-label col-md-3">Cantidad a Atender:</label>
                                                      <div class="col-md-9">
                                                          <input type="number" class="form-control" name="atendido_${item.id}" id="atendido_${item.id}" required>
                                                      </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" id="cerrar_modal_editar_${item.id}" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                      <button type="button" class="btn btn-primary" onclick="registrar_movimiento(${item.id});">Registrar Atención</button>
                                                  </div>
          
                                              </form>
          
          
          
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /MODAL EDITAR -->
                  
                  
                  
                  
                  
                  
                  
                  </td>
          `;
        document.querySelector('#tbl_tratamientos_consulta').appendChild(newtr);
        document.querySelector('#via_c_editar_' + item.id).value = item.via_administracion;
      });
    }
    console.log(resp);
  } catch (error) {
    console.log('Ocurrio un error ' + error);
  }
}

async function registrar_movimiento(id) {
  // se captura los campos
  let tipo = 'salida';
  let id_tratamiento = id;
  let id_medicamento = document.querySelector('#id_med_'+id).value;
  let cantidad = document.querySelector('#atendido_'+id).value;
  let detalle = 'atencion de medicamento por tratamiento';
  let procedencia = '';
  // validar campos vacios
  if (id_tratamiento == "" || id_medicamento == "" || cantidad == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData();
    data.append('tipo', tipo);
    data.append('detalle', detalle);
    data.append('procedencia', procedencia);
    data.append('id_tratamiento', id);
    data.append('id_medicamento', id_medicamento);
    data.append('cantidad', cantidad);

    let resp = await fetch(base_url + 'control/Farmacia.php?op=registrar_salida', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: data
    });
    json = await resp.json();
    if (json.status) {
      swal("Atención", json.msg, "success");
      document.querySelector('#atendido_'+id).value= '';
    } else {
      swal("Atención", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log('Ocurrio un error ' + error);
  }


}