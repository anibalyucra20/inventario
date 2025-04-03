<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Bien</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="busqueda_tabla_sede" class="col-3 col-form-label">Ambiente:</label>
                        <input type="hidden" id="sede_actual_filtro" value="0">
                        <div class="col-9">
                            <select class="form-control" name="busqueda_tabla_sede" id="busqueda_tabla_sede">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Código Patrimonial</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="detalle" class="col-3 col-form-label">Denominación</label>
                        <div class="col-9">
                            <textarea name="detalle" id="detalle" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Marca</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Modelo</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Tipo</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Color</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Serie</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Dimensiones</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Valor</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Situación</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Estado de Conservación</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="otros_detalle" class="col-3 col-form-label">Observaciones</label>
                        <div class="col-9">
                            <textarea name="otros_detalle" id="otros_detalle" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>bienes" class="btn btn-light waves-effect waves-light">Regresar</a>
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