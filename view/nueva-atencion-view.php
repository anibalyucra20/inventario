<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Nueva Consulta</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <form id="frmRegistro" class="form-horizontal form-label-left" autocomplete="off">
                            <div class="form-group">
                                <label for="codigo" class="form-label col-md-3">Código de Consulta:</label>
                                <input type="hidden" id="id_consulta" name="id_consulta">
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-md-6" id="codigo"placeholder="Ingresa Código" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-info col-md-2" onclick="buscar_consulta();"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paciente" class="form-label col-md-3">Paciente:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="paciente" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="motivo_c" class="form-label col-md-3">Motivo de consulta:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="motivo_c" id="motivo_c" cols="30" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="diagnostico_c" class="form-label col-md-3">Diagnóstico:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="diagnostico_c" id="diagnostico_c" cols="30" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="diagnostico_c" class="form-label col-md-3">Tratamiento:</label>
                                <div class="col-md-9">
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
                                <button type="submit" class="btn btn-success">Registrar</button>
                                <a href="<?php echo BASE_URL ?>consultorio" class="btn btn-success">Cancelar</a>
                            </div>
                        </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php BASE_URL ?>assets/js/functions_farmacia.js"></script>
<script>
</script>