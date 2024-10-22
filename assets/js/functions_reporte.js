async function reporte_farmacia() {
    let usuario = document.querySelector('#id_usu_sesion').value;
    let fecha_reporte = document.querySelector('#fecha_reporte').value;
    const formData = new FormData();
    formData.append('id_usuario', usuario);
    formData.append('fecha', fecha_reporte);
    try {
        let resp = await fetch(base_url + 'control/Farmacia.php?op=reporte', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        let caja = document.querySelector('#contenido_reporte_farmacia');
        if (json.status) {
            let data = json.data;
            let content = ``;
            let cont = 0;
            data.forEach(item=> {
                cont++;
                console.log();

                content +=`
                <table border="1" cellpadding="4" cellspacing="0" width="100%">
            <tr>
                <th>N. Atención</th>
                <th>Fecha</th>
                <th>CIA</th>
                <th>GRADO</th>
                <th>DNI/CIP</th>
                <th>EDAD</th>
                <th colspan="2">APELLIDOS Y NOMBRES</th>
            </tr>
            <tr>
                <td rowspan="2">${cont}</td>
                <td>${item.fecha}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="2">DIAGNOSTICO</th>
                <td colspan="3"></td>
                <th>PERSONAL</th>
                <td></td>
            </tr>
            <tr>
                <th colspan="3">TRATAMIENTO</th>
                <th>PPT</th>
                <th>CANTIDAD</th>
                <th>X HORAS</th>
                <th>X DIAS</th>
                <th>VIA DE ADMINISTRACION</th>
            </tr>
            <tr>
                <td colspan="3">${item.datos_tratamiento.nombre}</td>
                <td>${item.datos_tratamiento.presentacion}</td>
                <td>${item.datos_tratamiento.cantidad}</td>
                <td>${item.datos_tratamiento.por_hora}</td>
                <td>${item.datos_tratamiento.por_dia}</td>
                <td>${item.datos_tratamiento.via_administracion}</td>
            </tr>
    </table>
    <br>
                `;
            });
            caja.innerHTML = content;
        } else {
            caja.innerHTML = '';
        }
        console.log(json);

    } catch (e) {
        console.log('Ocurrio error al cargar consulta ' + e);
    }
}
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
        let caja = document.querySelector('#contenido_reporte_consulta');
        if (json.status) {
            let data = json.data;

            let content = ``;
            let cont = 0;
            data.forEach(item => {
                cont++;
                let tratamientos = ``;
                let cont_t = 0;
                item.datos_tratamiento.forEach(trata =>{
                    cont_t ++;
                    tratamientos += `${cont_t}.- ${trata.nombre} - ${trata.cantidad} - cada ${trata.por_hora} horas X ${trata.por_dia} dias <br>`;
                })
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
    <td colspan="4">${tratamientos}</td>
</tr>
</table><br>
                `
            });
            caja.innerHTML = content;
        } else {
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



function imprimir_reporte() {
    var element = document.getElementById('imprimir_form');
    
    html2pdf(element);
}