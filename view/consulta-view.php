<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ver Consulta</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <form id="frmRegistro" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label for="dni" class="form-label col-md-3">Dni (paciente):</label>
                                <input type="hidden" id="id_consulta" name="id_consulta">
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-md-6" id="dni"placeholder="DNI" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-info col-md-2" onclick="buscarUsuarioDni();"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paciente" class="form-label col-md-3">Paciente:</label>
                                <div class="col-md-9">
                                    <input type="hidden" id="id_paciente" name="id_paciente">
                                    <input type="hidden" id="id_usuario" name="id_usuario" value="<">
                                    <input type="text" class="form-control" id="paciente" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="motivo_c" class="form-label col-md-3">Motivo de consulta:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="motivo_c" id="motivo_c" cols="30" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="diagnostico_c" class="form-label col-md-3">Diagnóstico:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="diagnostico_c" id="diagnostico_c" cols="30" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="diagnostico_c" class="form-label col-md-3">Tratamiento:</label>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></button>

                                </div>

                                <div class="col-md-8">
                                    <div class="x_content">
                                        <table class="table table-striped" id="tbl_tratamientos_consulta">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Medicamento</th>
                                                    <th>cantidad</th>
                                                    <th>Por hora</th>
                                                    <th>Por dia</th>
                                                    <th>Vía de Adm.</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblTratamiento">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                                <a href="<?php echo BASE_URL ?>consultorio" class="btn btn-success">Cancelar</a>
                            </div>
                        </form>
                        <!-- Small modal -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Tratamiento</h4>
                                    </div>
                                    <form id="frm_tratamiento" class="form-horizontal form-label-left">
                                        <br>
                                        <div class="form-group">
                                            <label for="bmedicamento" class="form-label col-md-3">Medicamento:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control col-md-6" id="bmedicamento" name="bmedicamento" required onkeyup="buscar_medicamento();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="id_medicamento_frm" name="id_medicamento_frm">
                                            <label class="form-label col-md-3"></label>
                                            <div class="col-md-9">
                                                <ul id="listaproductos">
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="cantidad_c" class="form-label col-md-3">Cantidad:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="cantidad_c" id="cantidad_c" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="frecuencia_c" class="form-label col-md-3">Frecuencia x Hora:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="frecuencia_c" id="frecuencia_c" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dias_c" class="form-label col-md-3">Cantidad de días:</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="dias_c" id="dias_c" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="via_c" class="form-label col-md-3">Vía de Administración:</label>
                                            <div class="col-md-9">
                                                <select name="via_c" id="via_c" class="form-control" required>
                                                    <option></option>
                                                    <option value="Oral">Oral</option>
                                                    <option value="Intra Muscular">Intra Muscular</option>
                                                    <option value="Intra Venosa">Intra Venosa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>

                                    </form>



                                </div>
                            </div>
                        </div>
                        <!-- /modals -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php echo BASE_URL ?>assets/js/functions_consulta.js"></script>
<script>
    const id="<?php $pagina=explode("/", $_GET['views']); echo $pagina['1']?>";
    mostrar_consulta(id);
</script>