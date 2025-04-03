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
                        <div class="col-9">
                            <table style="border: 1px solid black ; width:100%;">
                                <tr>
                                    <th colspan="4" class="text-center">
                                        Lista de Bienes
                                    </th>
                                </tr>
                                <tr>
                                    <th>Nro</th>
                                    <th>Código</th>
                                    <th>Detalle</th>
                                    <th>Acción</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>548412</td>
                                    <td>MOnistor integrado all in one</td>
                                    <td></td>
                                </tr>
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
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_usuario.js"></script>
<script>
    datos_form();
</script>
<!-- end page title -->