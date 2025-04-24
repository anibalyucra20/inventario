<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Ingreso de Bienes</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="descripcion" class="col-3 col-form-label">Descripción</label>
                        <div class="col-9">
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="detalle" class="col-3 col-form-label">Detalle de bienes : </label>
                        <div class="col-9">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="5" class="text-center">
                                            Lista de Bienes
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_agregar">+ Agregar</button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Código Patrimonial</th>
                                        <th>Denominación</th>
                                        <th>Ambiente</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="contenido_bienes_tabla_ingresos">

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL; ?>bienes" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_ingreso();">Registrar</button>
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
                                        <label for="ambiente" class="col-3 col-form-label">Ambiente:</label>
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
                                    <br>
                                    <div class="form-group mb-0 justify-content-end row text-center">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancelar</button>
                                            <button type="reset" class="btn btn-info waves-effect waves-light">Limpiar</button>
                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="agregar_bien_ingreso();">Registrar</button>
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
<script src="<?php echo BASE_URL; ?>src/view/js/functions_bien.js"></script>
<script>
    datos_form();
    var lista_bienes_registro = [];
    var v_ambientes;
</script>
<!-- end page title -->