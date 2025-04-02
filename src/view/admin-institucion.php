<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">DATOS INSTITUCIONALES</h4>
                <br>
                <form class="form-horizontal">
                    <div class="form-group row mb-2">
                        <label for="cod_modular" class="col-3 col-form-label">Código Modular </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="cod_modular">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ruc" class="col-3 col-form-label">Ruc </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="ruc">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nombre" class="col-3 col-form-label">Nombre de Institución </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="nombre">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="dep" class="col-3 col-form-label">Departamento </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="dep">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="provincia" class="col-3 col-form-label">Provincia </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="provincia">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="distrito" class="col-3 col-form-label">Distrito </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="distrito">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="direccion" class="col-3 col-form-label">Dirección </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="direccion">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="telefono" class="col-3 col-form-label">Teléfono </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="telefono">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-3 col-form-label">Correo </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="resolucion" class="col-3 col-form-label">Resolución </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="resolucion">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" id="btn_guardar">Guardar</button>
                            <button type="button" class="btn btn-warning" id="btn_cancelar" onclick="desactivar_controles(); cancelar();">Cancelar</button>
                        </div>
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-success" id="btn_editar" onclick="activar_controles();">Editar Datos</button>
                    </div>
                </form>

                <script type="text/javascript">
                    function desactivar_controles() {
                        document.getElementById('cod_modular').disabled = true
                        document.getElementById('ruc').disabled = true
                        document.getElementById('nombre').disabled = true
                        document.getElementById('dep').disabled = true
                        document.getElementById('provincia').disabled = true
                        document.getElementById('distrito').disabled = true
                        document.getElementById('direccion').disabled = true
                        document.getElementById('telefono').disabled = true
                        document.getElementById('email').disabled = true
                        document.getElementById('resolucion').disabled = true
                        document.getElementById('btn_cancelar').style.display = 'none'
                        document.getElementById('btn_guardar').style.display = 'none'
                        document.getElementById('btn_editar').style.display = ''
                    };

                    function activar_controles() {
                        document.getElementById('cod_modular').disabled = false
                        document.getElementById('ruc').disabled = false
                        document.getElementById('nombre').disabled = false
                        document.getElementById('dep').disabled = false
                        document.getElementById('provincia').disabled = false
                        document.getElementById('distrito').disabled = false
                        document.getElementById('direccion').disabled = false
                        document.getElementById('telefono').disabled = false
                        document.getElementById('email').disabled = false
                        document.getElementById('resolucion').disabled = false
                        document.getElementById('btn_cancelar').removeAttribute('style')
                        document.getElementById('btn_guardar').removeAttribute('style')
                        document.getElementById('btn_editar').style.display = 'none'
                    };

                    function cancelar() {
                        document.getElementById('myform').reset();
                    }

                    window.onload = function() {
                        desactivar_controles();
                    };
                </script>

            </div>
        </div>
    </div>
</div>
<!-- end page title -->