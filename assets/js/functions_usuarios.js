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