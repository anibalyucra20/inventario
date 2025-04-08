<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">REGISTRAR NUEVO BIEN</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="ambiente" class="col-3 col-form-label">Ambiente:</label>
                        <input type="hidden" id="sede_actual_filtro" value="0">
                        <div class="col-9">
                            <select class="form-control" name="ambiente" id="ambiente">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="cod_patrimonial" class="col-3 col-form-label">Código Patrimonial</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="cod_patrimonial" name="cod_patrimonial">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="denominacion" class="col-3 col-form-label">Denominación</label>
                        <div class="col-9">
                            <textarea name="denominacion" id="denominacion" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="marca" class="col-3 col-form-label">Marca</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="marca" name="marca">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="modelo" class="col-3 col-form-label">Modelo</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="modelo" name="modelo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tipo" class="col-3 col-form-label">Tipo</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="tipo" name="tipo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="color" class="col-3 col-form-label">Color</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="serie" class="col-3 col-form-label">Serie</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="serie" name="serie">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="dimensiones" class="col-3 col-form-label">Dimensiones</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="dimensiones" name="dimensiones">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="valor" class="col-3 col-form-label">Valor</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="valor" name="valor">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="situacion" class="col-3 col-form-label">Situación</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="situacion" name="situacion">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="estado_conservacion" class="col-3 col-form-label">Estado de Conservación</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="estado_conservacion" name="estado_conservacion">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="observaciones" class="col-3 col-form-label">Observaciones</label>
                        <div class="col-9">
                            <textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>bienes" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_bien();">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_bien.js"></script>
<script>
    datos_form();
</script>
<!-- end page title -->