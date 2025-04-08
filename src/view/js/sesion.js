async function iniciar_sesion() {
    let dni = document.getElementById('dni').value;
    let password = document.getElementById('password').value;
    if (dni == "" || password == "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos...',
            footer: '',
            timer: 1500
        })
        return;
    }
    try {
        // capturamos datos del formulario html
        const datos = new FormData(frm_login);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Login.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            //swal("Iniciar Sesion", json.mensaje, "success");
            const formData = new FormData();
            formData.append('session', json.contenido['sesion_id']);
            formData.append('usuario', json.contenido['sesion_usuario']);
            formData.append('nombres_apellidos', json.contenido['sesion_usuario_nom']);
            formData.append('token', json.contenido['sesion_token']);
            formData.append('id_ies', json.contenido['sesion_ies']);

            fetch(base_url + 'src/control/sesion_cliente.php?tipo=iniciar_sesion', {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: formData
            });
            location.replace(base_url);
            location.replace(base_url);
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.msg,
                footer: '',
                timer: 1500
            })
        }
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar categorias" + e);
    }
}

if (document.querySelector('#frm_login')) {
    // evita que se envie el formulario
    let frm_iniciar_sesion = document.querySelector('#frm_login');
    frm_iniciar_sesion.onsubmit = function (e) {
        e.preventDefault();
        iniciar_sesion();
    }
}
async function cerrar_sesion() {
    let respuesta = await fetch(base_url + 'src/control/sesion_cliente.php?tipo=cerrar_sesion');
    json = await respuesta.json();
    if (json.status) {
        location.replace(base_url + "intranet");
    }
}