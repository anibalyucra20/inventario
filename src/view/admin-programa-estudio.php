<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Programas de Estudio</h4>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-new">+ Nuevo</button>
                <div class="modal fade bd-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Registrar Programa de Estudio</h5>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <div class="form-group row mb-2">
                                        <label for="codigo" class="col-3 col-form-label">Código</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="codigo">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="tipo" class="col-3 col-form-label">Tipo</label>
                                        <div class="col-9">
                                            <select class="form-control form-control-user" id="tipo">
                                                <option value=""></option>
                                                <option value="">MODULAR</option>
                                                <option value="">TRANSVERSAL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="anio_plan" class="col-3 col-form-label">Plan de Estudios(año)</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="anio_plan">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="nombre" class="col-3 col-form-label">Nombre </label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="nombre">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="resolucion" class="col-3 col-form-label">Resolución de Creación </label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="resolucion">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="perfil_egresado" class="col-3 col-form-label">Perfil de Egresado </label>
                                        <div class="col-9">
                                            <textarea name="perfil_egresado" id="perfil_egresado" style="width:100%;" class="form-control" rows="10"></textarea>
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
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Plan de Estudio</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DPW</td>
                            <td>Modular</td>
                            <td>2021</td>
                            <td>DISEÑO Y PROGRAMACION WEB</td>
                            <td>
                                <a href="" class="btn btn-success" waves-effect waves-light data-toggle="modal" data-target=".bd-example-modal-edit"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <div class="modal fade bd-example-modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h4" id="myLargeModalLabel">Editar Programa de Estudio</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal">
                                    <div class="form-group row mb-2">
                                        <label for="codigo" class="col-3 col-form-label">Código</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="codigo">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="tipo" class="col-3 col-form-label">Tipo</label>
                                        <div class="col-9">
                                            <select class="form-control form-control-user" id="tipo">
                                                <option value=""></option>
                                                <option value="">MODULAR</option>
                                                <option value="">TRANSVERSAL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="anio_plan" class="col-3 col-form-label">Plan de Estudios(año)</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="anio_plan">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="nombre" class="col-3 col-form-label">Nombre </label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="nombre">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="resolucion" class="col-3 col-form-label">Resolución de Creación </label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="resolucion">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="perfil_egresado" class="col-3 col-form-label">Perfil de Egresado </label>
                                        <div class="col-9">
                                            <textarea name="perfil_egresado" id="perfil_egresado" style="width:100%;" class="form-control" rows="10"></textarea>
                                        </div>
                                    </div>
                                        <div class="form-group mb-0 justify-content-end row text-center">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->