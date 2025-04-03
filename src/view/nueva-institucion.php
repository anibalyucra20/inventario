<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nueva Institución</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="dni" class="col-3 col-form-label">Código Modular</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="dni" name="dni">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ruc" class="col-3 col-form-label">Ruc</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="ruc" name="ruc">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="apellidos_nombres" class="col-3 col-form-label">Nombre</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="apellidos_nombres" name="apellidos_nombres">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                        <a href="<?php echo BASE_URL;?>instituciones" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_usuario();">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_usuario.js"></script>
<script>
    datos_form();
</script>
<!-- end page title -->