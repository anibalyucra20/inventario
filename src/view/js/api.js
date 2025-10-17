async function llamar_api() {
    const formulario = document.getElementById('frmApi');
    const datos = new FormData(formulario);
    let ruta_api = document.getElementById('ruta_api').value;
    try {
        let respuesta = await fetch(ruta_api + 'src/control/Api-request.php?tipo=verBienApiByNombre', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        document.getElementById('contenido').innerHTML = json;
    } catch (error) {
        console.log('Error:', error);
    }
}