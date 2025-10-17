async function llamar_api() {
    const formulario = document.getElementById('frmApi');
    const datos = new FormData(formulario);
    let ruta_api = document.getElementById('ruta_api').value;
    try {
        let respuesta = await fetch(ruta_api+'/src/control/Api-request.php?tipo=verBienApiByNombre', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        let contenidosss = '';
        let cont=0;
        json.contenido.forEach(Element => {
            cont++;
            contenidosss+="<tr>";
            contenidosss+="<td>"+cont+"</td>";
            contenidosss+="<td>"+Element.cod_patrimonial+"</td>";
            contenidosss+="<td>"+Element.denominacion+"</td>";
            contenidosss+="<td>"+Element.id_ambiente+"</td>";
        });
        document.getElementById('contenido').innerHTML = contenidosss;
    } catch (error) {
        console.log('Error:', error);
    }
}