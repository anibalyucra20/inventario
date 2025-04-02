<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Editar Unidad de Competencia</h4>
                <br>
                <form class="form-horizontal">
                    <div class="form-group row mb-2">
                        <label for="pe" class="col-3 col-form-label">Programa de Estudio</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="pe">
                                <option value=""></option>
                                <option value="">DPW</option>
                                <option value="">ET</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="modulo" class="col-3 col-form-label">Módulo Formativo</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="modulo">
                                <option value=""></option>
                                <option value="">I</option>
                                <option value="">II</option>
                                <option value="">III</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="tipo" class="col-3 col-form-label">Tipo de Competencia</label>
                        <div class="col-9">
                            <select class="form-control form-control-user" id="tipo">
                                <option value=""></option>
                                <option value="">ESPECIFICA</option>
                                <option value="">EMPLEABILIDAD</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="codigo" class="col-3 col-form-label">Código </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="descripcion" class="col-3 col-form-label">Descripción </label>
                        <div class="col-9">
                            <textarea name="descripcion" id="descripcion" style="width:100%;" class="form-control" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>admin/competencia" type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light">Guardar</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
<!-- end page title -->