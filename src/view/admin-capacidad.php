<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Capacidades</h4>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-new">+ Nuevo</button>
                <div class="modal fade bd-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Registrar Capacidad</h5>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <div class="form-group row mb-2">
                                        <label for="programa" class="col-3 col-form-label">Programa de Estudios</label>
                                        <div class="col-sm-9 mb-2 mb-sm-0">
                                            <select class="form-control form-control-user" id="programa">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="modulo" class="col-3 col-form-label">Módulo Formativo</label>
                                        <div class="col-sm-9 mb-2 mb-sm-0">
                                            <select class="form-control form-control-user" id="modulo">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="unidad" class="col-3 col-form-label">Unidad Didáctica</label>
                                        <div class="col-sm-9 mb-2 mb-sm-0">
                                            <select class="form-control form-control-user" id="unidad">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="competencia" class="col-3 col-form-label">Competencia</label>
                                        <div class="col-sm-9 mb-2 mb-sm-0">
                                            <select class="form-control form-control-user" id="competencia">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="codigo" class="col-3 col-form-label">Código</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="codigo" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="descripcion" class="col-3 col-form-label">Descripcion</label>
                                        <div class="col-9">
                                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 justify-content-end row text-center">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-success waves-effect waves-light">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <table id="example" class="table dt-responsive " width="100%">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Programa de Estudios</th>
                            <th>Módulo</th>
                            <th>Semestre</th>
                            <th>Unidad Didáctica</th>
                            <th>Créditos</th>
                            <th>Horas</th>
                            <th>Tipo</th>
                            <th>Orden</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2024-I</td>
                            <td>2024-02-01</td>
                            <td>2024-09-30</td>
                            <td>usu</td>
                            <td>2024-08-31</td>
                            <td>usu</td>
                            <td>2024-08-31</td>
                            <td>usu</td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>admin/editar-capacidad" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo BASE_URL; ?>admin/indicador-logro-capacidad" class="btn btn-primary"><i class="fa fa-sitemap"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->