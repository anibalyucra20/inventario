<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Token API</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="busqueda_tabla_cliente" class="col-3 col-form-label">Cliente</label>
                        <div class="col-9">
                            <select class="form-control" name="cliente" id="busqueda_tabla_cliente">
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                        <a href="<?php echo BASE_URL;?>api-token" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_token();">Generar TOKEN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_api_token.js"></script>
<script>
    cargar_clientes();
</script>
<!-- end page title -->