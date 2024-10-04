<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Registrar Usuario</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="frmRegistro">
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI :</label>
                                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" required>
                            </div>
                            <div class="mb-3">
                                <label for="cip" class="form-label">CIP (opcional):</label>
                                <input type="text" class="form-control" id="cip" name="cip" placeholder="CIP">
                            </div>
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Apellidos y Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Apellidos y Nombres" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento: </label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="genero" class="form-label">Género:</label>
                                <select name="genero" id="genero" class="form-control" required>
                                <option></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="talla" class="form-label">Talla (cm)</label>
                                <input type="number" class="form-control" id="talla" name="talla" required>
                            </div>
                            <div class="mb-3">
                                <label for="peso" class="form-label">Peso (kg):</label>
                                <input type="number" class="form-control" id="peso" name="peso" required>
                            </div>
                            <div class="mb-3">
                                <label for="grado" class="form-label">Grado (opcional):</label>
                                <input type="text" class="form-control" id="grado" name="grado" >
                            </div>
                            <div class="mb-3">
                                <label for="cia" class="form-label">CIA (opcional):</label>
                                <input type="text" class="form-control" id="cia" name="cia" >
                            </div>
                            <div class="mb-3">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                                <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                                <option></option>
                                <option value="paciente">Paciente</option>
                                <option value="consultorio">Usuario de Consultorio</option>
                                <option value="farmacia">Usuario de Farmacia</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success">Registrar</button>
                                <a href="<?php BASE_URL ?>usuarios" class="btn btn-success">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php echo BASE_URL; ?>assets/js/functions_usuarios.js"></script>