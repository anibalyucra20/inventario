<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Unidades de Competencia</h4>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-new">+ Nuevo</button>
                <div class="modal fade bd-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Registrar Unidad de Competencia</h5>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                            <th>Programa de Estudio</th>
                            <th>Módulo</th>
                            <th>Tipo de Competencia</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DPW</td>
                            <td>M1</td>
                            <td>ESPECIFICA</td>
                            <td>UC1</td>
                            <td>Desarrollar la construcción de programas de los sistemas de información, de acuerdo al diseño funcional, estándares internacionales de TI, buenas prácticas de programación y políticas de seguridad de la organización</td>
                            <td class="row">
                                <a href="<?php echo BASE_URL; ?>admin/editar-competencia" class="btn btn-success m-1"><i class="fa fa-edit"></i></a> 
                                <a href="<?php echo BASE_URL; ?>admin/indicador-logro-competencia" class="btn btn-primary m-1"><i class="fa fa-sitemap"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->