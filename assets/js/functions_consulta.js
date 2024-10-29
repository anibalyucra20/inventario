async function mostrar_consulta(id) {
  //mostrar consulta sin activar
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
      document.querySelector('#dni').value = json.data.dni;
      document.querySelector('#id_paciente').value = json.data.id_paciente;
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
async function getConsultas() {
  try {
    let resp = await fetch(base_url + 'control/Consultorio.php?op=listar');
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
                  <td>${item.id}</td>
                  <td>${item.fecha_hora}</td>
                  <td>${item.apellidos_nombres}</td>
                  <td>${item.motivo_consulta}</td>
                  <td>${item.options}</td>
          `;
        document.querySelector('#tblConsulta').appendChild(newtr);
      });
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar usuario ' + error);
  }

}
if (document.querySelector('#tblConsulta')) {
  getConsultas();
}

async function buscarConsultaRegistro() {
  //mostrar consulta sin activar
  let usuario = document.querySelector('#id_usu_sesion').value;
  const formData = new FormData();
  formData.append('id_usuario', usuario);
  try {
    let resp = await fetch(base_url + 'control/Consultorio.php?op=buscar_registro', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      document.querySelector('#id_paciente').value = json.data.id_paciente;
      document.querySelector('#motivo_c').value = json.data.motivo_consulta;
      document.querySelector('#diagnostico_c').value = json.data.diagnostico;
      document.querySelector('#id_consulta').value = json.data.id;
    } else {
      swal("Consultorio", json.msg, "error");
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar usuario ' + error);
  }
  buscartratamientos();
}

async function buscarPaciente() {
  //mostrar consulta sin activar
  let paciente = document.querySelector('#id_paciente').value;
  const formData = new FormData();
  formData.append('id_usuario', paciente);
  try {
    let resp = await fetch(base_url + 'control/Usuario.php?op=ver_id', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      document.querySelector('#dni').value = json.data.dni;
      document.querySelector('#paciente').value = json.data.apellidos_nombres;
    } else {
      swal("Usuario", json.msg, "error");
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar usuario ' + error);
  }
}

async function buscarUsuarioDni() {
  let dni = document.querySelector('#dni').value;
  const formData = new FormData();
  formData.append('dni_usuario', dni);
  try {
    let resp = await fetch(base_url + 'control/Usuario.php?op=ver_dni', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      document.querySelector('#id_paciente').value = json.data.id;
      document.querySelector('#paciente').value = json.data.apellidos_nombres;
    } else {
      document.querySelector('#id_paciente').value = '';
      document.querySelector('#paciente').value = '';
      swal("Usuario", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }
}

async function select_medicamento(id) {
  document.querySelector('#id_medicamento_frm').value = id;
}

async function buscar_medicamento() {
  document.querySelector('#id_medicamento_frm').value = '';
  let lista = document.querySelector('#listaproductos');
  while (document.querySelector('.elementolista')) {
    let elemento = document.querySelector('.elementolista');
    elemento.remove();
  }
  let med = document.querySelector('#bmedicamento').value;
  const formData = new FormData();
  formData.append('bmedicamento', med);
  try {
    let resp = await fetch(base_url + 'control/Producto.php?op=busqueda', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      let data = json.data;
      data.forEach(item => {
        let newtr = document.createElement("li");
        newtr.id = "med_" + item.id;
        newtr.className = "elementolista";
        newtr.innerHTML = `${item.nombre}  <input type="radio" clas="flat" name="element_med" value="${item.id}" onclick="select_medicamento(${item.id});"><br>`;
        lista.appendChild(newtr);
      });
    }
    console.log(json);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }
}

async function buscartratamientos() {
  while (document.querySelector('.element_tbl_tratamiento')) {
    document.querySelector('.element_tbl_tratamiento').remove();
  }
  let id_consulta = document.querySelector('#id_consulta').value;
  const data = new FormData();
  data.append('id_consulta', id_consulta);
  try {
    const data = new FormData(frm_tratamiento);
    data.append('id_consulta', id_consulta);

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
                  <td>${item.options}</td>
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


async function registrar_tratamiento() {
  // se captura los campos
  let id_consulta = document.querySelector('#id_consulta').value;
  let id_medicamento = document.querySelector('#id_medicamento_frm').value;
  let strmedicamento = document.querySelector('#bmedicamento').value;
  let cantidad_c = document.querySelector('#cantidad_c').value;
  let frecuencia_c = document.querySelector('#frecuencia_c').value;
  let dias_c = document.querySelector('#dias_c').value;
  let via_c = document.querySelector('#via_c').value;
  // validar campos vacios
  if (id_consulta == "" || strmedicamento == "" || cantidad_c == "" || frecuencia_c == "" || dias_c == "" || via_c == "" || id_medicamento == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData(frm_tratamiento);
    data.append('id_consulta', id_consulta);

    let resp = await fetch(base_url + 'control/Tratamiento.php?op=registrar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: data
    });
    json = await resp.json();
    if (json.status) {
      swal("Actualizar", json.msg, "success");
      buscartratamientos();
      frm_tratamiento.reset();
    } else {
      swal("Actualizar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log('Ocurrio un error ' + error);
  }

}
if (document.querySelector('#frm_tratamiento')) {
  //evitar que se recargue la pantalla a la hora de enviar informacion
  let frmTratamiento = document.querySelector('#frm_tratamiento');
  frmTratamiento.onsubmit = function (e) {
    e.preventDefault();
    registrar_tratamiento();
  }
}



async function actualizarTratamiento(id) {
  // se captura los campos
  let cantidad_t = document.querySelector('#cantidad_c_editar_' + id).value;
  let hora_t = document.querySelector('#frecuencia_c_editar_' + id).value;
  let dia_t = document.querySelector('#dias_c_editar_' + id).value;
  let via_t = document.querySelector('#via_c_editar_' + id).value;
  // validar campos vacios
  if (cantidad_t == "" || hora_t == "" || dia_t == "" || via_t == "") {
    alert('campos vacios');
    return;
  }
  const formData = new FormData();
  formData.append('idtratamiento', id);
  formData.append('cantidad_t', cantidad_t);
  formData.append('hora_t', hora_t);
  formData.append('dia_t', dia_t);
  formData.append('via_t', via_t);
  try {
    let resp = await fetch(base_url + 'control/Tratamiento.php?op=actualizar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {

      document.querySelector('button#cerrar_modal_editar_' + id).click();
      swal("Actualizar", json.msg, "success");
      buscartratamientos();
    } else {
      swal("Actualizar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log('Ocurrio un error ' + error);
  }


}



async function eliminarTratamiento(id) {

  swal({
    title: "Realmente deseas el Tratamiento?",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      fntEliminar_tratamiento(id);
    }
  })
}
async function fntEliminar_tratamiento(id) {
  const formData = new FormData();
  formData.append('idtratamiento', id);
  try {

    let resp = await fetch(base_url + 'control/Tratamiento.php?op=eliminar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      swal("Eliminar", json.msg, "success");
      document.querySelector('#row_tratamiento_' + id).remove();
    } else {
      swal("Eliminar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }
}



async function actualizarConsulta() {
  // se captura los campos
  let id_paciente = document.querySelector('#id_paciente').value;
  let motivo_c = document.querySelector('#motivo_c').value;
  let diagnostico_c = document.querySelector('#diagnostico_c').value;
  let id_consulta = document.querySelector('#id_consulta').value;
  let id_usuario = document.querySelector('#id_usuario').value;
  // validar campos vacios
  if (id_paciente == "" || motivo_c == "" || diagnostico_c == "" || id_consulta == "" || id_usuario == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData(frmRegistro);
    let resp = await fetch(base_url + 'control/Consultorio.php?op=actualizar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: data
    });
    json = await resp.json();
    if (json.status) {
      swal("Actualizar", json.msg, "success");
      location.href =base_url+"consultorio";
    } else {
      swal("Actualizar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log('Ocurrio un error ' + error);
  }

}

if (document.querySelector('#frmRegistro')) {
  //evitar que se recargue la pantalla a la hora de enviar informacion
  let frmRegistro = document.querySelector('#frmRegistro');
  frmRegistro.onsubmit = function (e) {
    e.preventDefault();
    actualizarConsulta();
  }
}
