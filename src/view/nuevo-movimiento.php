<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Movimiento</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="ambiente_origen" class="col-3 col-form-label">Ambiente de Origen:</label>
                        <input type="hidden" id="sede_actual_filtro" value="0">
                        <div class="col-9">
                            <select class="form-control" name="ambiente_origen" id="ambiente_origen">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ambiente_destino" class="col-3 col-form-label">Ambiente Destino:</label>
                        <input type="hidden" id="sede_actual_filtro" value="0">
                        <div class="col-9">
                            <select class="form-control" name="ambiente_destino" id="ambiente_destino">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="descripcion" class="col-3 col-form-label">Descripción</label>
                        <div class="col-9">
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="detalle" class="col-3 col-form-label">Detalle de bienes : </label>
                        <input type="hidden" id="detalle_bienes" name="detalle_bienes">
                        <div class="col-9">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center">
                                            Lista de Bienes
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_agregar">+ Agregar</button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Código</th>
                                        <th>Denominación</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>548412</td>
                                        <td>MOnistor integrado all in one</td>
                                        <td><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>movimientos" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_usuario();">Registrar</button>
                        </div>
                    </div>
                </form>
                <div class="modal fade modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title h5" id="myLargeModalLabel">Agregar Bien a Movimiento</h6>
                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="frmAgregarBienes">
                                    <div class="form-group row mb-2">
                                        <label for="codigo_patrimonial" class="col-3 col-form-label">Código Patrimonial y/o denominación:</label>
                                        <div class="col-6">
                                            <input type="text" name="codigo_patrimonial" id="codigo_patrimonial" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            <button type="button" class="btn btn-primary" onclick="fn_buscar_bien_movimiento();"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <table class="table table-bordered" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Código Patrimonial</th>
                                                    <th>Denominación</th>
                                                    <th>Ambiente</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detalle_busqueda_bienes">
                                                <tr>
                                                    <td>105515</td>
                                                    <td>BIEN PRUEBA</td>
                                                    <td>103</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="form-group mb-0 justify-content-end row text-center">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_movimiento.js"></script>
<script>
    datos_form();
</script>
<!-- end page title -->