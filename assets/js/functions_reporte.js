async function reporte_consultas() {
    let usuario = document.querySelector('#id_usu_sesion').value;
    let fecha_reporte = document.querySelector('#fecha_reporte').value;
    const formData = new FormData();
    formData.append('id_usuario', usuario);
    formData.append('fecha', fecha_reporte);
    try {
        let resp = await fetch(base_url + 'control/Consultorio.php?op=reporte', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        let caja = document.querySelector('#imprimir_form');
        if (json.status) {
            let data = json.data;
            
            let content = ``;
            let cont = 0;
            let tratamientos = '';
            pp = '';
            data.forEach(item => {
                tratamientos =  buscar_tratamiento(item.id).then(function(resultadoActual){ 
                    return resultadoActual.data;
                 });
                tratamientos.then(function (result) {
                    console.log(result);
                });
                console.log(pp);
                //tratamientos.then(function(actualResult) { console.log(actualResult); });
                cont++;
                content += `
                
<table border="1" cellpadding="4" cellspacing="0" width="100%">
<tr>
    <th rowspan="5">${cont}</th>
    <th colspan="3">NOMBRES Y APELLIDOS DEL PACIENTE</th>
    <td colspan="3">${item.apellidos_nombres}</td>
    <th colspan="2">FECHA DE NACIMIENTO</th>
    <td></td>
</tr>
<tr>
    <th>FECHA</th>
    <th>DNI/CIP</th>
    <th>EDAD</th>
    <th>CIA</th>
    <th>GRADO</th>
    <th>SEXO</th>
    <th>TALLA</th>
    <th>PESO</th>
    <th>DIAGNOSTICO</th>
</tr>
<tr>
    <td>${item.fecha_hora}</td>
    <td>${item.dni}</td>
    <td>${item.edad}</td>
    <td>${item.cia}</td>
    <td>${item.grado}</td>
    <td>${item.genero}</td>
    <td>${item.talla}</td>
    <td>${item.peso}</td>
    <td>${item.diagnostico}</td>
</tr>
<tr>
    <th colspan="5">MOTIVO DE CONSULTA</th>
    <th colspan="4">TRATAMIENTO</th>
</tr>
<tr>
    <td colspan="5">${item.motivo_consulta}</td>
    <td colspan="4">${pp}</td>
</tr>
</table><br>
                `
            });
            caja.innerHTML = content;
        }else{
            caja.innerHTML = '';
        }
        console.log(json);

    } catch (e) {
        console.log('Ocurrio error al cargar consulta ' + e);
    }
}
if (document.querySelector('#imprimir_form')) {
    reporte_consultas();
}


async function buscar_tratamiento(id) {
    const form_2 = new FormData();
    form_2.append('id_consulta', id);
    
    try {
        let resp_2 = await fetch(base_url + 'control/Tratamiento.php?op=listar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: form_2
        });
        json_2 = await resp_2.json();
        let tratamientos = '';
        if (json_2.status) {
            let data_2 = json_2.data;
            data_2.forEach(item => {
                tratamientos = item.nombre;
            })
        }
        
        //console.log(json_2);
        return json_2;
    } catch (error) {
        console.log('Ocurrio error al cargar tratamientos ' + error);
    }
}
function imprimir_r_consultas() {
    var element = document.getElementById('imprimir_form');
    html2pdf(element);
}