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
  let usuario = document.querySelector('#id_usuario').value;
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
      buscarPaciente()
    } else {
      swal("Usuario", json.msg, "error");
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
                  <th scope="row">${cont}</th>
                  <td>${item.nombre}</td>
                  <td>${item.cantidad}</td>
                  <td>${item.por_hora}</td>
                  <td>${item.por_dia}</td>
                  <td>${item.via_administracion}</td>
                  <td>${item.options}</td>
          `;
        document.querySelector('#tbl_tratamientos_consulta').appendChild(newtr);
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



async function ActualizarCategoria() {
  // se captura los campos
  let id_c = document.querySelector('#id_c').value;
  let strnombre = document.querySelector('#nombre').value;
  // validar campos vacios
  if (id_c == "" || strnombre == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData(frmEditar);
    let resp = await fetch(base_url + 'control/Categoria.php?op=actualizar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: data
    });
    json = await resp.json();
    if (json.status) {
      swal("Actualizar", json.msg, "success");
    } else {
      swal("Actualizar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log('Ocurrio un error ' + error);
  }
}
if (document.querySelector('#frmEditar')) {
  //evitar que se recargue la pantalla a la hora de enviar informacion
  let frmEditar = document.querySelector('#frmEditar');
  frmEditar.onsubmit = function (e) {
    e.preventDefault();
    ActualizarCategoria();
  }
}


async function eliminarCategoria(id) {

  swal({
    title: "Realmente deseas eliminar la Categoría?",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      fntEliminar(id);
    }
  })
}
async function fntEliminar(id) {
  const formData = new FormData();
  formData.append('idcategoria', id);
  try {

    let resp = await fetch(base_url + 'control/Categoria.php?op=eliminar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      swal("Eliminar", json.msg, "success");
      document.querySelector('#row_' + id).remove();
    } else {
      swal("Eliminar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }
}
