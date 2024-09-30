async function getCategorias() {
  try {
    let resp = await fetch(base_url + 'control/Categoria.php?op=listar');
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
                  <td>${item.nombre}</td>
                  <td>${item.options}</td>
          `;
        document.querySelector('#tblCategoria').appendChild(newtr);
      });
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar usuario ' + error);
  }

}
if (document.querySelector('#tblCategoria')) {
  getCategorias();
}



async function GuardarCategoria() {
  // se captura los campos
  let strnombre = document.querySelector('#nombre').value;
  // validar campos vacios
  if (strnombre == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData(frmRegistro);
    let resp = await fetch(base_url + 'control/Categoria.php?op=registrar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: data
    });
    json = await resp.json();
    if (json.status) {
      swal("Guardar", json.msg, "success");
      frmRegistro.reset();
    } else {
      swal("Guardar", json.msg, "error");
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
    GuardarCategoria();
  }
}

async function mostrar_categoria(id) {
  const formData = new FormData();
  formData.append('idcategoria', id);
  try {

    let resp = await fetch(base_url + 'control/Categoria.php?op=ver', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      document.querySelector('#id_c').value = json.data.id;
      document.querySelector('#nombre').value = json.data.nombre;
    } else {
      window.location = base_url + "categorias";
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
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
    buttons : true,
    dangerMode: true,
  }).then((willDelete)=>{
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
      document.querySelector('#row_'+id).remove();
    } else {
      swal("Eliminar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }
}
