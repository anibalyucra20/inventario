<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Editar Capacidad</h4>
                <br>
                <form class="form-horizontal">
                    <div class="form-group row mb-2">
                        <label for="programa" class="col-3 col-form-label">Programa de Estudios</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="programa">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="modulo" class="col-3 col-form-label">Módulo Formativo</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="modulo">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="unidad" class="col-3 col-form-label">Unidad Didáctica</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="unidad">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="competencia" class="col-3 col-form-label">Competencia</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="competencia">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Código</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="descripcion" class="col-3 col-form-label">Descripción </label>
                        <div class="col-9">
                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>admin/capacidad" type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->