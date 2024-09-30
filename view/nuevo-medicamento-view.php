<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Registrar Medicamento</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
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
                                <label for="codigo" class="form-label">Código</label>
                                <input type="number" class="form-control" id="codigo" name="codigo" placeholder="codigo" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="presentacion" class="form-label">Presentación</label>
                                <input type="text" class="form-control" id="presentacion" name="presentacion" placeholder="presentacion" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Categoria</label>
                                <select name="id_categoria" id="id_categoria" class="form-control" required>
                                <option></option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success">Registrar</button>
                                <a href="<?php BASE_URL ?>medicamento" class="btn btn-success">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php BASE_URL ?>assets/js/functions_medicamento.js"></script>