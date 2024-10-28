async function getUsuarios() {
    try {
        let resp = await fetch(base_url + 'control/Usuario.php?op=listar');
        json = await resp.json();
        if (json.status) {
            let data = json.data;
            let cont = 0;
            data.forEach(item => {
                let newtr = document.createElement("tr");
                newtr.id = "row_" + item.id;
                cont++;
                newtr.innerHTML = `
                    <td scope="row">${cont}</td>
                    <td>${item.dni}</td>
                    <td>${item.cip}</td>
                    <td>${item.apellidos_nombres}</td>
                    <td>${item.genero}</td>
                    <td>${item.tipo_usuario}</td>
                    <td>${item.options}</td>
                `;
                document.querySelector('#tblUsuario').appendChild(newtr);
            });
        }
        console.log(json);

    } catch (e) {
        console.log('Ocurrio error al cargar usuarios ' + e);
    }
}

if (document.querySelector('#tblUsuario')) {
    getUsuarios();
}

async function GuardarUsuario() {
    // se captura los campos
    let dni = document.querySelector('#dni').value;
    let nombres = document.querySelector('#nombres').value;
    let fecha_nacimiento = document.querySelector('#fecha_nacimiento').value;
    let genero = document.querySelector('#genero').value;
    let talla = document.querySelector('#talla').value;
    let peso = document.querySelector('#peso').value;
    let tipo_usuario = document.querySelector('#tipo_usuario').value;
    // validar campos vacios
    if (dni == "" || nombres == "" || fecha_nacimiento == "" || genero == "" || talla == "" || peso == "" || tipo_usuario == "") {
        alert('campos vacios');
        return;
    }
    try {
        const data = new FormData(frmRegistro);
        let resp = await fetch(base_url + 'control/Usuario.php?op=registrar', {
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
        GuardarUsuario();
    }
}

async function mostrar_usuario(id) {
    const formData = new FormData();
    formData.append('id_usuario', id);
    try {

        let resp = await fetch(base_url + 'control/Usuario.php?op=ver_id', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if (json.status) {
            document.querySelector('#id').value = json.data.id;
            document.querySelector('#dni').value = json.data.dni;
            document.querySelector('#cip').value = json.data.cip;
            document.querySelector('#nombres').value = json.data.apellidos_nombres;
            document.querySelector('#fecha_nacimiento').value = json.data.fecha_nacimiento;
            document.querySelector('#genero').value = json.data.genero;
            document.querySelector('#talla').value = json.data.talla;
            document.querySelector('#peso').value = json.data.peso;
            document.querySelector('#grado').value = json.data.grado;
            document.querySelector('#cia').value = json.data.cia;
            document.querySelector('#tipo_usuario').value = json.data.tipo_usuario;
        } else {
            window.location = base_url + "categorias";
        }
        console.log(resp);
    } catch (error) {
        console.log("Ocurrio un error: " + error);
    }

}


async function ActualizarUsuario() {
    // se captura los campos
    let id = document.querySelector('#id').value;
    let dni = document.querySelector('#dni').value;
    let cip = document.querySelector('#cip').value;
    let nombres = document.querySelector('#nombres').value;
    let fecha_nacimiento = document.querySelector('#fecha_nacimiento').value;
    let genero = document.querySelector('#genero').value;
    let talla = document.querySelector('#talla').value;
    let peso = document.querySelector('#peso').value;
    let grado = document.querySelector('#grado').value;
    let cia = document.querySelector('#cia').value;
    let tipo_usuario = document.querySelector('#tipo_usuario').value;
    // validar campos vacios
    if (id == "" || dni == "" || cip == "" || nombres == "" || fecha_nacimiento == "" || genero == "" || talla == "" || peso == "" || grado == "" || cia == "" || tipo_usuario == "") {
        alert('campos vacios');
        return;
    }
    try {
        const data = new FormData(frmEditar);
        let resp = await fetch(base_url + 'control/Usuario.php?op=actualizar', {
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
        ActualizarUsuario();
    }
}

async function eliminarUsuario(id) {

    swal({
      title: "Realmente deseas eliminar el Usuario?",
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
    formData.append('idusuario', id);
    try {
  
      let resp = await fetch(base_url + 'control/Usuario.php?op=eliminar', {
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