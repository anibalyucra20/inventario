    async function getProductos() {
    try {
      let resp = await fetch(base_url + 'control/Producto.php?op=listar');
      json = await resp.json();
      if (json.status) {
        let data = json.data;
        let cont =0;
        data.forEach(item => {
          let newtr = document.createElement("tr");
          newtr.id = "row_" + item.id;
          cont ++;
          newtr.innerHTML = `
                  <th scope="row">${cont}</th>
                  <td>${item.codigo}</td>
                  <td>${item.nombre}</td>
                  <td>${item.presentacion}</td>
                  <td>${item.stock}</td>
                  <td>${item.fecha_vencimiento}</td>
                  <td>${item.options}</td>
          `;
          document.querySelector('#tblUsuario').appendChild(newtr);
        });
      }
      console.log(json);
    } catch (error) {
      console.log('Ocurrio error al cargar usuario ' + error);
    }
  
  }
  if (document.querySelector('#tblUsuario')) {
    getProductos();
  }
