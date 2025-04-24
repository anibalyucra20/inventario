<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Ambiente</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="encargado" class="col-3 col-form-label">Usuario encargado :</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="encargado" name="encargado" placeholder="DNI, apellidos y nombres">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Código</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="detalle" class="col-3 col-form-label">Detalle</label>
                        <div class="col-9">
                            <textarea name="detalle" id="detalle" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="otros_detalle" class="col-3 col-form-label">Otros detalles</label>
                        <div class="col-9">
                            <textarea name="otros_detalle" id="otros_detalle" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>ambientes" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_ambiente();">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_ambiente.js"></script>
<!-- end page title -->