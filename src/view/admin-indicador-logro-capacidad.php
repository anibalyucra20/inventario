<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Indicadores de Logro de Capacidad</h4>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-new">+ Nuevo</button>
                <a href="<?php echo BASE_URL; ?>admin/capacidad" class="btn btn-danger">Regresar</a>
                <div class="modal fade bd-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Registrar Indicador de Logro de Capacidad</h5>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <div class="form-group row mb-2">
                                        <label for="descripcion" class="col-3 col-form-label">Descripción</label>
                                        <div class="col-9">
                                            <textarea class="form-control" rows="10" name="descripcion" id="descripcion"></textarea>
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
                            <th>Código</th>
                            <th>Capacidad</th>
                            <th>Cód. Indicador de Logro</th>
                            <th>Indicador de Logro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>C1</td>
                            <td>Desarrollar algoritmos computacionales, de acuerdo a las especificaciones de las etapas de desarrollo de software.</td>
                            <td>I1</td>
                            <td>Explica la estructura de un programa, de acuerdo a los métodos de algoritmos computacionales.</td>
                            <td class="row">
                                <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-edit"><i class="fa fa-edit"> Editar</i></button>
                            </td>
                            <div class="modal fade bd-example-modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h4" id="myLargeModalLabel">Editar Indicador de Logro de Capacidad</h5>
                                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal">
                                                <div class="form-group row mb-2">
                                                    <label for="codigo" class="col-3 col-form-label">Código</label>
                                                    <div class="col-9">
                                                        <input type="text" name="codigo" id="codigo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-2">
                                                    <label for="descripcion" class="col-3 col-form-label">Descripción </label>
                                                    <div class="col-9">
                                                        <textarea class="form-control" rows="10" name="descripcion" id="descripcion"></textarea>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->