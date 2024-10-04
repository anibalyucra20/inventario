
async function iniciar_sesion() {
    // se captura los campos
    let usuario= document.querySelector('#usuario_inv').value;
    let password = document.querySelector('#password').value;
    // validar campos vacios
    if (usuario == "" || password == "") {
      alert('campos vacios');
      return;
    }
    try {
      const data = new FormData(frm_iniciar_sesion);
      let resp = await fetch(base_url + 'control/Login.php?op=iniciar_sesion', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: data
      });
      json = await resp.json();
      if (json.status) {
        //swal("Iniciar Sesión", json.msg, "success");
        location.replace(base_url+"inicio");
      } else {
        swal("Iniciar Sesión", json.msg, "error");
      }
      console.log(resp);
    } catch (error) {
      console.log('Ocurrio un error ' + error);
    }
  }
  if (document.querySelector('#frm_iniciar_sesion')) {
    //evitar que se recargue la pantalla a la hora de enviar informacion
    let frm_iniciar_sesion = document.querySelector('#frm_iniciar_sesion');
    frm_iniciar_sesion.onsubmit = function (e) {
      e.preventDefault();
      iniciar_sesion();
    }
  }

  async function cerrar_sesion() {
    try {
      let resp = await fetch(base_url + 'control/Login.php?op=cerrar_sesion', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache'
      });
      json = await resp.json();
      if (json.status) {
        location.replace(base_url);
      }
      console.log(resp);
    } catch (error) {
      console.log('Ocurrio un error ' + error);
    }
  }