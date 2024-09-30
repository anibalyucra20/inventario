async function getUsuarios(){
    try {
        let resp = await fetch(base_url + 'control/Usuario.php?op=listar');
        json = await resp.json();
        if (json.status) {
            let data = json.data;
            let cont = 0;
            data.forEach(item => {
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.id;
                cont++;
                newtr.innerHTML=`
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

getUsuarios();