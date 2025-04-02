<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sedes</h4>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-new">+ Nuevo</button>
                <div class="modal fade bd-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="myLargeModalLabel">Registrar Periodo Academico</h5>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="frmRegistrar">
                                    <div class="form-group row mb-2">
                                        <label for="codigoModular" class="col-3 col-form-label">Código Modular</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="codigoModular" name="codigoModular" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="nombre" class="col-3 col-form-label">Nombre</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="departamento" class="col-3 col-form-label">Departamento</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="departamento" name="departamento" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="provincia" class="col-3 col-form-label">Provincia</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="provincia" name="provincia" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="distrito" class="col-3 col-form-label">Distrito</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="distrito" name="distrito" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="direccion" class="col-3 col-form-label">Dirección</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="telefono" class="col-3 col-form-label">Teléfono</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="correo" class="col-3 col-form-label">Correo Electrónico</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="correo" name="correo" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="responsable" class="col-3 col-form-label">Responsable</label>
                                        <div class="col-sm-9 mb-2 mb-sm-0">
                                            <select class="form-control form-control-user" id="responsable" name="responsable"></select>
                                            <option value="Seleccione"></option>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 justify-content-end row text-center">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_sede();">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div id="tablas"></div>
                <div id="modals_editar"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL;?>src/view/js/functions_sede.js"></script>
<script>
    listar_sedes();
    listar_director();
</script>
<!-- end page title -->