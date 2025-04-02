<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Editar Unidad Didáctica</h4>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group row mb-2">
                            <label for="unidad" class="col-3 col-form-label">Unidad Didáctica</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="unidad" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="programa" class="col-3 col-form-label">Programa de Estudios</label>
                            <div class="col-sm-9 mb-2 mb-sm-0">
                                <select class="form-control form-control-user" id="programa">
                                    <option value="" disabled></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="modulo" class="col-3 col-form-label">Módulo Formativo</label>
                            <div class="col-sm-9 mb-2 mb-sm-0">
                                <select class="form-control form-control-user" id="modulo"></select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="semestre" class="col-3 col-form-label">Semestre</label>
                            <div class="col-sm-9 mb-2 mb-sm-0">
                                <select class="form-control form-control-user" id="semestre"></select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="creditos" class="col-3 col-form-label">Créditos</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="creditos" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="horas" class="col-3 col-form-label">Horas (Semestral)</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="horas" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="tipo" class="col-3 col-form-label">Tipo</label>
                            <div class="col-sm-9 mb-2 mb-sm-0">
                                <select class="form-control form-control-user" id="responsable">
                                    <option value="" disabled></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-0 justify-content-end row text-center">
                            <div class="col-12">
                                <a href="<?php echo BASE_URL; ?>admin/unidad-didactica" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->