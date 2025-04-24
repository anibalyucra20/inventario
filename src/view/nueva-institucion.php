<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nueva Institución</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="beneficiario" class="col-3 col-form-label">Beneficiario:</label>
                        <div class="col-9">
                            <select class="form-control" name="beneficiario" id="beneficiario">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="cod_modular" class="col-3 col-form-label">Código Modular</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="cod_modular" name="cod_modular">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ruc" class="col-3 col-form-label">Ruc</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="ruc" name="ruc">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nombre" class="col-3 col-form-label">Nombre</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>instituciones" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_institucion();">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_institucion.js"></script>
<script>
    datos_form();
</script>
<!-- end page title -->