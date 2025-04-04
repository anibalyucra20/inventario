<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Usuario</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="dni" class="col-3 col-form-label">DNI</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="dni" name="dni">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="apellidos_nombres" class="col-3 col-form-label">Apellidos y Nombres</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="apellidos_nombres" name="apellidos_nombres">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="correo" class="col-3 col-form-label">Correo Electrónico</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="telefono" class="col-3 col-form-label">Teléfono </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                    </div>         
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                        <a href="<?php echo BASE_URL;?>usuarios" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_usuario();">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_usuario.js"></script>
<!-- end page title -->