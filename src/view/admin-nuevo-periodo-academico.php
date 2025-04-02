<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Nuevo Periodo Academico</h4>
                <br>
                <form class="form-horizontal" id="frmRegistrar">
                    <div class="form-group row mb-2">
                        <label for="anio" class="col-3 col-form-label">Periodo Académico</label>
                        <?php $anio = date("Y") - 2; ?>
                        <div class="col-sm-4 mb-2 mb-sm-0">
                            <select class="form-control form-control-user" id="anio" name="anio">
                                <option value=""></option>
                                <?php for ($i = 0; $i <= 5; $i++) { ?>
                                    <option value="<?php echo $anio + $i; ?>"><?php echo $anio + $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control form-control-user" id="semestre" name="semestre">
                                <option value=""></option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="fecha_inicio" class="col-3 col-form-label">Fecha de Inicio</label>
                        <div class="col-9">
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de Inicio">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="fecha_fin" class="col-3 col-form-label">Fecha de Fin</label>
                        <div class="col-9">
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Fecha de Fin">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="director" class="col-3 col-form-label">Director</label>
                        <div class="col-sm-9 mb-2 mb-sm-0">
                            <select class="form-control form-control-user" id="director" name="director"></select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="fecha_actas" class="col-3 col-form-label">Fecha para Actas</label>
                        <div class="col-9">
                            <input type="date" class="form-control" id="fecha_actas" name="fecha_actas" placeholder="Fecha para Actas">
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row text-center">
                        <div class="col-12">
                            <a href="<?php echo BASE_URL;?>admin/periodo-academico" class="btn btn-light waves-effect waves-light">Regresar</a>
                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_periodo();">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL;?>src/view/js/functions_periodoAcademico.js"></script>  
<script>
    listar_director();
</script>
<!-- end page title -->