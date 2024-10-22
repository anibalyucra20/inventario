async function getProductos() {
  // capturador de errores
  try {
    // llamar al controlador producto.php con la operacion llamada LISTAR
    let resp = await fetch(base_url + 'control/Producto.php?op=listar');
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
                  <td>${item.codigo}</td>
                  <td>${item.nombre}</td>
                  <td>${item.presentacion}</td>
                  <td>${item.stock}</td>
                  <td>${item.fecha_vencimiento}</td>
                  <td>${item.options}</td>
          `;
        document.querySelector('#tblMedicamento').appendChild(newtr);
      });
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar medicamentos ' + error);
  }
}

if (document.querySelector('#tblMedicamento')) {
  getProductos();
}

async function GuardarMedicamento() {
  // se captura los campos
  let strcodigo = document.querySelector('#codigo').value;
  let strnombre = document.querySelector('#nombre').value;
  let strdescripcion = document.querySelector('#descripcion').value;
  let strpresentacion = document.querySelector('#presentacion').value;
  let intstock = document.querySelector('#stock').value;
  let datefecha_vencimiento = document.querySelector('#fecha_vencimiento').value;
  let intid_categoria = document.querySelector('#id_categoria').value;
  // validar campos vacios
  if (strcodigo == "" || strnombre == "" || strdescripcion == "" || strpresentacion == "" || intstock == "" || datefecha_vencimiento == "" || intid_categoria == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData(frmRegistro);
    let resp = await fetch(base_url + 'control/Producto.php?op=registrar', {
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

async function getCategorias() {
  try {
    let resp = await fetch(base_url + 'control/Categoria.php?op=listar');
    json = await resp.json();
    if (json.status) {
      let data = json.data;
      data.forEach(item => {
        $('#id_categoria').append($('<option />', {
          text: `${item.nombre}`,
          value: `${item.id}`,
        }));
      });
    }
    console.log(json);
  } catch (error) {
    console.log('Ocurrio error al cargar medicamentos ' + error);
  }
}
if (document.querySelector('#frmRegistro')) {
  getCategorias();
  //evitar que se recargue la pantalla a la hora de enviar informacion
  let frmRegistro = document.querySelector('#frmRegistro');
  frmRegistro.onsubmit = function (e) {
    e.preventDefault();
    GuardarMedicamento();
  }
}

async function mostrar_producto(id) {
  getCategorias();
  const formData = new FormData();
  formData.append('idmedicamento', id);
  try {

    let resp = await fetch(base_url + 'control/Producto.php?op=ver', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      document.querySelector('#id_m').value = json.data.id;
      document.querySelector('#codigo').value = json.data.codigo;
      document.querySelector('#nombre').value = json.data.nombre;
      document.querySelector('#descripcion').value = json.data.descripcion;
      document.querySelector('#presentacion').value = json.data.presentacion;
      document.querySelector('#fecha_vencimiento').value = json.data.fecha_vencimiento;
      document.querySelector('#id_categoria').value = json.data.id_categoria;
    } else {
      window.location = base_url + "medicamento";
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }

}


async function ActualizarMedicamento() {
  // se captura los campos
  let id_med = document.querySelector('#id_m').value;
  let strcodigo = document.querySelector('#codigo').value;
  let strnombre = document.querySelector('#nombre').value;
  let strdescripcion = document.querySelector('#descripcion').value;
  let strpresentacion = document.querySelector('#presentacion').value;
  let datefecha_vencimiento = document.querySelector('#fecha_vencimiento').value;
  let intid_categoria = document.querySelector('#id_categoria').value;
  // validar campos vacios
  if (id_med == "" || strcodigo == "" || strnombre == "" || strdescripcion == "" || strpresentacion == "" || datefecha_vencimiento == "" || intid_categoria == "") {
    alert('campos vacios');
    return;
  }
  try {
    const data = new FormData(frmEditar);
    let resp = await fetch(base_url + 'control/Producto.php?op=actualizar', {
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
    ActualizarMedicamento();
  }
}

async function eliminarProducto(id) {

  swal({
    title: "Realmente deseas eliminar el Medicamento?",
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
  formData.append('idmedicamento', id);
  try {

    let resp = await fetch(base_url + 'control/Producto.php?op=eliminar', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: formData
    });
    json = await resp.json();
    if (json.status) {
      swal("Actualizar", json.msg, "success");
      document.querySelector('#row_'+id).remove();
    } else {
      swal("Actualizar", json.msg, "error");
    }
    console.log(resp);
  } catch (error) {
    console.log("Ocurrio un error: " + error);
  }
}